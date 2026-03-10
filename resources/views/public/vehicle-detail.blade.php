@extends('layouts.public')

@section('title', ($category->name_en ?? 'Vehicles') . ' — SeasideWorld')

@section('extra-css')
<style>
    .category-hero {
        background: linear-gradient(135deg, #0c2340 0%, #1a3a5c 100%);
        padding: 5rem 0 4rem;
        position: relative;
        overflow: hidden;
    }
    .category-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at 50% 120%, rgba(0,180,216,0.2), transparent 70%);
    }
    .category-hero-content { position: relative; z-index: 2; text-align: center; }
    .category-hero h1 { font-size: clamp(1.8rem, 4vw, 2.8rem); font-weight: 700; color: #fff; margin-bottom: 0.75rem; }
    .category-hero p { color: rgba(255,255,255,0.7); font-size: 1.05rem; max-width: 560px; margin: 0 auto; }
    .category-hero-wave { position: absolute; bottom: 0; left: 0; width: 100%; pointer-events: none; }

    .vehicles-section { padding: 3.5rem 0 5rem; background: #f8fafc; }
    .vehicle-card { border-radius: 14px; overflow: hidden; border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.08); height: 100%; }
    .vehicle-img-wrapper { overflow: hidden; }
    .vehicle-card img { height: 210px; object-fit: cover; width: 100%; transition: transform 0.35s; }
    .vehicle-card:hover img { transform: scale(1.06); }
    .vehicle-card .card-body { padding: 1.25rem; }
    .vehicle-name { font-weight: 600; font-size: 1rem; color: #0c2340; margin-bottom: 0.3rem; }
    .vehicle-price { font-family: 'Poppins', sans-serif; font-size: 1.2rem; font-weight: 700; color: #00b4d8; }
    .vehicle-meta { font-size: 0.82rem; color: #64748b; }
</style>
@endsection

@section('content')

<!-- Category Hero Banner -->
<section class="category-hero">
    <div class="container">
        <div class="category-hero-content">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb justify-content-center" style="background: transparent;">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: rgba(255,255,255,0.6);">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('gallery') }}" style="color: rgba(255,255,255,0.6);">Gallery</a></li>
                    <li class="breadcrumb-item active" style="color: rgba(255,255,255,0.9);">{{ $category->name_en ?? 'Category' }}</li>
                </ol>
            </nav>
            <h1>{{ $category->name_en ?? 'Vehicles' }}</h1>
            @if($category->description_en ?? false)
                <p>{{ $category->description_en }}</p>
            @else
                <p>Browse our selection of {{ $category->name_en ?? '' }} vehicles available for export.</p>
            @endif
        </div>
    </div>
    <div class="category-hero-wave">
        <svg viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,30 C360,55 1080,5 1440,30 L1440,60 L0,60 Z" fill="#f8fafc"/>
        </svg>
    </div>
</section>

<!-- Vehicles Grid -->
<section class="vehicles-section">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <span class="text-muted" style="font-size: 0.9rem;">
                    Showing {{ $vehicles->count() }} of {{ $vehicles->total() }} vehicles
                </span>
            </div>
            <a href="{{ route('gallery') }}" class="btn btn-outline-secondary btn-sm">
                <i class="fa fa-arrow-left me-1"></i>All Categories
            </a>
        </div>

        @if($vehicles->count() > 0)
            <div class="row g-4">
                @foreach($vehicles as $vehicle)
                    <div class="col-sm-6 col-lg-4">
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
                                <h6 class="vehicle-name">{{ $vehicle->name_en }}</h6>
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
                    {{ $vehicles->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-5">
                <i class="fa fa-car fa-3x text-muted mb-3 d-block"></i>
                <h5 class="text-muted">No vehicles in this category yet</h5>
                <a href="{{ route('gallery') }}" class="btn btn-primary mt-2">View All Vehicles</a>
            </div>
        @endif
    </div>
</section>

@endsection
