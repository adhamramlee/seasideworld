@extends('layouts.public')

@section('title', __('messages.export_process') . ' — SeasideWorld')

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

    .process-section { padding: 5rem 0; background: #f8fafc; }

    .step-card {
        background: #fff; border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        padding: 2rem; position: relative;
        border: none; height: 100%;
        border-top: 4px solid #00b4d8;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .step-card:hover { transform: translateY(-4px); box-shadow: 0 10px 28px rgba(0,0,0,0.12); }
    .step-number {
        position: absolute; top: -1px; right: 1.5rem;
        background: #00b4d8; color: #fff;
        font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 1.3rem;
        width: 48px; height: 48px; border-radius: 0 0 10px 10px;
        display: flex; align-items: center; justify-content: center;
    }
    .step-icon {
        width: 60px; height: 60px; border-radius: 14px;
        background: linear-gradient(135deg, #e0f7fc, #b3e5fc);
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem; color: #00b4d8; margin-bottom: 1.25rem;
    }
    .step-card h4 { font-size: 1.1rem; font-weight: 700; color: #0c2340; margin-bottom: 0.75rem; }
    .step-card p { font-size: 0.9rem; color: #64748b; line-height: 1.7; margin: 0; }

    /* Timeline variant for larger screens */
    .process-timeline { padding: 5rem 0; background: #fff; }
    .timeline-step { display: flex; gap: 2rem; margin-bottom: 3.5rem; }
    .timeline-step:last-child { margin-bottom: 0; }
    .timeline-left { display: flex; flex-direction: column; align-items: center; }
    .timeline-circle {
        width: 56px; height: 56px; border-radius: 50%;
        background: linear-gradient(135deg, #0c2340, #1a3a5c);
        color: #fff; display: flex; align-items: center; justify-content: center;
        font-size: 1.3rem; flex-shrink: 0;
    }
    .timeline-line { width: 2px; background: linear-gradient(#00b4d8, #e2e8f0); flex: 1; min-height: 50px; margin-top: 8px; }
    .timeline-step:last-child .timeline-line { display: none; }
    .timeline-body { padding-top: 0.6rem; flex: 1; }
    .timeline-step-num { font-size: 0.75rem; font-weight: 700; color: #00b4d8; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 0.3rem; }
    .timeline-body h4 { font-size: 1.15rem; font-weight: 700; color: #0c2340; margin-bottom: 0.5rem; }
    .timeline-body p { color: #64748b; font-size: 0.93rem; line-height: 1.7; margin: 0; }
    .timeline-details {
        background: #f8fafc; border-radius: 10px;
        padding: 1rem 1.25rem; margin-top: 1rem;
    }
    .timeline-details li { font-size: 0.87rem; color: #475569; padding: 0.25rem 0; }
    .timeline-details li::before { content: '→'; color: #00b4d8; margin-right: 0.5rem; }
</style>
@endsection

@section('content')

<!-- Page Hero -->
<section class="page-hero">
    <div class="container">
        <div class="page-hero-content">
            <h1><i class="fa fa-route me-2" style="color: #00b4d8;"></i>Export Process</h1>
            <p>Simple, transparent steps from vehicle selection to delivery at your destination.</p>
        </div>
    </div>
    <div class="page-hero-wave">
        <svg viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,30 C360,55 1080,5 1440,30 L1440,60 L0,60 Z" fill="#f8fafc"/>
        </svg>
    </div>
</section>

<!-- Process Cards (Mobile) -->
<section class="process-section d-lg-none">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Our 6-Step Process</h2>
            <p class="section-subtitle">We make vehicle exporting from Japan simple and stress-free.</p>
        </div>
        <div class="row g-4">
            <div class="col-sm-6">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <div class="step-icon"><i class="fa fa-search"></i></div>
                    <h4>{{ __('messages.step_1_title') ?? 'Vehicle Selection' }}</h4>
                    <p>{{ __('messages.step_1') ?? 'Browse our inventory or tell us exactly what you are looking for. We source vehicles from Japan\'s top auctions and dealerships.' }}</p>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="step-card">
                    <div class="step-number">2</div>
                    <div class="step-icon"><i class="fa fa-file-invoice-dollar"></i></div>
                    <h4>{{ __('messages.step_2_title') ?? 'Order & Payment' }}</h4>
                    <p>{{ __('messages.step_2') ?? 'Confirm your vehicle choice, review the invoice, and complete secure payment to proceed with your order.' }}</p>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="step-card">
                    <div class="step-number">3</div>
                    <div class="step-icon"><i class="fa fa-clipboard-check"></i></div>
                    <h4>{{ __('messages.step_3_title') ?? 'Inspection' }}</h4>
                    <p>{{ __('messages.step_3') ?? 'Every vehicle undergoes a thorough multi-point inspection. We provide detailed reports and photos for your review.' }}</p>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="step-card">
                    <div class="step-number">4</div>
                    <div class="step-icon"><i class="fa fa-file-contract"></i></div>
                    <h4>{{ __('messages.step_4_title') ?? 'Documentation' }}</h4>
                    <p>{{ __('messages.step_4') ?? 'We prepare and process all required export documents including the export certificate, deregistration, and customs paperwork.' }}</p>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="step-card">
                    <div class="step-number">5</div>
                    <div class="step-icon"><i class="fa fa-ship"></i></div>
                    <h4>{{ __('messages.step_5_title') ?? 'Shipping' }}</h4>
                    <p>{{ __('messages.step_5') ?? 'Your vehicle is loaded and shipped via the most suitable method (RoRo or container) to your destination port.' }}</p>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="step-card">
                    <div class="step-number">6</div>
                    <div class="step-icon"><i class="fa fa-flag-checkered"></i></div>
                    <h4>{{ __('messages.step_6_title') ?? 'Arrival & Support' }}</h4>
                    <p>{{ __('messages.step_6') ?? 'We notify you of arrival and provide all documentation needed to clear customs and register your vehicle.' }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Process Timeline (Desktop) -->
<section class="process-timeline d-none d-lg-block">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Our 6-Step Process</h2>
            <p class="section-subtitle">We make vehicle exporting from Japan simple and stress-free.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="timeline-step">
                    <div class="timeline-left">
                        <div class="timeline-circle"><i class="fa fa-search"></i></div>
                        <div class="timeline-line"></div>
                    </div>
                    <div class="timeline-body">
                        <div class="timeline-step-num">Step 01</div>
                        <h4>{{ __('messages.step_1_title') ?? 'Vehicle Selection' }}</h4>
                        <p>{{ __('messages.step_1') ?? 'Browse our inventory or tell us exactly what you are looking for. We source vehicles from Japan\'s top auctions and dealerships to match your specifications and budget.' }}</p>
                        <div class="timeline-details">
                            <ul class="list-unstyled mb-0">
                                <li>Browse our online gallery and filter by category, year, or price</li>
                                <li>Submit a specific request for custom vehicle sourcing</li>
                                <li>Get expert advice on market availability and pricing</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="timeline-step">
                    <div class="timeline-left">
                        <div class="timeline-circle"><i class="fa fa-file-invoice-dollar"></i></div>
                        <div class="timeline-line"></div>
                    </div>
                    <div class="timeline-body">
                        <div class="timeline-step-num">Step 02</div>
                        <h4>{{ __('messages.step_2_title') ?? 'Order & Payment' }}</h4>
                        <p>{{ __('messages.step_2') ?? 'Confirm your vehicle choice, review the proforma invoice, and complete secure payment to proceed with your order.' }}</p>
                        <div class="timeline-details">
                            <ul class="list-unstyled mb-0">
                                <li>Receive a detailed proforma invoice</li>
                                <li>Multiple secure payment methods accepted (TT, LC)</li>
                                <li>Transparent pricing with no hidden fees</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="timeline-step">
                    <div class="timeline-left">
                        <div class="timeline-circle"><i class="fa fa-clipboard-check"></i></div>
                        <div class="timeline-line"></div>
                    </div>
                    <div class="timeline-body">
                        <div class="timeline-step-num">Step 03</div>
                        <h4>{{ __('messages.step_3_title') ?? 'Inspection & Preparation' }}</h4>
                        <p>{{ __('messages.step_3') ?? 'Every vehicle undergoes a thorough multi-point inspection before shipping. We provide detailed reports and photos for your review.' }}</p>
                        <div class="timeline-details">
                            <ul class="list-unstyled mb-0">
                                <li>Full mechanical and body inspection</li>
                                <li>Photos and video walkaround provided</li>
                                <li>Pre-shipment cleaning and detailing</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="timeline-step">
                    <div class="timeline-left">
                        <div class="timeline-circle"><i class="fa fa-file-contract"></i></div>
                        <div class="timeline-line"></div>
                    </div>
                    <div class="timeline-body">
                        <div class="timeline-step-num">Step 04</div>
                        <h4>{{ __('messages.step_4_title') ?? 'Export Documentation' }}</h4>
                        <p>{{ __('messages.step_4') ?? 'We prepare and process all required export documents including the export certificate, de-registration, and customs paperwork.' }}</p>
                        <div class="timeline-details">
                            <ul class="list-unstyled mb-0">
                                <li>Export certificate (EV) obtained from MLIT</li>
                                <li>Vehicle de-registered from Japanese registry</li>
                                <li>Commercial invoice, packing list, and B/L prepared</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="timeline-step">
                    <div class="timeline-left">
                        <div class="timeline-circle"><i class="fa fa-ship"></i></div>
                        <div class="timeline-line"></div>
                    </div>
                    <div class="timeline-body">
                        <div class="timeline-step-num">Step 05</div>
                        <h4>{{ __('messages.step_5_title') ?? 'Shipping & Tracking' }}</h4>
                        <p>{{ __('messages.step_5') ?? 'Your vehicle is loaded and shipped via the most suitable method to your destination port. Track your shipment every step of the way.' }}</p>
                        <div class="timeline-details">
                            <ul class="list-unstyled mb-0">
                                <li>RoRo (Roll-on/Roll-off) for standard vehicles</li>
                                <li>Container shipping for multiple or modified vehicles</li>
                                <li>Real-time shipment tracking notifications</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="timeline-step">
                    <div class="timeline-left">
                        <div class="timeline-circle"><i class="fa fa-flag-checkered"></i></div>
                        <div class="timeline-line"></div>
                    </div>
                    <div class="timeline-body">
                        <div class="timeline-step-num">Step 06</div>
                        <h4>{{ __('messages.step_6_title') ?? 'Arrival & After-Sales Support' }}</h4>
                        <p>{{ __('messages.step_6') ?? 'We notify you of arrival and provide all documentation needed to clear customs and register your vehicle locally.' }}</p>
                        <div class="timeline-details">
                            <ul class="list-unstyled mb-0">
                                <li>Arrival notification with all original documents</li>
                                <li>Customs clearance documentation assistance</li>
                                <li>Ongoing after-sales support and follow-up</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section style="background: #f0f7ff; padding: 5rem 0;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Frequently Asked Questions</h2>
            <p class="section-subtitle">Common questions about the export process.</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    @foreach([
                        ['q' => 'How long does the export process take?', 'a' => 'The typical process takes 4–8 weeks from payment to delivery, depending on the destination port and shipping schedule. We provide estimated timelines for every order.'],
                        ['q' => 'What payment methods do you accept?', 'a' => 'We accept Telegraphic Transfer (TT/Wire Transfer) and Letter of Credit (LC). Payment details are provided in the proforma invoice.'],
                        ['q' => 'Do you provide insurance for shipped vehicles?', 'a' => 'Yes, marine cargo insurance is available for all shipments. We highly recommend it to protect your investment during transit.'],
                        ['q' => 'Can I request a specific vehicle not in your gallery?', 'a' => 'Absolutely! We offer a custom sourcing service. Simply contact us with your specifications and budget, and we will find your ideal vehicle.'],
                        ['q' => 'What documents will I receive?', 'a' => 'You will receive the Export Certificate, original title (if applicable), Deregistration document, Bill of Lading, Commercial Invoice, and Packing List.'],
                    ] as $i => $faq)
                    <div class="accordion-item border-0 mb-2" style="border-radius: 10px; overflow: hidden;">
                        <h2 class="accordion-header">
                            <button class="accordion-button {{ $i > 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $i }}" style="font-weight: 600; font-size: 0.95rem; color: #0c2340; background: #fff;">
                                {{ $faq['q'] }}
                            </button>
                        </h2>
                        <div id="faq{{ $i }}" class="accordion-collapse collapse {{ $i === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                            <div class="accordion-body" style="color: #64748b; font-size: 0.92rem; background: #fff;">
                                {{ $faq['a'] }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section style="background: linear-gradient(135deg, #0c2340, #1a3a5c); padding: 4rem 0; text-align: center;">
    <div class="container">
        <h2 style="color: #fff; font-weight: 700; margin-bottom: 1rem;">Ready to Start Your Export?</h2>
        <p style="color: rgba(255,255,255,0.7); max-width: 480px; margin: 0 auto 2rem;">
            Our team is ready to guide you through every step of the process.
        </p>
        <a href="{{ route('contact') }}" class="btn btn-primary btn-lg px-5">
            <i class="fa fa-envelope me-2"></i>Contact Us Today
        </a>
    </div>
</section>

@endsection
