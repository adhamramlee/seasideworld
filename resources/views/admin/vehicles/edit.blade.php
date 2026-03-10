@extends('layouts.admin')

@section('title', 'Edit Vehicle')
@section('page-title', 'Edit Vehicle')

@section('content')

<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb" style="font-size: 0.85rem;">
        <li class="breadcrumb-item"><a href="{{ route('admin.vehicles.index') }}" style="color: #00b4d8;">Vehicles</a></li>
        <li class="breadcrumb-item active text-muted">Edit: {{ $vehicle->name_en }}</li>
    </ol>
</nav>

<form action="{{ route('admin.vehicles.update', $vehicle) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
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
                                   value="{{ old('name_en', $vehicle->name_en) }}" required>
                            @error('name_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="name_jp">Name (Japanese)</label>
                            <input type="text" id="name_jp" name="name_jp"
                                   class="form-control @error('name_jp') is-invalid @enderror"
                                   value="{{ old('name_jp', $vehicle->name_jp) }}">
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
                                    <option value="{{ $category->id }}" {{ old('category_id', $vehicle->category_id) == $category->id ? 'selected' : '' }}>
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
                                   value="{{ old('year', $vehicle->year) }}"
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
                                       value="{{ old('price', $vehicle->price) }}" min="0" step="100">
                            </div>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="description_en">Description (English)</label>
                            <textarea id="description_en" name="description_en"
                                      class="form-control @error('description_en') is-invalid @enderror"
                                      rows="4">{{ old('description_en', $vehicle->description_en) }}</textarea>
                            @error('description_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="description_jp">Description (Japanese)</label>
                            <textarea id="description_jp" name="description_jp"
                                      class="form-control @error('description_jp') is-invalid @enderror"
                                      rows="4">{{ old('description_jp', $vehicle->description_jp) }}</textarea>
                            @error('description_jp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Existing Images -->
            @if($vehicle->images && $vehicle->images->count() > 0)
                <div class="admin-card mb-4">
                    <div class="card-header">
                        <i class="fa fa-images me-2 text-muted"></i>Current Images
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-3">
                            @foreach($vehicle->images as $image)
                                <div class="col-4 col-md-3" id="img-{{ $image->id }}">
                                    <div style="position: relative; border: 2px solid {{ $image->is_primary ? '#00b4d8' : '#e2e8f0' }}; border-radius: 10px; overflow: hidden;">
                                        <img src="{{ asset('storage/' . $image->image_path) }}"
                                             alt="Vehicle image"
                                             style="width: 100%; height: 90px; object-fit: cover;">
                                        @if($image->is_primary)
                                            <span style="position: absolute; top: 4px; left: 4px; background: #00b4d8; color: #fff; font-size: 0.6rem; padding: 2px 6px; border-radius: 4px; font-weight: 700;">PRIMARY</span>
                                        @endif
                                        <div class="d-flex gap-1 p-1" style="background: rgba(0,0,0,0.5);">
                                            @if(!$image->is_primary)
                                                <form action="{{ route('admin.vehicles.images.primary', [$vehicle, $image]) }}" method="POST" class="flex-fill">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm w-100" style="background: #00b4d8; color: #fff; font-size: 0.65rem; padding: 2px; border: none;" title="Set as primary">
                                                        <i class="fa fa-star"></i>
                                                    </button>
                                                </form>
                                            @endif
                                            <form action="{{ route('admin.vehicles.images.destroy', [$vehicle, $image]) }}" method="POST" onsubmit="return confirm('Delete this image?')" {{ $image->is_primary ? '' : 'class=flex-fill' }}>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm w-100" style="background: #ef4444; color: #fff; font-size: 0.65rem; padding: 2px; border: none;" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Add New Images -->
            <div class="admin-card">
                <div class="card-header">
                    <i class="fa fa-plus-circle me-2 text-muted"></i>Add More Images
                </div>
                <div class="card-body p-4">
                    <div id="drop-zone" style="border: 2px dashed #d1d5db; border-radius: 12px; padding: 2rem; text-align: center; cursor: pointer; transition: all 0.2s;"
                         onclick="document.getElementById('new-images').click()">
                        <i class="fa fa-cloud-upload-alt fa-2x text-muted mb-2 d-block"></i>
                        <p class="text-muted mb-1" style="font-size: 0.9rem;">Click to upload additional images</p>
                        <p class="text-muted mb-0" style="font-size: 0.8rem;">JPG, PNG, WebP up to 5MB each</p>
                    </div>
                    <input type="file" id="new-images" name="images[]" multiple accept="image/*" class="d-none" onchange="previewNewImages(this)">
                    <div id="new-image-preview" class="row g-2 mt-2"></div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Status -->
            <div class="admin-card mb-4">
                <div class="card-header">
                    <i class="fa fa-toggle-on me-2 text-muted"></i>Status
                </div>
                <div class="card-body p-3">
                    <select id="status" name="status" class="form-select">
                        <option value="available" {{ old('status', $vehicle->status) == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="reserved" {{ old('status', $vehicle->status) == 'reserved' ? 'selected' : '' }}>Reserved</option>
                        <option value="sold" {{ old('status', $vehicle->status) == 'sold' ? 'selected' : '' }}>Sold</option>
                    </select>
                </div>
            </div>

            <!-- Actions -->
            <div class="admin-card mb-4">
                <div class="card-body p-3">
                    <button type="submit" class="btn btn-primary w-100 mb-2">
                        <i class="fa fa-save me-2"></i>Update Vehicle
                    </button>
                    <a href="{{ route('admin.vehicles.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="fa fa-times me-2"></i>Cancel
                    </a>
                </div>
            </div>

            <!-- Danger Zone -->
            <div class="admin-card" style="border: 1px solid #fecaca;">
                <div class="card-header" style="background: #fff5f5; color: #ef4444;">
                    <i class="fa fa-exclamation-triangle me-2"></i>Danger Zone
                </div>
                <div class="card-body p-3">
                    <p class="text-muted mb-2" style="font-size: 0.82rem;">Permanently delete this vehicle and all its images.</p>
                    <form action="{{ route('admin.vehicles.destroy', $vehicle) }}" method="POST"
                          onsubmit="return confirm('Are you sure? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm w-100">
                            <i class="fa fa-trash me-2"></i>Delete Vehicle
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@section('extra-js')
<script>
    function previewNewImages(input) {
        const preview = document.getElementById('new-image-preview');
        preview.innerHTML = '';
        Array.from(input.files).forEach((file) => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const col = document.createElement('div');
                col.className = 'col-4';
                col.innerHTML = `<img src="${e.target.result}" style="width:100%;height:80px;object-fit:cover;border-radius:8px;border:1px solid #e2e8f0;">`;
                preview.appendChild(col);
            };
            reader.readAsDataURL(file);
        });
    }
</script>
@endsection
