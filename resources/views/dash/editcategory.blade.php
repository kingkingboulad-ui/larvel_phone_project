@extends('dash.master_dash')

@section('content')
<div class="container-fluid px-0 py-4 w-100">
    <div class="custom-card w-100 m-auto" style="max-width: 700px;">
        <div class="card-header-custom d-flex justify-content-between align-items-center mb-4 px-3">
            <h5 class="mb-0 fw-bold table-title">Edit Category</h5>
            <a href="{{ route('admin.category') }}" class="btn btn-action btn-delete text-decoration-none">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success mx-3 border-0" style="background-color: rgba(0, 179, 94, 0.1); color: var(--primary-color);">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="px-3">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="Category_Name" class="form-label fw-semibold mb-2" style="color: var(--text-color);">Category Name</label>
                <input type="text" name="Category_Name" id="Category_Name" 
                       class="form-control custom-input @error('Category_Name') is-invalid @enderror" 
                       value="{{ old('Category_Name', $category->name) }}" required>
                @error('Category_Name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="status" class="form-label fw-semibold mb-2" style="color: var(--text-color);">Status</label>
                <select name="status" id="status" class="form-select custom-input @error('status') is-invalid @enderror" required>
                    <option value="active" {{ old('status', $category->is_active ? 'active' : '') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', !$category->is_active ? 'inactive' : '') == 'inactive' ? 'selected' : '' }}>Suspended</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="file" class="form-label fw-semibold mb-2" style="color: var(--text-color);">Category Image</label>
                <input type="file" name="file" id="file" class="form-control custom-input @error('file') is-invalid @enderror" accept="image/*">
                @error('file')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                
                <div class="mt-3 d-flex align-items-center gap-4 p-3 rounded" style="background: rgba(255,255,255,0.02); border: 1px dashed var(--border-color);">
                    <div>
                        <span class="d-block text-muted small mb-1">Current Image:</span>
                        @if($category->file)
                            <img src="{{ asset('storage/' . $category->file) }}" class="rounded shadow-sm" width="80" height="80" style="object-fit: cover;">
                        @else
                            <span class="text-secondary small">No image uploaded</span>
                        @endif
                    </div>
                    
                    <div id="previewContainer" style="display: none;">
                        <span class="d-block text-muted small mb-1">New Preview:</span>
                        <img id="imagePreview" class="rounded shadow-sm border border-success" width="80" height="80" style="object-fit: cover;">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-5">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="fas fa-save me-1"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// كود جافاسكريبت لمعاينة الصورة الجديدة فور اختيارها
document.getElementById('file').addEventListener('change', function(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const output = document.getElementById('imagePreview');
        output.src = reader.result;
        document.getElementById('previewContainer').style.display = 'block';
    };
    if(event.target.files[0]) {
        reader.readAsDataURL(event.target.files[0]);
    }
});
</script>

<style>
    .custom-card {
        background-color: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md); 
        padding: 2rem 1.5rem;
        box-shadow: var(--shadow-md);
    }

    .table-title {
        color: var(--text-color);
        letter-spacing: 0.5px;
    }

    .custom-input {
        background-color: transparent !important;
        border: 1px solid var(--border-color) !important;
        color: var(--text-color) !important;
        padding: 10px 14px;
        border-radius: var(--radius-md) !important;
        transition: var(--transition);
    }

    .custom-input:focus {
        border-color: var(--primary-color) !important;
        box-shadow: 0 0 0 0.25rem rgba(0, 179, 94, 0.15) !important;
    }

    select.custom-input option {
        background-color: var(--card-bg);
        color: var(--text-color);
    }

    .btn-primary-custom {
        background-color: var(--primary-color);
        color: #ffffff;
        border: none;
        padding: 10px 24px;
        border-radius: var(--radius-md);
        transition: var(--transition);
        font-weight: 500;
    }

    .btn-primary-custom:hover {
        background-color: var(--primary-hover);
        color: #0f172a; 
        box-shadow: 0 4px 14px rgba(0, 255, 135, 0.4);
    }

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
    }

    .btn-delete {
        background-color: transparent;
        color: wheat;
        border-color: var(--secondary-color);
    }

    .btn-delete:hover {
        background-color: #ef4444; 
        color: #ffffff;
        border-color: #ef4444;
    }
</style>
@endsection