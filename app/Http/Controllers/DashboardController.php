<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Braintree\Gateway;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
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

    public function index()
    {
        $plans = [];
        $subscriptions = Subscription::query()
        ->where('user_id', Auth::id())
        ->where('status', 'Active')
        ->get();

        try {
            $plans = $this->gateway->plan()->all();
        } catch (Exception $ex) {
        }
        if ($subscriptions->count() > 0) {
            return redirect()->route('stats');
        } else {
        return Inertia::render('Dashboard', [
                'plans' => $plans
            
        ]);
    }
    }
}
