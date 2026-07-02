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
    <div class="container my-4">
        <h1 class="fw-bold text-uppercase">Explore Our <span style="color: #00ff87;">Store</span></h1>
        <p class="text-secondary">Find the best devices and accessories filtered just for you.</p>
    </div>

    <div class="container pb-5">
        <div class="row g-4">

            <div class="col-lg-3">
                <div class="filter-sidebar">
                    <form action="{{ route('products.filter') }}" method="GET">

                        <h5 class="fw-bold mb-4 d-flex align-items-center justify-content-between">
                            <span><i class="bi bi-funnel-fill me-2" style="color: #00ff87 !important;"></i>Filters</span>
                            <a href="{{ route('products.filter') }}" class="text-secondary text-decoration-none small"
                                style="font-size: 0.85rem;">Clear All</a>
                        </h5>

                        <div class="mb-4">
                            <h6 class="fw-bold text-uppercase text-secondary small mb-3">Brands</h6>
                        
                            @foreach ($brands as $item)
                                <div class="form-check mb-2">
                                    <input class="form-check-input"
                                    type="checkbox"
                                    name="brand[]"
                                    value="{{ $item->id }}"
                                    {{ in_array($item->id, request('brand', [])) ? 'checked' : '' }}>
                        
                                    <label class="form-check-label text-light small"
                                           for="brand{{ $item->id }}">
                                        {{ $item->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <hr style="border-color: #333;">

                        <div class="mb-4">
                            <h6 class="fw-bold text-uppercase text-secondary small mb-3">Category</h6>

                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="category" value="" id="catAll"
                                    {{ request('category') == null ? 'checked' : '' }}>
                                <label class="form-check-label text-light small" for="catAll">
                                    All Categories
                                </label>
                            </div>

                            @foreach ($categories as $item)
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="category"
                                        value="{{ $item->id }}" id="cat{{ $item->id }}"
                                        {{ request('category') == $item->id ? 'checked' : '' }}>
                                    <label class="form-check-label text-light small"
                                        for="cat{{ $item->id }}">{{ $item->name }}</label>
                                </div>
                            @endforeach
                        </div>

                        <hr style="border-color: #333;">

                        <div class="mb-2">
                            <h6 class="fw-bold text-uppercase text-secondary small mb-3">Price Range</h6>
                            <div class="d-flex gap-2">
                                <input type="number"
                                    class="form-control form-control-sm text-center bg-dark text-white border-secondary"
                                    name="min_price" placeholder="Min ($)" value="{{ request('min_price') }}">
                                <input type="number"
                                    class="form-control form-control-sm text-center bg-dark text-white border-secondary"
                                    name="max_price" placeholder="Max ($)" value="{{ request('max_price') }}">
                            </div>
                            <button type="submit" class="btn btn-neon btn-sm w-100 mt-3 py-2">Apply Filter</button>
                        </div>

                    </form>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4 p-3"
                    style="background-color: #1c1c1c; border-radius: 8px;">
                    <span class="text-secondary small">Showing <span class="text-white fw-bold">12</span> Products</span>
                    <div class="d-flex align-items-center gap-2">
                        <span class="text-secondary small text-nowrap d-none d-sm-inline">Sort by:</span>
                        <form action="" method="get">
                            <select name="sort" class="form-select form-select-sm" style="width:160px"
                                onchange="this.form.submit()">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>
                                    Latest Arrivals
                                </option>

                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>
                                    Price: Low to High
                                </option>

                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>
                                    Price: High to Low
                                </option>

                                <option value="featured" {{ request('sort') == 'featured' ? 'selected' : '' }}>
                                    Featured
                                </option>
                            </select>

                        </form>
                    </div>
                </div>

                <div class="row g-3">
                    @foreach ($products as $item)
                        <div class="col-sm-6 col-md-4">
                            <div class="card product-card border-0 text-white h-100">
                                <div class="product-img-container">
                                    <img src="{{ asset('storage/' . $item->image) }}" class="img-fluid rounded"
                                        alt="{{ $item->title }}"     loading="lazy">>
                                </div>
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="card-title fw-bold mb-1 fs-6">{{ $item->title }}</h5>
                                        <p class="text-secondary small mb-2">{{ $item->description }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <span class="fw-bold fs-5" style="color: #00ff87;">${{ $item->price }}</span>
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
                    <div class="d-flex justify-content-center mt-5">
                        {{ $products->links() }}
                    </div>
                </div>

                {{-- <nav class="mt-5">
                    <ul class="pagination custom-pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link rounded-start" href="#">Previous</a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link rounded-end" href="#" style="color: #00ff87 !important;">Next</a>
                        </li>
                    </ul>
                </nav> --}}

            </div>
        </div>
    </div>
@endsection
