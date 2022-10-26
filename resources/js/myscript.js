
<script>
import braintree from 'braintree-web';
import paypal from 'paypal-checkout';
import { useForm } from '@inertiajs/inertia-vue3';

export default {
    name: "CheckoutUI",
    props: {
        plans: Object,

    },
    data() {
        return {
            hostedFieldInstance: false,
            nonce: "",
            error: "",
            loading: true,
            plan_id: "{{planId}}"

        }
    },
    methods: {
        payWithCreditCard() {
            if (this.hostedFieldInstance) {
                alert(this.createSubscription());
                this.error = "";
                this.nonce = "";

                this.hostedFieldInstance.tokenize().then(payload => {
                    console.log(payload);
                    this.nonce = payload.nonce;

                })
                    .catch(err => {
                        console.error(err);
                        this.error = err.message;
                    })
            }
        },
        createSubscription() {
            const form = useForm({
                'nonce': this.nonce,
                'plandId': planId

            })
            return form;
        },

    },
    mounted() {
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

                this.loading = false;

                const hostedFieldInstance = instances[0];
                const paypalCheckoutInstance = instances[1];

                // Use hostedFieldInstance to send data to Braintree
                this.hostedFieldInstance = hostedFieldInstance;

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
                            // amount: parseFloat(this.amount) > 0 ? this.amount : 1.99,
                            // displayName: 'Braintree Testing',
                            // currency: 'USD'
                        })
                    },
                    onAuthorize: (data, options) => {
                        return paypalCheckoutInstance.tokenizePayment(data).then(payload => {
                            console.log(payload);
                            this.error = "";
                            this.nonce = payload.nonce;
                        })
                    },
                    onCancel: (data) => {
                        console.log(data);
                        console.log("Payment Cancelled");
                    },
                    onError: (err) => {
                        console.error(err);
                        this.error = "An error occurred while processing the paypal payment.";
                    }
                }, '#paypalButton')
            })
            .catch(err => {

            });
    }
}
</script>

