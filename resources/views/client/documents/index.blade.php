@extends('layouts.client')

@section('title', 'My Documents')

@section('content')

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h4 style="font-weight: 700; color: #0c2340; margin-bottom: 0.25rem;">
            <i class="fa fa-folder-open me-2" style="color: #00b4d8;"></i>My Documents
        </h4>
        <p class="text-muted mb-0" style="font-size: 0.9rem;">View and download your export documents.</p>
    </div>
</div>

<!-- Search & Filter -->
<div class="client-card mb-4 p-3">
    <form method="GET" action="{{ route('client.documents.index') }}" class="row g-2 align-items-end">
        <div class="col-sm-5">
            <label class="form-label mb-1" style="font-size: 0.82rem; font-weight: 600; color: #64748b;">SEARCH</label>
            <div class="input-group">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Search documents..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
        <div class="col-sm-3">
            <label class="form-label mb-1" style="font-size: 0.82rem; font-weight: 600; color: #64748b;">FILE TYPE</label>
            <select name="type" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="">All Types</option>
                <option value="pdf" {{ request('type') == 'pdf' ? 'selected' : '' }}>PDF</option>
                <option value="xlsx" {{ request('type') == 'xlsx' ? 'selected' : '' }}>Excel</option>
                <option value="docx" {{ request('type') == 'docx' ? 'selected' : '' }}>Word</option>
                <option value="jpg" {{ request('type') == 'jpg' ? 'selected' : '' }}>Image</option>
            </select>
        </div>
        @if(request()->hasAny(['search', 'type']))
            <div class="col-auto">
                <a href="{{ route('client.documents.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fa fa-times me-1"></i>Clear
                </a>
            </div>
        @endif
    </form>
</div>

<!-- Documents Table -->
<div class="client-card">
    @if(isset($documents) && $documents->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead style="background: #f8fafc; font-size: 0.8rem; text-transform: uppercase; color: #94a3b8; font-weight: 600;">
                    <tr>
                        <th class="px-4 py-3">Document</th>
                        <th class="py-3">Type</th>
                        <th class="py-3 d-none d-md-table-cell">Size</th>
                        <th class="py-3 d-none d-lg-table-cell">Downloads</th>
                        <th class="py-3 d-none d-md-table-cell">Date</th>
                        <th class="py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($documents as $document)
                        <tr>
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width: 38px; height: 38px; border-radius: 8px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        @php
                                            $ext = strtolower($document->file_type ?? 'file');
                                            $iconClass = match($ext) {
                                                'pdf' => 'fa-file-pdf text-danger',
                                                'xlsx', 'xls' => 'fa-file-excel text-success',
                                                'docx', 'doc' => 'fa-file-word text-primary',
                                                'jpg', 'jpeg', 'png' => 'fa-file-image text-warning',
                                                default => 'fa-file text-secondary'
                                            };
                                        @endphp
                                        <i class="fa {{ $iconClass }}"></i>
                                    </div>
                                    <div>
                                        <div style="font-size: 0.9rem; font-weight: 600; color: #0c2340;">{{ $document->title }}</div>
                                        @if($document->description)
                                            <div style="font-size: 0.75rem; color: #94a3b8;">{{ Str::limit($document->description, 50) }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="py-3">
                                <span class="badge" style="background: #e0f7fc; color: #006d8e; font-size: 0.72rem; font-weight: 600;">
                                    {{ strtoupper($document->file_type ?? 'FILE') }}
                                </span>
                            </td>
                            <td class="py-3 d-none d-md-table-cell" style="font-size: 0.85rem; color: #64748b;">
                                {{ $document->file_size ? number_format($document->file_size / 1024, 1) . ' KB' : '—' }}
                            </td>
                            <td class="py-3 d-none d-lg-table-cell" style="font-size: 0.85rem; color: #64748b;">
                                <i class="fa fa-download me-1"></i>{{ $document->downloads_count ?? 0 }}
                            </td>
                            <td class="py-3 d-none d-md-table-cell" style="font-size: 0.82rem; color: #94a3b8;">
                                {{ $document->created_at->format('d M Y') }}
                            </td>
                            <td class="py-3">
                                <div class="d-flex gap-1">
                                    <a href="{{ route('client.documents.show', $document) }}" class="btn btn-sm btn-outline-primary" title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    @if($document->file_path)
                                        <a href="{{ route('client.documents.download', $document) }}" class="btn btn-sm btn-primary" title="Download">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($documents->hasPages())
            <div class="p-3 border-top">
                {{ $documents->withQueryString()->links() }}
            </div>
        @endif
    @else
        <div class="text-center py-5">
            <i class="fa fa-folder-open fa-3x text-muted mb-3 d-block opacity-50"></i>
            <h6 class="text-muted">No documents found</h6>
            @if(request()->hasAny(['search', 'type']))
                <p class="text-muted mb-3" style="font-size: 0.88rem;">Try adjusting your search criteria.</p>
                <a href="{{ route('client.documents.index') }}" class="btn btn-outline-primary btn-sm">Clear Filters</a>
            @else
                <p class="text-muted mb-0" style="font-size: 0.88rem;">Your documents will appear here once uploaded.</p>
            @endif
        </div>
    @endif
</div>

@endsection
