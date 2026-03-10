@extends('layouts.admin')

@section('title', 'Pages')
@section('page-title', 'Pages')

@section('content')

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 style="font-weight: 700; color: #0c2340; margin: 0;">CMS Pages</h5>
        <p class="text-muted mb-0" style="font-size: 0.88rem;">Manage your website content pages.</p>
    </div>
    <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
        <i class="fa fa-plus me-2"></i>Add Page
    </a>
</div>

<!-- Pages Table -->
<div class="admin-card">
    @if(isset($pages) && $pages->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background: #f8fafc; font-size: 0.78rem; text-transform: uppercase; color: #94a3b8; font-weight: 600;">
                    <tr>
                        <th class="px-4 py-3">Title</th>
                        <th class="py-3 d-none d-md-table-cell">Slug</th>
                        <th class="py-3">Status</th>
                        <th class="py-3 d-none d-lg-table-cell">Updated</th>
                        <th class="py-3 text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pages as $page)
                        <tr>
                            <td class="px-4 py-3">
                                <div style="font-size: 0.9rem; font-weight: 600; color: #0c2340;">{{ $page->title_en }}</div>
                                @if($page->title_jp)
                                    <div style="font-size: 0.75rem; color: #94a3b8;">{{ $page->title_jp }}</div>
                                @endif
                            </td>
                            <td class="py-3 d-none d-md-table-cell">
                                <code style="background: #f1f5f9; padding: 0.15rem 0.5rem; border-radius: 4px; font-size: 0.82rem; color: #475569;">
                                    {{ $page->slug }}
                                </code>
                            </td>
                            <td class="py-3">
                                <span class="badge {{ $page->is_active ? 'bg-success' : 'bg-secondary' }}" style="font-size: 0.72rem;">
                                    {{ $page->is_active ? 'Published' : 'Draft' }}
                                </span>
                            </td>
                            <td class="py-3 d-none d-lg-table-cell" style="font-size: 0.82rem; color: #94a3b8;">
                                {{ $page->updated_at->format('d M Y') }}
                            </td>
                            <td class="py-3 text-end pe-4">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('admin.pages.edit', $page) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.pages.toggle', $page) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-sm {{ $page->is_active ? 'btn-outline-warning' : 'btn-outline-success' }}" title="{{ $page->is_active ? 'Unpublish' : 'Publish' }}">
                                            <i class="fa fa-{{ $page->is_active ? 'eye-slash' : 'eye' }}"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" onsubmit="return confirm('Delete this page?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($pages->hasPages())
            <div class="p-3 border-top">
                {{ $pages->links() }}
            </div>
        @endif
    @else
        <div class="text-center py-5">
            <i class="fa fa-file-alt fa-3x text-muted mb-3 d-block opacity-50"></i>
            <h6 class="text-muted">No pages found</h6>
            <a href="{{ route('admin.pages.create') }}" class="btn btn-primary btn-sm mt-2">
                <i class="fa fa-plus me-1"></i>Create First Page
            </a>
        </div>
    @endif
</div>

@endsection
