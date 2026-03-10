@extends('layouts.admin')

@section('title', 'Vehicles')
@section('page-title', 'Vehicles')

@section('content')

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 style="font-weight: 700; color: #0c2340; margin: 0;">Vehicle Inventory</h5>
        <p class="text-muted mb-0" style="font-size: 0.88rem;">Manage your vehicle listings.</p>
    </div>
    <a href="{{ route('admin.vehicles.create') }}" class="btn btn-primary">
        <i class="fa fa-plus me-2"></i>Add Vehicle
    </a>
</div>

<!-- Filters -->
<div class="admin-card mb-4 p-3">
    <form method="GET" action="{{ route('admin.vehicles.index') }}" class="row g-2 align-items-end">
        <div class="col-sm-4">
            <label class="form-label mb-1" style="font-size: 0.8rem; color: #64748b; font-weight: 600; text-transform: uppercase;">Search</label>
            <input type="text" name="search" class="form-control form-control-sm" placeholder="Vehicle name or year..." value="{{ request('search') }}">
        </div>
        <div class="col-sm-3">
            <label class="form-label mb-1" style="font-size: 0.8rem; color: #64748b; font-weight: 600; text-transform: uppercase;">Category</label>
            <select name="category" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="">All Categories</option>
                @foreach($categories ?? [] as $category)
                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name_en }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-2">
            <label class="form-label mb-1" style="font-size: 0.8rem; color: #64748b; font-weight: 600; text-transform: uppercase;">Status</label>
            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="">All Status</option>
                <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                <option value="reserved" {{ request('status') == 'reserved' ? 'selected' : '' }}>Reserved</option>
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-search me-1"></i>Search
            </button>
            @if(request()->hasAny(['search', 'category', 'status']))
                <a href="{{ route('admin.vehicles.index') }}" class="btn btn-outline-secondary btn-sm ms-1">
                    <i class="fa fa-times"></i>
                </a>
            @endif
        </div>
    </form>
</div>

<!-- Vehicles Table -->
<div class="admin-card">
    @if(isset($vehicles) && $vehicles->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background: #f8fafc; font-size: 0.78rem; text-transform: uppercase; color: #94a3b8; font-weight: 600;">
                    <tr>
                        <th class="px-3 py-3" style="width: 60px;">Image</th>
                        <th class="py-3">Vehicle</th>
                        <th class="py-3 d-none d-md-table-cell">Category</th>
                        <th class="py-3 d-none d-lg-table-cell">Year</th>
                        <th class="py-3 d-none d-lg-table-cell">Price</th>
                        <th class="py-3">Status</th>
                        <th class="py-3 text-end pe-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vehicles as $vehicle)
                        <tr>
                            <td class="px-3 py-2">
                                @if($vehicle->primaryImage)
                                    <img src="{{ asset('storage/' . $vehicle->primaryImage->image_path) }}"
                                         alt="{{ $vehicle->name_en }}"
                                         style="width: 50px; height: 40px; object-fit: cover; border-radius: 6px;">
                                @else
                                    <div style="width: 50px; height: 40px; background: #f1f5f9; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: #cbd5e1;">
                                        <i class="fa fa-car"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="py-2">
                                <div style="font-size: 0.9rem; font-weight: 600; color: #0c2340;">{{ $vehicle->name_en }}</div>
                                @if($vehicle->name_jp)
                                    <div style="font-size: 0.75rem; color: #94a3b8;">{{ $vehicle->name_jp }}</div>
                                @endif
                            </td>
                            <td class="py-2 d-none d-md-table-cell">
                                @if($vehicle->category)
                                    <span class="badge" style="background: #e0f7fc; color: #006d8e; font-size: 0.72rem; font-weight: 600;">
                                        {{ $vehicle->category->name_en }}
                                    </span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td class="py-2 d-none d-lg-table-cell" style="font-size: 0.88rem; color: #64748b;">
                                {{ $vehicle->year ?? '—' }}
                            </td>
                            <td class="py-2 d-none d-lg-table-cell" style="font-size: 0.9rem; font-weight: 600; color: #00b4d8;">
                                {{ $vehicle->price ? '$' . number_format($vehicle->price) : '—' }}
                            </td>
                            <td class="py-2">
                                @php
                                    $statusColors = ['available' => 'success', 'sold' => 'danger', 'reserved' => 'warning'];
                                    $color = $statusColors[$vehicle->status ?? 'available'] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $color }}" style="font-size: 0.72rem;">
                                    {{ ucfirst($vehicle->status ?? 'Available') }}
                                </span>
                            </td>
                            <td class="py-2 text-end pe-3">
                                <div class="d-flex justify-content-end gap-1">
                                    <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.vehicles.destroy', $vehicle) }}" method="POST" onsubmit="return confirm('Delete this vehicle?')">
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

        <!-- Pagination -->
        @if($vehicles->hasPages())
            <div class="p-3 border-top d-flex align-items-center justify-content-between">
                <div class="text-muted" style="font-size: 0.85rem;">
                    Showing {{ $vehicles->firstItem() }}–{{ $vehicles->lastItem() }} of {{ $vehicles->total() }}
                </div>
                {{ $vehicles->withQueryString()->links() }}
            </div>
        @endif
    @else
        <div class="text-center py-5">
            <i class="fa fa-car fa-3x text-muted mb-3 d-block opacity-50"></i>
            <h6 class="text-muted">No vehicles found</h6>
            @if(request()->hasAny(['search', 'category', 'status']))
                <a href="{{ route('admin.vehicles.index') }}" class="btn btn-outline-secondary btn-sm mt-2">Clear Filters</a>
            @else
                <a href="{{ route('admin.vehicles.create') }}" class="btn btn-primary btn-sm mt-2">
                    <i class="fa fa-plus me-1"></i>Add First Vehicle
                </a>
            @endif
        </div>
    @endif
</div>

@endsection
