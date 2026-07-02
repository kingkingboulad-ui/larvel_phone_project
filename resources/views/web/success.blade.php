@extends('web.master')

@section('content')
<style>
    body {
        background-color: #0b0b0b;
        color: #ffffff;
    }

    .success-card {
        background-color: #141414;
        border: 1px solid #222;
        border-radius: 24px;
        box-shadow: 0 10px 30px rgba(0, 255, 135, 0.02);
    }

    .icon-box {
        background-color: rgba(0, 255, 135, 0.05);
        border: 1px solid rgba(0, 255, 135, 0.1);
        width: 100px;
        height: 100px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 0 20px rgba(0, 255, 135, 0.05);
    }

    .info-row {
        border-bottom: 1px solid #1c1c1c;
        padding-bottom: 12px;
        margin-bottom: 12px;
    }

    .info-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
        margin-bottom: 0;
    }

    .btn-home {
        background-color: #00ff87;
        color: #0b0b0b;
        font-weight: 700;
        letter-spacing: 0.5px;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-home:hover {
        background-color: #00e476;
        box-shadow: 0 0 15px rgba(0, 255, 135, 0.3);
        color: #0b0b0b;
    }
</style>

<main class="container py-5 my-4">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
            
            <div class="card success-card p-5 text-white">
                <div class="icon-box mb-4">
                    <i class="bi bi-check-lg display-4" style="color: #00ff87;"></i>
                </div>

                <h2 class="fw-bold mb-2">Order Placed Successfully!</h2>
                <p class="text-secondary small mb-5">Thank you for your purchase. Your order is now being processed.</p>

                <div class="text-start bg-black bg-opacity-25 rounded-3 p-4 border border-secondary border-opacity-10 mb-5">
                    <h6 class="fw-bold text-uppercase mb-4 text-secondary small" style="letter-spacing: 1px;">Order Details</h6>
                    
                    <div class="d-flex justify-content-between info-row">
                        <span class="text-secondary small">Order ID</span>
                        <span class="fw-bold text-white">#{{ $order->id }}</span>
                    </div>

                    <div class="d-flex justify-content-between info-row">
                        <span class="text-secondary small">Phone Number</span>
                        <span class="fw-bold text-white">{{ $order->phone }}</span>
                    </div>

                    <div class="d-flex justify-content-between info-row">
                        <span class="text-secondary small">Shipping Address</span>
                        <span class="fw-bold text-white text-end" style="max-width: 60%;">{{ $order->address }}</span>
                    </div>

                    <div class="d-flex justify-content-between info-row">
                        <span class="text-secondary small">Total Amount</span>
                        <span class="fw-bold text-success">${{ $order->total_price }}</span>
                    </div>
                    
                    <div class="d-flex justify-content-between info-row">
                        <span class="text-secondary small">Status</span>
                        <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-20 px-3 py-1 rounded-pill small">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>

                <div class="d-flex flex-column gap-3">
                    <a href="{{ route('index') }}" class="btn btn-home rounded-pill py-3 text-uppercase shadow-sm">
                        <i class="bi bi-house-door me-2"></i> Back to Home
                    </a>
                </div>

            </div>

        </div>
    </div>
</main>
@endsection