@extends('layouts.client')

@section('title', $document->title ?? 'Document')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb" style="font-size: 0.85rem;">
        <li class="breadcrumb-item"><a href="{{ route('client.dashboard') }}" style="color: #00b4d8;">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('client.documents.index') }}" style="color: #00b4d8;">Documents</a></li>
        <li class="breadcrumb-item active text-muted">{{ Str::limit($document->title, 40) }}</li>
    </ol>
</nav>

<div class="row g-4">
    <!-- Document Details -->
    <div class="col-lg-8">
        <div class="client-card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
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
                    <i class="fa {{ $iconClass }} fa-lg"></i>
                    <span>{{ $document->title }}</span>
                </div>
                @if($document->file_path)
                    <a href="{{ route('client.documents.download', $document) }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-download me-1"></i>Download
                    </a>
                @endif
            </div>
            <div class="card-body p-4">
                @if($document->description)
                    <div class="mb-4">
                        <h6 style="font-weight: 600; color: #0c2340; margin-bottom: 0.75rem;">Description</h6>
                        <p style="color: #475569; font-size: 0.93rem; line-height: 1.7;">{{ $document->description }}</p>
                    </div>
                @endif

                <!-- Preview for images -->
                @if(in_array(strtolower($document->file_type ?? ''), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                    <div class="mb-4">
                        <h6 style="font-weight: 600; color: #0c2340; margin-bottom: 0.75rem;">Preview</h6>
                        <img src="{{ asset('storage/' . $document->file_path) }}" alt="{{ $document->title }}"
                             class="img-fluid rounded" style="max-height: 400px; object-fit: contain; border: 1px solid #e2e8f0; padding: 0.5rem;">
                    </div>
                @endif

                <!-- PDF preview hint -->
                @if(strtolower($document->file_type ?? '') === 'pdf')
                    <div class="text-center py-4" style="background: #f8fafc; border-radius: 10px; border: 1px dashed #d1d5db;">
                        <i class="fa fa-file-pdf fa-3x text-danger mb-3 d-block"></i>
                        <p class="text-muted mb-3" style="font-size: 0.9rem;">PDF Document — Click download to view</p>
                        @if($document->file_path)
                            <a href="{{ route('client.documents.download', $document) }}" class="btn btn-primary">
                                <i class="fa fa-download me-2"></i>Download PDF
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Metadata Sidebar -->
    <div class="col-lg-4">
        <div class="client-card">
            <div class="card-header">
                <i class="fa fa-info-circle me-2 text-muted"></i>Document Info
            </div>
            <div class="card-body p-3">
                <table class="table table-sm mb-0" style="font-size: 0.88rem;">
                    <tbody>
                        <tr>
                            <th class="text-muted fw-normal py-2" style="width: 45%;">File Type</th>
                            <td class="py-2">
                                <span class="badge" style="background: #e0f7fc; color: #006d8e; font-weight: 600;">
                                    {{ strtoupper($document->file_type ?? 'UNKNOWN') }}
                                </span>
                            </td>
                        </tr>
                        @if($document->file_size)
                            <tr>
                                <th class="text-muted fw-normal py-2">File Size</th>
                                <td class="py-2">{{ number_format($document->file_size / 1024, 1) }} KB</td>
                            </tr>
                        @endif
                        <tr>
                            <th class="text-muted fw-normal py-2">Downloads</th>
                            <td class="py-2">
                                <i class="fa fa-download me-1 text-muted"></i>{{ $document->downloads_count ?? 0 }}
                            </td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-normal py-2">Uploaded</th>
                            <td class="py-2">{{ $document->created_at->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-normal py-2">Updated</th>
                            <td class="py-2">{{ $document->updated_at->format('d M Y') }}</td>
                        </tr>
                    </tbody>
                </table>

                @if($document->file_path)
                    <div class="mt-3">
                        <a href="{{ route('client.documents.download', $document) }}" class="btn btn-primary w-100">
                            <i class="fa fa-download me-2"></i>Download File
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('client.documents.index') }}" class="btn btn-outline-secondary w-100">
                <i class="fa fa-arrow-left me-2"></i>Back to Documents
            </a>
        </div>
    </div>
</div>

@endsection
