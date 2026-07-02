<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('asset/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset_dash/css/style.css')}}">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="brand">
                    <i class="fas fa-bolt"></i> AdminPanel
                </div>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-item">
                    <a href="{{route('admin')}}" class="menu-link">
                        <i class="fas fa-chart-pie"></i> <span>Dashboard</span>
                    </a>
                </li>
             
                <li class="menu-item">
                    <a href="{{route('admin.post')}}" class="menu-link">
                        <i class="fas fa-plus-circle"></i> <span>Add Product</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('admin.category')}}" class="menu-link">
                        <i class="fas fa-folder-plus"></i> <span>Add Category</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('brands.index')}}" class="menu-link">
                        <i class="fas fa-trademark"></i> <span>Add Brand</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('show.post')}}" class="menu-link">
                        <i class="fas fa-table"></i> <span>Show Products</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('admin.showcategory')}}" class="menu-link">
                        <i class="fas fa-list-ul"></i> <span>Show Category</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="add-user.html" class="menu-link">
                        <i class="fas fa-user-plus"></i> <span>Add User</span>
                    </a>
                </li>
              

                <li class="menu-item">
                    <a href="{{route('dash.orders.index')}}" class="menu-link">
                        <i class="fas fa-shopping-cart"></i> <span>Order</span>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('settings.edit')}}" class="menu-link">
                        <i class="fas fa-sliders-h"></i> <span>Settings</span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Navbar -->
            <nav class="top-navbar">
                <button class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="nav-actions">
                    <button id="theme-toggle" class="theme-toggle">
                        <i class="fas fa-moon"></i>
                    </button>
                    <a href="{{route("notification")}}" class="theme-toggle"
                        style="position: relative; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-bell"></i>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                        <span style="position: absolute; top: 0; right: 0; width: 8px; height: 8px; background-color: #ef4444; border-radius: 50%;"></span>
                    @endif
                    </a>
                    <a href="{{ route('profile.edit') }}" class="user-profile">
                        <div class="avatar">A</div>
                        <span>Admin</span>
                        <i class="fas fa-chevron-down" style="font-size: 0.8rem;"></i>
                    </a>
                  
                    <a href="{{ route('index') }}" class="user-profile  bg-success rounded p-2">
                        GO to Web
                    </a>
                  
                </div>
            </nav>

            @yield('content')

            <script src="{{asset('asset_dash/js/app.js')}}"></script>
        </body>
        
        </html>