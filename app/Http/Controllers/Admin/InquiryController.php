<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        $query = Inquiry::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $inquiries = $query->latest()->paginate(15);

        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function show(Inquiry $inquiry)
    {
        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function update(Request $request, Inquiry $inquiry)
    {
        $request->validate([
            'status' => 'required|in:pending,replied,closed'
        ]);

        $inquiry->update(['status' => $request->status]);
        Cache::forget('pending_inquiries_count');

        return redirect()->back()
            ->with('success', 'Inquiry status updated successfully.');
    }

    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();
        Cache::forget('pending_inquiries_count');

        return redirect()->route('admin.inquiries.index')
            ->with('success', 'Inquiry deleted successfully.');
    }

    public function markAsReplied(Inquiry $inquiry)
    {
        $inquiry->update(['status' => 'replied']);
        Cache::forget('pending_inquiries_count');

        return redirect()->back()
            ->with('success', 'Inquiry marked as replied.');
    }
}