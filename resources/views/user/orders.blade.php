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
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-primary text-white rounded-top-3">
                    <h5 class="mb-0">
                        <i class="fa fa-shopping-bag me-2"></i> Đơn hàng của tôi
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>Mã đơn</th>
                                    <th>Tổng tiền</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày đặt</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td><strong>{{ $order->order_code }}</strong></td>
                                        <td class="text-success fw-bold">
                                            {{ number_format($order->total_price) }} VNĐ
                                        </td>
                                        <td>
                                            @if($order->status === 'pending')
                                                <span class="badge bg-warning text-dark rounded-pill px-3 py-2">
                                                    <i class="fa fa-clock me-1"></i> Chưa thanh toán
                                                </span>
                                            @elseif($order->status === 'paid')
                                                <span class="badge bg-success rounded-pill px-3 py-2">
                                                    <i class="fa fa-check me-1"></i> Đã thanh toán
                                                </span>
                                            @elseif($order->status === 'cancelled')
                                                <span class="badge bg-danger rounded-pill px-3 py-2">
                                                    <i class="fa fa-times me-1"></i> Đã hủy
                                                </span>
                                            @else
                                                <span class="badge bg-secondary rounded-pill px-3 py-2">
                                                    <i class="fa fa-times me-1"></i> Hoàn thành
                                                </span>
                                            @endif
                                        </td>
                                        <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            @if($order->status === 'completed')
                                                @foreach($order->items as $item)
                                                    <div class="mb-2">
                                                        <span class="fw-bold">{{ $item->product->name }}</span>
                                                        {{-- Nút mở form --}}
                                                        <button class="btn btn-sm btn-outline-primary ms-2 rounded-pill px-3"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#reviewForm-{{ $order->id }}-{{ $item->id }}">
                                                            <i class="fa fa-star"></i> Đánh giá
                                                        </button>

                                                        {{-- Form collapse --}}
                                                        <div class="collapse mt-2" id="reviewForm-{{ $order->id }}-{{ $item->id }}">
                                                            <form
                                                                action="{{ route('orders.review.store', [$order->id, $item->product->id]) }}"
                                                                method="POST" class="border p-3 rounded">
                                                                @csrf
                                                                <div class="mb-2">
                                                                    <label class="form-label">Đánh giá sao:</label>
                                                                    <select name="rating"
                                                                        class="form-select form-select-sm w-auto d-inline-block">
                                                                        <option value="5">⭐⭐⭐⭐⭐</option>
                                                                        <option value="4">⭐⭐⭐⭐</option>
                                                                        <option value="3">⭐⭐⭐</option>
                                                                        <option value="2">⭐⭐</option>
                                                                        <option value="1">⭐</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-2">
                                                                    <textarea name="comment" class="form-control form-control-sm"
                                                                        rows="2" placeholder="Nhập nhận xét..."></textarea>
                                                                </div>
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-success rounded-pill px-3">
                                                                    <i class="fa fa-paper-plane"></i> Gửi
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <em class="text-muted">—</em>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
</body>

</html>