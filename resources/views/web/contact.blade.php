
@extends('web.master')
@section("content")

<style>
    body {
        background-color: #0b0b0b;
        color: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .hero-contact {
        background: radial-gradient(circle at 50% 0%, #141414 0%, #0b0b0b 100%);
        border-bottom: 1px solid #1a1a1a;
    }
    .text-gradient {
        background: linear-gradient(135deg, #ffffff 30%, #00ff87 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .contact-card {
        background-color: #141414;
        border: 1px solid #222;
        border-radius: 16px;
    }
    .form-control, .form-select {
        background-color: #1c1c1c;
        border: 1px solid #333;
        color: #fff;
        border-radius: 10px;
        padding: 0.75rem 1rem;
    }
    .form-control:focus, .form-select:focus {
        background-color: #1c1c1c;
        border-color: #00ff87;
        color: #fff;
        box-shadow: 0 0 10px rgba(0, 255, 135, 0.15);
    }
    .icon-box {
        width: 45px;
        height: 45px;
        background: rgba(0, 255, 135, 0.05);
        border: 1px solid rgba(0, 255, 135, 0.1);
        color: #00ff87;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        font-size: 1.25rem;
    }
    .btn-gradient {
        background: linear-gradient(135deg, #00ff87 0%, #00b35e 100%);
        color: #000 !important;
        border: none;
        border-radius: 10px;
        padding: 0.75rem 2rem;
        transition: all 0.2s ease;
    }
    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 255, 135, 0.25);
    }
    .map-placeholder {
        background-color: #141414;
        border: 1px solid #222;
        border-radius: 16px;
        height: 250px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #555;
    }
</style> 
    <!-- Contact Hero Section -->
    <header class="hero-contact py-5 text-center">
        <div class="container py-4">
            <span class="badge bg-secondary bg-opacity-25 text-secondary mb-3 px-3 py-2 rounded-pill text-uppercase small fw-semibold">Get In Touch</span>
            <h1 class="display-4 fw-bold text-white mb-3">Let's Connect and <br><span class="text-gradient">Talk Technology</span></h1>
            <p class="lead text-secondary mx-auto" style="max-width: 600px;">
                Have questions, business inquiries, or technical feedback? Drop us a line, and our expert team will get back to you shortly.
            </p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container py-5">
        <div class="row g-5">
            
            <!-- Left Side: Contact Info & Map -->
            <div class="col-lg-5">
                <h3 class="fw-bold text-white mb-4">Contact Information</h3>
                
                <!-- Info List -->
                <div class="d-flex flex-column gap-4 mb-5">
                    <div class="d-flex align-items-center gap-3">
                        <div class="icon-box"><i class="bi bi-geo-alt"></i></div>
                        <div>
                            <span class="text-secondary small d-block">Our Headquarters</span>
                            <span class="text-white fw-medium">Silicon Valley, San Francisco, CA</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <div class="icon-box"><i class="bi bi-envelope-at"></i></div>
                        <div>
                            <span class="text-secondary small d-block">Email Support</span>
                            <span class="text-white fw-medium">support@phoneworld.com</span>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <div class="icon-box"><i class="bi bi-telephone"></i></div>
                        <div>
                            <span class="text-secondary small d-block">Call Center</span>
                            <span class="text-white fw-medium">+1 (555) 234-5678</span>
                        </div>
                    </div>
                </div>

                <!-- Map Placeholder / Embed -->
                <div class="map-placeholder">
                    <div class="text-center">
                        <i class="bi bi-map fs-2 mb-2 d-block text-secondary"></i>
                        <span class="small text-secondary">Interactive Map Embed Area</span>
                    </div>
                </div>
            </div>

            <!-- Right Side: Contact Form -->
            <div class="col-lg-7">
                <div class="card contact-card p-4 p-md-5">
                    <h3 class="fw-bold text-white mb-2">Send a Message</h3>
                    <p class="text-secondary small mb-4">Fields marked with * are required.</p>
                    
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-secondary small">First Name *</label>
                                <input type="text" class="form-control" placeholder="John" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-secondary small">Last Name *</label>
                                <input type="text" class="form-control" placeholder="Doe" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-secondary small">Email Address *</label>
                                <input type="email" class="form-control" placeholder="johndoe@example.com" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-secondary small">Inquiry Type</label>
                                <select class="form-select">
                                    <option selected>General Inquiry</option>
                                    <option>Business & Partnerships</option>
                                    <option>Technical Support</option>
                                    <option>Advertising</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-secondary small">Your Message *</label>
                                <textarea class="form-control" rows="5" placeholder="Write your message here..." required></textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-gradient fw-bold w-100 w-md-auto">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </main>

  




@endsection




















