<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $totalDocuments = $user->documents()->count();
        $recentDocuments = $user->documents()
            ->latest()
            ->limit(5)
            ->get();
            
        $recentInquiries = $user->inquiries()
            ->latest()
            ->limit(5)
            ->get();

        return view('client.dashboard', compact(
            'totalDocuments',
            'recentDocuments',
            'recentInquiries'
        ));
    }
}