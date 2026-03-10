<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InquiryController extends Controller
{
    public function index()
    {
        $inquiries = Auth::user()
            ->inquiries()
            ->latest()
            ->paginate(15);

        return view('client.inquiries.index', compact('inquiries'));
    }

    public function show(Inquiry $inquiry)
    {
        if ($inquiry->user_id !== Auth::id()) {
            abort(403);
        }

        return view('client.inquiries.show', compact('inquiry'));
    }
}