@extends('dash.master_dash')
@section('content')
@if(session('success'))
<script>
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });



</script>



@endif


    <div class="content-wrapper">
        <div class="page-header">
            <h1 class="page-title">Add New Product</h1>
        </div>

        <div class="card">
            <form method="POST" action="{{route('admin.addpost')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Product Name</label>
                    <input type="text" class="form-control" placeholder="Enter product name" required name="title">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label class="form-label">Price ($)</label>
                        <input type="number" class="form-control" placeholder="0.00" min="0" step="0.01"
                            required name="price">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Category</label>
                        <select class="form-control" required name="category_id">
                            @foreach ($categories as $id=> $item)
                                <option value="{{ $id }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group" >
                        <label class="form-label">Category</label>
                        <select class="form-control" required name="brand_id">
                            @foreach ( $brand  as  $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Product Image</label>
                    <input type="file" class="form-control" accept="image/*" name="image">
                    <div class="image-preview">
                        <span class="preview-placeholder">Product Image</span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" rows="4" placeholder="Product details..."  name="description"></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Featured Product</label>
                
                    <div class="d-flex gap-3 mt-2">
                        <label>
                            <input type="radio" name="is_featured" value="1" checked>
                            Yes
                        </label>
                
                        <label>
                            <input type="radio" name="is_featured" value="0">
                            No
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add Product
                </button>
            </form>
        </div>
    </div>
    </main>
    </div>
@endsection
