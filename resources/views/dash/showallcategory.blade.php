@extends('dash.master_dash')

@section('content')
<div class="container-fluid px-0 py-4 w-100">
    <div class="custom-card w-100">
        <div class="card-header-custom d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4 px-3">
            <h3 class="mb-0 fw-bold table-title">Data Management</h3>
            
            <div class="d-flex align-items-center gap-2 flex-grow-1 flex-sm-grow-0 justify-content-end">
                <div class="search-form m-0" style="margin-top: 10px">
                    <div class="input-group search-input-group">
                        <span class="input-group-text search-icon-wrapper">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" id="tableSearch" class="form-control form-control-sm search-input" 
                               placeholder="Search by name..." >
                        <button class="btn-clear-search" type="button" id="clearSearch" style="display: none;">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>

                <a href="{{ route('admin.category') }}" class="btn btn-primary-custom btn-sm text-nowrap" style="margin-top: 15px">
                    <i class="fas fa-plus me-1"></i> Add New
                </a>
            </div>
        </div>

        <div class="table-responsive w-100">
            <table class="table custom-table align-middle w-100 m-0" id="categoryTable">
                <thead>
                    <tr>
                        <th scope="col" style="width: 80px;">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">img</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center" style="width: 220px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getcategory as $index => $item)
                    <tr class="category-row">
                        <td>{{ $index + 1 }}</td>
                    
                        <td class="fw-semibold text-dark category-name">{{ $item->name }}</td>
                    
                        {{-- Image --}}
                        <td>
                            <img src="{{ asset('storage/' . $item->file) }}" width="60" height="60" style="border-radius: 8px;"     loading="lazy">
                        </td>
                    
                        {{-- Status --}}
                        <td>
                            @if($item->is_active)
                                <span class="badge bg-success-subtle text-success border border-success-subtle">
                                    Active
                                </span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">
                                    Suspended
                                </span>
                            @endif
                        </td>
                    
                        {{-- Actions --}}
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{route('admin.category.edit',$item->id) }}" class="btn btn-action btn-edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                    
                                <form action="{{ route('delete.category',$item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                
                                    <button type="submit" class="btn btn-action btn-delete"
                                        onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    
                    <tr id="noResultsRow" style="display: none;">
                        <td colspan="5" class="text-center py-4 text-muted">No matching data found.</td>
                    </tr>

                    @if($getcategory->isEmpty())
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">No data found.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('tableSearch');
    const clearBtn = document.getElementById('clearSearch');
    const rows = document.querySelectorAll('.category-row');
    const noResultsRow = document.getElementById('noResultsRow');

    searchInput.addEventListener('input', function () {
        const query = this.value.toLowerCase().trim();
        let hasResults = false;

        // إظهار/إخفاء زر الحذف (X) بناءً على وجود نص
        clearBtn.style.display = query.length > 0 ? 'block' : 'none';

        rows.forEach(row => {
            const nameText = row.querySelector('.category-name').textContent.toLowerCase();
            
            if (nameText.includes(query)) {
                row.style.display = ''; 
                hasResults = true;
            } else {
                row.style.display = 'none'; 
            }
        });

        if (!hasResults && query.length > 0) {
            noResultsRow.style.display = '';
        } else {
            noResultsRow.style.display = 'none';
        }
    });

    clearBtn.addEventListener('click', function () {
        searchInput.value = '';
        searchInput.dispatchEvent(new Event('input'));
        searchInput.focus();
    });
});
</script>

<style>
    body {
        background-color: var(--bg-color);
        color: var(--text-color);
    }

    .custom-card {
        background-color: var(--card-bg);
        border-top: 1px solid var(--border-color);
        border-bottom: 1px solid var(--border-color);
        border-left: none;
        border-right: none;
        border-radius: 0px; 
        padding: 1.5rem 1rem;
        box-shadow: var(--shadow-md);
        width: 100% !important; 
    }

    .table-title {
        color: var(--text-color);
        letter-spacing: 0.5px;
    }

    /* تنسيقات حقل البحث الحديثة */
    .search-form {
        max-width: 280px;
        width: 100%;
    }

    .search-input-group {
        position: relative;
        display: flex;
        align-items: center;
        background-color: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md) !important;
        transition: var(--transition);
    }

    .search-input-group:focus-within {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(0, 179, 94, 0.15);
    }

    .search-icon-wrapper {
        background: transparent !important;
        border: none !important;
        color: var(--text-muted);
        padding-left: 12px;
        padding-right: 4px;
    }

    .search-input {
        background: transparent !important;
        border: none !important;
        color: var(--text-color) !important;
        padding-left: 6px;
    }

    .search-input:focus {
        box-shadow: none !important;
    }

    .btn-clear-search {
        background: transparent;
        border: none;
        color: #ef4444;
        padding-right: 12px;
        padding-left: 8px;
        cursor: pointer;
        transition: color 0.2s ease;
    }

    .btn-clear-search:hover {
        color: #b91c1c;
    }

    .custom-table {
        border-collapse: separate;
        border-spacing: 0 8px;
        width: 100% !important;
    }

    .custom-table thead th {
        background-color: #090909;
        color: var(--text-muted);
        border-bottom: none;
        padding: 14px 16px;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .custom-table tbody tr {
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        text-align: center;
    }

    .custom-table tbody tr:hover {
        transform: translateY(-2px);
        background-color: rgba(0, 179, 94, 0.02);
    }

    .custom-table tbody td {
        padding: 16px;
        border-top: 1px solid var(--border-color);
        border-bottom: 1px solid var(--border-color);
        color: var(--text-color);
    }

    .custom-table tbody tr td:first-child {
        border-left: 1px solid var(--border-color);
        border-top-left-radius: var(--radius-md);
        border-bottom-left-radius: var(--radius-md);
    }

    .custom-table tbody tr td:last-child {
        border-right: 1px solid var(--border-color);
        border-top-right-radius: var(--radius-md);
        border-bottom-right-radius: var(--radius-md);
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

    .btn-edit {
        background-color: transparent;
        color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-edit:hover {
        background-color: var(--primary-color);
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(0, 179, 94, 0.25);
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
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
    }

    .btn-primary-custom {
        background-color: var(--primary-color);
        color: #ffffff;
        border: none;
        padding: 8px 18px;
        border-radius: var(--radius-md);
        transition: var(--transition);
        font-weight: 500;
    }

    .btn-primary-custom:hover {
        background-color: var(--primary-hover);
        color: #0f172a; 
        box-shadow: 0 4px 14px rgba(0, 255, 135, 0.4);
    }
</style>
@endsection