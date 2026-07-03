@extends('web.master')
@section('content')
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        @if (session('success'))
            <div class="toast show text-bg-success">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        @endif
    </div>
    <section class="hero-section text-white d-flex align-items-center"
        style="background: radial-gradient(circle at 80% 20%, #1a3a2a 0%, #121212 100%); min-height: 80vh; padding: 60px 0;">
        <div class="container">
            <div class="row align-items-center">
                <!-- Text Content (الجانب الأيسر) -->
                <div class="col-lg-6 text-center text-lg-start mb-5 mb-lg-0">
                    <span class="badge rounded-pill px-3 py-2 mb-3"
                        style="background-color: rgba(0, 255, 135, 0.1); color: #00ff87; border: 1px solid rgba(0, 255, 135, 0.2);">
                        🔥 New Arrival: iPhone 17 Pro & Galaxy S26
                    </span>
                    <h1 class="display-4 fw-bold mb-3" style="line-height: 1.2;">
                        Upgrade Your Style <br>
                        With <span style="color: #00ff87; text-shadow: 0 0 20px rgba(0, 255, 135, 0.2);">Latest
                            Tech</span>
                    </h1>
                    <p class="lead text-secondary mb-4" style="max-width: 500px;">
                        Explore the ultimate collection of premium smartphones, next-gen accessories, and certified
                        repair services. Fast delivery to your doorstep.
                    </p>
                    <!-- Action Buttons -->
                    <div class="d-sm-flex justify-content-center justify-content-lg-start gap-3">
                        <a href="{{route('latestproduct')}}" class="btn btn-primary-tech px-4 py-3 mb-3 mb-sm-0 fw-bold">Shop Latest Phones</a>
                        <a href="{{route('products.filter')}}" class="btn btn-outline-light-tech px-4 py-3 fw-bold">Explore Accessories</a>
                    </div>
                </div>

                <!-- Image Content (الجانب الأيمن) -->
                <div class="col-lg-6 text-center position-relative">
                    <!-- خلفية مضيئة خلف الهاتف -->
                    <div class="position-absolute top-50 start-50 translate-middle rounded-circle"
                        style="width: 300px; height: 300px; background: rgba(0, 255, 135, 0.15); filter: blur(80px); z-index: 1;">
                    </div>

                    <!-- ضع رابط صورة الهاتف هنا في الـ src -->
                    <img src="https://images.unsplash.com/photo-1616348436168-de43ad0db179?auto=format&fit=crop&w=800&q=80"
                        alt="Latest Smartphone" class="img-fluid floating-animation rounded"
                        style="max-height: 450px; object-fit: contain; position: relative; z-index: 2; filter: drop-shadow(0 15px 30px rgba(0,0,0,0.5));">
                </div>
            </div>
        </div>
    </section>



























    <section class="py-5" style="background-color: #121212;">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="text-white fw-bold text-uppercase">Browse By <span style="color: #00ff87;">Category</span>
                </h2>
                <p class="text-secondary">Find exactly what you are looking for instantly</p>
            </div>

            <div class="row g-4">


                @foreach ($category as $item)
                    <div class="col-md-4">
                        <div class="card category-card text-center p-4 border-0 h-100"
                            style="background-color: #1c1c1c; border-radius: 12px; transition: 0.3s;">

                            {{-- Image --}}
                            <div class="icon-box mb-3 d-inline-flex align-items-center justify-content-center mx-auto"
                                style="width: 70px; height: 70px; background-color: rgba(0,255,135,0.1); border-radius: 50%; overflow:hidden;">

                                <img src="{{ asset('storage/' . $item->file) }}" alt="{{ $item->name }}"
                                    style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;"
                                    loading="lazy">>
                            </div>

                            {{-- Category Name --}}
                            <h4 class="text-white fw-bold">
                                {{ $item->name }}
                            </h4>

                            <p class="text-secondary small">
                                Explore {{ $item->name }} products
                            </p>

                            <a href="{{route('cat.get',$item->id)}}" class="text-success text-decoration-none stretched-link mt-2"
                                style="color: #00ff87 !important;">
                                Explore <i class="bi bi-arrow-right"></i>
                            </a>

                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>

    <!-- ======================================================= -->
    <!-- 2. SECTION: FEATURED PRODUCTS (قسم المنتجات المميزة) -->
    <!-- ======================================================= -->
    <section class="py-5" style="background-color: #0b0b0b;">
        <div class="container">
            <!-- الرأس (Header) -->
            <div class="d-flex justify-content-between align-items-end mb-5">
                <div>
                    <h2 class="text-white fw-bold text-uppercase">Featured <span style="color: #00ff87;">Products</span>
                    </h2>
                    <p class="text-secondary mb-0">Hot deals on the best devices</p>
                </div>
                <!-- أزرار التحكم في السلايدر (أجمل من الأسهم التقليدية الجانبية) -->
                
            </div>

            <!-- السلايدر (Carousel) -->
      <section class="py-5">
    <div class="container">
        <div class="row g-4">
            
            @foreach ($product as $item)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card product-card border-0 text-white h-100"
                         style="background-color: #141414; border-radius: 12px; overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        
                        <div class="p-3 text-center style-holder" style="background: #1c1c1c;">
                            <img src="{{ asset('storage/' . $item->image) }}" class="img-fluid rounded"
                                 alt="{{ $item->title }}" style="max-height: 180px; height: 180px; object-fit: contain;"
                                 loading="lazy">
                        </div>
                        
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title fw-bold mb-1 fs-6" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $item->title }}
                                </h5>
                                <p class="text-secondary small mb-2" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $item->description }}
                                </p>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                {{-- تعديل: جلب السعر الحقيقي للمنتج بدلاً من السعر الثابت --}}
                                <span class="fw-bold fs-5" style="color: #00ff87;">${{ $item->price }}</span>
                                
                                <form method="POST" action="{{ route('cart.add', $item->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-neon btn-sm">
                                        <i class="bi bi-cart-plus-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach

        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $product->links() }}
        </div>
    </div>
