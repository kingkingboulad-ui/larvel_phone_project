@extends('web.master')

@section('content')
<style>
    body { background-color: #0b0b0b; color: #ffffff; }
    .checkout-card { background-color: #141414; border: 1px solid #222; border-radius: 16px; }
    .form-control, .form-select {
        background-color: #1c1c1c; border: 1px solid #2d2d2d; color: #fff; border-radius: 8px;
    }
    .form-control:focus, .form-select:focus {
        background-color: #1c1c1c; color: #fff; border-color: #00ff87; box-shadow: 0 0 8px rgba(0,255,135,0.2);
    }
</style>
@if ($errors->any())
    <div class="alert alert-danger m-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger m-4">
        {{ session('error') }}
    </div>
@endif
<main class="container py-5">
    <div class="row g-4">
        
        <div class="col-lg-7">
            <div class="card checkout-card p-4 text-white">
                <h4 class="fw-bold mb-4">
                    <i class="bi bi-truck me-2" style="color: #00ff87;"></i> Shipping & Payment
                </h4>
                
                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label text-secondary small">Phone Number</label>
                        <input type="text" name="phone" class="form-control" placeholder="+123 456 7890" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-secondary small">Full Delivery Address</label>
                        <textarea name="address" rows="3" class="form-control" placeholder="Street, Building, Apartment, City..." required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-secondary small">Payment Method</label>
                        <select name="payment_method" class="form-select" required>
                            <option value="cod">Cash on Delivery (COD)</option>
                            <option value="card">Credit / Debit Card</option>
                        </select>
                    </div>

                    <button type="submit" class="btn w-100 fw-bold text-uppercase py-3 rounded-pill" style="background-color: #00ff87; color: #0b0b0b; border: none;">
                        Place Order (${{ $total }})
                    </button>
                </form>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card checkout-card p-4 text-white">
                <h5 class="fw-bold mb-3">Order Summary</h5>
                <hr style="border-color: #222;">
                
                @foreach($items as $item)
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <div style="width: 50px; height: 50px; background:#1c1c1c; border-radius:8px; overflow:hidden;" class="d-flex align-items-center justify-content-center">
                            <img src="{{ asset('storage/'.$item->product->image) }}" style="max-height:85%; object-fit:contain;" alt="">
                        </div>
                        <div>
                            <h6 class="mb-0 small fw-bold">{{ $item->product->title }}</h6>
                            <small class="text-secondary">Qty: {{ $item->quantity }}</small>
                        </div>
                    </div>
                    <span class="text-success small fw-bold">${{ $item->product->price * $item->quantity }}</span>
                </div>
                @endforeach
                
                <hr style="border-color: #222;">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-secondary">Grand Total:</span>
                    <h4 class="fw-bold text-success mb-0">${{ $total }}</h4>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection