@extends('dash.master_dash')
@section('content')
<style>
    /* المتغيرات الاحتياطية في حال عدم وجودها في ملفك الأساسي */
    :root {
        --bg-color: #121212;
        --card-bg: #1e1e1e;
        --text-color: #ffffff;
        --text-muted: #a0a0a0;
        --border-color: #333333;
        --primary-color: #00b35e;
        --primary-hover: #00ff87;
        --secondary-color: #ef4444;
        --shadow-sm: 0 2px 4px rgba(0,0,0,0.1);
        --shadow-md: 0 4px 6px rgba(0,0,0,0.15);
        --radius-md: 8px;
        --transition: all 0.3s ease;
    }

    body {
        background-color: var(--bg-color);
        color: var(--text-color);
    }
    
    /* تنسيق الكارد الخاص بالفورم */
    .custom-card {
        background-color: var(--card-bg) !important;
        border: 1px solid var(--border-color) !important;
        border-radius: var(--radius-md) !important; 
        padding: 2rem;
        box-shadow: var(--shadow-md);
        width: 100% !important; 
    }

    .custom-input {
        background-color: rgba(255, 255, 255, 0.05) !important;
        border: 1px solid var(--border-color) !important;
        color: var(--text-color) !important;
        border-radius: var(--radius-md);
        padding: 10px 15px;
    }

    .custom-input:focus {
        border-color: var(--primary-color) !important;
        box-shadow: 0 0 0 0.25rem rgba(0, 179, 94, 0.25) !important;
        background-color: rgba(255, 255, 255, 0.07) !important;
    }
    
    .table-title {
        color: var(--text-color);
        letter-spacing: 0.5px;
        font-weight: 600;
    }
    
    /* تنسيق الجدول */
    .custom-table {
        border-collapse: separate;
        border-spacing: 0 8px;
        width: 100% !important;
    }
    
    .custom-table thead th {
        background-color: #090909 !important;
        color: var(--text-muted) !important;
        border-bottom: none;
        padding: 14px 16px;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-align: center; /* لتوحيد محاذاة العناوين مع المحتوى */
    }
    
    .custom-table tbody tr {
        background-color: var(--card-bg);
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
    }
    
    .custom-table tbody tr:hover {
        transform: translateY(-2px);
        background-color: rgba(0, 179, 94, 0.04) !important;
    }
    
    .custom-table tbody td {
        padding: 16px;
        border-top: 1px solid var(--border-color) !important;
        border-bottom: 1px solid var(--border-color) !important;
        color: white;
        text-align: center;
        background: black;
    }
    
    /* حواف دائرية لصفوف الجدول */
    .custom-table tbody tr td:first-child {
        border-left: 1px solid var(--border-color) !important;
        border-top-left-radius: var(--radius-md);
        border-bottom-left-radius: var(--radius-md);
    }
    
    .custom-table tbody tr td:last-child {
        border-right: 1px solid var(--border-color) !important;
        border-top-right-radius: var(--radius-md);
        border-bottom-right-radius: var(--radius-md);
    }
    
    /* أزرار العمليات (تعديل / حذف) */
    .btn-action {
        font-size: 0.85rem;
        padding: 6px 14px;
        border-radius: var(--radius-md);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: var(--transition);
        font-weight: 500;
        border: 1px solid transparent;
        text-decoration: none;
    }
    
    .btn-edit {
        background-color: transparent;
        color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    .btn-edit:hover {
        background-color: var(--primary-color);
        color: #ffffff !important;
        box-shadow: 0 4px 12px rgba(0, 179, 94, 0.25);
    }
    
    .btn-delete {
        background-color: transparent;
        color: #ff6b6b;
        border-color: var(--secondary-color);
    }
    
    .btn-delete:hover {
        background-color: var(--secondary-color);
        color: #ffffff !important;
        border-color: var(--secondary-color);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
    }
    
 
    .btn-primary-custom {
        background-color: var(--primary-color);
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        border-radius: var(--radius-md);
        transition: var(--transition);
        font-weight: 500;
        cursor: pointer;
    }
    
    .btn-primary-custom:hover {
        background-color: var(--primary-hover);
        color: #0f172a; 
        box-shadow: 0 4px 14px rgba(0, 255, 135, 0.4);
    }
</style>
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
    <div class="page-header mb-4">
        <h1 class="page-title">Add New Brand</h1>
    </div>

    <div class="card custom-card mb-5">
        <form method="POST" action="{{ route('brands.store') }}">
            @csrf

            <div class="form-group mb-4">
                <label class="form-label fw-bold mb-2">Brand Name</label>
                <input type="text"
                       class="form-control custom-input"
                       placeholder="Enter brand name"
                       name="name"
                       required>
            </div>

            <div class="form-group mb-4">
                <label class="form-label">Status</label>
                <div style="display:flex; gap:1rem;">
                    <label>
                        <input type="radio" name="is_active" value="1" checked>
                        Active
                    </label>

                    <label>
                        <input type="radio" name="is_active" value="0">
                        Inactive
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary-custom">
                Add Brand
            </button>

        </form>
        
    </div>

    <div class="page-header mb-3">
        <h2 class="table-title h4">Brands List</h2>
    </div>
    
    <div class="table-responsive w-100">
        <table class="table custom-table align-middle w-100 m-0">
            <thead>
                <tr>
                    <th scope="col" style="width: 80px;">#</th>
                    <th scope="col">Name</th>
    
                    <th scope="col">Status</th>
                    <th scope="col" class="text-center" style="width: 220px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($brands as $brand)
                <tr>
                    <td>{{ $brand->id }}</td>
                    <td>{{ $brand->name }}</td>
                    <td>
                        @if($brand->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <a href="#" class="btn-action btn-edit">Edit</a>
                        <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                        
                            <button type="submit" class="btn-action btn-delete"
                                onclick="return confirm('Are you sure you want to delete this brand?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

