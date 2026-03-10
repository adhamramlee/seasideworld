@extends('layouts.auth')

@section('title', 'Sign In')

@section('content')

<h4 class="text-center mb-1" style="font-weight: 700; color: #0c2340;">Welcome back</h4>
<p class="text-center text-muted mb-4" style="font-size: 0.88rem;">Sign in to your SeasideWorld account</p>

<form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email -->
    <div class="mb-3">
        <label class="form-label" for="email">Email Address</label>
        <div class="input-group">
            <span class="input-group-text" style="background: #f8fafc; border-right: none; border-color: #d1d5db;">
                <i class="fa fa-envelope text-muted"></i>
            </span>
            <input type="email" id="email" name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   style="border-left: none;"
                   value="{{ old('email') }}"
                   placeholder="your@email.com"
                   autocomplete="email" autofocus required>
        </div>
        @error('email')
            <div class="text-danger mt-1" style="font-size: 0.83rem;">{{ $message }}</div>
        @enderror
    </div>

    <!-- Password -->
    <div class="mb-3">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <label class="form-label mb-0" for="password">Password</label>
            @if(Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="auth-link" style="font-size: 0.82rem;">
                    Forgot password?
                </a>
            @endif
        </div>
        <div class="input-group">
            <span class="input-group-text" style="background: #f8fafc; border-right: none; border-color: #d1d5db;">
                <i class="fa fa-lock text-muted"></i>
            </span>
            <input type="password" id="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   style="border-left: none; border-right: none;"
                   placeholder="••••••••"
                   autocomplete="current-password" required>
            <button type="button" class="input-group-text" style="background: #f8fafc; border-left: none; border-color: #d1d5db; cursor: pointer;"
                    onclick="togglePassword()">
                <i class="fa fa-eye text-muted" id="toggleIcon"></i>
            </button>
        </div>
        @error('password')
            <div class="text-danger mt-1" style="font-size: 0.83rem;">{{ $message }}</div>
        @enderror
    </div>

    <!-- Remember Me -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="form-check mb-0">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember" style="font-size: 0.88rem; color: #64748b;">
                Remember me
            </label>
        </div>
    </div>

    <!-- Submit -->
    <button type="submit" class="btn-auth">
        <i class="fa fa-sign-in-alt me-2"></i>Sign In
    </button>
</form>

@if(Route::has('register'))
    <div class="auth-divider mt-4">
        <span>New to SeasideWorld?</span>
    </div>
    <div class="text-center">
        <a href="{{ route('register') }}" class="auth-link" style="font-size: 0.9rem;">
            Create an account
        </a>
    </div>
@endif

@endsection

@section('extra-js')
<script>
    function togglePassword() {
        const pwd = document.getElementById('password');
        const icon = document.getElementById('toggleIcon');
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
