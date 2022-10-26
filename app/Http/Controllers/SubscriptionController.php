<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
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
        $planId = $request->input('plan_id');

        //check if we have an existing subscription
        $subscription = Subscription::query()->where(
            [
                'user_id' => Auth::id(),
                'plan_id' => $planId
            ]
        )->first();

        if ($subscription) {
            //user already subscribed so we will update the subscription.
        } else {
            // this is the first time to subscribe to we will create the subscription
        }
       

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
        $paypalToken = 'f3hs61wg';

        // $nonce = "e79cf7a2-2eba-0935-c879-2d9ca18402f4";
        // $result = $this->gateway->paymentMethod()->create([
        //     'customerId' => "204388807",
        //     'paymentMethodNonce' => $nonce,
        // ]);
        $subscription = $this->gateway->subscription()->create([
            'paymentMethodToken' => $paypalToken,
            "planId" => "rc32"
        ]);

        //dd($result);
        // dd($subscription);
        return response()->json($subscription);
    }
}
