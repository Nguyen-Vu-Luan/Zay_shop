<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-light shadow">
    <div class="container d-flex justify-content-between align-items-center">

        <a class="navbar-brand text-success logo h1 align-self-center" href="{{ route('home') }}">
            Zay
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between"
            id="templatemo_main_nav">
            <div class="flex-fill">
                <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shop') }}">Cửa hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Liên hệ</a>
                    </li>
                </ul>
            </div>
            <div class="navbar align-self-center d-flex">
                <form action="{{ route('product.search') }}" method="GET" class="nav-icon position-relative">
                    <div class="input-group">
                        <input type="text" name="key" value="{{ request('key') }}" class="form-control"
                            placeholder="Search...">
                        <button type="submit" class="btn btn-outline-secondary">
                            <i class="fa fa-fw fa-search"></i>
                        </button>
                    </div>
                </form>
                <!-- User icon -->
                @guest
                    <!-- Nếu chưa đăng nhập -->
                    <a class="nav-icon position-relative text-decoration-none" href="{{ route('login') }}">
                        <i class="fa fa-fw fa-user text-dark mr-3"></i> Login
                    </a>
                @else
                    <!-- Nếu đã đăng nhập -->
                    <div class="dropdown d-inline-block">
                        <a class="nav-icon position-relative text-decoration-none dropdown-toggle" href="#" role="button"
                            id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-fw fa-user text-dark mr-3"></i> {{ Auth::user()->name }}
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userMenu">
                            <li class="dropdown-header text-center">
                                <strong>{{ Auth::user()->name }}</strong><br>
                                <small>{{ Auth::user()->email }}</small>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i class="fa fa-id-card"></i>
                                    Thông tin tài khoản</a></li>
                            <li><a class="dropdown-item" href="{{ route('orders.index') }}"><i
                                        class="fa fa-shopping-bag"></i> Đơn hàng của tôi</a></li>
                            <li><a class="dropdown-item" href="{{ route('wishlist.index') }}"><i class="fa fa-heart"></i>
                                    Danh sách yêu thích</a></li>
                            <li><a class="dropdown-item" href="{{ route('cart.index') }}"><i
                                        class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fa fa-sign-out-alt"></i> Đăng xuất
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endguest
            </div>
        </div>

    </div>
</nav>
<!-- Close Header -->