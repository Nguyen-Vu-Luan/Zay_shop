<!DOCTYPE html>
<html lang="en">

<head>
    <title>Giỏ hàng</title>
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
    @include('partials.topnav')
    @include('partials.shop-header')
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
                                                    $discount = $product->discount ?? 0; // % giảm giá
                                                    $originalPrice = $product->price;
                                                    $finalPrice = $originalPrice;

                                                    if ($discount > 0) {
                                                        $finalPrice = $originalPrice - ($originalPrice * $discount / 100);
                                                    }

                                                    $subtotal = $finalPrice * $cart->quantity;

                                                    $categorySlug = $product->category->slug ?? null;
                                                    $sizes = in_array($categorySlug, ['quan', 'ao'])
                                                        ? ['S', 'M', 'L', 'XL']
                                                        : (in_array($categorySlug, ['giay', 'dep']) ? range(35, 47) : []);
                                                @endphp
                                                <tr data-cart-id="{{ $cart->id }}">
                                                    <td>
                                                        <input type="checkbox" name="selected[]" value="{{ $cart->id }}"
                                                            class="cart-checkbox" data-price="{{ $subtotal }}">
                                                    </td>
                                                    <td>
                                                        <img src="{{ asset($product->image) }}" width="60" class="rounded">
                                                    </td>
                                                    <td>
                                                        {{ $product->name }}                                                        
                                                    </td>
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
                                                    <td class="fw-bold subtotal text-center">
                                                        @php
                                                            $discountedPrice = $product->discount > 0
                                                                ? $product->price * (1 - $product->discount / 100)
                                                                : $product->price;

                                                            $subtotalDiscounted = $discountedPrice * $cart->quantity;
                                                            $subtotalOriginal = $product->price * $cart->quantity;
                                                        @endphp

                                                        @if($product->discount > 0)                                                            
                                                            <div class="text-danger fw-bold">
                                                                <span
                                                                    class="subtotal-discounted">{{ number_format($subtotalDiscounted) }}
                                                                    VNĐ</span>
                                                            </div>
                                                            <div class="text-muted">
                                                                <del class="subtotal-original">{{ number_format($subtotalOriginal) }}
                                                                    VNĐ</del>
                                                            </div>
                                                        @else
                                                            <div class="text-success fw-bold">
                                                                <span class="subtotal-discounted">{{ number_format($subtotalOriginal) }}
                                                                    VNĐ</span>
                                                            </div>
                                                        @endif
                                                    </td>
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
                            {{-- Không cần chọn phương thức, mặc định MoMo --}}
                            <input type="hidden" name="payment_method" value="momo">
                            <button type="submit" class="btn btn-success mt-2">
                                <i class="fa fa-credit-card"></i> Thanh toán qua MoMo
                            </button>
                        </div>
                    </form>

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
    <script src="{{ asset('home/assets/js/cartAJAX.js') }}"></script>
</body>

</html>