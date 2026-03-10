@extends('layouts.client')

@section('title', 'Profile Settings')

@section('content')

<!-- Page Header -->
<div class="mb-4">
    <h4 style="font-weight: 700; color: #0c2340; margin-bottom: 0.25rem;">
        <i class="fa fa-user-cog me-2" style="color: #00b4d8;"></i>Profile Settings
    </h4>
    <p class="text-muted mb-0" style="font-size: 0.9rem;">Manage your account information and security settings.</p>
</div>

<div class="row g-4">
    <!-- Profile Update Form -->
    <div class="col-lg-7">
        <div class="client-card mb-4">
            <div class="card-header">
                <i class="fa fa-user me-2 text-muted"></i>Personal Information
            </div>
            <div class="card-body p-4">
                <form action="{{ route('client.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="name">Full Name <span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', auth()->user()->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="email">Email Address <span class="text-danger">*</span></label>
                            <input type="email" id="email" name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', auth()->user()->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   value="{{ old('phone', auth()->user()->phone ?? '') }}"
                                   placeholder="+1 234 567 8900">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="company">Company / Organization</label>
                            <input type="text" id="company" name="company"
                                   class="form-control @error('company') is-invalid @enderror"
                                   value="{{ old('company', auth()->user()->company ?? '') }}"
                                   placeholder="Your company name">
                            @error('company')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 mt-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save me-2"></i>Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Password Change -->
        <div class="client-card">
            <div class="card-header">
                <i class="fa fa-lock me-2 text-muted"></i>Change Password
            </div>
            <div class="card-body p-4">
                <form action="{{ route('client.profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label" for="current_password">Current Password <span class="text-danger">*</span></label>
                            <input type="password" id="current_password" name="current_password"
                                   class="form-control @error('current_password') is-invalid @enderror"
                                   placeholder="Enter your current password" required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="password">New Password <span class="text-danger">*</span></label>
                            <input type="password" id="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Minimum 8 characters" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="password_confirmation">Confirm New Password <span class="text-danger">*</span></label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   class="form-control" placeholder="Repeat new password" required>
                        </div>
                        <div class="col-12 mt-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-key me-2"></i>Update Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Account Sidebar -->
    <div class="col-lg-5">
        <!-- Avatar Card -->
        <div class="client-card mb-4">
            <div class="card-body p-4 text-center">
                <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, #0c2340, #1a3a5c); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: 700; font-family: 'Poppins', sans-serif; margin: 0 auto 1rem;">
                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                </div>
                <h5 style="font-weight: 700; color: #0c2340; margin-bottom: 0.25rem;">{{ auth()->user()->name }}</h5>
                <p class="text-muted mb-2" style="font-size: 0.88rem;">{{ auth()->user()->email }}</p>
                <span class="badge" style="background: #e0f7fc; color: #006d8e; font-size: 0.78rem;">Client Account</span>
            </div>
        </div>

        <!-- Account Info -->
        <div class="client-card">
            <div class="card-header">
                <i class="fa fa-shield-alt me-2 text-muted"></i>Account Security
            </div>
            <div class="card-body p-3">
                <div class="d-flex align-items-center justify-content-between py-2" style="border-bottom: 1px solid #f1f5f9;">
                    <div>
                        <div style="font-size: 0.88rem; font-weight: 600; color: #374151;">Email Verified</div>
                        <div style="font-size: 0.78rem; color: #94a3b8;">Your email status</div>
                    </div>
                    @if(auth()->user()->email_verified_at)
                        <span class="badge bg-success">Verified</span>
                    @else
                        <span class="badge bg-warning">Unverified</span>
                    @endif
                </div>
                <div class="d-flex align-items-center justify-content-between py-2" style="border-bottom: 1px solid #f1f5f9;">
                    <div>
                        <div style="font-size: 0.88rem; font-weight: 600; color: #374151;">Member Since</div>
                        <div style="font-size: 0.78rem; color: #94a3b8;">Account creation date</div>
                    </div>
                    <span style="font-size: 0.85rem; color: #64748b;">{{ auth()->user()->created_at->format('M Y') }}</span>
                </div>
                <div class="d-flex align-items-center justify-content-between py-2">
                    <div>
                        <div style="font-size: 0.88rem; font-weight: 600; color: #374151;">Last Login</div>
                        <div style="font-size: 0.78rem; color: #94a3b8;">Most recent session</div>
                    </div>
                    <span style="font-size: 0.85rem; color: #64748b;">Today</span>
                </div>

                <!-- Delete account link (disabled by default) -->
                <div class="mt-3 pt-2" style="border-top: 1px solid #f1f5f9;">
                    <p class="text-muted mb-2" style="font-size: 0.8rem;">Need to close your account? Contact us.</p>
                    <a href="mailto:info@seasideworld.jp?subject=Account Deletion Request" class="btn btn-outline-danger btn-sm w-100">
                        <i class="fa fa-trash me-1"></i>Request Account Deletion
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
