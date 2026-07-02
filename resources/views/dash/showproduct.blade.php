@extends("dash.master_dash")
@section('content')

<style>
    /* Application of styling based on your CSS variables */
    .products-container {
        background-color: var(--bg-color);
        color: var(--text-color);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
        padding: 2rem;
        transition: var(--transition);
    }
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .page-title h1 {
        font-size: 1.75rem;
        font-weight: 700;
        margin: 0;
    }
    .page-title p {
        color: var(--text-muted);
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }
    .page-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }
    /* Search Bar Styles */
    .search-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }
    .search-input {
        background-color: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md);
        padding: 0.625rem 1rem 0.625rem 2.5rem;
        color: var(--text-color);
        font-size: 0.875rem;
        width: 250px;
        transition: var(--transition);
        outline: none;
    }
    .search-input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(0, 255, 135, 0.15);
        width: 300px;
    }
    .search-input::placeholder {
        color: var(--text-muted);
    }
    .search-icon {
        position: absolute;
        left: 0.75rem;
        color: var(--text-muted);
        pointer-events: none;
    }
    .btn-primary {
        background-color: var(--primary-color);
        color: #000000;
        font-weight: 600;
        padding: 0.625rem 1.25rem;
        border-radius: var(--radius-md);
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: var(--transition);
        box-shadow: 0 0 15px rgba(0, 255, 135, 0.3);
        white-space: nowrap;
        text-decoration: none;
    }
    .btn-primary:hover {
        background-color: var(--primary-hover);
        box-shadow: 0 0 25px rgba(0, 255, 135, 0.6);
        transform: translateY(-2px);
    }
    /* Products Grid */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
    }
    /* No results message - Clean & Absolute display control */
    .no-results {
        text-align: center;
        padding: 4rem 2rem;
        color: var(--text-muted);
        background-color: var(--card-bg);
        border-radius: var(--radius-lg);
        border: 1px dashed var(--border-color);
        margin-top: 2rem;
    }
    .no-results h3 {
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
        color: var(--text-color);
    }
    .hidden {
        display: none !important;
    }
    /* Premium Product Card */
    .product-card {
        background-color: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        overflow: hidden;
        transition: var(--transition);
        box-shadow: var(--shadow-sm);
        position: relative;
    }
    .product-card:hover {
        transform: translateY(-5px);
        border-color: var(--primary-color);
        box-shadow: var(--shadow-md);
    }
    .product-image-wrapper {
        background-color: var(--secondary-color);
        height: 200px;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
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
    .product-badge {
        position: absolute;
        top: 1rem;
        left: 1rem;
        background-color: rgba(0, 0, 0, 0.75);
        border: 1px solid var(--primary-color);
        color: var(--primary-color);
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.25rem 0.75rem;
        border-radius: var(--radius-md);
        text-shadow: 0 0 5px var(--primary-color);
    }
    .product-info {
        padding: 1.25rem;
    }
    .product-category {
        color: var(--text-muted);
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
    }
    .product-name {
        font-size: 1.125rem;
        font-weight: 600;
        margin: 0 0 0.5rem 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .product-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid var(--border-color);
    }
    .product-price {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--primary-color);
        text-shadow: 0 0 10px rgba(0, 255, 135, 0.2);
    }
    .product-actions {
        display: flex;
        gap: 0.5rem;
    }
    .btn-icon {
        background-color: transparent;
        border: 1px solid var(--border-color);
        color: var(--text-muted);
        width: 36px;
        height: 36px;
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
    }
    .btn-icon:hover {
        border-color: var(--primary-color);
        color: var(--primary-color);
        box-shadow: 0 0 10px rgba(0, 255, 135, 0.2);
    }
    .btn-icon.delete:hover {
        border-color: #ff4a4a;
        color: #ff4a4a;
        box-shadow: 0 0 10px rgba(255, 74, 74, 0.2);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: stretch;
        }
        .page-actions {
            flex-direction: column;
            width: 100%;
        }
        .search-wrapper {
            width: 100%;
        }
        .search-input {
            width: 100%;
        }
        .search-input:focus {
            width: 100%;
        }
        .btn-primary {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="products-container" dir="ltr">
    
    <div class="page-header">
        <div class="page-title">
            <h1>Product Management</h1>
            <p>View, edit, and monitor all available products in your store.</p>
        </div>
        <div class="page-actions">
            <div class="search-wrapper">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input 
                    type="text" 
                    class="search-input" 
                    id="productSearch" 
                    placeholder="Search products..."
                    autocomplete="off"
                >
            </div>
            <a class="btn-primary" href="{{route('admin.addpost')}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Add New Product
            </a>
        </div>
    </div>

    <div class="products-grid" id="productsGrid">
        @foreach ($product as $item)
        {{-- تم ربط الداتا هنا بالقيم الحقيقية للمنتج حتى يعمل محرك البحث بدقة --}}
        <div class="product-card" data-name="{{ $item->title }}" data-description="{{ $item->description }}">
            <div class="product-image-wrapper">
                @if($item->is_featured == 1)
                    <span class="product-badge">Featured</span>
                @endif
                <img src="{{asset('storage/'.$item->image)}}" alt="{{ $item->title }}" class="product-image" loading="lazy">>
            </div>
            <div class="product-info">
                <div class="product-category">{{$item->title}}</div>
                <h3 class="product-name">{{$item->description}}</h3>
                
                <div class="product-meta">
                    <div class="product-price">${{$item->price}}</div>
                    <div class="product-actions">
                        <a class="btn-icon" title="Edit Product" href="{{route('product.edit',$item->id)}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4Z"></path>
                            </svg>
                        </a>
                        <form action="{{ route('product.delete', $item->id) }}"
                            method="POST"
                            style="display:inline-block;"
                            onsubmit="return confirm('Are you sure you want to delete this product?')">
                      
                            @csrf
                            @method('DELETE')
                      
                            <button type="submit"
                                    class="btn-icon delete"
                                    title="Delete Product"
                                    style="border:none;background:none;padding:0;cursor:pointer;">
                      
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="16"
                                     height="16"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="2"
                                     stroke-linecap="round"
                                     stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="no-results hidden" id="noResultsBox">
        <h3>🔍 No products found</h3>
        <p>Try adjusting your search terms.</p>
    </div>

</div>

<script>
    (function() {
        'use strict';

        const searchInput = document.getElementById('productSearch');
        const productCards = document.querySelectorAll('.product-card');
        const noResultsBox = document.getElementById('noResultsBox');

        function filterProducts() {
            const query = searchInput.value.toLowerCase().trim();
            let hasVisible = false;

            productCards.forEach(card => {
                const name = (card.dataset.name || '').toLowerCase();
                const description = (card.dataset.description || '').toLowerCase();
                const matches = query === '' || name.includes(query) || description.includes(query);
                
                if (matches) {
                    card.classList.remove('hidden');
                    hasVisible = true;
                } else {
                    card.classList.add('hidden');
                }
            });

            // تظهر الرسالة فقط إذا كان هناك نص مكتوب بالبحث، ولم يتم العثور على أي منتج متطابق
            if (query !== '' && !hasVisible) {
                noResultsBox.classList.remove('hidden');
            } else {
                noResultsBox.classList.add('hidden');
            }
        }

        // Debounce search for smooth performance
        let debounceTimer;
        searchInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(filterProducts, 150);
        });

    })();
</script>

@endsection