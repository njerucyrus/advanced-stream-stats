<template>
    <div class="container">
        <div class="alert alert-success" v-if="nonce">
            Successfully generated nonce.
            {{ nonce }}
        </div>
        <form id="cardPaymentForm">
            <div class="form-group">
                <label for="amount">Amount</label>
                <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                    <input type="number" id="amount" class="form-control" placeholder="Enter Amount">
                </div>
            </div>
            <hr />
            <div class="form-group">
                <label>Credit Card Number</label>
                <div id="creditCardNumber" class="form-control"></div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-6">
                        <label>Expire Date</label>
                        <div id="expireDate" class="form-control"></div>
                    </div>
                    <div class="col-6">
                        <label>CVV</label>
                        <div id="cvv" class="form-control"></div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-block" @click.prevent="payWithCreditCard">Pay with Credit Card</button>
        </form>
    </div>

</template>

<script>
import braintree from 'braintree-web';
export default {
    name: "PaymentForm",
    props: {

    },
    data() {
        return {
            hostedFieldInstance: false,
            nonce: ""
        }
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
                            'font-family': 'Open Sans'
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

                return braintree.hostedFields.create(options)
            })
            .then(hostedFieldInstance => {
                this.hostedFieldInstance = hostedFieldInstance;
            })
            .catch(err => {

            });
    },
    methods: {
        payWithCreditCard() {
            if (this.hostedFieldInstance) {
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
        }
    }




}

</script>
