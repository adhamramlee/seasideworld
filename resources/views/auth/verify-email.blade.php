@extends('layouts.auth')

@section('title', 'Verify Email')

@section('content')

<div class="text-center mb-4">
    <div style="width: 64px; height: 64px; border-radius: 50%; background: #e0f7fc; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem; color: #00b4d8; font-size: 1.6rem;">
        <i class="fa fa-envelope-open-text"></i>
    </div>
    <h4 style="font-weight: 700; color: #0c2340; margin-bottom: 0.75rem;">Verify Your Email</h4>
    <p class="text-muted" style="font-size: 0.9rem; line-height: 1.65;">
        Thanks for signing up! Before getting started, please verify your email address by clicking the link we just sent to you.
        If you didn't receive the email, we'll gladly send another.
    </p>
</div>

@if (session('status') == 'verification-link-sent')
    <div class="alert alert-success mb-4" role="alert" style="border-radius: 10px; font-size: 0.9rem;">
        <i class="fa fa-check-circle me-2"></i>
        A new verification link has been sent to your email address!
    </div>
@endif

<div class="d-flex flex-column gap-3">
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="btn-auth">
            <i class="fa fa-paper-plane me-2"></i>Resend Verification Email
        </button>
    </form>

    <div class="text-center">
        <form method="POST" action="{{ route('logout') }}" class="d-inline">
            @csrf
            <button type="submit" class="auth-link" style="background: none; border: none; cursor: pointer; font-size: 0.88rem;">
                <i class="fa fa-sign-out-alt me-1"></i>Sign out of this account
            </button>
        </form>
    </div>
</div>

@endsection
