<script setup>
import { ref, defineProps, onMounted } from 'vue'
import braintree from 'braintree-web';
import paypal from 'paypal-checkout';
import { useForm } from '@inertiajs/inertia-vue3';


const props = defineProps({
    plan_id: String
});




const hostedFieldInstance = ref(false);
const nonce = ref("");
const error = ref("");
const paymentMethod = ref("");
const loading = ref(true);
const cardLoading = ref(false);
const cardSuccess = ref("");


const createSubscription = (selectedMethod, paymentNonce) => {
    const form = useForm({
        "nonce": paymentNonce,
        "payment_method": selectedMethod,
        'plan_id':props.plan_id

    
    });
    form.post(route('checkout'), {
        onFinish: () => form.reset('nonce', 'payment_method'),
    });
}

const payWithCreditCard = () => {

    if (hostedFieldInstance.value) {

        error.value = "";
        nonce.value = "";
        cardLoading.value = true;

        hostedFieldInstance.value.tokenize().then(payload => {

            nonce.value = payload.nonce;
            paymentMethod.value = 'Credit Card';
            createSubscription('Creadit Card', payload.nonce);
            cardLoading.value = false;
            cardSuccess.value = "Credit card payment request submitted for processing please wait...";


        }).catch(err => {

            error.value = err.message;
        })
    }
}



onMounted(() => {
    braintree.client.create({
        authorization: "sandbox_q7dfqv9r_b6zn3gyf5267n24g"
    })
        .then(clientInstance => {
            let options = {
                client: clientInstance,
                styles: {
                    'input': {
                        'font-size': '18px',

                        'font-family': 'Open Sans',
                        'height': '100%',

                    },
                    '.number': {
                        'font-family': 'monospace',
                    },
                    '.valid': {
                        'color': 'green'
                    }
                },
                fields: {
                    number: {
                        container: '#creditCardNumber',
                        placeholder: 'Enter Credit Card'
                    },
                    cvv: {
                        selector: '#cvv',
                        placeholder: 'Enter CVV'
                    },
                    expirationDate: {
                        selector: '#expireDate',
                        placeholder: '00 / 0000'
                    }
                }
            }

            return Promise.all([
                braintree.hostedFields.create(options),
                braintree.paypalCheckout.create({ client: clientInstance, vault: true })
            ])

        })
        .then(instances => {

            loading.value = false;

            hostedFieldInstance.value = instances[0];
            const paypalCheckoutInstance = instances[1];


            // Setup PayPal Button

            return paypal.Button.render({
                env: 'sandbox',
                style: {
                    label: 'paypal',
                    size: 'responsive',
                    shape: 'rect'
                },
                payment: () => {
                    return paypalCheckoutInstance.createPayment({
                        flow: 'vault',
                        intent: 'capture',
                    })
                },
                onAuthorize: (data, options) => {
                    return paypalCheckoutInstance.tokenizePayment(data).then(payload => {
                        error.value = "";
                        nonce.value = payload.nonce;
                        paymentMethod.value = 'Paypal'
                        createSubscription('Paypal', payload.nonce);
                    })
                },
                onCancel: (data) => {
                    //Payment was canceled.
                    error.value = 'Payment Request was cancelled'
                },
                onError: (err) => {
                    error.value = "An error occurred while processing the paypal payment."+err;
                }
            }, '#paypalButton')
        })
        .catch(err => {

        });
})
</script>


<template>
    <div class="container">
        <div class="col-6 offset-3">
            <div class="alert alert-success" v-if="loading">Loading payment methods please wait...</div>
            <div class="card bg-light">
                <div class="card-header">Choose your preferred payment method below</div>
                <div class="card-body">
                   
                    <div class="alert alert-danger" v-if="error">
                        {{ error }}
                    </div>
                    <div id="paypalButton"></div>
                    <form class="mt-8">
                                    <div class="alert alert-success" v-if="cardSuccess">Payment request sent for processing. Please wait while we validate
                                        payment...</div>

                        <div class="form-group">
                            <label>Credit Card Number</label>
                            <div id="creditCardNumber" class="form-control form-control-lg">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col col-md-6">
                                    <label>Expire Date</label>
                                    <div id="expireDate" class="form-control"></div>
                                </div>
                                <div class="col col-md-6">
                                    <label>CVV</label>
                                    <div id="cvv" class="form-control"></div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" v-model="plan_id" />
                        
                    
                    
                    </form>
                    <button v-if="!cardLoading" class="mt-4 mb-8 btn btn-primary btn-block col-md-6" @click.prevent="payWithCreditCard">
                        <span>Pay with Credit Card</span>
                    
                    </button>
                    <button v-else class="mt-4 mb-8 btn btn-primary btn-block col-md-12" @click.prevent="payWithCreditCard">
                        <span>Sending request please wait...</span>
                    </button>
                    <hr />
                </div>
            </div>

        </div>
    </div>
</template>

<style>

</style>