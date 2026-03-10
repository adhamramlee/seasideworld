@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')

<h4 class="text-center mb-1" style="font-weight: 700; color: #0c2340;">Reset Password</h4>
<p class="text-center text-muted mb-4" style="font-size: 0.88rem;">Enter and confirm your new password below.</p>

<form method="POST" action="{{ route('password.store') }}">
    @csrf

    <!-- Token -->
    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <!-- Email (pre-filled) -->
    <div class="mb-3">
        <label class="form-label" for="email">Email Address</label>
        <input type="email" id="email" name="email"
               class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email', $request->email) }}"
               placeholder="your@email.com"
               autocomplete="email" required readonly
               style="background: #f8fafc;">
        @error('email')
            <div class="text-danger mt-1" style="font-size: 0.83rem;">{{ $message }}</div>
        @enderror
    </div>

    <!-- New Password -->
    <div class="mb-3">
        <label class="form-label" for="password">New Password <span class="text-danger">*</span></label>
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
                    onclick="togglePwd('password', 'icon1')">
                <i class="fa fa-eye text-muted" id="icon1"></i>
            </button>
        </div>
        @error('password')
            <div class="text-danger mt-1" style="font-size: 0.83rem;">{{ $message }}</div>
        @enderror
    </div>

    <!-- Confirm Password -->
    <div class="mb-4">
        <label class="form-label" for="password_confirmation">Confirm New Password <span class="text-danger">*</span></label>
        <div class="input-group">
            <span class="input-group-text" style="background: #f8fafc; border-right: none; border-color: #d1d5db;">
                <i class="fa fa-lock text-muted"></i>
            </span>
            <input type="password" id="password_confirmation" name="password_confirmation"
                   class="form-control"
                   style="border-left: none; border-right: none;"
                   placeholder="Repeat new password"
                   autocomplete="new-password" required>
            <button type="button" class="input-group-text" style="background: #f8fafc; border-left: none; border-color: #d1d5db; cursor: pointer;"
                    onclick="togglePwd('password_confirmation', 'icon2')">
                <i class="fa fa-eye text-muted" id="icon2"></i>
            </button>
        </div>
    </div>

    <button type="submit" class="btn-auth">
        <i class="fa fa-key me-2"></i>Reset Password
    </button>
</form>

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
