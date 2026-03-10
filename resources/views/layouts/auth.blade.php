<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sign In') — SeasideWorld</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --ocean-dark: #0c2340;
            --ocean-mid: #1a3a5c;
            --ocean-teal: #00b4d8;
            --gold: #f59e0b;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, var(--ocean-dark) 0%, #0a4f6e 50%, #006d8e 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            position: relative;
            overflow: hidden;
        }
        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(ellipse at center, rgba(0,180,216,0.12) 0%, transparent 60%);
            animation: pulse 8s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.1); opacity: 1; }
        }
        h1,h2,h3,h4,h5,h6 { font-family: 'Poppins', sans-serif; }

        .auth-card {
            background: #fff;
            border-radius: 16px;
            padding: 2.5rem;
            width: 100%;
            max-width: 440px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            position: relative;
            z-index: 10;
        }
        .auth-logo {
            text-align: center;
            margin-bottom: 1.75rem;
        }
        .auth-logo .logo-text {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.8rem;
            color: var(--ocean-dark);
        }
        .auth-logo .logo-sub {
            font-size: 0.85rem;
            color: #64748b;
            margin-top: 0.25rem;
        }
        .auth-divider {
            text-align: center;
            border-top: 1px solid #e2e8f0;
            margin: 1.5rem 0;
        }
        .auth-divider span {
            background: #fff;
            padding: 0 0.75rem;
            color: #94a3b8;
            font-size: 0.85rem;
            position: relative;
            top: -0.7rem;
        }
        .form-label { font-weight: 500; font-size: 0.9rem; color: #374151; }
        .form-control {
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 0.65rem 1rem;
            font-size: 0.93rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-control:focus {
            border-color: var(--ocean-teal);
            box-shadow: 0 0 0 3px rgba(0,180,216,0.12);
        }
        .btn-auth {
            background: var(--ocean-dark);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-size: 0.95rem;
            font-weight: 600;
            font-family: 'Poppins', sans-serif;
            width: 100%;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
        }
        .btn-auth:hover {
            background: var(--ocean-teal);
            transform: translateY(-1px);
        }
        .btn-auth:active { transform: translateY(0); }
        .auth-link { color: var(--ocean-teal); text-decoration: none; font-weight: 500; }
        .auth-link:hover { text-decoration: underline; }

        /* Wave decoration */
        .auth-waves {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            pointer-events: none;
            z-index: 1;
        }
    </style>

    @yield('extra-css')
</head>
<body>

<!-- Wave decoration -->
<div class="auth-waves">
    <svg viewBox="0 0 1440 120" xmlns="http://www.w3.org/2000/svg">
        <path d="M0,60 C360,100 1080,20 1440,60 L1440,120 L0,120 Z" fill="rgba(0,180,216,0.15)"/>
        <path d="M0,80 C480,40 960,100 1440,80 L1440,120 L0,120 Z" fill="rgba(0,180,216,0.1)"/>
    </svg>
</div>

<div class="auth-card">
    <div class="auth-logo">
        <div class="logo-text">🌊 SeasideWorld</div>
        <div class="logo-sub">Premium Japanese Vehicle Exports</div>
    </div>

    @if(session('status'))
        <div class="alert alert-success mb-3" role="alert">
            <i class="fa fa-check-circle me-2"></i>{{ session('status') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger mb-3" role="alert">
            <i class="fa fa-exclamation-circle me-2"></i>{{ session('error') }}
        </div>
    @endif

    @yield('content')
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@yield('extra-js')
</body>
</html>
