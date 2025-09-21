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
    @include('partials.topnav')
    @include('partials.shop-header')
    <div class="row">
        <div class="col-md-10 mx-auto">

            {{-- Card wishlist --}}
            <div class="card shadow-sm border-0 rounded-4">
                <div
                    class="card-header bg-danger text-white d-flex justify-content-between align-items-center rounded-top px-4 py-3">
                    <h5 class="mb-0 d-flex align-items-center">
                        <i class="fa fa-heart me-2"></i> Danh sách yêu thích
                    </h5>
                </div>

                <div class="card-body px-4 py-4">
                    @if($wishlist->isEmpty())
                        <p class="text-muted text-center mb-0">Bạn chưa có sản phẩm yêu thích nào.</p>
                    @else
                        <div class="row g-4">
                            @foreach($wishlist as $product)
                                @php
                                    $finalPrice = $product->price;
                                    if ($product->discount && $product->discount > 0) {
                                        $finalPrice = round($product->price * (1 - $product->discount / 100));
                                    }
                                @endphp
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div
                                        class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden hover-shadow position-relative">

                                        {{-- Badge giảm giá --}}
                                        @if($product->discount && $product->discount > 0)
                                            <span class="position-absolute top-0 start-0 m-2 badge bg-danger">
                                                -{{ $product->discount }}%
                                            </span>
                                        @endif

                                        {{-- Nút xóa góc trên bên phải --}}
                                        <form method="POST" action="{{ route('wishlist.remove', $product->id) }}"
                                            class="position-absolute top-0 end-0 m-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger btn-circle p-1">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </form>

                                        {{-- Ảnh sản phẩm --}}
                                        <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">

                                        <div class="card-body d-flex flex-column justify-content-between align-items-center">
                                            {{-- Tên sản phẩm --}}
                                            <h6 class="card-title text-truncate">{{ $product->name }}</h6>

                                            {{-- Giá sản phẩm --}}
                                            <div class="mb-2 text-center">
                                                @if($product->discount && $product->discount > 0)
                                                    <span
                                                        class="text-muted text-decoration-line-through me-2">{{ number_format($product->price) }}
                                                        VNĐ</span>
                                                    <span class="text-danger fw-bold">{{ number_format($finalPrice) }} VNĐ</span>
                                                @else
                                                    <span class="text-success fw-bold">{{ number_format($product->price) }}
                                                        VNĐ</span>
                                                @endif
                                            </div>


                                            {{-- Thêm vào giỏ --}}
                                            <form method="POST" action="{{ route('cart.add', $product->id) }}">
                                                @csrf
                                                <button type="submit"
                                                    class="btn btn-sm btn-primary d-flex align-items-center gap-1">
                                                    <i class="fa fa-cart-plus"></i> Thêm
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Pagination --}}
                @if($wishlist->hasPages())
                    <div class="card-footer border-0 bg-white d-flex justify-content-center py-3">
                        {{ $wishlist->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('partials.footer')
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