</section>

<style>
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 255, 135, 0.1);
    }
</style>

    <!-- ======================================================= -->
    <!-- 3. SECTION: SERVICES (قسم الصيانة والخدمات) -->
    <!-- ======================================================= -->
    <section class="py-5" style="background-color: #121212;">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-5">
                    <span class="text-uppercase fw-bold small tracking-wider"
                        style="color: #00ff87; letter-spacing: 1.5px;">Expert Support</span>
                    <h2 class="text-white fw-bold display-6 mt-2 mb-3">Professional Repair <br>Services For Your Device
                    </h2>
                    <p class="text-secondary">Don't let a broken screen or a dying battery ruin your day. Our certified
                        technicians can fix your device in no time with premium quality parts.</p>
                    <a href="#" class="btn btn-outline-success mt-2"
                        style="border-color: #00ff87; color: #00ff87; background: transparent;">Book a Repair <i
                            class="bi bi-tools ms-2"></i></a>
                </div>

                <div class="col-lg-7">
                    <div class="row g-4">
                        <!-- Service 1 -->
                        <div class="col-sm-6">
                            <div class="p-4" style="background-color: #1c1c1c; border-radius: 10px;">
                                <i class="bi bi-phone-vibrate text-success fs-3 mb-2"
                                    style="color: #00ff87 !important;"></i>
                                <h5 class="text-white fw-bold">Screen Replacement</h5>
                                <p class="text-secondary small mb-0">Cracked glass or bleeding LCDs fixed
                                    professionally.</p>
                            </div>
                        </div>
                        <!-- Service 2 -->
                        <div class="col-sm-6">
                            <div class="p-4" style="background-color: #1c1c1c; border-radius: 10px;">
                                <i class="bi bi-battery-charging text-success fs-3 mb-2"
                                    style="color: #00ff87 !important;"></i>
                                <h5 class="text-white fw-bold">Battery Diagnostics</h5>
                                <p class="text-secondary small mb-0">Get your battery health back to 100% with OEM
                                    parts.</p>
                            </div>
                        </div>
                        <!-- Service 3 -->
                        <div class="col-sm-6">
                            <div class="p-4" style="background-color: #1c1c1c; border-radius: 10px;">
                                <i class="bi bi-cpu text-success fs-3 mb-2" style="color: #00ff87 !important;"></i>
                                <h5 class="text-white fw-bold">Hardware Fixes</h5>
                                <p class="text-secondary small mb-0">Motherboard repair, charging ports, and camera
                                    replacements.</p>
                            </div>
                        </div>
                        <!-- Service 4 -->
                        <div class="col-sm-6">
                            <div class="p-4" style="background-color: #1c1c1c; border-radius: 10px;">
                                <i class="bi bi-shield-lock text-success fs-3 mb-2"
                                    style="color: #00ff87 !important;"></i>
                                <h5 class="text-white fw-bold">Software Setup</h5>
                                <p class="text-secondary small mb-0">OS flashing, data backup, lag fixes, and unlocking
                                    services.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
