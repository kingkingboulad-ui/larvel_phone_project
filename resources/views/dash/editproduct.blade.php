@extends('dash.master_dash')

@section('content')

<style>
    /* Main Container with LTR layout */
    .edit-product-container {
        background-color: var(--bg-color);
        color: var(--text-color);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        min-height: 100vh;
        padding: 2rem;
        transition: var(--transition);
    }
    
    /* Header Styles */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2.5rem;
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 1.5rem;
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
    .btn-back {
        background-color: transparent;
        border: 1px solid var(--border-color);
        color: var(--text-muted);
        font-weight: 500;
        padding: 0.625rem 1.25rem;
        border-radius: var(--radius-md);
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        transition: var(--transition);
    }
    .btn-back:hover {
        border-color: var(--text-color);
        color: var(--text-color);
    }

    /* Success Alert Neon Style */
    .alert-success {
        background-color: var(--card-bg);
        border: 1px solid var(--primary-color);
        color: var(--text-color);
        padding: 1rem;
        border-radius: var(--radius-md);
        margin-bottom: 2rem;
        box-shadow: 0 0 15px rgba(0, 255, 135, 0.1);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    /* Form Grid Layout */
    .edit-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }
    @media (max-width: 992px) {
        .edit-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Card Panels */
    .form-panel {
        background-color: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 2rem;
        box-shadow: var(--shadow-sm);
    }
    .panel-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-top: 0;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid var(--border-color);
    }

    /* Form Elements */
    .form-group {
        margin-bottom: 1.5rem;
    }
    .form-group.row-fluid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }
    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: var(--text-color);
    }
    .form-control {
        width: 100%;
        background-color: var(--secondary-color);
        border: 1px solid var(--border-color);
        color: var(--text-color);
        padding: 0.75rem 1rem;
        border-radius: var(--radius-md);
        font-size: 0.95rem;
        transition: var(--transition);
        box-sizing: border-box;
    }
    .form-control:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 10px rgba(0, 255, 135, 0.15);
    }
    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }
    .error-text {
        color: #ff4a4a;
        font-size: 0.8rem;
        margin-top: 0.25rem;
        display: block;
    }

    /* Image Upload Box */
    .image-upload-box {
        border: 2px dashed var(--border-color);
        border-radius: var(--radius-md);
        padding: 1.5rem;
        text-align: center;
        background-color: var(--secondary-color);
        cursor: pointer;
        transition: var(--transition);
        position: relative;
    }
    .image-upload-box:hover {
        border-color: var(--primary-color);
    }
    .preview-img {
        max-width: 100%;
        max-height: 180px;
        border-radius: var(--radius-md);
        margin-bottom: 1rem;
        display: block;
        margin-left: auto;
        margin-right: auto;
        object-fit: cover;
    }
    .upload-hint {
        color: var(--text-muted);
        font-size: 0.85rem;
    }

    /* Glowing Action Buttons */
    .action-row {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 2rem;
        border-top: 1px solid var(--border-color);
        padding-top: 1.5rem;
    }
    .btn-save {
        background-color: var(--primary-color);
        color: #000000;
        font-weight: 600;
        padding: 0.75rem 2rem;
        border-radius: var(--radius-md);
        border: none;
        cursor: pointer;
        transition: var(--transition);
        box-shadow: 0 0 15px rgba(0, 255, 135, 0.2);
    }
    .btn-save:hover {
        background-color: var(--primary-hover);
        box-shadow: 0 0 25px rgba(0, 255, 135, 0.5);
        transform: translateY(-1px);
    }
    .btn-cancel {
        background-color: transparent;
        border: 1px solid #ff4a4a;
        color: #ff4a4a;
        font-weight: 500;
        padding: 0.75rem 2rem;
        border-radius: var(--radius-md);
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: var(--transition);
    }
    .btn-cancel:hover {
        background-color: rgba(255, 74, 74, 0.1);
        box-shadow: 0 0 15px rgba(255, 74, 74, 0.2);
    }
</style>

<div class="edit-product-container" dir="ltr">
    
    <div class="page-header">
        <div class="page-title">
            <h1>Edit Product</h1>
            <p>Modify details, pricing, and media assets for this item.</p>
        </div>
        {{-- يمكنك استبدال الرابط بمسار عرض المنتجات الفعلي لديك --}}
        <a href="{{ url()->previous() }}" class="btn-back">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Back
        </a>
    </div>

    @if(session('success'))
        <div class="alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--primary-color)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    {{-- تأكد من وضع اسم الـ route الصحيح هنا، مثل route('products.update', $product->id) --}}
    <form action="{{route('product.update',$product->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="edit-grid">
            
            <div class="form-panel">
                <h3 class="panel-title">Product Information</h3>
                
                <div class="form-group">
                    <label class="form-label">Product Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $product->title) }}" placeholder="Enter product title">
                    @error('title') <span class="error-text">{{ $message }}</span> @enderror
                </div>

                <div class="form-group row-fluid">
                    <div>
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-control">
                            <option value="">Select Category</option>
                            @foreach($categories as $id => $name)
                                <option value="{{ $id }}" {{ old('category_id', $product->category_id) == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="error-text">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="form-label">Brand</label>
                        <select name="brand_id" class="form-control">
                            <option value="">Select Brand</option>
                            @foreach($brand as $b)
                                <option value="{{ $b->id }}" {{ old('brand_id', $product->brand_id) == $b->id ? 'selected' : '' }}>
                                    {{ $b->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_id') <span class="error-text">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" placeholder="Write a detailed description...">{{ old('description', $product->description) }}</textarea>
                    @error('description') <span class="error-text">{{ $message }}</span> @enderror
                </div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 2rem;">
                
                <div class="form-panel">
                    <h3 class="panel-title">Pricing & Settings</h3>
                    
                    <div class="form-group">
                        <label class="form-label">Price ($)</label>
                        <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price) }}">
                        @error('price') <span class="error-text">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Featured Product</label>
                        <select name="is_featured" class="form-control">
                            <option value="1" {{ old('is_featured', $product->is_featured) == 1 ? 'selected' : '' }}>Yes, Feature this product</option>
                            <option value="0" {{ old('is_featured', $product->is_featured) == 0 ? 'selected' : '' }}>No, Regular status</option>
                        </select>
                        @error('is_featured') <span class="error-text">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-panel">
                    <h3 class="panel-title">Product Image</h3>
                    
                    <div class="image-upload-box">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="Preview" class="preview-img" id="img-preview">
                        @else
                            <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=500&q=80" alt="Default Preview" class="preview-img" id="img-preview">
                        @endif
                        
                        <div class="upload-hint">
                            <span style="color: var(--primary-color);">Click to replace</span> or drag and drop<br>PNG, JPG up to 2MB
                        </div>
                        <input type="file" name="image" id="file-input" style="position: absolute; top:0; left:0; width:100%; height:100%; opacity:0; cursor:pointer;">
                    </div>
                    @error('image') <span class="error-text" style="text-align: center;">{{ $message }}</span> @enderror
                </div>

            </div>

        </div>

        <div class="action-row">
            <a href="{{ url()->previous() }}" class="btn-cancel">Discard Changes</a>
            <button type="submit" class="btn-save">Save Changes</button>
        </div>

    </form>
</div>

<script>
    // Live preview logic for image upload
    document.getElementById('file-input').addEventListener('change', function(e) {
        const reader = new FileReader();
        reader.onload = function() {
            document.getElementById('img-preview').src = reader.result;
        }
        if(e.target.files[0]) {
            reader.readAsDataURL(e.target.files[0]);
        }
    });
</script>

@endsection