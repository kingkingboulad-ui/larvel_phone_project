@extends('dash.master_dash')

@section('content')
 <div class="container-fluid px-0 py-4 w-100">
    <div class="custom-card w-100">
        <!-- هيدر الصفحة والبحث المتناسق -->
        <div class="card-header-custom d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4 px-3">
            <h3 class="mb-0 fw-bold table-title">Customer Messages</h3>
            
            <div class="d-flex align-items-center gap-2 flex-grow-1 flex-sm-grow-0 justify-content-end">
                <div class="search-form m-0" style="margin-top: 10px">
                    <div class="input-group search-input-group">
                        <span class="input-group-text search-icon-wrapper">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" id="tableSearch" class="form-control form-control-sm search-input" 
                               placeholder="Search messages..." >
                        <button class="btn-clear-search" type="button" id="clearSearch" style="display: none;">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- الجدول المتناسق والمحاذي عمودياً وأفقياً -->
        <div class="table-responsive w-100">
            <table class="table custom-table align-middle w-100 m-0" id="contactTable">
                <thead>
                    <tr>
                        <th scope="col" style="width: 80px;">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col" style="max-width: 400px;">Message</th>
                        <th scope="col">Date</th>
                        <th scope="col" class="text-center" style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getcontact as $index => $message)
                    <tr class="contact-row">
                        <!-- الرقم التسلسلي -->
                        <td>{{ $index + 1 }}</td>
                    
                        <!-- اسم العميل -->
                        <td class="fw-semibold contact-name">{{ $message->name }}</td>
                    
                        <!-- البريد الإلكتروني -->
                        <td class="contact-email text-muted">{{ $message->email }}</td>
                    
                        <!-- نص الرسالة مع حماية المظهر العام عند الرسائل الطويلة -->
                        <td class="contact-text text-start px-4" style="max-width: 400px; white-space: normal; word-break: break-word;">
                            {{ $message->message }}
                        </td>

                        <!-- تاريخ الإرسال -->
                        <td class="text-muted" style="font-size: 0.9rem;">
                            {{ $message->created_at->format('Y-m-d H:i') }}
                        </td>
                    
                        <!-- زر الحذف الموثوق -->
                        <td class="text-center">
                            <div class="d-flex justify-content-center">
                                <form action="{{ route('delete.contact', $message->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                
                                    <button type="submit" class="btn btn-action btn-delete"
                                            onclick="return confirm('Are you sure you want to delete this message?')">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    
                    <!-- سطر يظهر عند عدم تطابق أي نتيجة في البحث الفوري -->
                    <tr id="noResultsRow" style="display: none;">
                        <td colspan="6" class="text-center py-4 text-muted">No matching messages found.</td>
                    </tr>

                    <!-- سطر يظهر إذا كانت قاعدة البيانات فارغة تماماً من الرسائل -->
                    @if($getcontact->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">No messages received yet.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- السكريبت الخاص بالبحث الفوري المتطور بداخل الجدول -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('tableSearch');
    const clearBtn = document.getElementById('clearSearch');
    const rows = document.querySelectorAll('.contact-row');
    const noResultsRow = document.getElementById('noResultsRow');

    searchInput.addEventListener('input', function () {
        const query = this.value.toLowerCase().trim();
        let hasResults = false;

        // إظهار أو إخفاء زر (X) لمسح حقل البحث
        clearBtn.style.display = query.length > 0 ? 'block' : 'none';

        rows.forEach(row => {
            // البحث يبحث بداخل الاسم، الإيميل، ونص الرسالة معاً لتسهيل الوصول
            const nameText = row.querySelector('.contact-name').textContent.toLowerCase();
            const emailText = row.querySelector('.contact-email').textContent.toLowerCase();
            const msgText = row.querySelector('.contact-text').textContent.toLowerCase();
            
            if (nameText.includes(query) || emailText.includes(query) || msgText.includes(query)) {
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

<!-- الستايل الموحد الفخم للوضع الداكن (Premium Dark Mode) -->
<style>
    :root {
        --table-row-bg: #121212;
        --table-row-hover: #1a1a1a;
    }

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
        border-spacing: 0 10px;
        width: 100% !important;
        background-color: transparent !important;
    }

    .custom-table thead th {
        background-color: transparent !important;
        color: var(--text-muted);
        border: none;
        padding: 12px 16px;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-align: center;
    }

    .custom-table tbody tr {
        background-color: var(--table-row-bg) !important;
        box-shadow: var(--shadow-sm);
        transition: transform 0.2s ease, background-color 0.2s ease, box-shadow 0.2s ease;
    } 

    .custom-table tbody tr:hover {
        transform: translateY(-2px);
        background-color: var(--table-row-hover) !important;
        box-shadow: 0 4px 12px rgba(0, 179, 94, 0.08);
    }

    .custom-table tbody td {
        padding: 14px 16px;
        border-top: 1px solid var(--border-color) !important;
        border-bottom: 1px solid var(--border-color) !important;
        color: var(--text-color) !important;
        vertical-align: middle;
        text-align: center;

        background: black
    }

    .custom-table tbody td.contact-name {
        color: var(--text-color) !important;
    }

    .custom-table tbody tr td:first-child {
        border-left: 1px solid var(--border-color) !important;
        border-top-left-radius: var(--radius-md) !important;
        border-bottom-left-radius: var(--radius-md) !important;
    }

    .custom-table tbody tr td:last-child {
        border-right: 1px solid var(--border-color) !important;
        border-top-right-radius: var(--radius-md) !important;
        border-bottom-right-radius: var(--radius-md) !important;
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
        color: #f87171;
        border-color: rgba(239, 68, 68, 0.5);
    }

    .btn-delete:hover {
        background-color: #ef4444; 
        color: #ffffff !important;
        border-color: #ef4444;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
    }
</style> 


@endsection