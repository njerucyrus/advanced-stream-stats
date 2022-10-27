<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
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

    public function showCheckoutForm($planId)
    {
        //show the checkout form
        return Inertia::render('CheckoutPage', [
            'planId' => $planId
        ]);
    }
    public function checkout(Request $request)
    {
        $planId = $request->input('plan_id');
        $nonce = $request->input('nonce');
        $paymentMethodType = $request->input('payment_method');

        //check if we have an existing subscription
        $subscription = Subscription::query()->where(
            [
                'user_id' => Auth::id(),
                'plan_id' => $planId
            ]
        )->first();

        $paymentMethod = null;
        $existingPaymentMethod = PaymentMethod::query()->where('payment_type', $paymentMethodType)->first();
        if ($existingPaymentMethod) {
            $paymentMethod = $existingPaymentMethod;
        } else {

            $customer = $this->gateway->customer()->create([
                'firstName' => Auth::user()->name,
                'lastName' => "",
                'company' => '',
                'email' => Auth::user()->email,
                'phone' => '',
                'fax' => '',
                'website' => ''
            ]);
        
            if ($customer->success) {
                $paymentMethodResult = $this->gateway->paymentMethod()->create(
                    [
                        'customerId' => $customer->customer->id,
                        'paymentMethodNonce' => $nonce,
                    ]
                );
               

                if ($paymentMethodResult->success) {

                    $paymentMethod = PaymentMethod::create(
                        [
                            'user_id' => Auth::id(),
                            'customer_id' => $customer->customer->id,
                            'payment_type' => $paymentMethodType,
                            'masked_number',
                            'paypal_email' => $paymentMethod == 'Paypal' ? $paymentMethodResult->paymentMethod->email : "",
                            'card_image_url' => $paymentMethodResult->paymentMethod->imageUrl,
                            'token' => $paymentMethodResult->paymentMethod->token,
                        ]
                    );

                    $subscriptionResult = $this->gateway->subscription()->create(
                        [
                            'paymentMethodToken' => $paymentMethod->token,
                            'planId' => $planId
                        ]
                    );

                    

                    if ($subscriptionResult->success) {

                        Subscription::create([
                            "plan_id" => $planId,
                            "user_id" => Auth::id(),
                            "subscription_id" => $subscriptionResult->subscription->id

                        ]);

                        $message = "Subscrition created successfully";

                        //redirect the user to Stats Page
                        return redirect(route('stats'))->with('message', $message);
                    } else {
                        return redirect('dashboard')->with('error', 'An error occured while creating subscription please try again later');
                    }
                }
            }
        }

        
        if ($subscription) {

            //use payment method token to create subscription
            $subscriptionResult = $this->gateway->subscription()->create(
                [
                    'paymentMethodToken' => $paymentMethod->token,
                    'planId' => $planId
                ]
            );
           
          

            if ($subscriptionResult->success) {
                //update the subscription
                $subscription->status = 'Active';
                $subscription->plan_id = $planId;
                $subscription->subscription_id = $subscriptionResult->subscription->id;
                $subscription->save();
                $message = "Subscrition created successfully";

                //redirect the user to Stats Page
                return redirect(route('stats'))->with('message', $message);
            } else {
                $message = "An error occcured while creating subscription please try again later";
                // show the error message.
                return redirect('dashboard')->with('error', 'An error occured while creating subscription please try again later');
            }
            

        } else {
            // this is the first time to subscribe to we will create the subscription

            $subscriptionResult = $this->gateway->subscription()->create(
                [
                    'paymentMethodToken' => $paymentMethod->token,
                    'planId' => $planId
                ]
            );
            
            if ($subscriptionResult->success) {
                $message = "Subscrition created successfully";
                Subscription::create([
                    "plan_id" => $planId,
                    "user_id" => Auth::id(),
                    "subscription_id" => $subscriptionResult->subscription->id

                ]);
                return redirect(route('stats'))->with('message', $message);
            } else {
                return redirect('dashboard')->with('error', 'An error occured while creating subscription please try again later');
            }
        }
    }

    public function cancelSubscription(Request $request)
    {
        $subscriptionId = $request->input('subscription_id');
        $result = $this->gateway->subscription()->cancel($subscriptionId);
        if ($result->success) {
            $subscription = Subscription::query()->when('subscription_id', $subscriptionId)->first();
            $subscription->status = 'Cancelled';
            $subscription->save();
            $message = 'Subscription was cancelled successfully';
            return redirect()->with('message', $message);
        } else {
            $message = 'An error occurred while cancelling your subscription please try again later';
            return redirect()->with('error', $message);
        }
    }

    public function test()
    {
        // $collection = $this->gateway->transaction()->search([
        //     Braintree\TransactionSearch::customerId()->is('the_customer_id'),
        // ]);

        // foreach ($collection as $transaction) {
        //     echo $transaction->amount;
        // }
        $paymentMethod = $this->gateway->paymentMethod()->find('f3hs61wg');
        return response()->json($paymentMethod);

    }
}
