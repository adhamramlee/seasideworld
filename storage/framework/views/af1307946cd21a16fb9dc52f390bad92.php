<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'SeasideWorld - Premium Japanese Vehicle Exports'); ?></title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

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
            --light-bg: #f0f7ff;
            --text-dark: #1e293b;
        }
        body { font-family: 'Inter', sans-serif; color: var(--text-dark); }
        h1,h2,h3,h4,h5,h6 { font-family: 'Poppins', sans-serif; }
        .navbar-brand { font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 1.5rem; }
        .navbar { background: var(--ocean-dark) !important; padding: 1rem 0; }
        .navbar .nav-link { color: rgba(255,255,255,0.85) !important; font-weight: 500; transition: color 0.2s; padding: 0.5rem 1rem !important; }
        .navbar .nav-link:hover, .navbar .nav-link.active { color: var(--ocean-teal) !important; }
        .btn-primary { background: var(--ocean-teal); border-color: var(--ocean-teal); color: #fff; }
        .btn-primary:hover { background: #0096c7; border-color: #0096c7; }
        .btn-outline-primary { border-color: var(--ocean-teal); color: var(--ocean-teal); }
        .btn-outline-primary:hover { background: var(--ocean-teal); color: #fff; }
        .footer { background: var(--ocean-dark); color: #94a3b8; padding: 3rem 0 1rem; }
        .footer h5 { color: #fff; font-family: 'Poppins', sans-serif; margin-bottom: 1.2rem; }
        .footer a { color: #94a3b8; text-decoration: none; }
        .footer a:hover { color: var(--ocean-teal); }
        .section-title { font-size: 2rem; font-weight: 700; color: var(--ocean-dark); margin-bottom: 0.5rem; }
        .section-subtitle { color: #64748b; font-size: 1.1rem; margin-bottom: 2.5rem; }
        .card { border: none; box-shadow: 0 2px 12px rgba(0,0,0,0.08); border-radius: 12px; transition: transform 0.2s, box-shadow 0.2s; }
        .card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,0.14); }
        .badge.bg-success { background: #10b981 !important; }
        .badge.bg-warning { background: #f59e0b !important; }
        .badge.bg-danger { background: #ef4444 !important; }

        /* Language switcher */
        .lang-switcher form { display: inline; }
        .lang-switcher .btn-lang {
            background: transparent;
            border: 1px solid rgba(255,255,255,0.3);
            color: rgba(255,255,255,0.75);
            font-size: 0.8rem;
            padding: 0.25rem 0.6rem;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .lang-switcher .btn-lang:hover,
        .lang-switcher .btn-lang.active-lang {
            background: var(--ocean-teal);
            border-color: var(--ocean-teal);
            color: #fff;
        }

        /* Flash messages */
        .flash-container { position: fixed; top: 80px; right: 1rem; z-index: 9999; min-width: 300px; }

        /* Footer bottom border */
        .footer-bottom { border-top: 1px solid rgba(255,255,255,0.1); padding-top: 1.5rem; margin-top: 2rem; }
    </style>

    <?php echo $__env->yieldContent('extra-css'); ?>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand text-white" href="<?php echo e(route('home')); ?>">
            🌊 SeasideWorld
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav mx-auto gap-1">
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>" href="<?php echo e(route('home')); ?>">
                        <?php echo e(__('messages.home')); ?>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('about') ? 'active' : ''); ?>" href="<?php echo e(route('about')); ?>">
                        <?php echo e(__('messages.about')); ?>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('services') ? 'active' : ''); ?>" href="<?php echo e(route('services')); ?>">
                        <?php echo e(__('messages.services')); ?>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('gallery') ? 'active' : ''); ?>" href="<?php echo e(route('gallery')); ?>">
                        <?php echo e(__('messages.gallery')); ?>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('export-process') ? 'active' : ''); ?>" href="<?php echo e(route('export-process')); ?>">
                        <?php echo e(__('messages.export_process')); ?>

                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('contact') ? 'active' : ''); ?>" href="<?php echo e(route('contact')); ?>">
                        <?php echo e(__('messages.contact')); ?>

                    </a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-2">
                <!-- Language Switcher -->
                <div class="lang-switcher d-flex gap-1 me-2">
                    <form action="<?php echo e(route('language.switch', 'en')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn-lang <?php echo e(app()->getLocale() === 'en' ? 'active-lang' : ''); ?>">EN</button>
                    </form>
                    <form action="<?php echo e(route('language.switch', 'jp')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn-lang <?php echo e(app()->getLocale() === 'jp' ? 'active-lang' : ''); ?>">JP</button>
                    </form>
                </div>

                <?php if(auth()->guard()->check()): ?>
                    <div class="dropdown">
                        <a class="btn btn-sm" style="color:rgba(255,255,255,0.85); border: 1px solid rgba(255,255,255,0.3);" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fa fa-user-circle me-1"></i><?php echo e(auth()->user()->name); ?>

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <?php if(auth()->user()->role === 'admin'): ?>
                                <li><a class="dropdown-item" href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-tachometer-alt me-2"></i>Admin Panel</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="<?php echo e(route('client.dashboard')); ?>"><i class="fa fa-home me-2"></i>Dashboard</a></li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="<?php echo e(route('logout')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fa fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                <?php else: ?>
                    <?php if(auth()->guard()->guest()): ?>
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-sm" style="background: var(--ocean-teal); color: #fff; border: none; padding: 0.4rem 1rem; border-radius: 6px; font-weight: 500;">
                            <i class="fa fa-sign-in-alt me-1"></i>Login
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<!-- Flash Messages -->
<div class="flash-container">
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show shadow" role="alert">
            <i class="fa fa-check-circle me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow" role="alert">
            <i class="fa fa-exclamation-circle me-2"></i><?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <?php if(session('warning')): ?>
        <div class="alert alert-warning alert-dismissible fade show shadow" role="alert">
            <i class="fa fa-exclamation-triangle me-2"></i><?php echo e(session('warning')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <?php if(session('info')): ?>
        <div class="alert alert-info alert-dismissible fade show shadow" role="alert">
            <i class="fa fa-info-circle me-2"></i><?php echo e(session('info')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
</div>

<!-- Main Content -->
<main>
    <?php echo $__env->yieldContent('content'); ?>
</main>

<!-- Footer -->
<footer class="footer mt-auto">
    <div class="container">
        <div class="row g-4">
            <!-- Brand -->
            <div class="col-lg-4 col-md-6">
                <h5 style="font-size:1.4rem;">🌊 SeasideWorld</h5>
                <p style="font-size: 0.93rem; line-height: 1.7;">
                    Your trusted partner for premium Japanese vehicle exports. 
                    We bring quality vehicles from Japan to customers worldwide.
                </p>
                <div class="d-flex gap-3 mt-3">
                    <a href="#" class="fs-5"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="fs-5"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="fs-5"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="fs-5"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="fs-5"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6">
                <h5>Quick Links</h5>
                <ul class="list-unstyled" style="line-height: 2;">
                    <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-chevron-right me-1" style="font-size:0.7rem; color: var(--ocean-teal);"></i><?php echo e(__('messages.home')); ?></a></li>
                    <li><a href="<?php echo e(route('about')); ?>"><i class="fa fa-chevron-right me-1" style="font-size:0.7rem; color: var(--ocean-teal);"></i><?php echo e(__('messages.about')); ?></a></li>
                    <li><a href="<?php echo e(route('services')); ?>"><i class="fa fa-chevron-right me-1" style="font-size:0.7rem; color: var(--ocean-teal);"></i><?php echo e(__('messages.services')); ?></a></li>
                    <li><a href="<?php echo e(route('gallery')); ?>"><i class="fa fa-chevron-right me-1" style="font-size:0.7rem; color: var(--ocean-teal);"></i><?php echo e(__('messages.gallery')); ?></a></li>
                    <li><a href="<?php echo e(route('export-process')); ?>"><i class="fa fa-chevron-right me-1" style="font-size:0.7rem; color: var(--ocean-teal);"></i><?php echo e(__('messages.export_process')); ?></a></li>
                    <li><a href="<?php echo e(route('contact')); ?>"><i class="fa fa-chevron-right me-1" style="font-size:0.7rem; color: var(--ocean-teal);"></i><?php echo e(__('messages.contact')); ?></a></li>
                </ul>
            </div>

            <!-- Services -->
            <div class="col-lg-2 col-md-6">
                <h5>Services</h5>
                <ul class="list-unstyled" style="line-height: 2;">
                    <li><a href="#"><i class="fa fa-chevron-right me-1" style="font-size:0.7rem; color: var(--ocean-teal);"></i>Vehicle Export</a></li>
                    <li><a href="#"><i class="fa fa-chevron-right me-1" style="font-size:0.7rem; color: var(--ocean-teal);"></i>Documentation</a></li>
                    <li><a href="#"><i class="fa fa-chevron-right me-1" style="font-size:0.7rem; color: var(--ocean-teal);"></i>Shipping</a></li>
                    <li><a href="#"><i class="fa fa-chevron-right me-1" style="font-size:0.7rem; color: var(--ocean-teal);"></i>Customs Clearance</a></li>
                    <li><a href="#"><i class="fa fa-chevron-right me-1" style="font-size:0.7rem; color: var(--ocean-teal);"></i>Inspection</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-4 col-md-6">
                <h5>Contact Us</h5>
                <ul class="list-unstyled" style="line-height: 2.2;">
                    <li><i class="fa fa-map-marker-alt me-2" style="color: var(--ocean-teal);"></i>Yokohama, Japan</li>
                    <li>
                        <a href="tel:+81000000000">
                            <i class="fa fa-phone me-2" style="color: var(--ocean-teal);"></i>+81 00-0000-0000
                        </a>
                    </li>
                    <li>
                        <a href="mailto:info@seasideworld.jp">
                            <i class="fa fa-envelope me-2" style="color: var(--ocean-teal);"></i>info@seasideworld.jp
                        </a>
                    </li>
                    <li>
                        <a href="https://wa.me/81000000000" target="_blank">
                            <i class="fab fa-whatsapp me-2" style="color: var(--ocean-teal);"></i>WhatsApp Us
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom text-center">
            <p class="mb-0" style="font-size: 0.88rem;">
                &copy; <?php echo e(date('Y')); ?> SeasideWorld. All rights reserved. &nbsp;|&nbsp;
                <a href="#">Privacy Policy</a> &nbsp;|&nbsp;
                <a href="#">Terms of Service</a>
            </p>
        </div>
    </div>
</footer>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Auto-dismiss flash messages after 5 seconds
    setTimeout(function() {
        document.querySelectorAll('.flash-container .alert').forEach(function(el) {
            var alert = bootstrap.Alert.getOrCreateInstance(el);
            alert.close();
        });
    }, 5000);
</script>

<?php echo $__env->yieldContent('extra-js'); ?>
</body>
</html>
<?php /**PATH /home/runner/work/seasideworld/seasideworld/resources/views/layouts/public.blade.php ENDPATH**/ ?>