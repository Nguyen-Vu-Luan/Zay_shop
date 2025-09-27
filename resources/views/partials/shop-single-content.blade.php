<!-- Open Content -->
<section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            {{-- Hình ảnh sản phẩm --}}
            <div class="col-lg-5 mt-5">
                <div class="card mb-3 position-relative">
                    {{-- Badge giảm giá --}}
                    @if(!empty($product->discount) && $product->discount > 0)
                        <span class="badge bg-danger position-absolute top-0 start-0 m-2 px-2 py-1">
                            -{{ $product->discount }}%
                        </span>
                    @endif

                    <img class="card-img img-fluid" src="{{ $product->image }}" alt="{{ $product->name }}"
                        id="product-detail">
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

                        {{-- Hiển thị giá sau giảm và giá gốc --}}
                        @if(!empty($product->discount) && $product->discount > 0)
                            @php
                                $discountedPrice = $product->price - ($product->price * $product->discount / 100);
                            @endphp
                            <p class="h3 py-2">
                                <span class="text-danger fw-bold">{{ number_format($discountedPrice) }}₫</span>
                                <del class="text-muted ms-2">{{ number_format($product->price) }}₫</del>
                            </p>
                        @else
                            <p class="h3 py-2 text-success">{{ number_format($product->price) }}₫</p>
                        @endif

                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <h6>Thương hiệu:</h6>
                            </li>
                            <li class="list-inline-item">
                                <p class="text-muted"><strong>{{ $product->brand }}</strong></p>
                            </li>
                        </ul>
                        {{-- Form thêm vào giỏ hàng --}}
                        <form method="POST" action="{{ route('cart.add', $product->id) }}" id="add-to-cart-form">
                            @csrf

                            @php
                                $categorySlug = $product->category->slug ?? null;
                                $sizes = in_array($categorySlug, ['quan', 'ao']) ? ['S', 'M', 'L', 'XL'] :
                                    (in_array($categorySlug, ['giay', 'dep']) ? range(37, 47) : []);
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
                                        <li class="list-inline-item"><span class="btn btn-success"
                                                id="btn-minus">-</span></li>
                                        <li class="list-inline-item"><span class="badge bg-secondary"
                                                id="var-value">1</span></li>
                                        <li class="list-inline-item"><span class="btn btn-success"
                                                id="btn-plus">+</span></li>
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
<!-- Reviews Section -->
@if($product->reviews->count() > 0)
    <section class="container my-5">
        <h4 class="mb-4 text-center fw-bold">
            <i class="fa fa-star text-warning me-2"></i> Đánh giá sản phẩm
        </h4>

        <div id="reviewsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                @foreach($product->reviews->chunk(2) as $chunkIndex => $chunk)
                    <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                        <div class="row justify-content-center">
                            @foreach($chunk as $review)
                                <div class="col-md-5 mb-3">
                                    <div class="card shadow-sm border-0 rounded-4 h-100 p-4">
                                        {{-- Header user --}}
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($review->user->name ?? 'User') }}&background=random&size=50"
                                                class="rounded-circle me-3 border" width="50" height="50" alt="avatar">
                                            <div>
                                                <h6 class="mb-0 fw-bold">{{ $review->user->name ?? 'Người dùng ẩn danh' }}</h6>
                                                <small class="text-muted">{{ $review->created_at->format('d/m/Y H:i') }}</small>
                                            </div>
                                        </div>

                                        {{-- Rating stars --}}
                                        <div class="mb-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i
                                                    class="fa fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-secondary' }}"></i>
                                            @endfor
                                        </div>

                                        {{-- Comment --}}
                                        <p class="text-muted fst-italic">“{{ $review->comment }}”</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Nút điều hướng --}}
            <button class="carousel-control-prev custom-nav-btn" type="button" data-bs-target="#reviewsCarousel"
                data-bs-slide="prev">
                <i class="fa fa-chevron-left"></i>
            </button>
            <button class="carousel-control-next custom-nav-btn" type="button" data-bs-target="#reviewsCarousel"
                data-bs-slide="next">
                <i class="fa fa-chevron-right"></i>
            </button>

        </div>
    </section>
@endif
<!-- Close Content -->