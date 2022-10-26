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
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/subscriptions/create', [SubscriptionController::class, 'createSubscription'])->name('create_subscription');
Route::get('/stats', [StreamStatsController::class, 'index'])->name('stats');

require __DIR__ . '/auth.php';
