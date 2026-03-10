@extends('layouts.client')

@section('title', 'My Inquiries')

@section('content')

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h4 style="font-weight: 700; color: #0c2340; margin-bottom: 0.25rem;">
            <i class="fa fa-comments me-2" style="color: #00b4d8;"></i>My Inquiries
        </h4>
        <p class="text-muted mb-0" style="font-size: 0.9rem;">Track and manage your vehicle export inquiries.</p>
    </div>
    <a href="{{ route('contact') }}" class="btn btn-primary btn-sm">
        <i class="fa fa-plus me-1"></i>New Inquiry
    </a>
</div>

<!-- Inquiries Table -->
<div class="client-card">
    @if(isset($inquiries) && $inquiries->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead style="background: #f8fafc; font-size: 0.8rem; text-transform: uppercase; color: #94a3b8; font-weight: 600;">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="py-3">Subject / Message</th>
                        <th class="py-3 d-none d-md-table-cell">Status</th>
                        <th class="py-3 d-none d-lg-table-cell">Date</th>
                        <th class="py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inquiries as $inquiry)
                        <tr>
                            <td class="px-4 py-3" style="font-size: 0.82rem; color: #94a3b8; font-weight: 600;">
                                #{{ $inquiry->id }}
                            </td>
                            <td class="py-3">
                                <div style="font-size: 0.9rem; font-weight: 500; color: #0c2340;">
                                    {{ Str::limit($inquiry->subject ?? 'Vehicle Inquiry', 50) }}
                                </div>
                                <div style="font-size: 0.78rem; color: #94a3b8;">
                                    {{ Str::limit($inquiry->message, 60) }}
                                </div>
                                <!-- Mobile status -->
                                <div class="d-md-none mt-1">
                                    @php
                                        $statusColors = ['open' => 'success', 'pending' => 'warning', 'closed' => 'secondary', 'replied' => 'info'];
                                        $color = $statusColors[$inquiry->status ?? 'open'] ?? 'secondary';
                                    @endphp
                                    <span class="badge bg-{{ $color }}" style="font-size: 0.7rem;">
                                        {{ ucfirst($inquiry->status ?? 'Open') }}
                                    </span>
                                </div>
                            </td>
                            <td class="py-3 d-none d-md-table-cell">
                                @php
                                    $statusColors = ['open' => 'success', 'pending' => 'warning', 'closed' => 'secondary', 'replied' => 'info'];
                                    $color = $statusColors[$inquiry->status ?? 'open'] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $color }}" style="font-size: 0.75rem;">
                                    {{ ucfirst($inquiry->status ?? 'Open') }}
                                </span>
                            </td>
                            <td class="py-3 d-none d-lg-table-cell" style="font-size: 0.82rem; color: #94a3b8;">
                                {{ $inquiry->created_at->format('d M Y') }}<br>
                                <span style="font-size: 0.75rem;">{{ $inquiry->created_at->format('H:i') }}</span>
                            </td>
                            <td class="py-3">
                                <a href="{{ route('client.inquiries.show', $inquiry) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fa fa-eye me-1"></i><span class="d-none d-md-inline">View</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($inquiries->hasPages())
            <div class="p-3 border-top">
                {{ $inquiries->links() }}
            </div>
        @endif
    @else
        <div class="text-center py-5">
            <i class="fa fa-comments fa-3x text-muted mb-3 d-block opacity-50"></i>
            <h6 class="text-muted">No inquiries yet</h6>
            <p class="text-muted mb-3" style="font-size: 0.88rem;">Submit an inquiry about a vehicle or our services.</p>
            <a href="{{ route('contact') }}" class="btn btn-primary">
                <i class="fa fa-plus me-2"></i>Submit an Inquiry
            </a>
        </div>
    @endif
</div>

@endsection
