@extends('layouts.admin')

@section('title', 'Client Details')

@section('page-title', 'Client Details')

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Name:</strong> {{ $client->name }}</p>
                <p><strong>Email:</strong> {{ $client->email }}</p>
                <p><strong>Phone:</strong> {{ $client->phone ?? '—' }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Company:</strong> {{ $client->company ?? '—' }}</p>
                <p><strong>Status:</strong>
                    <span class="badge bg-{{ $client->is_active ? 'success' : 'danger' }}">
                        {{ $client->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </p>
                <p><strong>Member Since:</strong> {{ $client->created_at->format('M d, Y') }}</p>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Documents</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>File Type</th>
                        <th>Downloads</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($client->documents as $document)
                        <tr>
                            <td>{{ $document->title }}</td>
                            <td>{{ $document->file_type }}</td>
                            <td>{{ $document->downloads }}</td>
                            <td>{{ $document->created_at->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No documents found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Recent Inquiries</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($client->inquiries as $inquiry)
                        <tr>
                            <td>{{ $inquiry->subject }}</td>
                            <td>{{ Str::limit($inquiry->message, 50) }}</td>
                            <td>
                                <span class="badge bg-{{ $inquiry->status === 'resolved' ? 'success' : ($inquiry->status === 'pending' ? 'warning' : 'info') }}">
                                    {{ ucfirst($inquiry->status) }}
                                </span>
                            </td>
                            <td>{{ $inquiry->created_at->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No inquiries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">Back to Clients</a>
@endsection
