<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree\Gateway;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SubscriptionController extends Controller
{
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

    public function token(Request $request)
    {
        $clientToken = $this->gateway->clientToken()->generate();
    }

    public function showSubscriptionForm(Request $request)
    {
        $clientToken = $this->gateway->clientToken()->generate();

        $plans = $this->gateway->plan()->all();
        return Inertia::render('Dashboard', [
            'plans' => $plans,
            'token' => $clientToken
        ]);
    }
    public function createSubscription(Request $request)
    {
        $paymentMethod = $this->gateway->paymentMethod()->find('fsgjht0s');
        // print_r(json_encode($paymentMethod))
        // $customer = $this->gateway->customer()->create([
        //     'firstName' => 'Mike',
        //     'lastName' => 'Jones',
        //     'company' => 'Jones Co.',
        //     'email' => 'mike.jones@example.com',
        //     'phone' => '281.330.8004',
        //     'fax' => '419.555.1235',
        //     'website' => 'http://example.com'
        // ]);
        // dd($customer);

        // $nonce = "tokencc_bj_8pys48_mcnp4v_32qy9p_58mv5g_875";
        // $result = $this->gateway->paymentMethod()->create([
        //     'customerId' => "204388807",
        //     'paymentMethodNonce' => $nonce,
        // ]);
        // $subscription = $this->gateway->subscription()->create([
        //     'paymentMethodToken' => 'fsgjht0s',
        //     "planId" => "bdpr"
        // ]);

        // //dd($result);
        // dd($subscription);
        return response()->json($paymentMethod);
    }
}
