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
<style>
    body {
        background-color: #0b0b0b;
        color: #ffffff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .hero-section {
        background: linear-gradient(135deg, #111 0%, #1a1a1a 100%);
        border-bottom: 1px solid #222;
    }
    .phone-card {
        background-color: #141414;
        border: 1px solid #222;
        border-radius: 16px;
        transition: all 0.3s ease;
        overflow: hidden;
    }
    .phone-card:hover {
        transform: translateY(-8px);
        border-color: #00ff87;
        box-shadow: 0 10px 30px rgba(0, 255, 135, 0.08);
    }
    .img-container {
        background-color: #1c1c1c;
        padding: 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 240px;
    }
    .phone-img {
        max-height: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
    }
    .phone-card:hover .phone-img {
        transform: scale(1.05);
    }
    .badge-tech {
        background-color: rgba(0, 255, 135, 0.1);
        color: #00ff87;
        border: 1px solid rgba(0, 255, 135, 0.2);
    }
    .spec-icon {
        color: #aaa;
        font-size: 0.9rem;
    }
</style> 

    <header class="hero-section py-5 text-center position-relative">
        <!-- هالة الإضاءة الخلفية الفاخرة -->
        <div class="glow-orb"></div>
        
        <div class="container py-5 position-relative" style="z-index: 2;">
            <!-- شارة زجاجية عصرية -->
            <span class="badge badge-blur mb-4 px-3 py-2 rounded-pill text-uppercase small fw-semibold">
                <i class="bi bi-cpu me-1 text-success"></i> Flagship Devices Guide
            </span>
            
            <!-- عنوان ضخم بتدرج لوني احترافي -->
            <h1 class="display-3 fw-bold text-white mb-3 tracking-tight">
                The Future of Mobile <br class="d-none d-md-block">
                <span class="text-gradient">Smartphones of 2026</span>
            </h1>
            
            <!-- نص وصفي بمسافات مريحة للعين -->
            <p class="lead text-secondary mx-auto mb-4" style="max-width: 650px; font-size: 1.15rem; linear-height: 1.7;">
                Discover the most powerful releases from tech giants this year, featuring next-gen specifications fully powered by AI and innovative folding technologies.
            </p>
            
            
        </div>
    </header>

    <main class="container py-5">
        <div class="row g-4">
            @foreach ( $products as $item )
                
           
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card phone-card h-100 text-white">
                    <div class="img-container">
                        <img src="{{asset('storage/'.$item->image)}}" class="phone-img img-fluid" alt="Samsung Galaxy S26 Ultra"     loading="lazy">>
                    </div>
                    <div class="card-body d-flex flex-column justify-content-between p-4">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-secondary opacity-75">{{$item->title}}</span>
                                <span class="badge badge-tech">{{$item->descreption}}</span>
                            </div>
                            <h4 class="card-title fw-bold mb-3">Galaxy S26 Ultra</h4>
                            
                           
                        </div>
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top border-secondary border-opacity-25">
                            <span class="fs-4 fw-bold" style="color: #00ff87;">${{$item->price}}</span>
                            <form method="Post" action="{{route('cart.add',$item->id)}}">
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
    </main>

  






@endsection








