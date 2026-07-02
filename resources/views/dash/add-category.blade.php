@extends('dash.master_dash')
@section('content')
    @if (session('success'))
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



    @if (session('error'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif
    <div class="content-wrapper">
        <div class="page-header">
            <h1 class="page-title">Manage Categories</h1>
        </div>

        <div class="card" style="max-width: 600px;">
            <form method="POST" enctype="multipart/form-data" action="{{ route('stor.category') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label">Category Name</label>
                    <input type="text" class="form-control" placeholder="Processing, Marketing, etc." required
                        name="Category_Name">
                </div>
                <div class="form-group">
                    <label class="form-label">Category Image</label>
                    <input type="file" class="form-control" placeholder="Processing, Marketing, etc." required
                        name="file">
                </div>

                {{-- <div class="form-group">
                            <label class="form-label">Parent Category (Optional)</label>
                            <select class="form-control" name="">
                                <option value="">None</option>
                                <option value="1">Electronics</option>
                                <option value="2">Fashion</option>
                            </select>
                        </div> --}}

                <div class="form-group">
                    <label class="form-label">Status</label>
                    <div style="display: flex; gap: 1rem; align-items: center;">
                        <label style="display: flex; gap: 0.5rem; align-items: center; cursor: pointer;">
                            <input type="radio" name="status" value="active" checked> Active
                        </label>
                        <label style="display: flex; gap: 0.5rem; align-items: center; cursor: pointer;">
                            <input type="radio" name="status" value="inactive"> Inactive
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-check"></i> Save Category
                </button>
            </form>
        </div>
    </div>
    </main>
    </div>
@endsection
