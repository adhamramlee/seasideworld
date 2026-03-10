@extends('layouts.client')

@section('title', 'Inquiry #' . ($inquiry->id ?? ''))

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb" style="font-size: 0.85rem;">
        <li class="breadcrumb-item"><a href="{{ route('client.dashboard') }}" style="color: #00b4d8;">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('client.inquiries.index') }}" style="color: #00b4d8;">Inquiries</a></li>
        <li class="breadcrumb-item active text-muted">Inquiry #{{ $inquiry->id }}</li>
    </ol>
</nav>

<div class="row g-4">
    <!-- Inquiry Details -->
    <div class="col-lg-8">
        <div class="client-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fa fa-comments me-2 text-muted"></i>Inquiry #{{ $inquiry->id }}</span>
                @php
                    $statusColors = ['open' => 'success', 'pending' => 'warning', 'closed' => 'secondary', 'replied' => 'info'];
                    $color = $statusColors[$inquiry->status ?? 'open'] ?? 'secondary';
                @endphp
                <span class="badge bg-{{ $color }}">{{ ucfirst($inquiry->status ?? 'Open') }}</span>
            </div>
            <div class="card-body p-4">
                @if($inquiry->subject ?? false)
                    <h5 style="font-weight: 700; color: #0c2340; margin-bottom: 1.25rem;">
                        {{ $inquiry->subject }}
                    </h5>
                @endif

                <div style="background: #f8fafc; border-radius: 10px; padding: 1.5rem; border-left: 4px solid #00b4d8;">
                    <div style="font-size: 0.82rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.75rem;">
                        <i class="fa fa-comment-dots me-1"></i>Your Message
                    </div>
                    <p style="font-size: 0.95rem; color: #374151; line-height: 1.75; margin: 0; white-space: pre-wrap;">{{ $inquiry->message }}</p>
                </div>

                @if($inquiry->admin_reply ?? false)
                    <div style="background: #f0f9ff; border-radius: 10px; padding: 1.5rem; border-left: 4px solid #0c2340; margin-top: 1.25rem;">
                        <div style="font-size: 0.82rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.75rem;">
                            <i class="fa fa-reply me-1"></i>Response from SeasideWorld
                        </div>
                        <p style="font-size: 0.95rem; color: #374151; line-height: 1.75; margin: 0; white-space: pre-wrap;">{{ $inquiry->admin_reply }}</p>
                        @if($inquiry->replied_at ?? false)
                            <div style="font-size: 0.78rem; color: #94a3b8; margin-top: 0.75rem;">
                                Replied: {{ \Carbon\Carbon::parse($inquiry->replied_at)->format('d M Y, H:i') }}
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <div class="client-card mb-3">
            <div class="card-header">
                <i class="fa fa-info-circle me-2 text-muted"></i>Inquiry Details
            </div>
            <div class="card-body p-3">
                <table class="table table-sm mb-0" style="font-size: 0.88rem;">
                    <tbody>
                        <tr>
                            <th class="text-muted fw-normal py-2" style="width: 45%;">Status</th>
                            <td class="py-2">
                                <span class="badge bg-{{ $color }}">{{ ucfirst($inquiry->status ?? 'Open') }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-normal py-2">Name</th>
                            <td class="py-2">{{ $inquiry->name ?? auth()->user()->name }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-normal py-2">Email</th>
                            <td class="py-2" style="word-break: break-word;">{{ $inquiry->email ?? auth()->user()->email }}</td>
                        </tr>
                        @if($inquiry->phone ?? false)
                            <tr>
                                <th class="text-muted fw-normal py-2">Phone</th>
                                <td class="py-2">{{ $inquiry->phone }}</td>
                            </tr>
                        @endif
                        <tr>
                            <th class="text-muted fw-normal py-2">Submitted</th>
                            <td class="py-2">{{ $inquiry->created_at->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-normal py-2">Updated</th>
                            <td class="py-2">{{ $inquiry->updated_at->format('d M Y') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="client-card">
            <div class="card-header">
                <i class="fa fa-headset me-2 text-muted"></i>Need Help?
            </div>
            <div class="card-body p-3">
                <p class="text-muted mb-3" style="font-size: 0.88rem;">
                    Have a follow-up question? Our team is here to help.
                </p>
                <a href="mailto:info@seasideworld.jp" class="btn btn-outline-primary btn-sm w-100 mb-2">
                    <i class="fa fa-envelope me-1"></i>Email Us
                </a>
                <a href="https://wa.me/81000000000" target="_blank" class="btn btn-sm w-100" style="background: #25d366; color: #fff; border: none;">
                    <i class="fab fa-whatsapp me-1"></i>WhatsApp
                </a>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('client.inquiries.index') }}" class="btn btn-outline-secondary w-100">
                <i class="fa fa-arrow-left me-2"></i>Back to Inquiries
            </a>
        </div>
    </div>
</div>

@endsection
