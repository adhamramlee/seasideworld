@extends('layouts.public')

@section('title', __('messages.about') . ' — SeasideWorld')

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

    .about-section { padding: 5rem 0; }
    .about-content-card {
        background: #fff; border-radius: 14px;
        box-shadow: 0 2px 16px rgba(0,0,0,0.07);
        padding: 2.5rem;
    }
    .about-content-card h2 { font-size: 1.6rem; color: #0c2340; margin-bottom: 1rem; }
    .about-content-card p { color: #475569; line-height: 1.8; font-size: 0.97rem; }

    .value-card {
        background: #fff; border-radius: 12px; padding: 1.75rem;
        box-shadow: 0 2px 10px rgba(0,0,0,0.07);
        text-align: center; height: 100%;
    }
    .value-icon {
        width: 60px; height: 60px; border-radius: 50%;
        background: linear-gradient(135deg, #e0f7fc, #b3e5fc);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 1rem; font-size: 1.4rem; color: #00b4d8;
    }
    .value-card h5 { font-size: 1rem; font-weight: 700; color: #0c2340; margin-bottom: 0.5rem; }
    .value-card p { font-size: 0.88rem; color: #64748b; margin: 0; line-height: 1.6; }

    .timeline-section { background: #f0f7ff; padding: 5rem 0; }
    .timeline-item { position: relative; padding-left: 3.5rem; margin-bottom: 2.5rem; }
    .timeline-item:last-child { margin-bottom: 0; }
    .timeline-dot {
        position: absolute; left: 0; top: 0.2rem;
        width: 36px; height: 36px; border-radius: 50%;
        background: #0c2340; color: #fff;
        display: flex; align-items: center; justify-content: center;
        font-weight: 700; font-size: 0.85rem; font-family: 'Poppins', sans-serif;
    }
    .timeline-item::before {
        content: '';
        position: absolute;
        left: 17px; top: 36px;
        width: 2px; height: calc(100% + 14px);
        background: #e2e8f0;
    }
    .timeline-item:last-child::before { display: none; }
    .timeline-year { font-size: 0.78rem; font-weight: 600; color: #00b4d8; letter-spacing: 1px; text-transform: uppercase; }
    .timeline-item h5 { font-size: 1rem; font-weight: 700; color: #0c2340; margin: 0.3rem 0 0.4rem; }
    .timeline-item p { font-size: 0.88rem; color: #64748b; margin: 0; line-height: 1.6; }
</style>
@endsection

@section('content')

<!-- Page Hero -->
<section class="page-hero">
    <div class="container">
        <div class="page-hero-content">
            <h1><i class="fa fa-anchor me-2" style="color: #00b4d8;"></i>About Us</h1>
            <p>Learn about our story, mission, and the team behind SeasideWorld.</p>
        </div>
    </div>
    <div class="page-hero-wave">
        <svg viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,30 C360,55 1080,5 1440,30 L1440,60 L0,60 Z" fill="#fff"/>
        </svg>
    </div>
</section>

<!-- About Content -->
<section class="about-section">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-7">
                <div class="about-content-card">
                    @if(isset($page) && $page->content_en)
                        <h2>{{ $page->title_en ?? 'Our Story' }}</h2>
                        {!! $page->content_en !!}
                    @else
                        <h2>Our Story</h2>
                        <p>
                            SeasideWorld was founded with a simple mission: to connect car buyers worldwide with the finest Japanese vehicles available. Based in Yokohama, Japan — one of the world's premier automotive export hubs — we have been facilitating seamless vehicle exports for over 18 years.
                        </p>
                        <p>
                            Japan is renowned for producing some of the world's most reliable, fuel-efficient, and well-maintained vehicles. Our team of experts has in-depth knowledge of the Japanese automotive market and maintains strong relationships with dealers, auctions, and manufacturers across the country.
                        </p>
                        <p>
                            We pride ourselves on transparency, quality, and exceptional customer service. From the moment you select your vehicle to the day it arrives at your destination port, our dedicated team is with you every step of the way.
                        </p>
                    @endif
                </div>
            </div>
            <div class="col-lg-5">
                <div class="p-3" style="background: linear-gradient(135deg, #0c2340, #1a3a5c); border-radius: 16px; color: #fff; text-align: center; padding: 2.5rem !important;">
                    <div style="font-size: 4rem; margin-bottom: 1rem;">🌊</div>
                    <h3 style="font-weight: 700; margin-bottom: 0.5rem;">SeasideWorld</h3>
                    <p style="color: rgba(255,255,255,0.7); font-size: 0.93rem; margin-bottom: 2rem;">Your Trusted Japanese Vehicle Export Partner</p>
                    <div class="row g-3">
                        <div class="col-6">
                            <div style="background: rgba(255,255,255,0.1); border-radius: 10px; padding: 1rem;">
                                <div style="font-family: 'Poppins', sans-serif; font-size: 1.8rem; font-weight: 700; color: #00b4d8;">5,000+</div>
                                <div style="font-size: 0.78rem; color: rgba(255,255,255,0.6);">Vehicles Exported</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div style="background: rgba(255,255,255,0.1); border-radius: 10px; padding: 1rem;">
                                <div style="font-family: 'Poppins', sans-serif; font-size: 1.8rem; font-weight: 700; color: #00b4d8;">80+</div>
                                <div style="font-size: 0.78rem; color: rgba(255,255,255,0.6);">Countries</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div style="background: rgba(255,255,255,0.1); border-radius: 10px; padding: 1rem;">
                                <div style="font-family: 'Poppins', sans-serif; font-size: 1.8rem; font-weight: 700; color: #00b4d8;">18+</div>
                                <div style="font-size: 0.78rem; color: rgba(255,255,255,0.6);">Years Experience</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div style="background: rgba(255,255,255,0.1); border-radius: 10px; padding: 1rem;">
                                <div style="font-family: 'Poppins', sans-serif; font-size: 1.8rem; font-weight: 700; color: #00b4d8;">98%</div>
                                <div style="font-size: 0.78rem; color: rgba(255,255,255,0.6);">Satisfaction Rate</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Values -->
<section style="background: #f8fafc; padding: 5rem 0;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Our Core Values</h2>
            <p class="section-subtitle">The principles that guide everything we do at SeasideWorld.</p>
        </div>
        <div class="row g-4">
            @foreach([
                ['icon' => 'fa-star', 'title' => 'Excellence', 'desc' => 'We pursue the highest standards in every vehicle we source and every service we provide.'],
                ['icon' => 'fa-handshake', 'title' => 'Integrity', 'desc' => 'Honesty and transparency are at the heart of every relationship we build with our clients.'],
                ['icon' => 'fa-globe', 'title' => 'Global Reach', 'desc' => 'Our worldwide network ensures we can serve customers in any corner of the globe.'],
                ['icon' => 'fa-users', 'title' => 'Customer First', 'desc' => 'Our clients\' satisfaction and trust are the driving force behind our success.'],
                ['icon' => 'fa-leaf', 'title' => 'Sustainability', 'desc' => 'We are committed to responsible business practices that respect the environment.'],
                ['icon' => 'fa-lightbulb', 'title' => 'Innovation', 'desc' => 'We continuously evolve our processes and technology to better serve our clients.'],
            ] as $value)
            <div class="col-sm-6 col-lg-4">
                <div class="value-card">
                    <div class="value-icon"><i class="fa {{ $value['icon'] }}"></i></div>
                    <h5>{{ $value['title'] }}</h5>
                    <p>{{ $value['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Company Timeline -->
<section class="timeline-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Our Journey</h2>
            <p class="section-subtitle">Key milestones in the SeasideWorld story.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="timeline-item">
                    <div class="timeline-dot">05</div>
                    <div class="timeline-year">2005</div>
                    <h5>Founded in Yokohama</h5>
                    <p>SeasideWorld was established with a focus on quality Japanese vehicle exports to Southeast Asia.</p>
                </div>
                <div class="timeline-item">
                    <div class="timeline-dot">10</div>
                    <div class="timeline-year">2010</div>
                    <h5>Expanded to Africa & Middle East</h5>
                    <p>Successfully extended our operations to African and Middle Eastern markets, doubling our client base.</p>
                </div>
                <div class="timeline-item">
                    <div class="timeline-dot">15</div>
                    <div class="timeline-year">2015</div>
                    <h5>Launched Online Client Portal</h5>
                    <p>Introduced our digital platform enabling clients to track orders and manage documents online.</p>
                </div>
                <div class="timeline-item">
                    <div class="timeline-dot">20</div>
                    <div class="timeline-year">2020</div>
                    <h5>5,000 Vehicles Milestone</h5>
                    <p>Celebrated exporting our 5,000th vehicle, serving customers in over 80 countries worldwide.</p>
                </div>
                <div class="timeline-item">
                    <div class="timeline-dot">24</div>
                    <div class="timeline-year">2024</div>
                    <h5>New Platform Launch</h5>
                    <p>Launched our redesigned website and enhanced client portal for an even better experience.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section style="background: linear-gradient(135deg, #0c2340, #1a3a5c); padding: 4rem 0; text-align: center;">
    <div class="container">
        <h2 style="color: #fff; font-weight: 700; margin-bottom: 1rem;">Ready to Work With Us?</h2>
        <p style="color: rgba(255,255,255,0.7); max-width: 500px; margin: 0 auto 2rem;">
            Join thousands of satisfied customers worldwide who trust SeasideWorld for their vehicle export needs.
        </p>
        <a href="{{ route('contact') }}" class="btn btn-primary btn-lg px-5">
            <i class="fa fa-envelope me-2"></i>Get In Touch
        </a>
    </div>
</section>

@endsection
