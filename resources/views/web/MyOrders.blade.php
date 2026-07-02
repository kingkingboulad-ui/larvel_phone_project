@extends('web.master')
@section('content')
    <style>
        body {
            background-color: #0b0b0b;
            color: #ffffff;
        }

        .order-card {
            background-color: #141414;
            border: 1px solid #222;
            border-radius: 16px;
            transition: all 0.3s ease;
        }

        .order-card:hover {
            border-color: #00ff87;
            box-shadow: 0 5px 20px rgba(0, 255, 135, 0.05);
        }

        .badge-pending {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
            border: 1px solid rgba(255, 193, 7, 0.2);
            padding: 6px 12px;
            border-radius: 50px;
        }

        .item-img-container {
            background-color: #1c1c1c;
            border-radius: 12px;
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 1px solid #2d2d2d;
        }

        .item-img {
            max-height: 85%;
            object-fit: contain;
        }

        /* ستايل مخصص لزر الشراء عند التمرير */
        .btn-checkout {
            background-color: #00ff87;
            color: #0b0b0b;
            font-weight: 700;
            letter-spacing: 0.5px;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-checkout:hover {
            background-color: #00e476;
            box-shadow: 0 0 15px rgba(0, 255, 135, 0.4);
            color: #0b0b0b;
        }

        /* ستايل مخصص لزر الحذف المتناسق مع التصميم */
        .btn-cart-delete {
            border: 0;
            background: none;
            color: #ff4a4a;
            font-size: 0.85rem;
            font-weight: 500;
            padding: 4px 8px;
            border-radius: 6px;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            text-decoration: none;
        }
        .btn-cart-delete:hover {
            background-color: rgba(255, 74, 74, 0.1);
            color: #ff2a2a;
        }
    </style>

    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-bold mb-1">Shopping Cart</h2>
                        <p class="text-secondary small mb-0">Review your items before proceeding to payment</p>
                    </div>
                </div>

                <div class="d-flex flex-column gap-4">

                    {{-- بداية عرض عناصر السلة --}}
                    @forelse($orders as $item)
                    
                    <div class="card order-card text-white p-4">
                        <div class="row align-items-center g-3">
                            <div class="col-md-3">
                                <span class="text-secondary d-block small">Product ID</span>
                                <span class="fw-bold">#{{ $item->product->id }}</span>
                            </div>
                    
                            <div class="col-md-3">
                                <span class="text-secondary d-block small">Added Date</span>
                                <span>{{ $item->created_at->format('d M Y') }}</span>
                            </div>
                    
                            <div class="col-md-2">
                                <span class="text-secondary d-block small">Subtotal</span>
                                <span class="fw-bold text-success">
                                    ${{ $item->product->price * $item->quantity }}
                                </span>
                            </div>
                    
                            <div class="col-md-4 text-md-end">
                                <span class="badge badge-pending">In Cart</span>
                            </div>
                        </div>
                    
                        <div class="mt-4 pt-3 border-top border-secondary">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="item-img-container">
                                        <img src="{{ asset('storage/'.$item->product->image) }}" class="item-img" alt="" loading="lazy">
                                    </div>
                        
                                    <div>
                                        <h6 class="mb-1">{{ $item->product->title }}</h6>
                                        <small class="text-secondary">Qty : {{ $item->quantity }}</small>
                                        <span class="text-secondary mx-2">|</span>
                                        <small class="text-success">${{ $item->product->price }}</small>
                                    </div>
                                </div>

                                <div>
                                    <form action="{{ route('cart.item.delete', $item->id) }}"
                                          method="POST"
                                          style="display:inline"
                                          onsubmit="return confirm('Delete this item from your cart?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-cart-delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @empty
                    <div class="text-center py-5">
                        <i class="bi bi-cart-x text-secondary display-1 d-block mb-3"></i>
                        <h4 class="text-secondary">Your cart is empty.</h4>
                    </div>
                    @endforelse
                    {{-- نهاية عرض عناصر السلة --}}

                    {{-- ======================================================= --}}
                    {{-- كارد الـ CHECKOUT الاحترافي في أسفل الصفحة --}}
                    {{-- ======================================================= --}}
                    @if($orders->count() > 0)
                    <div class="card order-card text-white p-4 mt-2" style="border-color: rgba(0, 255, 135, 0.2);">
                        <div class="row align-items-center g-4">
                            <div class="col-md-6">
                                <span class="text-secondary d-block small text-uppercase fw-bold mb-1" style="letter-spacing: 1px;">Total Amount</span>
                                <h2 class="fw-bold text-success mb-0">${{ $orders->sum(fn($item) => $item->product->price * $item->quantity) }}</h2>
                            </div>
                            <div class="col-md-6 text-md-end">
                                <a href="{{ route('checkout.index') }}" class="btn btn-checkout rounded-pill px-5 py-3 text-uppercase shadow-sm">
                                    Proceed to Checkout <i class="bi bi-arrow-right ms-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </main>
@endsection