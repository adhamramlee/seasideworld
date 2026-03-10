@extends('layouts.public')

@section('title', __('messages.contact') . ' — SeasideWorld')

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

    .contact-section { padding: 5rem 0; background: #f8fafc; }
    .contact-form-card {
        background: #fff; border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.09);
        padding: 2.5rem;
    }
    .form-label { font-weight: 500; font-size: 0.9rem; color: #374151; }
    .form-control, .form-select {
        border: 1px solid #d1d5db; border-radius: 8px;
        padding: 0.65rem 1rem; font-size: 0.93rem;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #00b4d8;
        box-shadow: 0 0 0 3px rgba(0,180,216,0.12);
    }
    textarea.form-control { resize: vertical; min-height: 140px; }
    .btn-submit {
        background: #0c2340; color: #fff; border: none;
        padding: 0.8rem 2rem; border-radius: 8px;
        font-weight: 600; font-family: 'Poppins', sans-serif;
        font-size: 0.95rem; cursor: pointer;
        transition: background 0.2s, transform 0.1s;
        width: 100%;
    }
    .btn-submit:hover { background: #00b4d8; transform: translateY(-1px); }

    .contact-info-card {
        background: linear-gradient(135deg, #0c2340, #1a3a5c);
        border-radius: 16px; padding: 2.5rem; color: #fff; height: 100%;
    }
    .contact-info-item { display: flex; gap: 1rem; margin-bottom: 1.75rem; }
    .contact-info-icon { width: 44px; height: 44px; border-radius: 10px; background: rgba(0,180,216,0.2); color: #00b4d8; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; flex-shrink: 0; }
    .contact-info-item h6 { font-size: 0.82rem; font-weight: 600; color: rgba(255,255,255,0.6); letter-spacing: 0.5px; text-transform: uppercase; margin-bottom: 0.2rem; }
    .contact-info-item p, .contact-info-item a { font-size: 0.93rem; color: #fff; text-decoration: none; margin: 0; }
    .contact-info-item a:hover { color: #00b4d8; }

    .whatsapp-btn {
        display: flex; align-items: center; gap: 0.75rem;
        background: #25d366; color: #fff; border: none;
        padding: 0.85rem 1.5rem; border-radius: 10px;
        font-weight: 600; text-decoration: none; font-size: 0.95rem;
        transition: background 0.2s, transform 0.1s;
        width: 100%; justify-content: center;
    }
    .whatsapp-btn:hover { background: #20ba58; color: #fff; transform: translateY(-1px); }

    .map-placeholder {
        background: linear-gradient(135deg, #e2e8f0, #f1f5f9);
        border-radius: 12px; height: 300px;
        display: flex; align-items: center; justify-content: center;
        color: #94a3b8; font-size: 1rem;
    }

    .invalid-feedback { display: block; }
</style>
@endsection

@section('content')

<!-- Page Hero -->
<section class="page-hero">
    <div class="container">
        <div class="page-hero-content">
            <h1><i class="fa fa-envelope me-2" style="color: #00b4d8;"></i>Contact Us</h1>
            <p>Reach out to our team and we'll respond within 24 hours.</p>
        </div>
    </div>
    <div class="page-hero-wave">
        <svg viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,30 C360,55 1080,5 1440,30 L1440,60 L0,60 Z" fill="#f8fafc"/>
        </svg>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section">
    <div class="container">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4 shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fa fa-check-circle fa-lg me-3 text-success"></i>
                    <div>
                        <strong>Message Sent!</strong><br>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-5">
            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="contact-form-card">
                    <h3 style="font-weight: 700; color: #0c2340; margin-bottom: 0.4rem;">Send Us a Message</h3>
                    <p style="color: #64748b; font-size: 0.93rem; margin-bottom: 2rem;">
                        Fill out the form below and our team will get back to you promptly.
                    </p>

                    <form action="{{ route('contact.store') }}" method="POST" novalidate>
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="name">Full Name <span class="text-danger">*</span></label>
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                                       placeholder="Your full name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="email">Email Address <span class="text-danger">*</span></label>
                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                       placeholder="your@email.com" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="phone">Phone Number</label>
                                <input type="tel" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                       placeholder="+1 234 567 8900" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="subject">Subject</label>
                                <select id="subject" name="subject" class="form-select @error('subject') is-invalid @enderror">
                                    <option value="">Select a subject</option>
                                    <option value="vehicle_inquiry" {{ old('subject') == 'vehicle_inquiry' ? 'selected' : '' }}>Vehicle Inquiry</option>
                                    <option value="shipping" {{ old('subject') == 'shipping' ? 'selected' : '' }}>Shipping & Delivery</option>
                                    <option value="documents" {{ old('subject') == 'documents' ? 'selected' : '' }}>Documentation</option>
                                    <option value="pricing" {{ old('subject') == 'pricing' ? 'selected' : '' }}>Pricing & Payment</option>
                                    <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            @if(request('vehicle'))
                                <input type="hidden" name="vehicle_id" value="{{ request('vehicle') }}">
                            @endif
                            <div class="col-12">
                                <label class="form-label" for="message">Message <span class="text-danger">*</span></label>
                                <textarea id="message" name="message" class="form-control @error('message') is-invalid @enderror"
                                          placeholder="Tell us about your requirements..." required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12 mt-2">
                                <button type="submit" class="btn-submit">
                                    <i class="fa fa-paper-plane me-2"></i>Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-5">
                <div class="contact-info-card">
                    <h4 style="font-weight: 700; margin-bottom: 0.5rem;">Get in Touch</h4>
                    <p style="color: rgba(255,255,255,0.65); font-size: 0.9rem; margin-bottom: 2rem;">
                        We're here to help with all your Japanese vehicle export needs.
                    </p>

                    <div class="contact-info-item">
                        <div class="contact-info-icon"><i class="fa fa-map-marker-alt"></i></div>
                        <div>
                            <h6>Address</h6>
                            <p>1-1 Minatomachi, Naka-ku<br>Yokohama, Kanagawa, Japan</p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="contact-info-icon"><i class="fa fa-phone"></i></div>
                        <div>
                            <h6>Phone</h6>
                            <a href="tel:+81000000000">+81 00-0000-0000</a>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="contact-info-icon"><i class="fa fa-envelope"></i></div>
                        <div>
                            <h6>Email</h6>
                            <a href="mailto:info@seasideworld.jp">info@seasideworld.jp</a>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="contact-info-icon"><i class="fa fa-clock"></i></div>
                        <div>
                            <h6>Business Hours</h6>
                            <p>Mon – Sat: 9:00 AM – 6:00 PM JST</p>
                        </div>
                    </div>

                    <div class="mt-3">
                        <a href="https://wa.me/81000000000" target="_blank" class="whatsapp-btn">
                            <i class="fab fa-whatsapp fa-lg"></i>
                            Chat on WhatsApp
                        </a>
                    </div>
                </div>

                <!-- Map Placeholder -->
                <div class="map-placeholder mt-4">
                    <div class="text-center">
                        <i class="fa fa-map-marked-alt fa-2x mb-2 d-block"></i>
                        <span>Map — Yokohama, Japan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
