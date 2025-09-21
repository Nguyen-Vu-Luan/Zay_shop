<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            min-height: 100vh;
            display: flex;
        }

        .sidebar {
            width: 250px;
            background: #343a40;
            color: white;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px 15px;
        }

        .sidebar a:hover {
            background: #495057;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
        }
    </style>
</head>

<body>
    {{-- Sidebar --}}
    <div class="sidebar">
        <h4 class="p-3">Admin Panel</h4>
        <a href="{{ route('admin.dashboard') }}"><i class="fa fa-tachometer-alt me-2"></i> Dashboard</a>
        <a href="{{ route('admin.users') }}"><i class="fa fa-users me-2"></i> Người dùng</a>
        <a href="{{ route('admin.products') }}"><i class="fa fa-box me-2"></i> Sản phẩm</a>
        <a href="{{ route('admin.orders') }}"><i class="fa fa-shopping-cart me-2"></i> Đơn hàng</a>
        <a href="{{ url('/') }}"><i class="fa fa-home me-2"></i> Về trang chủ</a>
        <form action="{{ route('logout') }}" method="POST" class="p-3">
            @csrf
            <button type="submit" class="btn btn-danger w-100">Đăng xuất</button>
        </form>
    </div>

    {{-- Content --}}
    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>