<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\InquiryRequest;
use App\Models\Inquiry;
use App\Models\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        $page = Page::where('slug', 'contact')->firstOrFail();
        return view('public.contact', compact('page'));
    }

    public function store(InquiryRequest $request)
    {
        $data = $request->validated();

        if (Auth::check()) {
            $data['user_id'] = Auth::id();
            $data['name'] = Auth::user()->name;
            $data['email'] = Auth::user()->email;
        }

        Inquiry::create($data);
        Cache::forget('pending_inquiries_count');

        $this->sendWhatsAppNotification($data);

        return redirect()->back()->with('success', __('messages.inquiry_sent'));
    }

    private function sendWhatsAppNotification(array $data): void
    {
        $whatsappNumber = config('services.whatsapp.number');

        if (empty($whatsappNumber)) {
            return;
        }

        Log::info('WhatsApp notification pending', [
            'to' => $whatsappNumber,
            'inquiry_from' => $data['name'],
        ]);

        // TODO: Implement WhatsApp API integration (e.g., Twilio, WhatsApp Business API)
        // Should be dispatched as a queued job in production
    }
}