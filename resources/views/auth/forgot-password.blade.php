@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('content')

<div class="text-center mb-4">
    <div style="width: 56px; height: 56px; border-radius: 50%; background: #e0f7fc; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; color: #00b4d8; font-size: 1.4rem;">
        <i class="fa fa-lock-open"></i>
    </div>
    <h4 style="font-weight: 700; color: #0c2340; margin-bottom: 0.5rem;">Forgot Password?</h4>
    <p class="text-muted" style="font-size: 0.88rem;">
        Enter your email address and we'll send you a link to reset your password.
    </p>
</div>

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="mb-4">
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

    <button type="submit" class="btn-auth">
        <i class="fa fa-paper-plane me-2"></i>Send Reset Link
    </button>
</form>

<div class="auth-divider mt-4">
    <span>Remembered your password?</span>
</div>
<div class="text-center">
    <a href="{{ route('login') }}" class="auth-link" style="font-size: 0.9rem;">
        <i class="fa fa-arrow-left me-1"></i>Back to Sign In
    </a>
</div>

@endsection
