<?php $__env->startSection('title', __('messages.home') . ' — SeasideWorld'); ?>

<?php $__env->startSection('extra-css'); ?>
<style>
    /* Hero */
    .hero-section {
        min-height: 100vh;
        background: linear-gradient(135deg, #0c2340 0%, #0a3d62 45%, #0a4f6e 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        padding: 6rem 0 4rem;
    }
    .hero-section::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at 30% 60%, rgba(0,180,216,0.18) 0%, transparent 60%);
    }
    .hero-content { position: relative; z-index: 2; text-align: center; }
    .hero-badge {
        display: inline-block;
        background: rgba(0,180,216,0.18);
        border: 1px solid rgba(0,180,216,0.4);
        color: #00b4d8;
        font-size: 0.85rem;
        font-weight: 600;
        padding: 0.4rem 1.2rem;
        border-radius: 50px;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 1.5rem;
    }
    .hero-title {
        font-family: 'Poppins', sans-serif;
        font-size: clamp(2.2rem, 5vw, 4rem);
        font-weight: 800;
        color: #fff;
        line-height: 1.15;
        margin-bottom: 1.25rem;
    }
    .hero-title span { color: #00b4d8; }
    .hero-subtitle {
        font-size: 1.15rem;
        color: rgba(255,255,255,0.7);
        max-width: 580px;
        margin: 0 auto 2.5rem;
        line-height: 1.7;
    }
    .hero-cta-group { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }
    .btn-hero-primary {
        background: #00b4d8; color: #fff; border: none;
        padding: 0.85rem 2rem; border-radius: 8px;
        font-size: 1rem; font-weight: 600; font-family: 'Poppins', sans-serif;
        text-decoration: none; transition: all 0.2s;
    }
    .btn-hero-primary:hover { background: #0096c7; color: #fff; transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,180,216,0.35); }
    .btn-hero-outline {
        background: transparent; color: #fff;
        border: 2px solid rgba(255,255,255,0.4);
        padding: 0.85rem 2rem; border-radius: 8px;
        font-size: 1rem; font-weight: 600; font-family: 'Poppins', sans-serif;
        text-decoration: none; transition: all 0.2s;
    }
    .btn-hero-outline:hover { border-color: #fff; color: #fff; background: rgba(255,255,255,0.1); }

    /* Animated wave */
    .hero-wave {
        position: absolute;
        bottom: 0; left: 0; width: 100%;
        pointer-events: none;
    }

    /* Stats strip */
    .stats-strip {
        background: #fff;
        padding: 1.5rem 0;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    }
    .stat-item { text-align: center; }
    .stat-number { font-family: 'Poppins', sans-serif; font-size: 1.9rem; font-weight: 700; color: #0c2340; line-height: 1; }
    .stat-label { font-size: 0.83rem; color: #64748b; margin-top: 0.25rem; font-weight: 500; }

    /* Features */
    .features-section { background: #f0f7ff; padding: 5rem 0; }
    .feature-card {
        background: #fff;
        border-radius: 14px;
        padding: 2rem 1.5rem;
        text-align: center;
        border: none;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07);
        height: 100%;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .feature-card:hover { transform: translateY(-4px); box-shadow: 0 10px 28px rgba(0,0,0,0.12); }
    .feature-icon {
        width: 68px; height: 68px; border-radius: 50%;
        background: linear-gradient(135deg, #e0f7fc, #b3e5fc);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 1.25rem; font-size: 1.6rem; color: #00b4d8;
    }
    .feature-card h5 { font-size: 1.05rem; font-weight: 700; color: #0c2340; margin-bottom: 0.6rem; }
    .feature-card p { font-size: 0.9rem; color: #64748b; margin: 0; line-height: 1.65; }

    /* Vehicles section */
    .vehicles-section { padding: 5rem 0; }
    .vehicle-card { border-radius: 14px; overflow: hidden; border: none; box-shadow: 0 2px 12px rgba(0,0,0,0.08); height: 100%; }
    .vehicle-card img { height: 200px; object-fit: cover; width: 100%; transition: transform 0.3s; }
    .vehicle-card:hover img { transform: scale(1.05); }
    .vehicle-img-wrapper { overflow: hidden; }
    .vehicle-card .card-body { padding: 1.25rem; }
    .vehicle-price { font-family: 'Poppins', sans-serif; font-size: 1.25rem; font-weight: 700; color: #00b4d8; }
    .vehicle-name { font-weight: 600; font-size: 1.05rem; color: #0c2340; margin-bottom: 0.35rem; }

    /* CTA section */
    .cta-section {
        background: linear-gradient(135deg, #0c2340, #1a3a5c);
        padding: 5rem 0;
        text-align: center;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <div class="hero-badge">
                <i class="fa fa-ship me-1"></i>
                <?php echo e(__('messages.hero_badge') ?? 'Trusted Since 2005'); ?>

            </div>
            <h1 class="hero-title">
                <?php echo e(__('messages.hero_title') ?? 'Premium Japanese Vehicles,'); ?><br>
                <span><?php echo e(__('messages.hero_title_2') ?? 'Exported Globally'); ?></span>
            </h1>
            <p class="hero-subtitle">
                <?php echo e(__('messages.hero_subtitle') ?? 'Discover an extensive selection of quality Japanese cars, trucks, and SUVs. We handle everything — sourcing, inspection, documentation and shipping to your door.'); ?>

            </p>
            <div class="hero-cta-group">
                <a href="<?php echo e(route('gallery')); ?>" class="btn-hero-primary">
                    <i class="fa fa-car me-2"></i><?php echo e(__('messages.view_gallery') ?? 'View Gallery'); ?>

                </a>
                <a href="<?php echo e(route('contact')); ?>" class="btn-hero-outline">
                    <i class="fa fa-envelope me-2"></i><?php echo e(__('messages.contact_us') ?? 'Contact Us'); ?>

                </a>
            </div>
        </div>
    </div>

    <!-- Animated Wave -->
    <div class="hero-wave">
        <svg viewBox="0 0 1440 100" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,50 C240,90 480,20 720,50 C960,80 1200,20 1440,50 L1440,100 L0,100 Z" fill="#f0f7ff" opacity="0.8"/>
            <path d="M0,65 C360,30 1080,80 1440,65 L1440,100 L0,100 Z" fill="#f0f7ff"/>
        </svg>
    </div>
</section>

<!-- Stats Strip -->
<section class="stats-strip">
    <div class="container">
        <div class="row justify-content-center text-center g-4">
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number">5,000+</div>
                    <div class="stat-label">Vehicles Exported</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number">80+</div>
                    <div class="stat-label">Countries Served</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number">18+</div>
                    <div class="stat-label">Years Experience</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-item">
                    <div class="stat-number">98%</div>
                    <div class="stat-label">Client Satisfaction</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title"><?php echo e(__('messages.why_choose_us') ?? 'Why Choose SeasideWorld?'); ?></h2>
            <p class="section-subtitle"><?php echo e(__('messages.why_subtitle') ?? 'We provide end-to-end vehicle export solutions with unmatched quality and service.'); ?></p>
        </div>
        <div class="row g-4">
            <div class="col-sm-6 col-lg-3">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa fa-shield-alt"></i></div>
                    <h5><?php echo e(__('messages.feature_quality') ?? 'Quality Assured'); ?></h5>
                    <p><?php echo e(__('messages.feature_quality_desc') ?? 'Every vehicle undergoes rigorous multi-point inspection before export.'); ?></p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa fa-ship"></i></div>
                    <h5><?php echo e(__('messages.feature_shipping') ?? 'Global Shipping'); ?></h5>
                    <p><?php echo e(__('messages.feature_shipping_desc') ?? 'We ship to over 80 countries worldwide with reliable logistics partners.'); ?></p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa fa-headset"></i></div>
                    <h5><?php echo e(__('messages.feature_support') ?? '24/7 Support'); ?></h5>
                    <p><?php echo e(__('messages.feature_support_desc') ?? 'Our multilingual team is available around the clock to assist you.'); ?></p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fa fa-file-signature"></i></div>
                    <h5><?php echo e(__('messages.feature_docs') ?? 'Paperwork Handled'); ?></h5>
                    <p><?php echo e(__('messages.feature_docs_desc') ?? 'We manage all export documentation, customs clearance, and registration.'); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Vehicles -->
<section class="vehicles-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title"><?php echo e(__('messages.featured_vehicles') ?? 'Featured Vehicles'); ?></h2>
            <p class="section-subtitle"><?php echo e(__('messages.featured_subtitle') ?? 'Explore our latest selection of premium Japanese vehicles ready for export.'); ?></p>
        </div>

        <div class="row g-4">
            <?php $__empty_1 = true; $__currentLoopData = $featuredVehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-6 col-lg-4">
                    <div class="vehicle-card card h-100">
                        <div class="vehicle-img-wrapper">
                            <?php if($vehicle->primaryImage): ?>
                                <img src="<?php echo e(asset('storage/' . $vehicle->primaryImage->image_path)); ?>"
                                     alt="<?php echo e($vehicle->name_en); ?>"
                                     class="w-100">
                            <?php else: ?>
                                <div style="height: 200px; background: linear-gradient(135deg, #e2e8f0, #f1f5f9); display: flex; align-items: center; justify-content: center;">
                                    <i class="fa fa-car fa-3x text-muted opacity-50"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="vehicle-name mb-0"><?php echo e($vehicle->name_en); ?></h6>
                                <?php if($vehicle->category): ?>
                                    <span class="badge" style="background: #e0f7fc; color: #006d8e; font-size: 0.75rem; font-weight: 600;">
                                        <?php echo e($vehicle->category->name_en); ?>

                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="d-flex align-items-center gap-2 text-muted mb-3" style="font-size: 0.85rem;">
                                <span><i class="fa fa-calendar-alt me-1"></i><?php echo e($vehicle->year); ?></span>
                            </div>
                            <?php if($vehicle->price): ?>
                                <div class="vehicle-price mb-3">
                                    $<?php echo e(number_format($vehicle->price)); ?>

                                </div>
                            <?php endif; ?>
                            <a href="<?php echo e(route('gallery')); ?>" class="btn btn-primary mt-auto w-100 btn-sm">
                                <i class="fa fa-eye me-1"></i>View Details
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center py-5">
                    <i class="fa fa-car fa-3x text-muted mb-3 d-block"></i>
                    <p class="text-muted">No featured vehicles available at the moment.</p>
                    <a href="<?php echo e(route('gallery')); ?>" class="btn btn-primary">Browse All Vehicles</a>
                </div>
            <?php endif; ?>
        </div>

        <?php if(isset($featuredVehicles) && $featuredVehicles->count() > 0): ?>
            <div class="text-center mt-5">
                <a href="<?php echo e(route('gallery')); ?>" class="btn btn-outline-primary btn-lg px-5">
                    <i class="fa fa-th-large me-2"></i>View All Vehicles
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Export Process Teaser -->
<section style="background: #f0f7ff; padding: 5rem 0;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">How It Works</h2>
            <p class="section-subtitle">Simple, transparent process from selection to delivery.</p>
        </div>
        <div class="row g-4 justify-content-center">
            <?php $__currentLoopData = [
                ['icon' => 'fa-search', 'step' => '01', 'title' => 'Choose Your Vehicle', 'desc' => 'Browse our extensive inventory and select the perfect vehicle.'],
                ['icon' => 'fa-handshake', 'step' => '02', 'title' => 'Place Your Order', 'desc' => 'Contact us, confirm specifications, and complete payment.'],
                ['icon' => 'fa-file-alt', 'step' => '03', 'title' => 'Documentation', 'desc' => 'We handle all export paperwork and customs clearance.'],
                ['icon' => 'fa-ship', 'step' => '04', 'title' => 'Delivery', 'desc' => 'Your vehicle is shipped and delivered safely to your port.'],
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-sm-6 col-lg-3">
                <div class="text-center">
                    <div style="position: relative; display: inline-block; margin-bottom: 1.25rem;">
                        <div style="width: 72px; height: 72px; border-radius: 50%; background: linear-gradient(135deg, #0c2340, #1a3a5c); display: flex; align-items: center; justify-content: center; margin: 0 auto; color: #fff; font-size: 1.4rem;">
                            <i class="fa <?php echo e($step['icon']); ?>"></i>
                        </div>
                        <div style="position: absolute; top: -6px; right: -6px; background: #00b4d8; color: #fff; font-size: 0.7rem; font-weight: 700; width: 22px; height: 22px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-family: 'Poppins', sans-serif;">
                            <?php echo e($step['step']); ?>

                        </div>
                    </div>
                    <h6 style="font-weight: 700; color: #0c2340; margin-bottom: 0.5rem;"><?php echo e($step['title']); ?></h6>
                    <p style="font-size: 0.88rem; color: #64748b; margin: 0; line-height: 1.6;"><?php echo e($step['desc']); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="text-center mt-4">
            <a href="<?php echo e(route('export-process')); ?>" class="btn btn-primary px-4">
                <i class="fa fa-info-circle me-2"></i>Learn More
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 text-center">
                <h2 style="font-family: 'Poppins', sans-serif; font-size: 2.2rem; font-weight: 700; color: #fff; margin-bottom: 1rem;">
                    <?php echo e(__('messages.cta_title') ?? 'Ready to Export Your Dream Vehicle?'); ?>

                </h2>
                <p style="color: rgba(255,255,255,0.7); font-size: 1.05rem; margin-bottom: 2rem; line-height: 1.7;">
                    <?php echo e(__('messages.cta_subtitle') ?? 'Get in touch with our expert team today and let us make your vehicle export seamless.'); ?>

                </p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="<?php echo e(route('contact')); ?>" class="btn-hero-primary" style="padding: 0.9rem 2.25rem;">
                        <i class="fa fa-envelope me-2"></i>Contact Us Now
                    </a>
                    <a href="https://wa.me/81000000000" target="_blank" class="btn-hero-outline" style="padding: 0.9rem 2.25rem; border: 2px solid rgba(255,255,255,0.4); color: #fff; border-radius: 8px; font-size: 1rem; font-weight: 600; font-family: 'Poppins', sans-serif; text-decoration: none; transition: all 0.2s;">
                        <i class="fab fa-whatsapp me-2"></i>WhatsApp Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/runner/work/seasideworld/seasideworld/resources/views/public/home.blade.php ENDPATH**/ ?>