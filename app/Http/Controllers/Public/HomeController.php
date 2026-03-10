<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;

class HomeController extends Controller
{
    public function index()
    {
        $featuredVehicles = Vehicle::with(['category', 'primaryImage'])
            ->active()
            ->latest()
            ->limit(6)
            ->get();

        return view('public.home', compact('featuredVehicles'));
    }
}