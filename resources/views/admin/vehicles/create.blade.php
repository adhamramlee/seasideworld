@extends('layouts.admin')

@section('title', 'Add Vehicle')
@section('page-title', 'Add Vehicle')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb" style="font-size: 0.85rem;">
        <li class="breadcrumb-item"><a href="{{ route('admin.vehicles.index') }}" style="color: #00b4d8;">Vehicles</a></li>
        <li class="breadcrumb-item active text-muted">Add Vehicle</li>
    </ol>
</nav>

<form action="{{ route('admin.vehicles.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row g-4">
        <!-- Main Form -->
        <div class="col-lg-8">

            <!-- Basic Info -->
            <div class="admin-card mb-4">
                <div class="card-header">
                    <i class="fa fa-car me-2 text-muted"></i>Vehicle Information
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="name_en">Name (English) <span class="text-danger">*</span></label>
                            <input type="text" id="name_en" name="name_en"
                                   class="form-control @error('name_en') is-invalid @enderror"
                                   value="{{ old('name_en') }}" placeholder="e.g. Toyota Land Cruiser" required>
                            @error('name_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="name_jp">Name (Japanese)</label>
                            <input type="text" id="name_jp" name="name_jp"
                                   class="form-control @error('name_jp') is-invalid @enderror"
                                   value="{{ old('name_jp') }}" placeholder="ランドクルーザー">
                            @error('name_jp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="category_id">Category <span class="text-danger">*</span></label>
                            <select id="category_id" name="category_id"
                                    class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="">Select Category</option>
                                @foreach($categories ?? [] as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name_en }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="year">Year</label>
                            <input type="number" id="year" name="year"
                                   class="form-control @error('year') is-invalid @enderror"
                                   value="{{ old('year') }}" placeholder="{{ date('Y') }}"
                                   min="1980" max="{{ date('Y') + 1 }}">
                            @error('year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="price">Price (USD)</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" id="price" name="price"
                                       class="form-control @error('price') is-invalid @enderror"
                                       value="{{ old('price') }}" placeholder="25000" min="0" step="100">
                            </div>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="description_en">Description (English)</label>
                            <textarea id="description_en" name="description_en"
                                      class="form-control @error('description_en') is-invalid @enderror"
                                      rows="4" placeholder="Describe the vehicle...">{{ old('description_en') }}</textarea>
                            @error('description_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="description_jp">Description (Japanese)</label>
                            <textarea id="description_jp" name="description_jp"
                                      class="form-control @error('description_jp') is-invalid @enderror"
                                      rows="4" placeholder="車両の説明...">{{ old('description_jp') }}</textarea>
                            @error('description_jp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image Upload -->
            <div class="admin-card">
                <div class="card-header">
                    <i class="fa fa-images me-2 text-muted"></i>Vehicle Images
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label">Upload Images</label>
                        <div id="drop-zone" style="border: 2px dashed #d1d5db; border-radius: 12px; padding: 2rem; text-align: center; cursor: pointer; transition: border-color 0.2s, background 0.2s;"
                             onclick="document.getElementById('images').click()">
                            <i class="fa fa-cloud-upload-alt fa-2x text-muted mb-2 d-block"></i>
                            <p class="text-muted mb-1" style="font-size: 0.9rem;">Click to upload or drag & drop images</p>
                            <p class="text-muted mb-0" style="font-size: 0.8rem;">JPG, PNG, WebP up to 5MB each. First image will be the primary image.</p>
                        </div>
                        <input type="file" id="images" name="images[]" multiple accept="image/*" class="d-none" onchange="previewImages(this)">
                        @error('images.*')
                            <div class="text-danger mt-1" style="font-size: 0.85rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image Preview -->
                    <div id="image-preview" class="row g-2 mt-2"></div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Status -->
            <div class="admin-card mb-4">
                <div class="card-header">
                    <i class="fa fa-toggle-on me-2 text-muted"></i>Status & Visibility
                </div>
                <div class="card-body p-3">
                    <label class="form-label" for="status">Status</label>
                    <select id="status" name="status" class="form-select">
                        <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="reserved" {{ old('status') == 'reserved' ? 'selected' : '' }}>Reserved</option>
                        <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                    </select>
                </div>
            </div>

            <!-- Submit Actions -->
            <div class="admin-card">
                <div class="card-body p-3">
                    <button type="submit" class="btn btn-primary w-100 mb-2">
                        <i class="fa fa-save me-2"></i>Save Vehicle
                    </button>
                    <a href="{{ route('admin.vehicles.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="fa fa-times me-2"></i>Cancel
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@section('extra-js')
<script>
    // Drop zone hover effect
    const dropZone = document.getElementById('drop-zone');
    if (dropZone) {
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.style.borderColor = '#00b4d8';
            dropZone.style.background = '#f0fdff';
        });
        dropZone.addEventListener('dragleave', () => {
            dropZone.style.borderColor = '#d1d5db';
            dropZone.style.background = '';
        });
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.style.borderColor = '#d1d5db';
            dropZone.style.background = '';
            const input = document.getElementById('images');
            const dt = new DataTransfer();
            Array.from(e.dataTransfer.files).forEach(f => dt.items.add(f));
            input.files = dt.files;
            previewImages(input);
        });
    }

    function previewImages(input) {
        const preview = document.getElementById('image-preview');
        preview.innerHTML = '';
        Array.from(input.files).forEach((file, i) => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const col = document.createElement('div');
                col.className = 'col-4';
                col.innerHTML = `
                    <div style="position:relative;">
                        <img src="${e.target.result}" style="width:100%;height:80px;object-fit:cover;border-radius:8px;border:2px solid ${i===0?'#00b4d8':'#e2e8f0'};">
                        ${i===0 ? '<span style="position:absolute;bottom:4px;left:4px;background:#00b4d8;color:#fff;font-size:0.65rem;padding:1px 6px;border-radius:4px;font-weight:600;">PRIMARY</span>' : ''}
                    </div>`;
                preview.appendChild(col);
            };
            reader.readAsDataURL(file);
        });
    }
</script>
@endsection
