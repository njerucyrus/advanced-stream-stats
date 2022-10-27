<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StreamStatsController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('index');


Route::get('/dashboard', [DashboardController::class, 'index'])
->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/transactions', [SubscriptionController::class, 'transactions'])->name('transactions');
// Route::get('/subscriptions', [SubscriptionController::class, 'subscriptions'])->name('subscriptions');

Route::get('/subscriptions/checkout/{planId}/', [SubscriptionController::class, 'showCheckoutForm'])->name('show_checkout_form');
Route::post('/subscriptions/checkout', [SubscriptionController::class, 'checkout'])->name('checkout');
Route::get('/stats', [StreamStatsController::class, 'index'])->name('stats');

require __DIR__ . '/auth.php';
