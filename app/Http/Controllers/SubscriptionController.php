<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class SubscriptionController extends Controller
{
    private $gateway;
    public function __construct()
    {
        $this->gateway =  new \Braintree\Gateway(
            [
                'environment' => env('BRAINTREE_ENVIRONMENT'),
                'merchantId' => env('BRAINTREE_MERCHANT_ID'),
                'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
                'privateKey' => env('BRAINTREE_PRIVATE_KEY')
            ]
        );
    }

    public function token(Request $request)
    {
        $clientToken = $this->gateway->clientToken()->generate();
    }

    
}
