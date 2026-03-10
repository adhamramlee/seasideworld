@extends('layouts.client')

@section('title', 'Dashboard')

@section('content')

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h4 style="font-weight: 700; color: #0c2340; margin-bottom: 0.25rem;">
            Welcome back, {{ auth()->user()->name ?? 'Client' }}! 👋
        </h4>
        <p class="text-muted mb-0" style="font-size: 0.9rem;">Here's a summary of your account activity.</p>
    </div>
    <a href="{{ route('contact') }}" class="btn btn-primary btn-sm">
        <i class="fa fa-plus me-1"></i>New Inquiry
    </a>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-lg-3">
        <div class="client-card p-3 d-flex align-items-center gap-3">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #e0f7fc; display: flex; align-items: center; justify-content: center; color: #00b4d8; font-size: 1.3rem; flex-shrink: 0;">
                <i class="fa fa-folder-open"></i>
            </div>
            <div>
                <div style="font-family: 'Poppins', sans-serif; font-size: 1.6rem; font-weight: 700; color: #0c2340; line-height: 1;">
                    {{ $documentsCount ?? 0 }}
                </div>
                <div style="font-size: 0.82rem; color: #64748b;">Total Documents</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="client-card p-3 d-flex align-items-center gap-3">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #fef3c7; display: flex; align-items: center; justify-content: center; color: #f59e0b; font-size: 1.3rem; flex-shrink: 0;">
                <i class="fa fa-comments"></i>
            </div>
            <div>
                <div style="font-family: 'Poppins', sans-serif; font-size: 1.6rem; font-weight: 700; color: #0c2340; line-height: 1;">
                    {{ $inquiriesCount ?? 0 }}
                </div>
                <div style="font-size: 0.82rem; color: #64748b;">Total Inquiries</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="client-card p-3 d-flex align-items-center gap-3">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #d1fae5; display: flex; align-items: center; justify-content: center; color: #10b981; font-size: 1.3rem; flex-shrink: 0;">
                <i class="fa fa-check-circle"></i>
            </div>
            <div>
                <div style="font-family: 'Poppins', sans-serif; font-size: 1.6rem; font-weight: 700; color: #0c2340; line-height: 1;">
                    {{ $openInquiries ?? 0 }}
                </div>
                <div style="font-size: 0.82rem; color: #64748b;">Open Inquiries</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="client-card p-3 d-flex align-items-center gap-3">
            <div style="width: 48px; height: 48px; border-radius: 12px; background: #ede9fe; display: flex; align-items: center; justify-content: center; color: #8b5cf6; font-size: 1.3rem; flex-shrink: 0;">
                <i class="fa fa-download"></i>
            </div>
            <div>
                <div style="font-family: 'Poppins', sans-serif; font-size: 1.6rem; font-weight: 700; color: #0c2340; line-height: 1;">
                    {{ $downloadsCount ?? 0 }}
                </div>
                <div style="font-size: 0.82rem; color: #64748b;">Downloads</div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Documents & Inquiries -->
<div class="row g-4">

    <!-- Recent Documents -->
    <div class="col-lg-6">
        <div class="client-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fa fa-folder-open me-2 text-muted"></i>Recent Documents</span>
                <a href="{{ route('client.documents.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                @if(isset($recentDocuments) && $recentDocuments->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background: #f8fafc; font-size: 0.8rem; text-transform: uppercase; color: #94a3b8; font-weight: 600;">
                                <tr>
                                    <th class="px-3 py-2">Document</th>
                                    <th class="py-2">Type</th>
                                    <th class="py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentDocuments as $doc)
                                    <tr>
                                        <td class="px-3 py-2">
                                            <div style="font-size: 0.88rem; font-weight: 500; color: #0c2340;">{{ Str::limit($doc->title, 30) }}</div>
                                            <div style="font-size: 0.75rem; color: #94a3b8;">{{ $doc->created_at->format('d M Y') }}</div>
                                        </td>
                                        <td class="py-2">
                                            <span class="badge" style="background: #e0f7fc; color: #006d8e; font-size: 0.72rem;">
                                                {{ strtoupper($doc->file_type ?? 'PDF') }}
                                            </span>
                                        </td>
                                        <td class="py-2">
                                            <a href="{{ route('client.documents.show', $doc) }}" class="btn btn-sm btn-outline-primary" style="font-size: 0.8rem; padding: 0.2rem 0.6rem;">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fa fa-folder-open fa-2x text-muted mb-2 d-block opacity-50"></i>
                        <p class="text-muted mb-0" style="font-size: 0.88rem;">No documents yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Inquiries -->
    <div class="col-lg-6">
        <div class="client-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fa fa-comments me-2 text-muted"></i>Recent Inquiries</span>
                <a href="{{ route('client.inquiries.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body p-0">
                @if(isset($recentInquiries) && $recentInquiries->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background: #f8fafc; font-size: 0.8rem; text-transform: uppercase; color: #94a3b8; font-weight: 600;">
                                <tr>
                                    <th class="px-3 py-2">Subject</th>
                                    <th class="py-2">Status</th>
                                    <th class="py-2">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentInquiries as $inquiry)
                                    <tr>
                                        <td class="px-3 py-2">
                                            <a href="{{ route('client.inquiries.show', $inquiry) }}" style="font-size: 0.88rem; font-weight: 500; color: #0c2340; text-decoration: none;">
                                                {{ Str::limit($inquiry->subject ?? $inquiry->message, 35) }}
                                            </a>
                                        </td>
                                        <td class="py-2">
                                            @php
                                                $statusColors = ['open' => 'success', 'pending' => 'warning', 'closed' => 'secondary', 'replied' => 'info'];
                                                $color = $statusColors[$inquiry->status ?? 'open'] ?? 'secondary';
                                            @endphp
                                            <span class="badge bg-{{ $color }}" style="font-size: 0.72rem;">
                                                {{ ucfirst($inquiry->status ?? 'Open') }}
                                            </span>
                                        </td>
                                        <td class="py-2" style="font-size: 0.8rem; color: #94a3b8;">
                                            {{ $inquiry->created_at->format('d M') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fa fa-comments fa-2x text-muted mb-2 d-block opacity-50"></i>
                        <p class="text-muted mb-2" style="font-size: 0.88rem;">No inquiries yet.</p>
                        <a href="{{ route('contact') }}" class="btn btn-sm btn-primary">
                            <i class="fa fa-plus me-1"></i>Submit Inquiry
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>

@endsection
