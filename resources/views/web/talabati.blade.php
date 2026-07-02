@extends('web.master')
@section('content')
<style>
    body { background-color: #0b0b0b; color: #ffffff; }
    .order-panel { background-color: #141414; border: 1px solid #222; border-radius: 16px; }
    
    /* ستايلات احترافية لحالات الطلب */
    .status-pending { background-color: rgba(255, 193, 7, 0.1); color: #ffc107; border: 1px solid rgba(255, 193, 7, 0.2); }
    .status-processing { background-color: rgba(0, 123, 255, 0.1); color: #007bff; border: 1px solid rgba(0, 123, 255, 0.2); }
    .status-delivered { background-color: rgba(0, 255, 135, 0.1); color: #00ff87; border: 1px solid rgba(0, 255, 135, 0.2); }
    .status-cancelled { background-color: rgba(220, 53, 69, 0.1); color: #dc3545; border: 1px solid rgba(220, 53, 69, 0.2); }
    
    .badge-pill { padding: 6px 16px; border-radius: 50px; font-size: 0.85rem; font-weight: 600; }
    .product-thumb { width: 55px; height: 55px; background: #1c1c1c; border-radius: 8px; overflow: hidden; border: 1px solid #2d2d2d; }
</style>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            
            <div class="mb-4">
                <h2 class="fw-bold mb-1">Track My Orders</h2>
                <p class="text-secondary small">View and monitor the live status of your purchases</p>
            </div>

            <div class="d-flex flex-column gap-4">
                @forelse($orders as $order)
                <div class="card order-panel p-4 text-white">
                    
                    <div class="row align-items-center g-3 border-bottom border-secondary border-opacity-10 pb-3 mb-3">
                        <div class="col-md-3">
                            <span class="text-secondary d-block small">Order ID</span>
                            <span class="fw-bold">#{{ $order->id }}</span>
                        </div>
                        <div class="col-md-3">
                            <span class="text-secondary d-block small">Order Date</span>
                            <span>{{ $order->created_at->format('d M Y - h:i A') }}</span>
                        </div>
                        <div class="col-md-3">
                            <span class="text-secondary d-block small">Total Amount</span>
                            <span class="fw-bold text-success">${{ $order->total_price }}</span>
                        </div>
                        
                        <div class="col-md-3 text-md-end">
                            @if($order->status == 'pending')
                                <span class="badge-pill status-pending"><i class="bi bi-clock-history me-1"></i> Pending</span>
                            @elseif($order->status == 'processing')
                                <span class="badge-pill status-processing"><i class="bi bi-gear-fill me-1"></i> Processing</span>
                            @elseif($order->status == 'delivered')
                                <span class="badge-pill status-delivered"><i class="bi bi-check-circle-fill me-1"></i> Delivered</span>
                            @else
                                <span class="badge-pill status-cancelled"><i class="bi bi-x-circle-fill me-1"></i> Cancelled</span>
                            @endif
                        </div>
                    </div>

                    <div class="order-items">
                        @foreach($order->items as $item)
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="d-flex align-items-center gap-3">
                                <div class="product-thumb d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('storage/'.$item->product->image) }}" style="max-height:85%; object-fit:contain;" alt="">
                                </div>
                                <div>
                                    <h6 class="mb-0 small fw-bold">{{ $item->product->title }}</h6>
                                    <small class="text-secondary">Qty: {{ $item->quantity }}</small>
                                </div>
                            </div>
                            <span class="text-secondary small">${{ $item->price }} / item</span>
                        </div>
                        @endforeach
                    </div>

                </div>
                @empty
                <div class="text-center py-5">
                    <i class="bi bi-box-seam text-secondary display-1 d-block mb-3"></i>
                    <h4 class="text-secondary">You haven't placed any orders yet.</h4>
                </div>
                @endforelse
            </div>

        </div>
    </div>
</main>
@endsection