@extends('web.master')

@section('content')





<style>
    body {
        background-color: #0b0b0b;
        color: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .hero-about {
        background: radial-gradient(circle at 50% 100%, #141414 0%, #0b0b0b 100%);
        border-bottom: 1px solid #1a1a1a;
    }
    .text-gradient {
        background: linear-gradient(135deg, #ffffff 30%, #00ff87 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .about-card {
        background-color: #141414;
        border: 1px solid #222;
        border-radius: 16px;
        transition: all 0.3s ease;
    }
    .about-card:hover {
        border-color: #00ff87;
        transform: translateY(-5px);
    }
    .stat-box {
        background: linear-gradient(135deg, #141414 0%, #1c1c1c 100%);
        border: 1px solid #222;
        border-radius: 16px;
    }
    .icon-box {
        width: 50px;
        height: 50px;
        background: rgba(0, 255, 135, 0.05);
        border: 1px solid rgba(0, 255, 135, 0.1);
        color: #00ff87;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 1.5rem;
    }
</style> 

    <!-- About Hero Section -->
    <header class="hero-about py-5 text-center">
        <div class="container py-4">
            <span class="badge bg-secondary bg-opacity-25 text-secondary mb-3 px-3 py-2 rounded-pill text-uppercase small fw-semibold">Who We Are</span>
            <h1 class="display-4 fw-bold text-white mb-3">Shaping the Future of <br><span class="text-gradient">Mobile Technology</span></h1>
            <p class="lead text-secondary mx-auto" style="max-width: 600px;">
                We are your ultimate destination to explore, compare, and discover next-generation smartphones driven by AI and tech innovations.
            </p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container py-5">
        
        <!-- Story Section -->
        <div class="row align-items-center g-5 mb-5">
            <div class="col-lg-6">
                <span class="text-success fw-bold text-uppercase small tracking-wider">Our Story</span>
                <h2 class="fw-bold text-white mt-2 mb-4">Driven by Passion & Innovation</h2>
                <p class="text-secondary mb-3" style="font-size: 1.05rem; line-height: 1.7;">
                    Founded with a vision to simplify technology decisions, Phone World has grown into a leading global platform for flagship device reviews, specifications, and insights.
                </p>
                <p class="text-secondary" style="font-size: 1.05rem; line-height: 1.7;">
                    In 2026, as mobile tech pivots entirely around Artificial Intelligence and folding form-factors, we remain committed to bringing you unbiased, crystal-clear, and cutting-edge tech data.
                </p>
            </div>
            <div class="col-lg-6">
                <!-- Grid of Stats -->
                <div class="row g-4">
                    <div class="col-6">
                        <div class="stat-box p-4 text-center">
                            <h3 class="display-5 fw-bold text-gradient mb-1">5M+</h3>
                            <span class="text-secondary small">Active Users</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-box p-4 text-center">
                            <h3 class="display-5 fw-bold text-gradient mb-1">200+</h3>
                            <span class="text-secondary small">Devices Reviewed</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-box p-4 text-center">
                            <h3 class="display-5 fw-bold text-gradient mb-1">99%</h3>
                            <span class="text-secondary small">Accuracy Rate</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-box p-4 text-center">
                            <h3 class="display-5 fw-bold text-gradient mb-1">24/7</h3>
                            <span class="text-secondary small">Tech Updates</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="border-secondary border-opacity-25 my-5">

        <!-- Core Values Section -->
        <div class="text-center mb-5">
            <span class="text-success fw-bold text-uppercase small tracking-wider">Our Core Values</span>
            <h2 class="fw-bold text-white mt-2">What Stands Us Apart</h2>
        </div>

        <div class="row g-4">
            <!-- Value 1 -->
            <div class="col-md-4">
                <div class="card about-card text-white p-4 h-100">
                    <div class="icon-box mb-4">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Absolute Integrity</h5>
                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        Our reviews and specs data are 100% transparent and unbiased. We score smartphones strictly based on reality and performance.
                    </p>
                </div>
            </div>
            <!-- Value 2 -->
            <div class="col-md-4">
                <div class="card about-card text-white p-4 h-100">
                    <div class="icon-box mb-4">
                        <i class="bi bi-lightning-charge"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Hyper Speed</h5>
                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        The tech world moves fast, and so do we. Get instant specifications and leaks of upcoming flagships seconds after they hit the radar.
                    </p>
                </div>
            </div>
            <!-- Value 3 -->
            <div class="col-md-4">
                <div class="card about-card text-white p-4 h-100">
                    <div class="icon-box mb-4">
                        <i class="bi bi-cpu"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Future Focused</h5>
                    <p class="text-secondary small mb-0" style="line-height: 1.6;">
                        We don't just look at the cameras or batteries; we analyze the AI ecosystems, NPU chips, and long-term software sustainability.
                    </p>
                </div>
            </div>
        </div>

    </main>

    @endsection

    <!-- Footer -->





















