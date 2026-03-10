@extends('layouts.auth')

@section('title', 'Confirm Password')

@section('content')

<div class="text-center mb-4">
    <div style="width: 56px; height: 56px; border-radius: 50%; background: #fef3c7; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; color: #f59e0b; font-size: 1.3rem;">
        <i class="fa fa-shield-alt"></i>
    </div>
    <h4 style="font-weight: 700; color: #0c2340; margin-bottom: 0.5rem;">Confirm Password</h4>
    <p class="text-muted" style="font-size: 0.88rem; line-height: 1.6;">
        This is a secure area. Please confirm your password before continuing.
    </p>
</div>

<form method="POST" action="{{ route('password.confirm') }}">
    @csrf

    <div class="mb-4">
        <label class="form-label" for="password">Current Password</label>
        <div class="input-group">
            <span class="input-group-text" style="background: #f8fafc; border-right: none; border-color: #d1d5db;">
                <i class="fa fa-lock text-muted"></i>
            </span>
            <input type="password" id="password" name="password"
                   class="form-control @error('password') is-invalid @enderror"
                   style="border-left: none; border-right: none;"
                   placeholder="Enter your password"
                   autocomplete="current-password" autofocus required>
            <button type="button" class="input-group-text" style="background: #f8fafc; border-left: none; border-color: #d1d5db; cursor: pointer;"
                    onclick="const p=document.getElementById('password'); p.type=p.type==='password'?'text':'password'; this.querySelector('i').classList.toggle('fa-eye'); this.querySelector('i').classList.toggle('fa-eye-slash');">
                <i class="fa fa-eye text-muted"></i>
            </button>
        </div>
        @error('password')
            <div class="text-danger mt-1" style="font-size: 0.83rem;">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn-auth">
        <i class="fa fa-check-circle me-2"></i>Confirm
    </button>
</form>

@endsection
