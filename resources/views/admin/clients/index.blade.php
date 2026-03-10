@extends('layouts.admin')

@section('title', 'Clients')

@section('page-title', 'Clients')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <form method="GET" action="{{ route('admin.clients.index') }}" class="d-flex gap-2">
        <input type="text" name="search" class="form-control" placeholder="Search clients..." value="{{ request('search') }}">
        <select name="status" class="form-select" style="width: auto;">
            <option value="">All</option>
            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    <a href="{{ route('admin.clients.create') }}" class="btn btn-success">Add Client</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Company</th>
                        <th>Documents</th>
                        <th>Inquiries</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clients as $client)
                        <tr>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->company }}</td>
                            <td>{{ $client->documents_count }}</td>
                            <td>{{ $client->inquiries_count }}</td>
                            <td>
                                <span class="badge bg-{{ $client->is_active ? 'success' : 'danger' }}">
                                    {{ $client->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.clients.show', $client) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('admin.clients.edit', $client) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.clients.toggle-status', $client) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-secondary">
                                        {{ $client->is_active ? 'Deactivate' : 'Activate' }}
                                    </button>
                                </form>
                                <form action="{{ route('admin.clients.destroy', $client) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No clients found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $clients->withQueryString()->links() }}
</div>
@endsection
