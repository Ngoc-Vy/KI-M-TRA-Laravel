<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Trang Sức</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-gold: #D4AF37;
            --dark-bg: #1a1a1a;
            --sidebar-bg: #2d2d2d;
            --text-color: #333;
            --light-bg: #f4f6f9;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background: var(--light-bg); display: flex; min-height: 100vh; }
        
        /* Sidebar */
        .sidebar {
            width: 250px;
            background: var(--sidebar-bg);
            color: #fff;
            display: flex;
            flex-direction: column;
        }
        .sidebar-header {
            padding: 20px;
            text-align: center;
            background: var(--dark-bg);
            border-bottom: 2px solid var(--primary-gold);
        }
        .sidebar-header h2 { color: var(--primary-gold); }
        .nav-list { list-style: none; padding: 20px 0; }
        .nav-item a {
            display: flex;
            align-items: center;
            padding: 15px 25px;
            color: #ccc;
            text-decoration: none;
            transition: 0.3s;
        }
        .nav-item a:hover, .nav-item.active a {
            background: var(--primary-gold);
            color: #fff;
        }
        .nav-item i { width: 25px; }
        
        /* Main Content */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .topbar {
            height: 60px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .content {
            padding: 30px;
            flex: 1;
            overflow-y: auto;
        }
        
        /* Components */
        .card { background: #fff; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); padding: 20px; margin-bottom: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #eee; }
        .table th { background: #f8f9fa; font-weight: 600; color: #555; }
        .btn { padding: 8px 15px; border-radius: 4px; border: none; cursor: pointer; text-decoration: none; color: #fff; display: inline-block; font-size: 14px;}
        .btn-gold { background: var(--primary-gold); }
        .btn-danger { background: #dc3545; }
        .btn-primary { background: #0d6efd; }
        .badge { padding: 5px 10px; border-radius: 20px; font-size: 12px; font-weight: 600; color: #fff;}
        .badge-success { background: #198754; }
        .badge-warning { background: #ffc107; color: #000; }
        .badge-danger { background: #dc3545; }
        .badge-primary { background: #0d6efd; }

        /* Tabs */
        .tabs { display: flex; border-bottom: 1px solid #ddd; margin-bottom: 20px; }
        .tab-link { padding: 10px 20px; text-decoration: none; color: #555; border-bottom: 3px solid transparent; }
        .tab-link.active { border-color: var(--primary-gold); color: var(--primary-gold); font-weight: 600; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>JEWELRY ADMIN</h2>
        </div>
        <ul class="nav-list">
            <li class="nav-item {{ request()->routeIs('trangsuc.admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('trangsuc.admin.dashboard') }}"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
            </li>
            <li class="nav-item {{ request()->routeIs('trangsuc.admin.users*') ? 'active' : '' }}">
                <a href="{{ route('trangsuc.admin.users') }}"><i class="fa-solid fa-users"></i> Khách hàng</a>
            </li>
            <li class="nav-item {{ request()->routeIs('trangsuc.admin.categories*') ? 'active' : '' }}">
                <a href="{{ route('trangsuc.admin.categories') }}"><i class="fa-solid fa-list"></i> Loại Sản phẩm</a>
            </li>
            <li class="nav-item {{ request()->routeIs('trangsuc.admin.products*') ? 'active' : '' }}">
                <a href="{{ route('trangsuc.admin.products') }}"><i class="fa-solid fa-gem"></i> Sản phẩm</a>
            </li>
            <li class="nav-item {{ request()->routeIs('trangsuc.admin.orders*') ? 'active' : '' }}">
                <a href="{{ route('trangsuc.admin.orders') }}"><i class="fa-solid fa-cart-shopping"></i> Đơn hàng</a>
            </li>
            <li class="nav-item {{ request()->routeIs('trangsuc.admin.slides*') ? 'active' : '' }}">
                <a href="{{ route('trangsuc.admin.slides') }}"><i class="fa-solid fa-images"></i> Slides</a>
            </li>
            <li class="nav-item {{ request()->routeIs('trangsuc.admin.contacts*') ? 'active' : '' }}">
                <a href="{{ route('trangsuc.admin.contacts') }}"><i class="fa-solid fa-envelope"></i> Liên hệ</a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/trangsuc') }}" target="_blank"><i class="fa-solid fa-globe"></i> Xem Website</a>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <div class="topbar">
            <div>
                <h3>Trang quản trị Trang Sức</h3>
            </div>
            <div>
                <span>Admin</span>
            </div>
        </div>

        <div class="content">
            @if(session('success'))
                <div style="padding: 15px; background: #d1e7dd; color: #0f5132; margin-bottom: 20px; border-radius: 5px;">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</body>
</html>
