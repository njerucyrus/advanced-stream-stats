<?php

namespace App\Http\Controllers;

use Braintree\Gateway;
use Exception;
use Illuminate\Http\Request;
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
        try {
            $plans = $this->gateway->plan()->all();
        } catch (Exception $ex) {
        }
        return Inertia::render('Dashboard', [
            'plans' => $plans,
        ]);
    }
}
