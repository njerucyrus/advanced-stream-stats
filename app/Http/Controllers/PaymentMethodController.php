<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree\Gateway;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\PaymentMethod;


class PaymentMethodController extends Controller
{
    //
    private $gateway;
    public function __construct()
    {
        $this->gateway =  new Gateway(

            [
                'environment' => env('BRAINTREE_ENVIRONMENT'),
                'merchantId' => env('BRAINTREE_MERCHANT_ID'),
                'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
                'privateKey' => env('BRAINTREE_PRIVATE_KEY')
            ]
        );
    }
    //list all the registered payment methods
    public function index()
    {
        $paymentMethods = PaymentMethod::query()->where('user_id', Auth::id());
        return Inertia::render('PaymentMethods', [
            'payment_methods' => $paymentMethods
        ]);
    }

    public function create(Request $request)
    {
        return Inertia::render('PaymentMethods');
    }
    //create payment method
    public function store(Request $request)
    {
        #check if user has any any payment methods 
        $previousPaymentMethod = PaymentMethod::query()->where('user_id', Auth::id())->first();

        if ($previousPaymentMethod) {
            $customerId = $previousPaymentMethod->customer_id;
        } else {
            $customer = $this->gateway->customer()->create();
            $customerId = $customer->id;
        }


        $nonce = $request->input('nonce');
        $result = $this->gateway->paymentMethod()->create(
            [
                'customerId' => $customerId,
                'paymentMethodNonce' => $nonce
            ]
        );

        if ($result->success) {
            //store payment method locally to our database
            $cardType = "";
            $paypalEmail = "";
            $maskedNumber = "";
            $paymentType = "";

            if ($result->cardType != '') {
                $cardType = $result->cardType;
                $paymentType = 'Credit Card';
                $maskedNumber = $result->maskedNumber;
            } else {
                $paymentType = 'Paypal';
                $paypalEmail = $result->email;
            }

            PaymentMethod::create([
                'user_id' => Auth::id(),
                'customer_id' => $customerId,
                'token' => $result->token,
                'paypal_email' => $paypalEmail,
                'payment_type' => $paymentType,
                'masked_number' => $maskedNumber,
                'image_url' => $result->imageUrl
            ]);
            $message = "Payment method saved successfully";
        } else {
            $message = "An error occurred while creating your payment method";
        }
        $paymentMethods = PaymentMethod::query()->where('user_id', Auth::id());
        return Inertia::render('PaymentMethods', [
            'message' => $message,
            'payment_methods' => $paymentMethods
        ]);

    }

    //remove payment method
    public function delete($token)
    {
        //revoke the payment from braintree
        $this->gateway->paymentMethod()->revoke($token);
        //also delete the payment method from our database
        $paymentMethod = PaymentMethod::query()->where('token', $token);
        $paymentMethod->delete();

        $message = "Payment method has been removed successfully";
        return Inertia::render('PaymentMethods', [
            'message' => $message
        ]);
    }
}
