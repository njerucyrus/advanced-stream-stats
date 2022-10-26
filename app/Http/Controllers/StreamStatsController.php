<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class StreamStatsController extends Controller
{
    public function index() {
        //this should represent data from twitch. For now we use dammy data 
        //so no need to have real data
        $stats = [];
        
        return Inertia::render('StreamStats', [
            'stats'=>$stats
        ]);
    }
}
