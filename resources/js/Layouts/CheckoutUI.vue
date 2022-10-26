<script setup>
import { ref, defineProps, onMounted } from 'vue'
import braintree from 'braintree-web';
import paypal from 'paypal-checkout';
import { useForm } from '@inertiajs/inertia-vue3';

defineProps({
    plan: Object,
});



const hostedFieldInstance = ref(false);
const nonce = ref("");
const error = ref("");
const loading = ref(true);
const form = useForm({
    "nonce": nonce.value,

})


const payWithCreditCard = () => {
    alert('You clicked credit card payment');
    if (hostedFieldInstance.value) {
        //alert(this.createSubscription());
        error.value = "";
        nonce.value = "";

        this.hostedFieldInstance.tokenize().then(payload => {
            console.log(payload);
            nonce.value = payload.nonce;

        }).catch(err => {
            console.error(err);
            error.value = err.message;
        })
    }
}

const createSubscription = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('nonce'),
    });
}

onMounted(() => {
    braintree.client.create({
        authorization: "sandbox_q7dfqv9r_b6zn3gyf5267n24g"
    })
        .then(clientInstance => {
            let options = {
                client: clientInstance,
                styles: {
                    input: {
                        'font-size': '14px',
                        'font-family': 'Open Sans',
                        'height': '32px',
                        'padding': '0px'
                    }
                },
                fields: {
                    number: {
                        selector: '#creditCardNumber',
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
                        console.log(payload);
                        error.value = "";
                        nonce.value = payload.nonce;
                    })
                },
                onCancel: (data) => {
                    console.log(data);
                    console.log("Payment Cancelled");
                },
                onError: (err) => {
                    console.error(err);
                    error.value = "An error occurred while processing the paypal payment.";
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
                <div class="card-header">Payment Details</div>
                <div class="card-body">
                    <div class="alert alert-success" v-if="nonce">
                        Successfully generated nonce. {{ nonce }}
                    </div>
                    <div class="alert alert-danger" v-if="error">
                        {{ error }}
                    </div>
                    <form>
                        <div class="form-group">
                            <label>Credit Card Number</label>
                            <div id="creditCardNumber" class="form-control" style="padding: -8px;"></div>
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
                        <button class="mt-4 mb-8 btn btn-primary btn-block col-md-6"
                            @click.prevent="createSubscription">Pay
                            with
                            Credi Card</button>
                        <hr />
            
                        <div id="paypalButton"></div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</template>

<style>

</style>