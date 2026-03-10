@extends('layouts.public')

@section('title', __('messages.gallery') . ' — SeasideWorld')

@section('extra-css')
<style>
    .page-hero {
        background: linear-gradient(135deg, #0c2340 0%, #1a3a5c 100%);
        padding: 5rem 0 4rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .page-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at 50% 120%, rgba(0,180,216,0.2), transparent 70%);
    }
    .page-hero-content { position: relative; z-index: 2; }
    .page-hero h1 { font-size: clamp(1.8rem, 4vw, 2.8rem); font-weight: 700; color: #fff; margin-bottom: 0.75rem; }
    .page-hero p { color: rgba(255,255,255,0.7); font-size: 1.05rem; max-width: 520px; margin: 0 auto; }
    .page-hero-wave { position: absolute; bottom: 0; left: 0; width: 100%; pointer-events: none; }

    .filter-bar {
        background: #fff;
        border-bottom: 1px solid #e2e8f0;
        padding: 1rem 0;
        position: sticky;
        top: 68px;
        z-index: 100;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .filter-select {
        border: 1px solid #d1d5db;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
        background: #f8fafc;
        color: #374151;
    }
    .filter-select:focus { outline: none; border-color: #00b4d8; box-shadow: 0 0 0 3px rgba(0,180,216,0.1); }
    .search-input {
        border: 1px solid #d1d5db;
        border-radius: 8px;
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }
    .search-input:focus { outline: none; border-color: #00b4d8; box-shadow: 0 0 0 3px rgba(0,180,216,0.1); }

    .gallery-section { padding: 3rem 0 5rem; background: #f8fafc; }
    .vehicle-card { border-radius: 14px; overflow: hidden; border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.08); height: 100%; }
    .vehicle-img-wrapper { overflow: hidden; }
    .vehicle-card img { height: 210px; object-fit: cover; width: 100%; transition: transform 0.35s; }
    .vehicle-card:hover img { transform: scale(1.06); }
    .vehicle-card .card-body { padding: 1.25rem; }
    .vehicle-name { font-weight: 600; font-size: 1rem; color: #0c2340; margin-bottom: 0.3rem; }
    .vehicle-price { font-family: 'Poppins', sans-serif; font-size: 1.2rem; font-weight: 700; color: #00b4d8; }
    .vehicle-meta { font-size: 0.82rem; color: #64748b; }
    .vehicle-category-badge { background: #e0f7fc; color: #006d8e; font-size: 0.72rem; font-weight: 600; padding: 0.2rem 0.6rem; border-radius: 20px; }

    .no-results { text-align: center; padding: 4rem 0; }
</style>
@endsection

@section('content')

<!-- Page Hero -->
<section class="page-hero">
    <div class="container">
        <div class="page-hero-content">
            <h1><i class="fa fa-car me-2" style="color: #00b4d8;"></i>Vehicle Gallery</h1>
            <p>Browse our extensive collection of premium Japanese vehicles available for export.</p>
        </div>
    </div>
    <div class="page-hero-wave">
        <svg viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,30 C360,55 1080,5 1440,30 L1440,60 L0,60 Z" fill="#f8fafc"/>
        </svg>
    </div>
</section>

<!-- Filter Bar -->
<div class="filter-bar">
    <div class="container">
        <form method="GET" action="{{ route('gallery') }}" class="row g-2 align-items-center">
            <div class="col-auto">
                <select name="category" class="filter-select" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    @foreach($categories ?? [] as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name_en }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-4">
                <div class="input-group">
                    <input type="text" name="search" class="search-input form-control" placeholder="Search vehicles..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
            @if(request()->hasAny(['category', 'search']))
                <div class="col-auto">
                    <a href="{{ route('gallery') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fa fa-times me-1"></i>Clear
                    </a>
                </div>
            @endif
            <div class="col-auto ms-auto">
                <span class="text-muted" style="font-size: 0.88rem;">
                    {{ $vehicles->total() ?? 0 }} vehicles found
                </span>
            </div>
        </form>
    </div>
</div>

<!-- Gallery Grid -->
<section class="gallery-section">
    <div class="container">
        @if(isset($vehicles) && $vehicles->count() > 0)
            <div class="row g-4">
                @foreach($vehicles as $vehicle)
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="vehicle-card card h-100">
                            <div class="vehicle-img-wrapper">
                                @if($vehicle->primaryImage)
                                    <img src="{{ asset('storage/' . $vehicle->primaryImage->image_path) }}"
                                         alt="{{ $vehicle->name_en }}" class="w-100">
                                @else
                                    <div style="height: 210px; background: linear-gradient(135deg, #e2e8f0, #f1f5f9); display: flex; align-items: center; justify-content: center;">
                                        <i class="fa fa-car fa-3x" style="color: #cbd5e1;"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <h6 class="vehicle-name mb-0">{{ $vehicle->name_en }}</h6>
                                    @if($vehicle->category)
                                        <span class="vehicle-category-badge">{{ $vehicle->category->name_en }}</span>
                                    @endif
                                </div>
                                <div class="vehicle-meta mb-2">
                                    <i class="fa fa-calendar-alt me-1"></i>{{ $vehicle->year }}
                                    @if($vehicle->status)
                                        &nbsp;&bull;&nbsp;
                                        <span class="badge bg-{{ $vehicle->status === 'available' ? 'success' : 'warning' }} text-white" style="font-size: 0.7rem;">
                                            {{ ucfirst($vehicle->status) }}
                                        </span>
                                    @endif
                                </div>
                                @if($vehicle->price)
                                    <div class="vehicle-price mb-3">${{ number_format($vehicle->price) }}</div>
                                @endif
                                <a href="{{ route('contact') }}?vehicle={{ $vehicle->id }}" class="btn btn-primary btn-sm mt-auto w-100">
                                    <i class="fa fa-envelope me-1"></i>Enquire Now
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($vehicles->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $vehicles->withQueryString()->links() }}
                </div>
            @endif
        @else
            <div class="no-results">
                <i class="fa fa-search fa-3x text-muted mb-3 d-block"></i>
                <h5 class="text-muted">No vehicles found</h5>
                <p class="text-muted">Try adjusting your search filters.</p>
                <a href="{{ route('gallery') }}" class="btn btn-primary mt-2">Clear Filters</a>
            </div>
        @endif
    </div>
</section>

@endsection
