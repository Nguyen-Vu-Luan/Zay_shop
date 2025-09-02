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
                <div class="card-header bg-danger text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fa fa-heart me-2"></i> Danh sách yêu thích</h5>
                    @if($wishlist->count())
                        <form method="POST" action="{{ route('wishlist.clear') }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-light text-danger">
                                <i class="fa fa-trash"></i> Xóa tất cả
                            </button>
                        </form>
                    @endif
                </div>
                <div class="card-body">
                    @if($wishlist->isEmpty())
                        <p class="text-muted text-center">Bạn chưa có sản phẩm yêu thích nào.</p>
                    @else
                        <div class="row">
                            @foreach($wishlist as $product)
                                <div class="col-md-4 col-sm-6 mb-4">
                                    <div class="card h-100 shadow-sm">
                                        <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                                        <div class="card-body text-center">
                                            <h6 class="card-title">{{ $product->name }}</h6>
                                            <p class="text-success fw-bold">{{ number_format($product->price) }} VNĐ</p>
                                            <div class="d-flex justify-content-center gap-2">
                                                {{-- Thêm vào giỏ --}}
                                                <form method="POST" action="{{ route('cart.add', $product->id) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-primary">
                                                        <i class="fa fa-cart-plus"></i> Thêm vào giỏ
                                                    </button>
                                                </form>

                                                {{-- Xóa khỏi yêu thích --}}
                                                <form method="POST" action="{{ route('wishlist.remove', $product->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            <x-pagination :paginator="$wishlist" />
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
    <!-- End Script -->
</body>

</html>