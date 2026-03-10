@extends('layouts.auth')

@section('title', 'Create Account')

@section('content')

<h4 class="text-center mb-1" style="font-weight: 700; color: #0c2340;">Create Account</h4>
<p class="text-center text-muted mb-4" style="font-size: 0.88rem;">Register for a SeasideWorld client account</p>

<form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name -->
    <div class="mb-3">
        <label class="form-label" for="name">Full Name <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-text" style="background: #f8fafc; border-right: none; border-color: #d1d5db;">
                <i class="fa fa-user text-muted"></i>
            </span>
            <input type="text" id="name" name="name"
                   class="form-control @error('name') is-invalid @enderror"
                   style="border-left: none;"
                   value="{{ old('name') }}"
                   placeholder="Your full name"
                   autocomplete="name" autofocus required>
        </div>
        @error('name')
            <div class="text-danger mt-1" style="font-size: 0.83rem;">{{ $message }}</div>
        @enderror
    </div>

    <!-- Email -->
    <div class="mb-3">
        <label class="form-label" for="email">Email Address <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-text" style="background: #f8fafc; border-right: none; border-color: #d1d5db;">
                <i class="fa fa-envelope text-muted"></i>
            </span>
            <input type="email" id="email" name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   style="border-left: none;"
                   value="{{ old('email') }}"
                   placeholder="your@email.com"
                   autocomplete="email" required>
        </div>
        @error('email')
            <div class="text-danger mt-1" style="font-size: 0.83rem;">{{ $message }}</div>
        @enderror
    </div>

    <!-- Password -->
    <div class="mb-3">
        <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-text" style="background: #f8fafc; border-right: none; border-color: #d1d5db;">
                <i class="fa fa-lock text-muted"></i>
            </span>
            <input type="password" id="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   style="border-left: none; border-right: none;"
                   placeholder="Minimum 8 characters"
                   autocomplete="new-password" required>
            <button type="button" class="input-group-text" style="background: #f8fafc; border-left: none; border-color: #d1d5db; cursor: pointer;"
                    onclick="togglePwd('password', 'toggleIcon1')">
                <i class="fa fa-eye text-muted" id="toggleIcon1"></i>
            </button>
        </div>
        @error('password')
            <div class="text-danger mt-1" style="font-size: 0.83rem;">{{ $message }}</div>
        @enderror
    </div>

    <!-- Confirm Password -->
    <div class="mb-4">
        <label class="form-label" for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-text" style="background: #f8fafc; border-right: none; border-color: #d1d5db;">
                <i class="fa fa-lock text-muted"></i>
            </span>
            <input type="password" id="password_confirmation" name="password_confirmation"
                   class="form-control"
                   style="border-left: none; border-right: none;"
                   placeholder="Repeat your password"
                   autocomplete="new-password" required>
            <button type="button" class="input-group-text" style="background: #f8fafc; border-left: none; border-color: #d1d5db; cursor: pointer;"
                    onclick="togglePwd('password_confirmation', 'toggleIcon2')">
                <i class="fa fa-eye text-muted" id="toggleIcon2"></i>
            </button>
        </div>
    </div>

    <!-- Submit -->
    <button type="submit" class="btn-auth">
        <i class="fa fa-user-plus me-2"></i>Create Account
    </button>
</form>

<div class="auth-divider mt-4">
    <span>Already have an account?</span>
</div>
<div class="text-center">
    <a href="{{ route('login') }}" class="auth-link" style="font-size: 0.9rem;">
        Sign in instead
    </a>
</div>

@endsection

@section('extra-js')
<script>
    function togglePwd(fieldId, iconId) {
        const pwd = document.getElementById(fieldId);
        const icon = document.getElementById(iconId);
        if (pwd.type === 'password') {
            pwd.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            pwd.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>
@endsection
