@extends('layouts.admin')

@section('title', 'Upload Document')

@section('page-title', 'Upload Document')

@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.documents.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="title_en" class="form-label">Title (EN)</label>
                    <input type="text" name="title_en" id="title_en" class="form-control @error('title_en') is-invalid @enderror" value="{{ old('title_en') }}">
                    @error('title_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="title_jp" class="form-label">Title (JP)</label>
                    <input type="text" name="title_jp" id="title_jp" class="form-control @error('title_jp') is-invalid @enderror" value="{{ old('title_jp') }}">
                    @error('title_jp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="description_en" class="form-label">Description (EN)</label>
                    <textarea name="description_en" id="description_en" rows="4" class="form-control @error('description_en') is-invalid @enderror">{{ old('description_en') }}</textarea>
                    @error('description_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="description_jp" class="form-label">Description (JP)</label>
                    <textarea name="description_jp" id="description_jp" rows="4" class="form-control @error('description_jp') is-invalid @enderror">{{ old('description_jp') }}</textarea>
                    @error('description_jp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">File</label>
                <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror" required>
                @error('file')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="status" id="status" class="form-check-input" value="1" {{ old('status', true) ? 'checked' : '' }}>
                <label for="status" class="form-check-label">Active</label>
            </div>

            <div class="mb-3">
                <label class="form-label">Assign to Clients</label>
                <div class="card">
                    <div class="card-body" style="max-height: 200px; overflow-y: auto;">
                        @foreach($clients as $client)
                            <div class="form-check">
                                <input type="checkbox" name="client_ids[]" id="client_{{ $client->id }}" class="form-check-input" value="{{ $client->id }}" {{ in_array($client->id, old('client_ids', [])) ? 'checked' : '' }}>
                                <label for="client_{{ $client->id }}" class="form-check-label">{{ $client->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
                @error('client_ids')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Upload Document</button>
            <a href="{{ route('admin.documents.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
