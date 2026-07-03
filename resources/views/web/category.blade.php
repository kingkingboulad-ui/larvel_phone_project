@extends('web.master')
@section('content')
    <div class="category-container">
        <!-- Category Title -->
        <h2 class="category-title">{{ $category->name }}</h2>

        <!-- Products Grid -->
        <div class="products-grid">
            @forelse($category->products as $product)
                <div class="product-card">
                    <div class="product-info">
                        <!-- Product Image Container -->
                        <div class="product-image-wrapper">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->title }}"
                                class="product-image" loading="lazy">
                        </div>

                        <!-- Product Text -->
                        <h5 class="product-name">{{ $product->title }}</h5>
                        <p class="product-description">{{ $product->description }}</p>
                    </div>

                    <!-- Product Footer Action / Price & Cart -->
                    <div class="product-action-footer">
                        <span class="product-price">{{ $product->price }} AED</span>

                        <form method="POST" action="{{ route('cart.add', $product->id) }}">
                            @csrf
                            <button type="submit" class="btn-cart-add" title="Add to Cart">
                                <i class="bi bi-cart-plus-fill"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <!-- Empty State Message -->
                <div class="no-products">
                    <div class="icon">📦</div>
                    <p>No products available in this category at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Styles aligned with your theme variables -->
    <style>
        .category-container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            direction: ltr;
            /* English alignment */
            background-color: var(--bg-color);
            color: var(--text-color);
            transition: var(--transition);
        }

        .category-title {
            font-size: 2rem;
            color: var(--text-color);
            margin-bottom: 30px;
            border-bottom: 3px solid var(--primary-color);
            padding-bottom: 10px;
            display: inline-block;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }

        .product-card {

            background-color: #141414;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;

        
            box-shadow: var(--shadow-sm);
            padding: 20px;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            border: 1px solid var(--border-color);
          
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-color);
            /* Glow effect on border */
        }

        /* Product Image styling */
        .product-image-wrapper {
            width: 100%;
            height: 200px;
            background-color: var(--secondary-color);
            border-radius: var(--radius-md);
            margin-bottom: 15px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        /* Typography */
        .product-name {
            font-size: 1.1rem;
            font-weight: bold;
            color: var(--text-color);
            margin: 0 0 6px 0;
        }

        .product-description {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            /* قص النص الطويل في سطرين مظهر نظيف */
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Price and Cart Container Layout */
        .product-action-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
            padding-top: 10px;
        }

        .product-price {
            font-size: 1.2rem;
            color: var(--primary-color);
            /* Glow Green for price */
            font-weight: bold;
        }

        /* Neon Style Cart Button */
        .btn-cart-add {
    
            color: #a9a9a9;
            /* Dark text for visual contrast on phosphor green */
            border: none;
            width: 40px;
            height: 40px;
            border-radius: var(--radius-md);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            transition: var(--transition);
            box-shadow: 0 0 10px rgba(0, 255, 135, 0.2);
        }

        .btn-cart-add:hover {
            background-color: var(--primary-hover);
            box-shadow: 0 0 15px rgba(0, 255, 135, 0.5);
            transform: scale(1.05);
        }

        /* Empty State */
        .no-products {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            background: var(--secondary-color);
            border-radius: var(--radius-lg);
            border: 2px dashed var(--border-color);
            color: var(--text-muted);
        }

        .no-products .icon {
            font-size: 3rem;
            margin-bottom: 15px;
        }

        .no-products p {
            font-size: 1.2rem;
            margin: 0;
        }
    </style>
@endsection
