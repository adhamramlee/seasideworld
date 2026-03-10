@extends('layouts.admin')

@section('title', 'Edit Page')
@section('page-title', 'Edit Page')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Edit Page</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.pages.update', $page) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title_en" class="form-label">Title (EN) <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title_en') is-invalid @enderror" id="title_en" name="title_en" value="{{ old('title_en', $page->title_en) }}" required>
                @error('title_en')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="title_jp" class="form-label">Title (JP) <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title_jp') is-invalid @enderror" id="title_jp" name="title_jp" value="{{ old('title_jp', $page->title_jp) }}" required>
                @error('title_jp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content_en" class="form-label">Content (EN)</label>
                <textarea class="form-control @error('content_en') is-invalid @enderror" id="content_en" name="content_en" rows="8">{{ old('content_en', $page->content_en) }}</textarea>
                @error('content_en')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content_jp" class="form-label">Content (JP)</label>
                <textarea class="form-control @error('content_jp') is-invalid @enderror" id="content_jp" name="content_jp" rows="8">{{ old('content_jp', $page->content_jp) }}</textarea>
                @error('content_jp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="meta_description" class="form-label">Meta Description</label>
                <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description" rows="3">{{ old('meta_description', $page->meta_description) }}</textarea>
                @error('meta_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input @error('is_active') is-invalid @enderror" id="is_active" name="is_active" value="1" {{ old('is_active', $page->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Active</label>
                @error('is_active')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Page</button>
            <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@endsection
