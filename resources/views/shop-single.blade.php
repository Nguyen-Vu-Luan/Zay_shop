<!DOCTYPE html>
<html lang="en">

<head>
    <title>Zay Shop - Product Detail Page</title>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('home/assets/css/slick.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('home/assets/css/slick-theme.css') }}">
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

    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ...">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>



    <!-- Open Content -->
    <section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            {{-- Hình ảnh sản phẩm --}}
            <div class="col-lg-5 mt-5">
                <div class="card mb-3">
                    <img class="card-img img-fluid" src="{{ $product->image }}"
                        alt="{{ $product->name }}" id="product-detail">
                </div>

                {{-- Carousel ảnh phụ --}}
                <div class="row">
                    <div class="col-1 align-self-center">
                        <a href="#multi-item-example" role="button" data-bs-slide="prev">
                            <i class="text-dark fas fa-chevron-left"></i>
                        </a>
                    </div>
                    <div id="multi-item-example" class="col-10 carousel slide carousel-multi-item"
                        data-bs-ride="carousel">
                        <div class="carousel-inner product-links-wap" role="listbox">
                            <div class="carousel-item active">
                                <div class="row">
                                    @foreach($product->images->slice(0, 3) as $img)
                                        <div class="col-4">
                                            <img class="card-img img-fluid" src="{{ $img->url }}"
                                                alt="{{ $product->name }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="row">
                                    @foreach($product->images->slice(3, 3) as $img)
                                        <div class="col-4">
                                            <img class="card-img img-fluid" src="{{ $img->url }}"
                                                alt="{{ $product->name }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-1 align-self-center">
                        <a href="#multi-item-example" role="button" data-bs-slide="next">
                            <i class="text-dark fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Thông tin sản phẩm --}}
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h1 class="h2">{{ $product->name }}</h1>
                        <p class="h3 py-2 text-success">{{ number_format($product->price) }}₫</p>

                        <ul class="list-inline">
                            <li class="list-inline-item"><h6>Thương hiệu:</h6></li>
                            <li class="list-inline-item"><p class="text-muted"><strong>{{ $product->brand }}</strong></p></li>
                        </ul>

                        <ul class="list-inline">
                            <li class="list-inline-item"><h6>Màu sắc:</h6></li>
                            <li class="list-inline-item"><p class="text-muted"><strong>{{ $product->color }}</strong></p></li>
                        </ul>

                        {{-- Form thêm vào giỏ hàng --}}
                        <form method="POST" action="{{ route('cart.add', $product->id) }}" id="add-to-cart-form">
                            @csrf

                            @php
                                $categorySlug = $product->category->slug ?? null;
                                $sizes = in_array($categorySlug, ['quan', 'ao']) ? ['S', 'M', 'L', 'XL'] :
                                         (in_array($categorySlug, ['giay', 'dep']) ? range(37,47) : []);
                            @endphp

                            <input type="hidden" name="size" id="product-size" value="">
                            <input type="hidden" name="quantity" id="product-quantity" value="1">

                            <div class="row">
                                @if($sizes)
                                    <div class="col-auto">
                                        <ul class="list-inline pb-3">
                                            <li class="list-inline-item">Size :</li>
                                            @foreach($sizes as $size)
                                                <li class="list-inline-item">
                                                    <span class="btn btn-outline-danger btn-size"
                                                        onclick="selectSize('{{ $size }}', this)">
                                                        {{ $size }}
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="col-auto">
                                    <ul class="list-inline pb-3">
                                        <li class="list-inline-item text-right">Số lượng</li>
                                        <li class="list-inline-item"><span class="btn btn-success" id="btn-minus">-</span></li>
                                        <li class="list-inline-item"><span class="badge bg-secondary" id="var-value">1</span></li>
                                        <li class="list-inline-item"><span class="btn btn-success" id="btn-plus">+</span></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="row pb-3">
                                <div class="col d-grid">
                                    <button type="submit" class="btn btn-success btn-lg">Thêm vào giỏ</button>
                                </div>
                            </div>
                        </form>

                        {{-- Hiển thị lỗi nếu có --}}
                        @if ($errors->has('size'))
                            <div class="alert alert-danger mt-2">{{ $errors->first('size') }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Close Content -->

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
    <script src="{{ asset('home/assets/js/sort.js') }}"></script>
    <!-- End Script -->

    <script>
    function selectSize(size, el) {
        document.getElementById('product-size').value = size;
        document.querySelectorAll('.btn-size').forEach(btn => btn.classList.remove('active'));
        el.classList.add('active');
    }

    document.getElementById('btn-plus').addEventListener('click', function () {
        let val = parseInt(document.getElementById('var-value').textContent);
        val++;
        document.getElementById('var-value').textContent = val;
        document.getElementById('product-quantity').value = val;
    });

    document.getElementById('btn-minus').addEventListener('click', function () {
        let val = parseInt(document.getElementById('var-value').textContent);
        if (val > 1) {
            val--;
            document.getElementById('var-value').textContent = val;
            document.getElementById('product-quantity').value = val;
        }
    });

    document.getElementById('add-to-cart-form').addEventListener('submit', function (e) {
        const size = document.getElementById('product-size').value;
        if (!size) {
            e.preventDefault();
            alert('Vui lòng chọn size trước khi thêm vào giỏ hàng');
        }
    });
</script>
    <!-- End Slider Script -->

</body>

</html>