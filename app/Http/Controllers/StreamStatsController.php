<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class StreamStatsController extends Controller
{
    public function index() {
        $stats = [];
        return Inertia::render('StreamStats', [
            'stats'=>$stats
        ]);
    }
}
