<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class StreamStatsController extends Controller
{
    public function index() {
        //this should represent data from twitch. For now we use dammy data 
        //so no need to have real data
        $stats = [];
        $subcription = Subscription::query()->where('user_id', Auth::id())
        ->where('status', 'Active')->get();

        if ($subcription->count() > 0) {
            return Inertia::render('StreamStats', [
                'stats' => $stats
            ]);
            
        } else {
            return redirect()->route('index');
        }
    }
}
