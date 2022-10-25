<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree\Gateway;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

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
        
    }

    public function create(Request $request)
    {
    }
    //create payment method
    public function store()
    {
    }

    //remove payment method
    public function delete()
    {
    }
}
