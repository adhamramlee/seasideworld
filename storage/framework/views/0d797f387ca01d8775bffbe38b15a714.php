<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Seaside World — Premium Vehicle Export from Japan'); ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@300;400;700&family=Outfit:wght@300;400;500;600;700;800&family=Kaisei+Decol:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/seaside.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/about-premium.css')); ?>">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    
    <div id="loader">
        <svg class="ld-wave" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4,36 C11,26 17,44 24,34 C31,24 37,42 44,32 C49,25 52,30 56,28" stroke="#f1812d" stroke-width="2.5" stroke-linecap="round" fill="none"/>
            <path d="M4,43 C11,33 17,51 24,41 C31,31 37,49 44,39 C49,32 52,37 56,35" stroke="#f1812d" stroke-width="1.5" stroke-linecap="round" fill="none" opacity=".5"/>
            <path d="M18,17 L28,7 L38,17" stroke="#fdcd82" stroke-width="1.5" stroke-linecap="round" fill="none" opacity=".6"/>
        </svg>
        <div class="ld-bar"><div class="ld-fill"></div></div>
        <div class="ld-txt">Premium Export from Japan</div>
    </div>

    
    <nav id="nav">
        <a href="<?php echo e(route('home')); ?>" class="nav-logo">
            <div class="nav-logo-mark">SW</div>
            <div class="nav-logo-txt">
                <span class="nav-logo-en">SEASIDE WORLD</span>
                <span class="nav-logo-jp">Vehicle Export from Japan</span>
            </div>
        </a>

        <ul class="nav-links">
            <li><a href="<?php echo e(route('home')); ?>" class="<?php echo e(request()->routeIs('home') ? 'active' : ''); ?>"><?php echo e(__('messages.home')); ?></a></li>
            <li><a href="<?php echo e(route('about')); ?>" class="<?php echo e(request()->routeIs('about') ? 'active' : ''); ?>"><?php echo e(__('messages.about')); ?></a></li>
            <li><a href="<?php echo e(route('services')); ?>" class="<?php echo e(request()->routeIs('services') ? 'active' : ''); ?>"><?php echo e(__('messages.services')); ?></a></li>
            <li><a href="<?php echo e(route('gallery')); ?>" class="<?php echo e(request()->routeIs('gallery*') ? 'active' : ''); ?>"><?php echo e(__('messages.gallery')); ?></a></li>
            <li><a href="<?php echo e(route('export-process')); ?>" class="<?php echo e(request()->routeIs('export-process') ? 'active' : ''); ?>"><?php echo e(__('messages.export_process')); ?></a></li>
        </ul>

        <div class="nav-right">
            <div class="nav-lang">
                <form method="POST" action="<?php echo e(route('language.switch', 'en')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="lang-btn <?php echo e(app()->getLocale() == 'en' ? 'active' : ''); ?>">EN</button>
                </form>
                <form method="POST" action="<?php echo e(route('language.switch', 'jp')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="lang-btn <?php echo e(app()->getLocale() == 'jp' ? 'active' : ''); ?>">JP</button>
                </form>
            </div>
            <?php if(auth()->guard()->guest()): ?>
                <a href="<?php echo e(route('contact')); ?>" class="nav-cta-btn"><?php echo e(__('messages.contact')); ?></a>
            <?php else: ?>
                <a href="<?php echo e(Auth::user()->dashboardRoute()); ?>" class="nav-cta-btn"><?php echo e(Auth::user()->name); ?></a>
            <?php endif; ?>
            <button class="nav-toggle" aria-label="Menu">
                <span></span><span></span><span></span>
            </button>
        </div>
    </nav>

    
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    
    <div class="footer-road">
        <svg viewBox="0 0 1440 110" preserveAspectRatio="none" height="110" xmlns="http://www.w3.org/2000/svg" style="display:block">
            <defs><linearGradient id="sk" x1="0" y1="0" x2="0" y2="1"><stop offset="0%" stop-color="#1a0b04"/><stop offset="100%" stop-color="#2d1206"/></linearGradient></defs>
            <rect width="1440" height="78" fill="url(#sk)"/>
            <path d="M0,52 C120,38 240,62 360,48 C480,34 600,58 720,48 C840,38 960,58 1080,48 C1200,38 1320,56 1440,48 L1440,78 L0,78 Z" fill="#f1812d" opacity=".10"/>
            <rect y="76" width="1440" height="34" fill="#130b06"/>
            <line x1="0" y1="93" x2="1440" y2="93" stroke="rgba(255,255,255,.06)" stroke-width="1"/>
            <line x1="60" y1="93" x2="160" y2="93" stroke="#fdcd82" stroke-width="2" stroke-dasharray="55,40" opacity=".45"/>
            <line x1="260" y1="93" x2="360" y2="93" stroke="#fdcd82" stroke-width="2" stroke-dasharray="55,40" opacity=".45"/>
            <line x1="460" y1="93" x2="560" y2="93" stroke="#fdcd82" stroke-width="2" stroke-dasharray="55,40" opacity=".45"/>
            <line x1="660" y1="93" x2="760" y2="93" stroke="#fdcd82" stroke-width="2" stroke-dasharray="55,40" opacity=".45"/>
            <line x1="860" y1="93" x2="960" y2="93" stroke="#fdcd82" stroke-width="2" stroke-dasharray="55,40" opacity=".45"/>
            <line x1="1060" y1="93" x2="1160" y2="93" stroke="#fdcd82" stroke-width="2" stroke-dasharray="55,40" opacity=".45"/>
            <line x1="1260" y1="93" x2="1360" y2="93" stroke="#fdcd82" stroke-width="2" stroke-dasharray="55,40" opacity=".45"/>
            <g id="rcar">
                <rect width="78" height="19" rx="4" fill="rgba(241,129,45,.18)" stroke="rgba(241,129,45,.38)" stroke-width="1"/>
                <path d="M9,19 L18,7 L60,7 L69,19" fill="rgba(241,129,45,.1)" stroke="rgba(241,129,45,.28)" stroke-width="1"/>
                <circle cx="17" cy="19" r="6" fill="none" stroke="rgba(241,129,45,.45)" stroke-width="1.5"/>
                <circle cx="61" cy="19" r="6" fill="none" stroke="rgba(241,129,45,.45)" stroke-width="1.5"/>
                <rect x="70" y="10" width="9" height="5" rx="1" fill="rgba(253,205,130,.5)"/>
            </g>
        </svg>
    </div>

    
    <footer class="site-footer">
        <div class="footer-inner">
            <div class="footer-grid">
                <div class="footer-brand">
                    <div class="f-logo">
                        <div class="f-mark">SW</div>
                        <span class="f-en">Seaside World</span>
                    </div>
                    <p><?php echo e(__('messages.footer_about')); ?></p>
                    <p class="f-jp-txt">Beyond the Ocean Roads</p>
                    <div class="f-socials">
                        <a href="#" class="fsoc">LINE</a>
                        <a href="#" class="fsoc">Instagram</a>
                        <a href="#" class="fsoc">WhatsApp</a>
                    </div>
                </div>
                <div class="footer-col">
                    <h4><?php echo e(__('messages.quick_links')); ?></h4>
                    <ul>
                        <li><a href="<?php echo e(route('home')); ?>"><?php echo e(__('messages.home')); ?></a></li>
                        <li><a href="<?php echo e(route('about')); ?>"><?php echo e(__('messages.about')); ?></a></li>
                        <li><a href="<?php echo e(route('gallery')); ?>"><?php echo e(__('messages.gallery')); ?></a></li>
                        <li><a href="<?php echo e(route('export-process')); ?>"><?php echo e(__('messages.export_process')); ?></a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4><?php echo e(__('messages.services')); ?></h4>
                    <ul>
                        <li><a href="<?php echo e(route('services')); ?>"><?php echo e(__('messages.services')); ?></a></li>
                        <li><a href="<?php echo e(route('contact')); ?>"><?php echo e(__('messages.contact')); ?></a></li>
                        <?php if(auth()->guard()->guest()): ?>
                            <li><a href="<?php echo e(route('login')); ?>"><?php echo e(__('messages.login')); ?></a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4><?php echo e(__('messages.contact_info')); ?></h4>
                    <ul>
                        <li><span style="color:rgba(255,255,255,0.38)">+81 3-1234-5678</span></li>
                        <li><span style="color:rgba(255,255,255,0.38)">info@seasideworld.com</span></li>
                        <li><span style="color:rgba(255,255,255,0.38)">Tokyo, Japan</span></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <span class="footer-copy">&copy; <?php echo e(date('Y')); ?> Seaside World. <?php echo e(__('messages.all_rights_reserved')); ?></span>
                <span class="footer-wave-text">Beyond the Ocean Roads</span>
            </div>
        </div>
    </footer>

    <script src="<?php echo e(asset('js/seaside.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\xampp2\htdocs\seasideworld\resources\views/layouts/public.blade.php ENDPATH**/ ?>