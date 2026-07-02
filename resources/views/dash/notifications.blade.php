@extends('dash.master_dash')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .notifications-list {
            display: flex;
            flex-direction: column;
            gap: 0;
        }
        .notification-item {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            transition: var(--transition);
            position: relative;
        }
        /* تأثير عند مرور الماوس */
        .notification-item:hover {
            background-color: rgba(0, 255, 135, 0.02);
        }
        /* الأيقونة الدائرية للطلب الجديد */
        .icon-wrapper-order {
            width: 40px;
            height: 40px;
            background-color: rgba(0, 255, 135, 0.1);
            color: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border: 1px solid rgba(0, 255, 135, 0.2);
            box-shadow: 0 0 10px rgba(0, 255, 135, 0.05);
        }
        /* زر الحذف النيون المخصص */
        .btn-delete-notification {
            background: transparent;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 50%;
            transition: var(--transition);
            align-self: center;
        }
        .btn-delete-notification:hover {
            color: #dc3545;
            background-color: rgba(220, 53, 69, 0.1);
            box-shadow: 0 0 8px rgba(220, 53, 69, 0.2);
        }
        /* زر حذف الكل المخصص */
        .btn-delete-all {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.2);
            padding: 0.5rem 1rem;
            border-radius: var(--radius-md);
            font-size: 0.875rem;
            font-weight: 500;
            transition: var(--transition);
        }
        .btn-delete-all:hover {
            background-color: #dc3545;
            color: #fff;
            box-shadow: 0 0 12px rgba(220, 53, 69, 0.3);
        }
        /* أنيميشن عند دخول إشعار جديد */
        @keyframes slideInNotification {
            from { opacity: 0; transform: translateY(-10px); background-color: rgba(0, 255, 135, 0.05); }
            to { opacity: 1; transform: translateY(0); background-color: transparent; }
        }
        /* أنيميشن التلاشي عند الحذف لجميع العناصر */
        .fade-out {
            opacity: 0 !important;
            transform: translateX(30px);
            transition: all 0.4s ease;
        }
    </style>

    <div class="content-wrapper">
        <div class="page-header mb-4 d-flex justify-content-between align-items-center">
            <h1 class="page-title fw-bold" style="color: var(--text-color); margin-bottom: 0;">Notifications</h1>
            
            @if(auth()->user()->notifications->count() > 0)
                <button class="btn-delete-all" id="deleteAllBtn" onclick="deleteAllNotifications()">
                    <i class="fas fa-trash-sweep me-1"></i> Delete All
                </button>
            @endif
        </div>

        <div class="card table-card">
            <div class="notifications-list" id="notificationsContainer">
                
                @forelse(auth()->user()->notifications as $notification)
                    <div class="notification-item d-flex justify-content-between align-items-center" id="notification-{{ $notification->id }}" @if($notification->read_at) style="opacity: 0.6;" @endif>
                        <div class="d-flex align-items-start gap-3">
                            <div class="icon-wrapper-order">
                                <i class="fas fa-shopping-basket"></i>
                            </div>
                            <div>
                                <h4 style="font-size: 1rem; margin-bottom: 0.25rem; color: var(--text-color);" class="fw-bold">
                                    New Order #{{ $notification->data['order_id'] ?? '' }}
                                </h4>
                                <p style="color: var(--text-muted); font-size: 0.875rem; margin-bottom: 0.25rem;">
                                    {{ $notification->data['message'] ?? '' }}
                                </p>
                                <span style="font-size: 0.75rem; color: var(--text-muted); display: block;">
                                    {{ $notification->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                        
                        <button class="btn-delete-notification" onclick="deleteNotification('{{ $notification->id }}')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                @empty
                    <div id="noNotificationsPlaceholder" class="text-center py-5" style="color: var(--text-muted);">
                        <i class="bi bi-bell-slash display-4 d-block mb-3" style="color: var(--border-color);"></i>
                        No notifications found.
                    </div>
                @endforelse

            </div>
        </div>
    </div>

    <script>
        const adminId = "{{ auth()->id() }}"; 

        if (adminId) {
            // 1. الاستماع الحي للإشعارات (Real-time)
            Echo.private(`App.Models.User.${adminId}`)
                .notification((notification) => {
                    console.log('طلب جديد وصل فوراً:', notification);
                    
                    let audio = new Audio('https://assets.mixkit.co/active_storage/sfx/2869/2869-600.wav');
                    audio.play();

                    // التنبيه السفلي المتنقل (Toast)
                    let notificationHtml = `
                        <div class="alert alert-dismissible fade show shadow-lg position-fixed bottom-0 end-0 m-4 text-white" 
                             role="alert" 
                             style="background-color: #141414; border: 1px solid var(--primary-color); border-radius: var(--radius-lg); z-index: 9999; max-width: 350px;">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-lightning-charge-fill" style="color: var(--primary-color); font-size: 1.2rem;"></i>
                                <div>
                                    <strong style="color: var(--primary-color);">New Order Received!</strong>
                                    <p class="mb-0 small text-secondary">${notification.message}</p>
                                </div>
                            </div>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `;
                    document.body.insertAdjacentHTML('beforeend', notificationHtml);

                    // حقن العنصر الجديد داخل صفحة الإشعارات
                    let container = document.getElementById('notificationsContainer');
                    let placeholder = document.getElementById('noNotificationsPlaceholder');
                    
                    if (container) {
                        if (placeholder) placeholder.remove();

                        // إظهار زر Delete All في حال ظهر إشعار جديد لايف وكانت الصفحة فارغة
                        if (!document.getElementById('deleteAllBtn')) {
                            let header = document.querySelector('.page-header');
                            header.insertAdjacentHTML('beforeend', `
                                <button class="btn-delete-all" id="deleteAllBtn" onclick="deleteAllNotifications()">
                                    <i class="fas fa-trash-sweep me-1"></i> Delete All
                                </button>
                            `);
                        }

                        let newNotificationItem = `
                            <div class="notification-item d-flex justify-content-between align-items-center" id="notification-${notification.id}" style="animation: slideInNotification 0.8s ease forwards;">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="icon-wrapper-order">
                                        <i class="fas fa-shopping-basket"></i>
                                    </div>
                                    <div>
                                        <h4 style="font-size: 1rem; margin-bottom: 0.25rem; color: var(--text-color);" class="fw-bold">
                                            New Order #${notification.order_id}
                                        </h4>
                                        <p style="color: var(--text-muted); font-size: 0.875rem; margin-bottom: 0.25rem;">
                                            ${notification.message}
                                        </p>
                                        <span style="font-size: 0.75rem; color: var(--primary-color); display: block;">
                                            Just Now
                                        </span>
                                    </div>
                                </div>
                                <button class="btn-delete-notification" onclick="deleteNotification('${notification.id}')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        `;
                        container.insertAdjacentHTML('afterbegin', newNotificationItem);
                    }
                });
        }

        // 2. دالة حذف إشعار واحد
        function deleteNotification(notificationId) {
            if(!confirm('Are you sure you want to delete this notification?')) return;

            let element = document.getElementById(`notification-${notificationId}`);
            
            fetch(`/admin/notifications/${notificationId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    element.classList.add('fade-out');
                    setTimeout(() => {
                        element.remove();
                        checkEmptyContainer();
                    }, 400);
                }
            });
        }

        // 3. دالة حذف جميع الإشعارات لايف دفعة واحدة المضافة حديثاً
        function deleteAllNotifications() {
            if(!confirm('Are you sure you want to delete ALL notifications?')) return;

            fetch(`/admin/notifications/delete-all`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    let items = document.querySelectorAll('.notification-item');
                    
                    // تطبيق تأثير التلاشي على جميع الإشعارات تدريجياً
                    items.forEach((item) => {
                        item.classList.add('fade-out');
                    });

                    setTimeout(() => {
                        items.forEach(item => item.remove());
                        checkEmptyContainer();
                    }, 400);
                }
            });
        }

        // دالة فحص ومراقبة القائمة لعرض الحالة الافتراضية وإخفاء زر حذف الكل
        function checkEmptyContainer() {
            let container = document.getElementById('notificationsContainer');
            if (container && container.querySelectorAll('.notification-item').length === 0) {
                container.innerHTML = `
                    <div id="noNotificationsPlaceholder" class="text-center py-5" style="color: var(--text-muted);">
                        <i class="bi bi-bell-slash display-4 d-block mb-3" style="color: var(--border-color);"></i>
                        No notifications found.
                    </div>
                `;
                let deleteBtn = document.getElementById('deleteAllBtn');
                if(deleteBtn) deleteBtn.remove();
            }
        }
    </script>
@endsection