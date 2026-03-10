@extends('layouts.admin')

@section('title', 'Inquiry Details')

@section('page-title', 'Inquiry Details')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.inquiries.index') }}" class="btn btn-secondary">Back to Inquiries</a>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Contact Information</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <strong>Name:</strong>
                <p class="mb-0">{{ $inquiry->name }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <strong>Email:</strong>
                <p class="mb-0">{{ $inquiry->email }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <strong>Phone:</strong>
                <p class="mb-0">{{ $inquiry->phone ?? 'N/A' }}</p>
            </div>
            <div class="col-md-3 mb-3">
                <strong>Status:</strong>
                <p class="mb-0">
                    @if($inquiry->status === 'pending')
                        <span class="badge bg-warning">Pending</span>
                    @elseif($inquiry->status === 'replied')
                        <span class="badge bg-success">Replied</span>
                    @else
                        <span class="badge bg-secondary">Closed</span>
                    @endif
                </p>
            </div>
            <div class="col-md-3 mb-3">
                <strong>Date:</strong>
                <p class="mb-0">{{ $inquiry->created_at->format('Y-m-d H:i') }}</p>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Message</h5>
    </div>
    <div class="card-body">
        <p class="mb-0" style="white-space: pre-wrap;">{{ $inquiry->message }}</p>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Update Status</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.inquiries.update-status', $inquiry) }}" class="d-flex gap-2 align-items-center">
            @csrf
            <select name="status" class="form-select" style="width: auto;">
                <option value="pending" {{ $inquiry->status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="replied" {{ $inquiry->status === 'replied' ? 'selected' : '' }}>Replied</option>
                <option value="closed" {{ $inquiry->status === 'closed' ? 'selected' : '' }}>Closed</option>
            </select>
            <button type="submit" class="btn btn-primary">Update Status</button>
        </form>
    </div>
</div>
@endsection
