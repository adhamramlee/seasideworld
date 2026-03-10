<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Inquiry;
use App\Models\User;
use App\Models\Vehicle;

class DashboardController extends Controller
{
    public function index()
    {
        $totalVehicles = Vehicle::count();
        $totalInquiries = Inquiry::count();
        $pendingInquiries = Inquiry::pending()->count();
        $totalClients = User::where('role', 'client')->count();
        $totalDocuments = Document::count();
        
        $recentInquiries = Inquiry::with('user')
            ->latest()
            ->limit(5)
            ->get();
            
        $recentClients = User::where('role', 'client')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalVehicles',
            'totalInquiries',
            'pendingInquiries',
            'totalClients',
            'totalDocuments',
            'recentInquiries',
            'recentClients'
        ));
    }
}