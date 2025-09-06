<!DOCTYPE html>
<html lang="en">

<head>
    <title>Laravel Web eCommerce - Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="{{ asset('home/assets/img/apple-icon.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('home/assets/img/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('home/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('home/assets/css/templatemo.css') }}">
    <link rel="stylesheet" href="{{ asset('home/assets/css/custom.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="{{ asset('home/assets/css/fontawesome.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <!-- Start Top Nav -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none"
                        href="mailto:info@company.com">info@company.com</a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel:010-020-0340">010-020-0340</a>
                </div>
                <div>
                    <a class="text-light" href="https://fb.com/templatemo" target="_blank" rel="sponsored"><i
                            class="fab fa-facebook-f fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.instagram.com/" target="_blank"><i
                            class="fab fa-instagram fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://twitter.com/" target="_blank"><i
                            class="fab fa-twitter fa-sm fa-fw me-2"></i></a>
                    <a class="text-light" href="https://www.linkedin.com/" target="_blank"><i
                            class="fab fa-linkedin fa-sm fa-fw"></i></a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Top Nav -->
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
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about') }}">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('shop') }}">Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact') }}">Contact</a>
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
                            <a class="nav-icon position-relative text-decoration-none dropdown-toggle" href="#"
                                role="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
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

                                <li><a class="dropdown-item" href="{{ route('profile.show') }}"><i
                                            class="fa fa-id-card"></i> Thông tin tài khoản</a></li>
                                <li><a class="dropdown-item" href="{{ route('orders.index') }}"><i
                                            class="fa fa-shopping-bag"></i> Đơn hàng của tôi</a></li>
                                <li><a class="dropdown-item" href="{{ route('wishlist.index') }}"><i
                                            class="fa fa-heart"></i> Danh sách yêu thích</a></li>
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
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fa fa-shopping-cart me-2"></i> Giỏ hàng của bạn</h5>
                </div>

                @if($cartItems->isEmpty())
                    <div class="card-body">
                        <p class="text-muted text-center">Giỏ hàng của bạn đang trống.</p>
                    </div>
                @else
                    <form method="POST" action="{{ route('checkout') }}" id="cart-form">
                        @csrf
                        <div class="card-body p-0">
                            <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                                <table class="table table-bordered align-middle text-center mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th><input type="checkbox" id="select-all"></th>
                                            <th>Ảnh</th>
                                            <th>Sản phẩm</th>
                                            <th>Size</th>
                                            <th>Số lượng</th>
                                            <th>Tổng</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cartItems as $cart)
                                            @if($cart->product)
                                                @php
                                                    $product = $cart->product;
                                                    $subtotal = $product->price * $cart->quantity;
                                                    $categorySlug = $product->category->slug ?? null;
                                                    $sizes = in_array($categorySlug, ['quan', 'ao']) ? ['S', 'M', 'L', 'XL'] : (in_array($categorySlug, ['giay', 'dep']) ? range(35, 47) : []);
                                                @endphp
                                                <tr data-cart-id="{{ $cart->id }}">
                                                    <td>
                                                        <input type="checkbox" name="selected[]" value="{{ $cart->id }}"
                                                            class="cart-checkbox" data-price="{{ $subtotal }}">
                                                    </td>
                                                    <td><img src="{{ asset($product->image) }}" width="60" class="rounded"></td>
                                                    <td>{{ $product->name }}</td>
                                                    <td>
                                                        <select class="form-select form-select-sm size-select"
                                                            data-id="{{ $cart->id }}">
                                                            @foreach($sizes as $size)
                                                                <option value="{{ $size }}" {{ $cart->size == $size ? 'selected' : '' }}>
                                                                    {{ $size }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <button type="button" class="btn btn-sm btn-success me-2 btn-decrease"
                                                                data-id="{{ $cart->id }}">-</button>
                                                            <span
                                                                class="badge bg-secondary px-3 quantity-display">{{ $cart->quantity }}</span>
                                                            <button type="button" class="btn btn-sm btn-success ms-2 btn-increase"
                                                                data-id="{{ $cart->id }}">+</button>
                                                        </div>
                                                    </td>
                                                    <td class="fw-bold subtotal">{{ number_format($subtotal) }} VNĐ</td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-danger btn-remove-item"
                                                            data-id="{{ $cart->id }}">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td colspan="7" class="text-danger">Sản phẩm đã bị xóa khỏi hệ thống</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="mt-3 text-end">
                            <h5>Tổng tiền đã chọn: <span id="selected-total" class="text-success">0 VNĐ</span></h5>
                            <form action="{{ route('checkout') }}" method="GET">
                                @foreach($cartItems as $item)
                                    <input type="checkbox" name="selected[]" value="{{ $item->id }}" checked hidden>
                                @endforeach
                                <div class="mb-2">
                                    <label for="payment-method" class="form-label">Chọn phương thức thanh toán:</label>
                                    <select name="payment_method" id="payment-method"
                                        class="form-select w-auto d-inline-block">
                                        <option value="momo">Momo</option>
                                        <option value="vnpay">VNPay</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-success mt-2">
                                    <i class="fa fa-credit-card"></i> Thanh toán
                                </button>
                            </form>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <!-- Start Footer -->
    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row">

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3 border-light logo">Zay Shop</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>
                            <i class="fas fa-map-marker-alt fa-fw"></i>
                            123 Consectetur at ligula 10660
                        </li>
                        <li>
                            <i class="fa fa-phone fa-fw"></i>
                            <a class="text-decoration-none" href="tel:010-020-0340">010-020-0340</a>
                        </li>
                        <li>
                            <i class="fa fa-envelope fa-fw"></i>
                            <a class="text-decoration-none" href="mailto:info@company.com">info@company.com</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Products</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="#">Luxury</a></li>
                        <li><a class="text-decoration-none" href="#">Sport Wear</a></li>
                        <li><a class="text-decoration-none" href="#">Men's Shoes</a></li>
                        <li><a class="text-decoration-none" href="#">Women's Shoes</a></li>
                        <li><a class="text-decoration-none" href="#">Popular Dress</a></li>
                        <li><a class="text-decoration-none" href="#">Gym Accessories</a></li>
                        <li><a class="text-decoration-none" href="#">Sport Shoes</a></li>
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Further Info</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="#">Home</a></li>
                        <li><a class="text-decoration-none" href="#">About Us</a></li>
                        <li><a class="text-decoration-none" href="#">Shop Locations</a></li>
                        <li><a class="text-decoration-none" href="#">FAQs</a></li>
                        <li><a class="text-decoration-none" href="#">Contact</a></li>
                    </ul>
                </div>

            </div>

            <div class="row text-light mb-4">
                <div class="col-12 mb-3">
                    <div class="w-100 my-3 border-top border-light"></div>
                </div>
                <div class="col-auto me-auto">
                    <ul class="list-inline text-left footer-icons">
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/"><i
                                    class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank"
                                href="https://www.instagram.com/"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/"><i
                                    class="fab fa-twitter fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank"
                                href="https://www.linkedin.com/"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-auto">
                    <label class="sr-only" for="subscribeEmail">Email address</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control bg-dark border-light" id="subscribeEmail"
                            placeholder="Email address">
                        <div class="input-group-text btn-success text-light">Subscribe</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-100 bg-black py-3">
            <div class="container">
                <div class="row pt-2">
                    <div class="col-12">
                        <p class="text-left text-light">
                            Copyright &copy; 2021 Company Name
                            | Designed by <a rel="sponsored" href="https://templatemo.com"
                                target="_blank">TemplateMo</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->
    <!-- Start Script -->
    <script src="{{ asset('home/assets/js/jquery-1.11.0.min.js') }}"></script>
    <script src="{{ asset('home/assets/js/jquery-migrate-1.2.1.min.js') }}"></script>
    <script src="{{ asset('home/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('home/assets/js/custom.js') }}"></script>
    <script src="{{ asset('home/assets/js/templatemo.js') }}"></script>
    <script src="{{ asset('home/assets/js/sort.js') }}"></script>
    <script src="{{ asset('home/assets/js/cartAJAX.js') }}"></script>
</body>

</html>