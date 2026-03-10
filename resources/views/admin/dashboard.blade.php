@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-2">Total Vehicles</h6>
                    <h2 class="mb-0">{{ $totalVehicles }}</h2>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-truck"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-2">Total Inquiries</h6>
                    <h2 class="mb-0">{{ $totalInquiries }}</h2>
                    <small class="text-warning">{{ $pendingInquiries }} pending</small>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-2">Total Clients</h6>
                    <h2 class="mb-0">{{ $totalClients }}</h2>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-2">Total Documents</h6>
                    <h2 class="mb-0">{{ $totalDocuments }}</h2>
                </div>
                <div class="stat-icon">
                    <i class="fas fa-file-pdf"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Recent Inquiries</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentInquiries as $inquiry)
                                <tr>
                                    <td>{{ $inquiry->name }}</td>
                                    <td>{{ $inquiry->email }}</td>
                                    <td>
                                        <span class="badge bg-{{ $inquiry->status == 'pending' ? 'warning' : ($inquiry->status == 'replied' ? 'success' : 'secondary') }}">
                                            {{ ucfirst($inquiry->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $inquiry->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No inquiries found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('admin.inquiries.index') }}" class="btn btn-primary btn-sm">View All</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Recent Clients</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Company</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentClients as $client)
                                <tr>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->company ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $client->is_active ? 'success' : 'danger' }}">
                                            {{ $client->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No clients found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <a href="{{ route('admin.clients.index') }}" class="btn btn-primary btn-sm">View All</a>
            </div>
        </div>
    </div>
</div>
@endsection