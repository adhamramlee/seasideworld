<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — SeasideWorld</title>

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
            --sidebar-width: 260px;
        }
        * { box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f0f4f8; min-height: 100vh; }
        h1,h2,h3,h4,h5,h6 { font-family: 'Poppins', sans-serif; }

        /* Sidebar */
        #sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--ocean-dark);
            overflow-y: auto;
            z-index: 1040;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s;
        }
        .sidebar-brand {
            padding: 1.5rem 1.5rem 1rem;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.3rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-decoration: none;
            display: block;
        }
        .sidebar-brand:hover { color: var(--ocean-teal); }
        .sidebar-section {
            padding: 1.5rem 0.75rem 0.5rem;
        }
        .sidebar-section-label {
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: rgba(255,255,255,0.35);
            padding: 0 0.75rem;
            margin-bottom: 0.5rem;
        }
        .sidebar-nav { list-style: none; padding: 0; margin: 0; }
        .sidebar-nav li a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.65rem 1rem;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            border-radius: 8px;
            font-size: 0.93rem;
            font-weight: 500;
            transition: all 0.2s;
            margin-bottom: 2px;
        }
        .sidebar-nav li a i { width: 20px; text-align: center; font-size: 0.95rem; }
        .sidebar-nav li a:hover { background: rgba(255,255,255,0.08); color: #fff; }
        .sidebar-nav li a.active { background: var(--ocean-teal); color: #fff; }
        .sidebar-badge {
            margin-left: auto;
            background: var(--gold);
            color: #fff;
            font-size: 0.7rem;
            padding: 0.15rem 0.45rem;
            border-radius: 10px;
        }

        /* Top Navbar */
        #topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: 64px;
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            z-index: 1030;
            box-shadow: 0 1px 4px rgba(0,0,0,0.06);
        }
        .topbar-title { font-family: 'Poppins', sans-serif; font-weight: 600; font-size: 1.1rem; color: var(--ocean-dark); }
        .topbar-right { display: flex; align-items: center; gap: 1rem; }
        .topbar-icon-btn {
            background: none; border: none; color: #64748b; font-size: 1.1rem; cursor: pointer;
            position: relative; padding: 0.4rem;
        }
        .topbar-icon-btn:hover { color: var(--ocean-teal); }
        .notif-badge {
            position: absolute; top: 0; right: 0;
            background: #ef4444; color: #fff; font-size: 0.6rem;
            width: 16px; height: 16px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
        }
        .user-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: var(--ocean-teal); color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-weight: 600; font-size: 0.9rem;
        }

        /* Main content */
        #main-content {
            margin-left: var(--sidebar-width);
            padding-top: 64px;
            min-height: 100vh;
        }
        .content-wrapper { padding: 1.75rem; }

        /* Flash */
        .flash-box { margin-bottom: 1.25rem; }

        /* Cards */
        .admin-card {
            background: #fff;
            border-radius: 12px;
            border: none;
            box-shadow: 0 1px 8px rgba(0,0,0,0.07);
        }
        .admin-card .card-header {
            background: none;
            border-bottom: 1px solid #e2e8f0;
            padding: 1rem 1.25rem;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }

        /* Responsive */
        @media (max-width: 991px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.show { transform: translateX(0); }
            #topbar { left: 0; }
            #main-content { margin-left: 0; }
        }

        .btn-primary { background: var(--ocean-teal); border-color: var(--ocean-teal); }
        .btn-primary:hover { background: #0096c7; border-color: #0096c7; }
    </style>

    @yield('extra-css')
</head>
<body>

<!-- Sidebar -->
<nav id="sidebar">
    <a class="sidebar-brand" href="{{ route('admin.dashboard') }}">
        🌊 SeasideWorld
        <div style="font-size: 0.7rem; font-weight: 400; color: rgba(255,255,255,0.4); margin-top: 2px;">Admin Panel</div>
    </a>

    <div class="sidebar-section flex-fill">
        <div class="sidebar-section-label">Main</div>
        <ul class="sidebar-nav">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
        </ul>

        <div class="sidebar-section-label mt-3">Inventory</div>
        <ul class="sidebar-nav">
            <li>
                <a href="{{ route('admin.vehicles.index') }}" class="{{ request()->routeIs('admin.vehicles*') ? 'active' : '' }}">
                    <i class="fa fa-car"></i> Vehicles
                </a>
            </li>
            <li>
                <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                    <i class="fa fa-tags"></i> Categories
                </a>
            </li>
        </ul>

        <div class="sidebar-section-label mt-3">Content</div>
        <ul class="sidebar-nav">
            <li>
                <a href="{{ route('admin.pages.index') }}" class="{{ request()->routeIs('admin.pages*') ? 'active' : '' }}">
                    <i class="fa fa-file-alt"></i> Pages
                </a>
            </li>
            <li>
                <a href="{{ route('admin.documents.index') }}" class="{{ request()->routeIs('admin.documents*') ? 'active' : '' }}">
                    <i class="fa fa-folder-open"></i> Documents
                </a>
            </li>
        </ul>

        <div class="sidebar-section-label mt-3">Customers</div>
        <ul class="sidebar-nav">
            <li>
                <a href="{{ route('admin.clients.index') }}" class="{{ request()->routeIs('admin.clients*') ? 'active' : '' }}">
                    <i class="fa fa-users"></i> Clients
                </a>
            </li>
            <li>
                <a href="{{ route('admin.inquiries.index') }}" class="{{ request()->routeIs('admin.inquiries*') ? 'active' : '' }}">
                    <i class="fa fa-comments"></i> Inquiries
                    {{-- @if($pendingInquiries ?? 0 > 0)
                        <span class="sidebar-badge">{{ $pendingInquiries }}</span>
                    @endif --}}
                </a>
            </li>
        </ul>
    </div>

    <!-- Sidebar Footer -->
    <div style="padding: 1rem; border-top: 1px solid rgba(255,255,255,0.1);">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" style="background: none; border: none; color: rgba(255,255,255,0.5); font-size: 0.88rem; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; padding: 0.4rem 0; width: 100%;">
                <i class="fa fa-sign-out-alt"></i> Sign Out
            </button>
        </form>
    </div>
</nav>

<!-- Top Bar -->
<div id="topbar">
    <div class="d-flex align-items-center gap-3">
        <button class="topbar-icon-btn d-lg-none" id="sidebarToggle" onclick="document.getElementById('sidebar').classList.toggle('show')">
            <i class="fa fa-bars"></i>
        </button>
        <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
    </div>
    <div class="topbar-right">
        <button class="topbar-icon-btn" title="Notifications">
            <i class="fa fa-bell"></i>
            <span class="notif-badge">3</span>
        </button>
        <div class="dropdown">
            <button class="btn p-0 d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
                <div class="text-start d-none d-md-block">
                    <div style="font-size: 0.85rem; font-weight: 600; color: #1e293b;">{{ auth()->user()->name ?? 'Admin' }}</div>
                    <div style="font-size: 0.75rem; color: #64748b;">Administrator</div>
                </div>
                <i class="fa fa-chevron-down" style="font-size: 0.75rem; color: #94a3b8;"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="fa fa-home me-2 text-muted"></i>Dashboard</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fa fa-sign-out-alt me-2"></i>Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- Main Content -->
<div id="main-content">
    <div class="content-wrapper">

        <!-- Flash Messages -->
        <div class="flash-box">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-triangle me-2"></i>{{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa fa-exclamation-circle me-2"></i>
                    <strong>Please fix the following errors:</strong>
                    <ul class="mb-0 mt-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
        </div>

        @yield('content')
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Close sidebar on outside click (mobile)
    document.addEventListener('click', function(e) {
        const sidebar = document.getElementById('sidebar');
        const toggle = document.getElementById('sidebarToggle');
        if (sidebar && sidebar.classList.contains('show') && !sidebar.contains(e.target) && toggle && !toggle.contains(e.target)) {
            sidebar.classList.remove('show');
        }
    });

    // Auto-dismiss alerts
    setTimeout(function() {
        document.querySelectorAll('.flash-box .alert').forEach(function(el) {
            var alert = bootstrap.Alert.getOrCreateInstance(el);
            alert.close();
        });
    }, 6000);
</script>

@yield('extra-js')
</body>
</html>
