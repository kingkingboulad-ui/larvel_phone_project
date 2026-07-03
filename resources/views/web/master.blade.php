
@php
    $setting = \App\Models\Setting::first();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $setting->hero_description }}">
        

    <meta name="keywords" content="ecommerce, online shop, phones, smartphones, products, brands, buy online, best prices, Laravel store">
    <meta name="author" content="{{$setting->site_name}}">
    <link rel="stylesheet" href="{{ asset('asset/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">


    <title>Home </title>
</head>


<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3 sticky-top" dir="ltr"
        style="background-color: #121212 !important; box-shadow: 0 4px 12px rgba(0,0,0,0.15);">
        <div class="container">
            <!-- Shop Name / Logo -->
            <a class="navbar-brand fw-bold text-uppercase" href="{{ route('index') }}" style="letter-spacing: 1px;">
                <span class="text-success" style="color: #00ff87 !important;">Phone</span>Store
            </a>

            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarScroll">
                <!-- Navigation Links -->
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="{{ route('about') }}">ِAbout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="{{ route('contact.create') }}">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="{{ route('cart.request') }}">My Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('latestproduct') }}">Latest Phones</a>
                    </li>
                    <!-- Accessories Dropdown -->

                    <!-- Repair Service Link -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.filter') }}">Shop</a>
                    </li>

                    @if (auth()->user()->role==="admin")
                    <li class="nav-item">
                        <a class="nav-link bg-success rounded" href="{{ route('admin') }}">Dashboard</a>
                    </li>

                    @endif
                </ul>

                <!-- Order & Profile Icons (بديل خانة البحث) -->
                <div class="d-flex align-items-center gap-3 ms-lg-3 mt-3 mt-lg-0">
                    <!-- Orders Link -->
                    <a href="{{ route('cart.index') }}" class="nav-icon-link position-relative text-decoration-none"
                        title="My Orders" style="color: #aaa; transition: 0.3s; font-size: 1.25rem;">
                        <i class="bi bi-bag-check"></i>
                        <!-- شارة حمراء صغيرة لعدد الطلبات في السلة أو النشطة (اختياري) -->
                        @if ($cart && $cart->items->count() > 0)
                            <span
                                class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"
                                style="width: 8px; height: 8px;">
                            </span>
                        @endif
                    </a>

                    <a href="{{ route('profile.edit') }}" class="nav-icon-link text-decoration-none" title="My Profile"
                        style="color: #aaa; transition: 0.3s; font-size: 1.25rem;">
                        <i class="bi bi-person-circle"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- ستايل إضافي بسيط لتحسين تأثير تمرير الماوس (Hover) على زر البحث -->




    @yield('content')
































































    <!-- ======================================================= -->
    <!-- FOOTER (تذييل الصفحة) -->
    <!-- ======================================================= -->
    <footer class="pt-5 pb-3" style="background-color: #0b0b0b; border-top: 1px solid #1a1a1a;">
        <div class="container">
            <div class="row g-4 mb-5">

                <!-- Column 1: About the Shop -->
                <div class="col-lg-4 col-md-6">
                    <a class="navbar-brand fw-bold text-uppercase fs-4 text-white text-decoration-none" href="#">
                        <span style="color: #00ff87;">Phone</span>Store
                    </a>
                    <p class="text-secondary mt-3 small" style="line-height: 1.6; max-width: 320px;">
                        Your ultimate destination for the latest smartphones, premium tech accessories, and certified
                        professional hardware & software repair services.
                    </p>
                    <!-- Social Media Icons -->
                    <div class="d-flex gap-2 mt-4">
                        <a href="#" class="social-icon d-inline-flex align-items-center justify-content-center"
                            style="width: 38px; height: 38px; background-color: #141414; border-radius: 8px; color: #aaa; transition: 0.3s; text-decoration: none;">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="social-icon d-inline-flex align-items-center justify-content-center"
                            style="width: 38px; height: 38px; background-color: #141414; border-radius: 8px; color: #aaa; transition: 0.3s; text-decoration: none;">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" class="social-icon d-inline-flex align-items-center justify-content-center"
                            style="width: 38px; height: 38px; background-color: #141414; border-radius: 8px; color: #aaa; transition: 0.3s; text-decoration: none;">
                            <i class="bi bi-tiktok"></i>
                        </a>
                        <a href="#" class="social-icon d-inline-flex align-items-center justify-content-center"
                            style="width: 38px; height: 38px; background-color: #141414; border-radius: 8px; color: #aaa; transition: 0.3s; text-decoration: none;">
                            <i class="bi bi-whatsapp"></i>
                        </a>
                    </div>
                </div>

                <!-- Column 2: Quick Links -->
                <div class="col-lg-2 col-md-6">
                    <h5 class="text-white fw-bold mb-3 fs-6 text-uppercase" style="letter-spacing: 0.5px;">Quick Links
                    </h5>
                    <ul class="list-unstyled footer-links">
                        <li class="mb-2"><a href="{{route('index')}}" class="text-secondary text-decoration-none small">Home</a>
                        </li>
                        <li class="mb-2"><a href="{{route('latestproduct')}}" class="text-secondary text-decoration-none small">Latest
                                Phones</a>
                        </li>
                        <li class="mb-2"><a href="{{route('products.filter')}}"
                                class="text-secondary text-decoration-none small">Accessories</a>
                        </li>
                        <li class="mb-2"><a href="#"
                                class="text-secondary text-decoration-none small">Special
                                Offers</a></li>
                    </ul>
                </div>

                <!-- Column 3: Services -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white fw-bold mb-3 fs-6 text-uppercase" style="letter-spacing: 0.5px;">Our
                        Services
                    </h5>
                    <ul class="list-unstyled footer-links">
                        <li class="mb-2"><a href="#" class="text-secondary text-decoration-none small">Screen
                                Replacement</a></li>
                        <li class="mb-2"><a href="#"
                                class="text-secondary text-decoration-none small">Battery
                                Diagnostics</a></li>
                        <li class="mb-2"><a href="#"
                                class="text-secondary text-decoration-none small">Motherboard
                                Repair</a></li>
                        <li class="mb-2"><a href="#"
                                class="text-secondary text-decoration-none small">Software
                                Flashing</a></li>
                    </ul>
                </div>

                <!-- Column 4: Contact Info -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white fw-bold mb-3 fs-6 text-uppercase" style="letter-spacing: 0.5px;">Contact Us
                    </h5>
                    <ul class="list-unstyled text-secondary small">
                        <li class="d-flex align-items-start mb-3">
                            <i class="bi bi-geo-alt text-success me-2 mt-1" style="color: #00ff87 !important;"></i>
                            <span>Main Street, Phone District, City, Country</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="bi bi-telephone text-success me-2" style="color: #00ff87 !important;"></i>
                            <span>+123 456 7890</span>
                        </li>
                        <li class="d-flex align-items-center mb-3">
                            <i class="bi bi-envelope text-success me-2" style="color: #00ff87 !important;"></i>
                            <span>support@phonestore.com</span>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Horizontal Divider -->
            <hr style="border-color: #222;">

            <!-- Copyright & Bottom Section -->
            <div class="row align-items-center pt-2">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p class="text-secondary small mb-0">&copy; 2026 PhoneStore. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <!-- Payment Badges / Methods (تأثير بصري ممتاز لثقة العميل) -->
                    <div class="text-secondary small">
                        <i class="bi bi-credit-card-2-front fs-5 me-2"></i> Cash on Delivery & Cards Accepted
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('asset/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
