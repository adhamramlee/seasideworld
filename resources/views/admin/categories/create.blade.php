@extends('layouts.admin')

@section('title', 'Create Category')
@section('page-title', 'Create Category')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Create Category</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name_en" class="form-label">Name (EN) <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name_en') is-invalid @enderror" id="name_en" name="name_en" value="{{ old('name_en') }}" required>
                @error('name_en')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="name_jp" class="form-label">Name (JP) <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name_jp') is-invalid @enderror" id="name_jp" name="name_jp" value="{{ old('name_jp') }}" required>
                @error('name_jp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description_en" class="form-label">Description (EN)</label>
                <textarea class="form-control @error('description_en') is-invalid @enderror" id="description_en" name="description_en" rows="3">{{ old('description_en') }}</textarea>
                @error('description_en')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description_jp" class="form-label">Description (JP)</label>
                <textarea class="form-control @error('description_jp') is-invalid @enderror" id="description_jp" name="description_jp" rows="3">{{ old('description_jp') }}</textarea>
                @error('description_jp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input @error('is_active') is-invalid @enderror" id="is_active" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Active</label>
                @error('is_active')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create Category</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@endsection
