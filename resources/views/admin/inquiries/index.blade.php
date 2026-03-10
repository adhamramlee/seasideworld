@extends('layouts.admin')

@section('title', 'Inquiries')

@section('page-title', 'Inquiries')

@section('content')
<div class="mb-4">
    <form method="GET" action="{{ route('admin.inquiries.index') }}" class="d-flex gap-2">
        <input type="text" name="search" class="form-control" placeholder="Search inquiries..." value="{{ request('search') }}">
        <select name="status" class="form-select" style="width: auto;">
            <option value="">All Status</option>
            <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="replied" {{ request('status') === 'replied' ? 'selected' : '' }}>Replied</option>
            <option value="closed" {{ request('status') === 'closed' ? 'selected' : '' }}>Closed</option>
        </select>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($inquiries as $inquiry)
                        <tr>
                            <td>{{ $inquiry->name }}</td>
                            <td>{{ $inquiry->email }}</td>
                            <td>{{ $inquiry->phone }}</td>
                            <td>{{ Str::limit($inquiry->message, 50) }}</td>
                            <td>
                                @if($inquiry->status === 'pending')
                                    <span class="badge bg-warning">Pending</span>
                                @elseif($inquiry->status === 'replied')
                                    <span class="badge bg-success">Replied</span>
                                @else
                                    <span class="badge bg-secondary">Closed</span>
                                @endif
                            </td>
                            <td>{{ $inquiry->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="btn btn-sm btn-info">View</a>
                                    @if($inquiry->status === 'pending')
                                        <form method="POST" action="{{ route('admin.inquiries.mark-replied', $inquiry) }}" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">Mark as Replied</button>
                                        </form>
                                    @endif
                                    <form method="POST" action="{{ route('admin.inquiries.destroy', $inquiry) }}" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No inquiries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $inquiries->withQueryString()->links() }}
</div>
@endsection
