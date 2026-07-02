@extends('dash.master_dash')

@section('content')
    <div class="orders-dashboard-wrapper">
        <!-- Modern Fonts & FontAwesome Icons -->
        <link
            href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Cairo:wght@300;400;600;700&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <style>
            /* CSS Variables - Defined by User */
            :root {
                /* الوضع الفاتح (تقني ونظيف بلمسات خضراء) */
                --primary-color: #00b35e;
                /* الأخضر الأساسي */
                --primary-hover: #00ff87;
                /* الأخضر المضيء عند التمرير */
                --secondary-color: #475569;
                /* رمادي متناسق */
                --bg-color: #f8fafc;
                /* خلفية فاتحة مريحة */
                --card-bg: #ffffff;
                /* بطاقات بيضاء ناصعة */
                --text-color: #0f172a;
                /* نصوص داكنة وواضحة */
                --text-muted: #64748b;
                /* نصوص فرعية رمادية */
                --border-color: #e2e8f0;
                /* حواف خفيفة */

                /* الهيكل والقياسات الثابتة */
                --sidebar-width: 260px;
                --header-height: 64px;
                --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
                --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
                --radius-md: 0.5rem;
                --radius-lg: 0.75rem;
                --transition: all 0.3s ease;

                /* عناصر إضافية متناسقة للوضع الفاتح */
                --primary-text: #ffffff;
                /* لون النص فوق الأخضر الأساسي */
                --th-bg: #f8fafc;
                /* خلفية الهيدر للجدول */

                /* ألوان الحالات والبادجات */
                --success-color: #00b35e;
                --success-bg: rgba(0, 179, 94, 0.1);
                --warning-color: #d97706;
                --warning-bg: rgba(217, 119, 6, 0.1);
                --danger-color: #dc2626;
                --danger-bg: rgba(220, 38, 38, 0.1);
                --info-color: #2563eb;
                --info-bg: rgba(37, 99, 235, 0.1);
            }

            /* الوضع الداكن (الأساسي للموقع - الفاخر والمستقبلي) */
            [data-theme="dark"],
            body {
                --bg-color: #0b0b0b;
                /* الأسود الداكن العميق للموقع */
                --card-bg: #141414;
                /* الرمادي الداكن جداً للبطاقات والقوائم */
                --border-color: #222222;
                /* حواف داكنة وأنيقة تمنع التشتت */
                --text-color: #ffffff;
                /* أبيض ناصع للنصوص الأساسية */
                --text-muted: #aaaaaa;
                /* رمادي ناعم للمواصفات والنصوص الفرعية */

                /* الألوان التفاعلية المشعة (Glow Tech) */
                --primary-color: #00ff87;
                /* الأخضر الفوسفوري المضيء (المميز لموقعك) */
                --primary-hover: #00b35e;
                /* أخضر أعمق عند التمرير الضوئي */
                --secondary-color: #1c1c1c;
                /* لون الحاويات الداخلية مثل الصور */

                /* التظليل المخصص للثيم المظلم */
                --shadow-sm: 0 1px 2px 0 rgba(0, 255, 135, 0.02);
                --shadow-md: 0 10px 30px rgba(0, 255, 135, 0.08), 0 2px 4px -2px rgba(0, 0, 0, 0.5);

                /* تعديلات إضافية للوضع الداكن لضمان جمالية خرافية وتناسق عالي */
                --primary-text: #050505;
                /* نص أسود داكن ومقروء بوضوح فوق الأخضر الفسفوري */
                --th-bg: #1a1a1a;

                --success-color: #00ff87;
                --success-bg: rgba(0, 255, 135, 0.1);
                --warning-color: #fbbf24;
                --warning-bg: rgba(251, 191, 36, 0.1);
                --danger-color: #f87171;
                --danger-bg: rgba(248, 113, 113, 0.1);
                --info-color: #60a5fa;
                --info-bg: rgba(96, 165, 250, 0.1);
            }

            /* Scoped styles to ensure clean layout without master template interference */
            .orders-dashboard-wrapper {
                font-family: 'Outfit', 'Cairo', sans-serif;
                background-color: var(--bg-color);
                padding: 24px;
                color: var(--text-color);
                min-height: 100vh;
                transition: var(--transition);
            }

            /* KPI Metric Cards */


            .metric-card {
                background: var(--card-bg);
                border-radius: var(--radius-lg);
                padding: 20px;
                box-shadow: var(--shadow-sm);
                border: 1px solid var(--border-color);
                display: flex;
                align-items: center;
                justify-content: space-between;
                transition: var(--transition);
                position: relative;
                overflow: hidden;
            }

            .metric-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 4px;
                height: 100%;
                background: transparent;
                transition: background 0.3s ease;
            }

            .metric-card:hover {
                transform: translateY(-4px);
                box-shadow: var(--shadow-md);
                border-color: var(--primary-color);
            }

            .metric-card.primary::before {
                background: var(--primary-color);
            }

            .metric-card.warning::before {
                background: var(--warning-color);
            }

            .metric-card.success::before {
                background: var(--success-color);
            }

            .metric-card.danger::before {
                background: var(--danger-color);
            }

            .metric-info h3 {
                font-size: 13px;
                font-weight: 600;
                color: var(--text-muted);
                margin: 0 0 6px 0;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }

            .metric-info .value {
                font-size: 26px;
                font-weight: 700;
                color: var(--text-color);
                margin: 0;
            }

            .metric-icon {
                width: 48px;
                height: 48px;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 20px;
            }

            .metric-card.primary .metric-icon {
                background: rgba(0, 255, 135, 0.1);
                color: var(--primary-color);
            }

            .metric-card.warning .metric-icon {
                background: var(--warning-bg);
                color: var(--warning-color);
            }

            .metric-card.success .metric-icon {
                background: var(--success-bg);
                color: var(--success-color);
            }

            .metric-card.danger .metric-icon {
                background: var(--danger-bg);
                color: var(--danger-color);
            }

            /* Dashboard Main Panel */
            .dashboard-content-box {
                background: var(--card-bg);
                border-radius: var(--radius-lg);
                border: 1px solid var(--border-color);
                box-shadow: var(--shadow-sm);
                padding: 24px;
                transition: var(--transition);
            }

            /* Top Action Controls */
            .controls-header {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                align-items: center;
                gap: 16px;
                margin-bottom: 24px;
            }

            .search-filter-box {
                display: flex;
                align-items: center;
                gap: 12px;
                flex-grow: 1;
                max-width: 500px;
            }

            .search-input-wrapper {
                position: relative;
                flex-grow: 1;
            }

            .search-input-wrapper i {
                position: absolute;
                left: 14px;
                top: 50%;
                transform: translateY(-50%);
                color: var(--text-muted);
                font-size: 15px;
            }

            .search-input {
                width: 100%;
                padding: 10px 14px 10px 40px;
                border-radius: var(--radius-md);
                border: 1px solid var(--border-color);
                background: var(--card-bg);
                color: var(--text-color);
                font-size: 14px;
                outline: none;
                transition: var(--transition);
            }

            .search-input:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 12px rgba(0, 255, 135, 0.15);
            }

            .action-buttons {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .btn-custom {
                padding: 10px 16px;
                border-radius: var(--radius-md);
                font-size: 14px;
                font-weight: 500;
                display: flex;
                align-items: center;
                gap: 8px;
                cursor: pointer;
                transition: var(--transition);
                text-decoration: none;
                border: none;
            }

            .btn-primary-custom {
                background: var(--primary-color);
                color: var(--primary-text) !important;
                font-weight: 600;
            }

            .btn-primary-custom:hover {
                background: var(--primary-hover);
                color: var(--primary-text) !important;
                box-shadow: 0 0 15px rgba(0, 255, 135, 0.25);
            }

            .btn-secondary-custom {
                background: var(--card-bg);
                color: var(--text-color);
                border: 1px solid var(--border-color);
            }

            .btn-secondary-custom:hover {
                background: var(--th-bg);
                color: var(--text-color);
                border-color: var(--primary-color);
            }

            /* Filter Tabs */
            .filter-tabs {
                display: flex;
                gap: 8px;
                border-bottom: 1px solid var(--border-color);
                margin-bottom: 20px;
                overflow-x: auto;
                padding-bottom: 8px;
            }

            .tab-btn {
                background: none;
                border: none;
                padding: 8px 16px;
                font-size: 14px;
                font-weight: 500;
                color: var(--text-muted);
                cursor: pointer;
                position: relative;
                white-space: nowrap;
                transition: var(--transition);
            }

            .tab-btn:hover {
                color: var(--text-color);
            }

            .tab-btn.active {
                color: var(--primary-color);
                font-weight: 600;
            }

            .tab-btn.active::after {
                content: '';
                position: absolute;
                bottom: -9px;
                left: 0;
                width: 100%;
                height: 2px;
                background: var(--primary-color);
            }

            /* Table Design */
            .table-responsive {
                overflow-x: auto;
                border-radius: var(--radius-md);
                border: 1px solid var(--border-color);
            }

            .modern-table {
                width: 100%;
                border-collapse: collapse;
                text-align: left;
            }

            .modern-table th {
                background: var(--th-bg);
                padding: 14px 18px;
                font-size: 12px;
                font-weight: 600;
                color: var(--text-muted);
                text-transform: uppercase;
                letter-spacing: 0.5px;
                border-bottom: 2px solid var(--border-color);
            }

            .modern-table td {
                padding: 16px 18px;
                font-size: 14px;
                border-bottom: 1px solid var(--border-color);
                color: var(--text-color);
            }

            .modern-table tbody tr {
                transition: var(--transition);
            }

            .modern-table tbody tr:hover {
                background: var(--th-bg);
            }

            /* Status & Payment Badges */
            .badge {
                padding: 6px 12px;
                border-radius: 9999px;
                font-size: 12px;
                font-weight: 600;
                display: inline-flex;
                align-items: center;
                gap: 5px;
            }

            .badge-payment {
                background: var(--th-bg);
                color: var(--text-color);
                border: 1px solid var(--border-color);
            }

            .badge-pending {
                background-color: var(--warning-bg);
                color: var(--warning-color);
            }

            .badge-processing {
                background-color: var(--info-bg);
                color: var(--info-color);
            }

            .badge-completed {
                background-color: var(--success-bg);
                color: var(--success-color);
            }

            .badge-cancelled {
                background-color: var(--danger-bg);
                color: var(--danger-color);
            }

            .customer-cell {
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .customer-avatar {
                width: 36px;
                height: 36px;
                border-radius: 50%;
                object-fit: cover;
                background: var(--th-bg);
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 600;
                color: var(--primary-color);
                border: 1px solid var(--border-color);
                font-size: 14px;
            }

            .customer-details {
                display: flex;
                flex-direction: column;
            }

            .customer-name {
                font-weight: 600;
                color: var(--text-color);
            }

            .customer-email {
                font-size: 12px;
                color: var(--text-muted);
            }

            /* Actions buttons */
            .action-icon-btn {
                width: 32px;
                height: 32px;
                border-radius: var(--radius-md);
                display: inline-flex;
                align-items: center;
                justify-content: center;
                color: var(--text-muted);
                border: 1px solid var(--border-color);
                background: var(--card-bg);
                cursor: pointer;
                transition: var(--transition);
                margin-right: 4px;
            }

            .action-icon-btn:hover {
                color: var(--primary-color);
                border-color: var(--primary-color);
                background: var(--th-bg);
                box-shadow: 0 0 8px rgba(0, 255, 135, 0.15);
            }

            .action-icon-btn.delete:hover {
                color: var(--danger-color);
                border-color: var(--danger-color);
                background: var(--danger-bg);
                box-shadow: none;
            }

            /* Pagination Layout */
            .pagination-container {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-top: 24px;
                padding-top: 16px;
                border-top: 1px solid var(--border-color);
            }

            .pagination-info {
                font-size: 14px;
                color: var(--text-muted);
            }

            .pagination-buttons {
                display: flex;
                gap: 6px;
            }

            .pagination-btn {
                padding: 8px 12px;
                border-radius: var(--radius-md);
                border: 1px solid var(--border-color);
                background: var(--card-bg);
                font-size: 13px;
                color: var(--text-color);
                cursor: pointer;
                transition: var(--transition);
            }

            .pagination-btn:hover:not(:disabled) {
                background: var(--th-bg);
                border-color: var(--primary-color);
            }

            .pagination-btn.active {
                background: var(--primary-color);
                color: var(--primary-text);
                border-color: var(--primary-color);
            }

            .pagination-btn:disabled {
                opacity: 0.4;
                cursor: not-allowed;
            }

            /* Modal Popup */
            .modal {
                display: none;
                position: fixed;
                z-index: 1050;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0, 0, 0, 0.7);
                backdrop-filter: blur(6px);
                align-items: center;
                justify-content: center;
            }

            .modal.open {
                display: flex;
                animation: fadeIn 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            }

            .modal-content {
                background-color: var(--card-bg);
                border-radius: var(--radius-lg);
                box-shadow: var(--shadow-md);
                width: 90%;
                max-width: 600px;
                overflow: hidden;
                border: 1px solid var(--border-color);
                transform: scale(0.95);
                transition: var(--transition);
            }

            .modal.open .modal-content {
                transform: scale(1);
            }

            .modal-header {
                padding: 18px 24px;
                background: var(--th-bg);
                border-bottom: 1px solid var(--border-color);
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .modal-title {
                font-size: 18px;
                font-weight: 700;
                color: var(--text-color);
            }

            .close-btn {
                background: none;
                border: none;
                font-size: 20px;
                cursor: pointer;
                color: var(--text-muted);
                transition: var(--transition);
            }

            .close-btn:hover {
                color: var(--text-color);
            }

            .modal-body {
                padding: 24px;
            }

            .modal-footer {
                padding: 16px 24px;
                background: var(--th-bg);
                border-top: 1px solid var(--border-color);
                display: flex;
                justify-content: flex-end;
                gap: 12px;
            }

            .order-detail-row {
                display: flex;
                justify-content: space-between;
                padding: 8px 0;
                border-bottom: 1px dashed var(--border-color);
            }

            .order-detail-row:last-child {
                border-bottom: none;
            }

            .order-detail-label {
                font-weight: 500;
                color: var(--text-muted);
            }

            .order-detail-value {
                font-weight: 600;
                color: var(--text-color);
            }

            .items-list {
                background: var(--th-bg);
                border-radius: var(--radius-md);
                padding: 12px;
                margin-top: 12px;
                border: 1px solid var(--border-color);
            }

            .item-row {
                display: flex;
                justify-content: space-between;
                font-size: 13px;
                padding: 6px 0;
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }

            /* RTL support for Arabic alignment */
            [dir="rtl"] .orders-dashboard-wrapper {
                text-align: right;
            }

            [dir="rtl"] .search-input-wrapper i {
                right: 14px;
                left: auto;
            }

            [dir="rtl"] .search-input {
                padding: 10px 40px 10px 14px;
            }

            [dir="rtl"] .modern-table {
                text-align: right;
            }

            [dir="rtl"] .metric-card::before {
                right: 0;
                left: auto;
            }
        </style>

        <!-- Top KPI Cards / إحصائيات سريعة -->


        <!-- Main Content / جدول الطلبات -->
        <div class="dashboard-content-box">
            <!-- Controls Header -->
            <div class="controls-header">
                <div class="search-filter-box">
                    <div class="search-input-wrapper">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="orderSearch" class="search-input"
                            placeholder="Search orders, customers... / ابحث عن الطلبات أو العملاء...">
                    </div>
                </div>
                
            </div>

            <!-- Filter Status Tabs -->
            <div class="filter-tabs">
                <button class="tab-btn active" onclick="filterStatus('all', this)">All Orders (الكل)</button>
                <button class="tab-btn" onclick="filterStatus('pending', this)">Pending (قيد الانتظار)</button>
                <button class="tab-btn" onclick="filterStatus('processing', this)">Processing (قيد التنفيذ)</button>
                <button class="tab-btn" onclick="filterStatus('completed', this)">Completed (مكتمل)</button>
                <button class="tab-btn" onclick="filterStatus('cancelled', this)">Cancelled (ملغي)</button>
            </div>

            <!-- Orders Table -->
            <div class="table-responsive">
                <table class="modern-table" id="ordersTable">
                    <thead>
                        <tr>
                            <th>Order ID / الرقم</th>
                            <th>Customer / العميل</th>
                            <th>Date / التاريخ</th>
                            <th>Items / المنتجات</th>
                            <th>Total / الإجمالي</th>
                            <th>Image</th>
                            <th>Status / الحالة</th>
                            <th style="width: 120px;">Actions / إجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- 
                        LARAVEL DYNAMIC BINDING NOTE:
                        To render this dynamically from your Laravel Controller, replace the mock rows below with:
                        
                        @forelse($orders as $order)
                        <tr data-status="{{ $order->status }}">
                            <td style="font-weight: 700; color: var(--primary-color);">#ORD-{{ $order->order_number }}</td>
                            <td>
                                <div class="customer-cell">
                                    <div class="customer-avatar">
                                        {{ strtoupper(substr($order->customer_name, 0, 2)) }}
                                    </div>
                                    <div class="customer-details">
                                        <span class="customer-name">{{ $order->customer_name }}</span>
                                        <span class="customer-email">{{ $order->customer_email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                            <td>{{ Str::limit($order->items_summary, 40) }}</td>
                            <td style="font-weight: 600;">${{ number_format($order->total_price, 2) }}</td>
                            <td>
                                <span class="badge badge-payment">
                                    <i class="fa-regular fa-credit-card"></i> {{ $order->payment_method }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-{{ $order->status }}">
                                    @if ($order->status == 'completed')
                                        <i class="fa-solid fa-circle-check"></i> Completed
                                    @elseif($order->status == 'pending')
                                        <i class="fa-solid fa-clock"></i> Pending
                                    @elseif($order->status == 'processing')
                                        <i class="fa-solid fa-spinner fa-spin"></i> Processing
                                    @else
                                        <i class="fa-solid fa-circle-xmark"></i> Cancelled
                                    @endif
                                </span>
                            </td>
                            <td>
                                <button class="action-icon-btn" onclick="viewOrderDetails('{{ $order->order_number }}', '{{ $order->customer_name }}', '{{ $order->created_at->format('M d, Y H:i') }}', '{{ $order->items_detailed }}', '${{ number_format($order->total_price, 2) }}', '{{ $order->payment_method }}', '{{ $order->status }}')">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <a href="{{ route('orders.edit', $order->id) }}" class="action-icon-btn">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this order?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="action-icon-btn delete" type="submit">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 40px; color: var(--text-muted);">
                                <i class="fa-regular fa-folder-open" style="font-size: 32px; display: block; margin-bottom: 12px; color: var(--primary-color);"></i>
                                No orders found / لا توجد طلبات
                            </td>
                        </tr>
                        @endforelse
                    --}}

                        <!-- Mock Row 1 -->

                        @foreach ($orders as $item)
                            <tr data-status="{{ $item->status }}">

                                <td style="font-weight: 700; color: var(--primary-color);">
                                    #ORD-{{ $item->id }}
                                </td>

                                <td>
                                    <div class="customer-cell">
                                        <div class="customer-avatar">
                                            {{ strtoupper(substr($item->user->name ?? 'U', 0, 2)) }}
                                        </div>

                                        <div class="customer-details">
                                            <span class="customer-name">
                                                {{ $item->user->name ?? 'Unknown' }}
                                            </span>

                                            <span class="customer-email">
                                                {{ $item->user->email ?? '-' }}
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    {{ $item->created_at->format('Y-m-d H:i') }}
                                </td>

                                <td>
                                    {{ $item->items->pluck('product.title')->join(', ') }}
                                </td>

                                <td style="font-weight: 600;">
                                    ${{ $item->total_price }}
                                </td>

                                <td>
                                    <span class="badge badge-payment">
                                        <img src="{{ asset('storage/' . optional($item->items->first()->product)->image) }}" alt="" style="width: 50px"     loading="lazy">>
                                    </span>
                                </td>

                                {{-- Status Select Form / قائمة تعديل وتحديث الحالة الفورية --}}
                                <td>
                                    <form action="{{ route('dash.orders.updateStatus', $item->id) }}" method="POST"
                                        class="m-0">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="status-select select-{{ $item->status }}"
                                            onchange="this.form.submit()">
                                            <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>
                                                Pending / قيد الانتظار</option>
                                            <option value="processing"
                                                {{ $item->status == 'processing' ? 'selected' : '' }}>Processing / قيد
                                                التحضير</option>
                                            <option value="delivered" {{ $item->status == 'delivered' ? 'selected' : '' }}>
                                                Delivered / تم التوصيل</option>
                                            <option value="cancelled" {{ $item->status == 'cancelled' ? 'selected' : '' }}>
                                                Cancelled / ملغي</option>
                                        </select>
                                    </form>
                                </td>

                                <td>
                                    <button class="action-icon-btn"
                                        onclick="viewOrderDetails(
                                    '{{ $item->id }}',
                                    '{{ $item->user->name ?? '' }}',
                                    '{{ $item->created_at->format('Y-m-d H:i') }}',
                                    '{{ $item->items->pluck('product.title')->join(', ') }}',
                                    '${{ $item->total_price }}',
                                    'Card',
                                    '{{ $item->status }}'
                                )"
                                        title="View Details">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>

                                   
                                    <form action="{{route('dash.orders.destroy',$item->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="action-icon-btn delete" onclick="deleteOrder('{{ $item->id }}')"
                                            title="Delete Order">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                 
                                </td>

                            </tr>
                        @endforeach


                        <!-- Mock Row 2 -->

                    </tbody>
                </table>
            </div>

            <!-- Table Footer / Pagination -->
            <div class="pagination-container">
                <div class="pagination-info">
                    Showing 1 to 4 of 1,284 entries
                </div>
                <div class="pagination-buttons">
                    <button class="pagination-btn" disabled><i class="fa-solid fa-chevron-left"></i> Previous</button>
                    <button class="pagination-btn active">1</button>
                    <button class="pagination-btn">2</button>
                    <button class="pagination-btn">3</button>
                    <button class="pagination-btn">Next <i class="fa-solid fa-chevron-right"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Detail Modal -->
    <div id="orderDetailsModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalOrderId">Order Details</h5>
                <button class="close-btn" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                <div class="order-detail-row">
                    <span class="order-detail-label">Customer Name / الاسم:</span>
                    <span class="order-detail-value" id="modalCustName"></span>
                </div>
                <div class="order-detail-row">
                    <span class="order-detail-label">Order Date / التاريخ:</span>
                    <span class="order-detail-value" id="modalOrderDate"></span>
                </div>
                <div class="order-detail-row">
                    <span class="order-detail-label">Payment Method / طريقة الدفع:</span>
                    <span class="order-detail-value" id="modalPayment"></span>
                </div>
                <div class="order-detail-row">
                    <span class="order-detail-label">Status / الحالة:</span>
                    <span class="order-detail-value" id="modalStatus"></span>
                </div>
                <div class="order-detail-row" style="flex-direction: column; align-items: flex-start; gap: 8px;">
                    <span class="order-detail-label">Items Purchased / المنتجات:</span>
                    <div class="items-list" id="modalItems" style="width: 100%;"></div>
                </div>
                <div class="order-detail-row"
                    style="margin-top: 16px; border-top: 2px solid var(--border-color); padding-top: 12px;">
                    <span class="order-detail-label" style="font-size: 16px; color: var(--text-color);">Total Price /
                        الإجمالي:</span>
                    <span class="order-detail-value" style="font-size: 18px; color: var(--primary-color);"
                        id="modalTotal"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-custom btn-secondary-custom" onclick="closeModal()">Close / إغلاق</button>
                <button class="btn-custom btn-primary-custom" onclick="printReceipt()"><i class="fa-solid fa-print"></i>
                    Print / طباعة</button>
            </div>
        </div>
    </div>

    <!-- JavaScript for Client-side Search, Filtering, and Modals -->
    <script>
        // Search Box Functionality (filters customer name, email, order ID, items)
        document.getElementById('orderSearch').addEventListener('keyup', function() {
            let filter = this.value.toUpperCase();
            let rows = document.querySelectorAll("#ordersTable tbody tr");

            rows.forEach(row => {
                let text = row.textContent.toUpperCase();
                if (text.indexOf(filter) > -1) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });

        // Tab Filtering Functionality
        function filterStatus(status, btnElement) {
            // Toggle Active Class
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            btnElement.classList.add('active');

            let rows = document.querySelectorAll("#ordersTable tbody tr");
            rows.forEach(row => {
                let rowStatus = row.getAttribute('data-status');
                if (status === 'all' || rowStatus === status) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }

        // Modal Display Functionality
        function viewOrderDetails(id, customerName, date, items, total, payment, status) {
            document.getElementById('modalOrderId').innerText = 'Order #' + id + ' Details';
            document.getElementById('modalCustName').innerText = customerName;
            document.getElementById('modalOrderDate').innerText = date;
            document.getElementById('modalPayment').innerText = payment;
            document.getElementById('modalTotal').innerText = total;

            // Dynamic status badge inside modal
            let statusBadge = '';
            if (status === 'completed') {
                statusBadge =
                    '<span class="badge badge-completed"><i class="fa-solid fa-circle-check"></i> Completed</span>';
            } else if (status === 'pending') {
                statusBadge = '<span class="badge badge-pending"><i class="fa-solid fa-clock"></i> Pending</span>';
            } else if (status === 'processing') {
                statusBadge =
                    '<span class="badge badge-processing"><i class="fa-solid fa-spinner fa-spin"></i> Processing</span>';
            } else {
                statusBadge =
                    '<span class="badge badge-cancelled"><i class="fa-solid fa-circle-xmark"></i> Cancelled</span>';
            }
            document.getElementById('modalStatus').innerHTML = statusBadge;

            // Splitting list items to render nicely
            let itemsHtml = '';
            let itemsArr = items.split(', ');
            itemsArr.forEach(item => {
                itemsHtml +=
                    '<div class="item-row" style="border-bottom: 1px solid var(--border-color); padding: 6px 0;"><span><i class="fa-solid fa-box-open" style="color: var(--text-muted); margin-right: 6px;"></i> ' +
                    item + '</span></div>';
            });
            document.getElementById('modalItems').innerHTML = itemsHtml;

            // Open Modal
            document.getElementById('orderDetailsModal').classList.add('open');
        }

        function closeModal() {
            document.getElementById('orderDetailsModal').classList.remove('open');
        }

        // Close Modal on clicking backdrop
        window.onclick = function(event) {
            let modal = document.getElementById('orderDetailsModal');
            if (event.target == modal) {
                closeModal();
            }
        }

        // Delete Order Trigger
        function deleteOrder(id) {
            if (confirm('Are you sure you want to delete order #' + id + '?')) {
                alert('Order #' + id + ' deleted successfully. (Frontend mockup notification)');
            }
        }

        // Print Receipt
        function printReceipt() {
            alert('Printing receipt...');
        }

        // Export Mockup
        function exportData(type) {
            alert('Exporting data as ' + type.toUpperCase() + '...');
        }
    </script>
@endsection
