@extends('layouts.public')

@section('title', __('messages.services') . ' — SeasideWorld')

@section('extra-css')
<style>
    .page-hero {
        background: linear-gradient(135deg, #0c2340 0%, #1a3a5c 100%);
        padding: 5rem 0 4rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .page-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at 50% 120%, rgba(0,180,216,0.2), transparent 70%);
    }
    .page-hero-content { position: relative; z-index: 2; }
    .page-hero h1 { font-size: clamp(1.8rem, 4vw, 2.8rem); font-weight: 700; color: #fff; margin-bottom: 0.75rem; }
    .page-hero p { color: rgba(255,255,255,0.7); font-size: 1.05rem; max-width: 520px; margin: 0 auto; }
    .page-hero-wave { position: absolute; bottom: 0; left: 0; width: 100%; pointer-events: none; }

    .services-section { padding: 5rem 0; }
    .service-card {
        background: #fff; border-radius: 14px; padding: 2rem;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07);
        height: 100%; border: none;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .service-card:hover { transform: translateY(-4px); box-shadow: 0 10px 28px rgba(0,0,0,0.12); }
    .service-icon {
        width: 64px; height: 64px; border-radius: 14px;
        background: linear-gradient(135deg, #0c2340, #1a3a5c);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem; color: #00b4d8; margin-bottom: 1.25rem;
    }
    .service-card h4 { font-size: 1.15rem; font-weight: 700; color: #0c2340; margin-bottom: 0.75rem; }
    .service-card p { font-size: 0.9rem; color: #64748b; line-height: 1.7; margin-bottom: 1rem; }
    .service-features { list-style: none; padding: 0; margin: 0; }
    .service-features li { font-size: 0.88rem; color: #475569; padding: 0.3rem 0; }
    .service-features li::before { content: '✓'; color: #00b4d8; font-weight: 700; margin-right: 0.5rem; }

    .process-card {
        background: linear-gradient(135deg, #f0f7ff, #e0f4ff);
        border-radius: 14px; padding: 2rem;
        border: none; height: 100%;
    }

    .why-section { background: #f8fafc; padding: 5rem 0; }
    .why-item { display: flex; gap: 1.25rem; margin-bottom: 2rem; }
    .why-icon { width: 48px; height: 48px; border-radius: 10px; background: #e0f7fc; color: #00b4d8; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0; }
    .why-item h5 { font-size: 1rem; font-weight: 700; color: #0c2340; margin-bottom: 0.4rem; }
    .why-item p { font-size: 0.88rem; color: #64748b; margin: 0; line-height: 1.6; }
</style>
@endsection

@section('content')

<!-- Page Hero -->
<section class="page-hero">
    <div class="container">
        <div class="page-hero-content">
            <h1><i class="fa fa-cogs me-2" style="color: #00b4d8;"></i>Our Services</h1>
            <p>Comprehensive Japanese vehicle export services tailored to your needs.</p>
        </div>
    </div>
    <div class="page-hero-wave">
        <svg viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,30 C360,55 1080,5 1440,30 L1440,60 L0,60 Z" fill="#fff"/>
        </svg>
    </div>
</section>

<!-- Services Content from CMS -->
@if(isset($page) && $page->content_en)
<section style="padding: 4rem 0; background: #fff;">
    <div class="container">
        <div class="prose-content" style="max-width: 860px; margin: 0 auto; font-size: 0.97rem; color: #475569; line-height: 1.8;">
            {!! $page->content_en !!}
        </div>
    </div>
</section>
@endif

<!-- Services Grid -->
<section class="services-section" style="{{ isset($page) && $page->content_en ? 'background: #f8fafc;' : 'background: #fff;' }}">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">What We Offer</h2>
            <p class="section-subtitle">End-to-end solutions for every step of your vehicle export journey.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="service-card">
                    <div class="service-icon"><i class="fa fa-search-dollar"></i></div>
                    <h4>Vehicle Sourcing</h4>
                    <p>We source the best vehicles from Japan's top auctions, dealerships, and private sellers based on your specifications.</p>
                    <ul class="service-features">
                        <li>Auction house representation</li>
                        <li>Market price negotiation</li>
                        <li>Custom vehicle search</li>
                        <li>Pre-purchase inspections</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="service-card">
                    <div class="service-icon"><i class="fa fa-clipboard-check"></i></div>
                    <h4>Vehicle Inspection</h4>
                    <p>Thorough multi-point quality checks ensure every vehicle meets our strict standards before export.</p>
                    <ul class="service-features">
                        <li>Mechanical inspection</li>
                        <li>Body condition assessment</li>
                        <li>Mileage verification</li>
                        <li>Photo/video documentation</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="service-card">
                    <div class="service-icon"><i class="fa fa-file-contract"></i></div>
                    <h4>Export Documentation</h4>
                    <p>We handle all necessary paperwork including export certificates, deregistration, and customs documents.</p>
                    <ul class="service-features">
                        <li>Export certificate (EV)</li>
                        <li>De-registration from Japan</li>
                        <li>Bill of lading</li>
                        <li>Commercial invoice & packing list</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="service-card">
                    <div class="service-icon"><i class="fa fa-ship"></i></div>
                    <h4>International Shipping</h4>
                    <p>Reliable shipping solutions via RoRo and container methods to ports worldwide at competitive rates.</p>
                    <ul class="service-features">
                        <li>RoRo & container shipping</li>
                        <li>Port-to-port delivery</li>
                        <li>Shipment tracking</li>
                        <li>Insurance coverage</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="service-card">
                    <div class="service-icon"><i class="fa fa-passport"></i></div>
                    <h4>Customs Clearance</h4>
                    <p>Expert assistance with import customs procedures at your destination country to ensure smooth clearance.</p>
                    <ul class="service-features">
                        <li>Import duty consultation</li>
                        <li>Customs documentation</li>
                        <li>Tariff classification</li>
                        <li>Agent coordination</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="service-card">
                    <div class="service-icon"><i class="fa fa-headset"></i></div>
                    <h4>After-Sales Support</h4>
                    <p>Our commitment doesn't end at delivery. We provide ongoing support for all post-export needs.</p>
                    <ul class="service-features">
                        <li>Parts sourcing assistance</li>
                        <li>Registration guidance</li>
                        <li>Technical support</li>
                        <li>Repeat client discounts</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="why-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5">
                <h2 class="section-title">Why SeasideWorld?</h2>
                <p class="section-subtitle mb-4">We go above and beyond to ensure your complete satisfaction.</p>
                <a href="{{ route('contact') }}" class="btn btn-primary px-4">
                    <i class="fa fa-envelope me-2"></i>Get a Free Quote
                </a>
            </div>
            <div class="col-lg-7">
                <div class="why-item">
                    <div class="why-icon"><i class="fa fa-certificate"></i></div>
                    <div>
                        <h5>Licensed & Accredited</h5>
                        <p>Fully licensed Japanese vehicle exporter with all necessary certifications and government approvals.</p>
                    </div>
                </div>
                <div class="why-item">
                    <div class="why-icon"><i class="fa fa-lock"></i></div>
                    <div>
                        <h5>Secure Transactions</h5>
                        <p>We use secure, internationally accepted payment methods to protect your investment.</p>
                    </div>
                </div>
                <div class="why-item">
                    <div class="why-icon"><i class="fa fa-chart-line"></i></div>
                    <div>
                        <h5>Best Market Prices</h5>
                        <p>Our strong relationships with auctions and dealers allow us to negotiate the best prices for you.</p>
                    </div>
                </div>
                <div class="why-item">
                    <div class="why-icon"><i class="fa fa-language"></i></div>
                    <div>
                        <h5>Multilingual Support</h5>
                        <p>Our team communicates in English, Japanese, and other languages for a smooth experience.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section style="background: linear-gradient(135deg, #0c2340, #1a3a5c); padding: 4rem 0; text-align: center;">
    <div class="container">
        <h2 style="color: #fff; font-weight: 700; margin-bottom: 1rem;">Ready to Get Started?</h2>
        <p style="color: rgba(255,255,255,0.7); max-width: 480px; margin: 0 auto 2rem;">
            Contact our team today to discuss your requirements and get a customized quote.
        </p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="{{ route('contact') }}" class="btn btn-primary btn-lg px-4">
                <i class="fa fa-envelope me-2"></i>Contact Us
            </a>
            <a href="{{ route('export-process') }}" class="btn btn-outline-light btn-lg px-4">
                <i class="fa fa-info-circle me-2"></i>Export Process
            </a>
        </div>
    </div>
</section>

@endsection
