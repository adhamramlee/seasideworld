<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Client Portal') — SeasideWorld</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --ocean-dark: #0c2340;
            --ocean-teal: #00b4d8;
            --gold: #f59e0b;
            --sidebar-width: 240px;
        }
        body { font-family: 'Inter', sans-serif; background: #f8fafc; min-height: 100vh; }
        h1,h2,h3,h4,h5,h6 { font-family: 'Poppins', sans-serif; }

        /* Top Navbar */
        #client-topbar {
            position: fixed; top: 0; left: 0; right: 0;
            height: 60px; background: var(--ocean-dark);
            display: flex; align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem; z-index: 1040;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        .topbar-brand { font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 1.2rem; color: #fff; text-decoration: none; }
        .topbar-brand:hover { color: var(--ocean-teal); }

        /* Sidebar */
        #client-sidebar {
            position: fixed; top: 60px; left: 0;
            width: var(--sidebar-width); height: calc(100vh - 60px);
            background: #fff; border-right: 1px solid #e2e8f0;
            overflow-y: auto; z-index: 1030;
            transition: transform 0.3s;
        }
        .client-nav { list-style: none; padding: 1rem 0.75rem; margin: 0; }
        .client-nav li { margin-bottom: 2px; }
        .client-nav li a {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.65rem 1rem;
            color: #475569; text-decoration: none;
            border-radius: 8px; font-size: 0.93rem; font-weight: 500;
            transition: all 0.2s;
        }
        .client-nav li a i { width: 20px; text-align: center; color: #94a3b8; }
        .client-nav li a:hover { background: #f0f9ff; color: var(--ocean-dark); }
        .client-nav li a:hover i { color: var(--ocean-teal); }
        .client-nav li a.active { background: #e0f7fc; color: var(--ocean-dark); font-weight: 600; }
        .client-nav li a.active i { color: var(--ocean-teal); }
        .client-nav-divider { border-top: 1px solid #e2e8f0; margin: 0.75rem 0; }

        /* Main Content */
        #client-main {
            margin-left: var(--sidebar-width);
            padding-top: 60px;
            min-height: 100vh;
        }
        .client-content { padding: 1.75rem; }

        /* Cards */
        .client-card {
            background: #fff; border-radius: 12px;
            border: none; box-shadow: 0 1px 6px rgba(0,0,0,0.07);
        }
        .client-card .card-header {
            background: none; border-bottom: 1px solid #f1f5f9;
            padding: 1rem 1.25rem;
            font-family: 'Poppins', sans-serif; font-weight: 600;
        }

        .btn-primary { background: var(--ocean-teal); border-color: var(--ocean-teal); }
        .btn-primary:hover { background: #0096c7; border-color: #0096c7; }

        @media (max-width: 991px) {
            #client-sidebar { transform: translateX(-100%); }
            #client-sidebar.show { transform: translateX(0); }
            #client-main { margin-left: 0; }
        }
    </style>

    @yield('extra-css')
</head>
<body>

<!-- Top Navbar -->
<nav id="client-topbar">
    <div class="d-flex align-items-center gap-3">
        <button class="btn p-0 d-lg-none" style="color:#fff; background:none; border:none;" onclick="document.getElementById('client-sidebar').classList.toggle('show')">
            <i class="fa fa-bars fa-lg"></i>
        </button>
        <a class="topbar-brand" href="{{ route('home') }}">🌊 SeasideWorld</a>
    </div>
    <div class="d-flex align-items-center gap-3">
        <span style="color: rgba(255,255,255,0.7); font-size: 0.88rem;">
            <i class="fa fa-user-circle me-1"></i>{{ auth()->user()->name ?? 'Client' }}
        </span>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" style="background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.25); color: #fff; padding: 0.35rem 0.9rem; border-radius: 6px; font-size: 0.85rem; cursor: pointer;">
                <i class="fa fa-sign-out-alt me-1"></i>Logout
            </button>
        </form>
    </div>
</nav>

<!-- Sidebar -->
<nav id="client-sidebar">
    <div style="padding: 1rem 1.25rem 0.5rem;">
        <div style="font-size: 0.7rem; font-weight: 600; letter-spacing: 1.5px; text-transform: uppercase; color: #94a3b8;">Client Portal</div>
    </div>
    <ul class="client-nav">
        <li>
            <a href="{{ route('client.dashboard') }}" class="{{ request()->routeIs('client.dashboard') ? 'active' : '' }}">
                <i class="fa fa-home"></i> Dashboard
            </a>
        </li>
        <li><div class="client-nav-divider"></div></li>
        <li>
            <a href="{{ route('client.documents.index') }}" class="{{ request()->routeIs('client.documents*') ? 'active' : '' }}">
                <i class="fa fa-folder-open"></i> My Documents
            </a>
        </li>
        <li>
            <a href="{{ route('client.inquiries.index') }}" class="{{ request()->routeIs('client.inquiries*') ? 'active' : '' }}">
                <i class="fa fa-comments"></i> My Inquiries
            </a>
        </li>
        <li><div class="client-nav-divider"></div></li>
        <li>
            <a href="{{ route('client.profile.edit') }}" class="{{ request()->routeIs('client.profile*') ? 'active' : '' }}">
                <i class="fa fa-user-cog"></i> Profile Settings
            </a>
        </li>
        <li><div class="client-nav-divider"></div></li>
        <li>
            <a href="{{ route('home') }}">
                <i class="fa fa-globe"></i> Visit Website
            </a>
        </li>
    </ul>
</nav>

<!-- Main Content -->
<main id="client-main">
    <div class="client-content">

        <!-- Flash Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                <i class="fa fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                <strong>Please fix the following errors:</strong>
                <ul class="mb-0 mt-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>
</main>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Close sidebar on outside click (mobile)
    document.addEventListener('click', function(e) {
        const sidebar = document.getElementById('client-sidebar');
        if (sidebar && sidebar.classList.contains('show') && !sidebar.contains(e.target) && !e.target.closest('[onclick*="client-sidebar"]')) {
            sidebar.classList.remove('show');
        }
    });

    // Auto-dismiss alerts
    setTimeout(function() {
        document.querySelectorAll('.alert').forEach(function(el) {
            var alert = bootstrap.Alert.getOrCreateInstance(el);
            alert.close();
        });
    }, 6000);
</script>

@yield('extra-js')
</body>
</html>
