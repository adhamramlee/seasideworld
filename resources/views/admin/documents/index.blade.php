@extends('layouts.admin')

@section('title', 'Documents')

@section('page-title', 'Documents')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <form method="GET" action="{{ route('admin.documents.index') }}" class="d-flex gap-2">
        <input type="text" name="search" class="form-control" placeholder="Search documents..." value="{{ request('search') }}">
        <select name="status" class="form-select" style="width: auto;">
            <option value="">All Status</option>
            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Inactive</option>
        </select>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>
    <a href="{{ route('admin.documents.create') }}" class="btn btn-success">Upload Document</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Title (EN)</th>
                        <th>File Type</th>
                        <th>File Size</th>
                        <th>Downloads</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($documents as $document)
                        <tr>
                            <td>{{ $document->title_en }}</td>
                            <td>{{ $document->file_type }}</td>
                            <td>{{ $document->sizeForHumans }}</td>
                            <td>{{ $document->downloads }}</td>
                            <td>
                                @if($document->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.documents.edit', $document) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="{{ route('admin.documents.download', $document) }}" class="btn btn-sm btn-info">Download</a>
                                    <form method="POST" action="{{ route('admin.documents.toggle-status', $document) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Toggle Status</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.documents.destroy', $document) }}" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No documents found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $documents->withQueryString()->links() }}
</div>
@endsection
