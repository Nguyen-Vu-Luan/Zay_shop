<!-- Start Content -->
<div class="container py-5">
    <div class="row">
        {{-- Load Categories --}}
        <div class="col-lg-3">
            <ul class="list-unstyled templatemo-accordion">
                @foreach ($categories as $category)
                    <li class="pb-3">
                        <a class="collapsed d-flex justify-content-between h3 text-decoration-none"
                            href="{{ route('categories.filter', ['slug' => $category->slug]) }}">
                            {{ $category->name }}
                            <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
                        </a>
                    </li>
                @endforeach
                <li class="pb-3">
                    <a class="collapsed d-flex justify-content-between h3 text-decoration-none"
                        href="{{ route('shop') }}">
                        Thương hiệu
                        <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>
                    <ul class="collapse show list-unstyled pl-3">
                        @foreach ($brands as $brand)
                            @if (!empty($brand))
                                <li>
                                    <a class="text-decoration-none"
                                        href="{{ route('brand.filter', ['brand' => $brand]) }}">{{ $brand }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
        <div class="col-lg-9">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-inline shop-top-menu pb-3 pt-1">
                        <li class="list-inline-item">
                            <a class="h3 text-dark text-decoration-none mr-3" href="{{route('shop')}}">Tất cả</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="h3 text-dark text-decoration-none mr-3"
                                href="{{ $slug ? route('category.gender.filter', [$slug, 'man']) : route('gender.filter', 'man') }}">Nam</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="h3 text-dark text-decoration-none mr-3"
                                href="{{ $slug ? route('category.gender.filter', [$slug, 'woman']) : route('gender.filter', 'woman') }}">Nữ</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="h3 text-dark text-decoration-none"
                                href="{{ $slug ? route('category.gender.filter', [$slug, 'kid']) : route('gender.filter', 'kid') }}">Trẻ
                                em</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 pb-4">
                    <div class="d-flex">
                        <select id="sortSelect" class="form-control" name="sort">
                            <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }}>Tên A → Z
                            </option>
                            <option value="name_desc" {{ request('sort') === 'name_desc' ? 'selected' : '' }}>Tên Z →
                                A</option>
                            <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Giá tăng
                                dần</option>
                            <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Giá
                                giảm dần</option>
                        </select>
                    </div>
                </div>
            </div>
            {{-- Show Products --}}
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-md-4">
                        <div class="card mb-4 product-wap rounded-0">
                            <div class="card rounded-0 position-relative overflow-hidden">
                                {{-- Badge giảm giá --}}
                                @if(!empty($product->discount) && $product->discount > 0)
                                    <span class="badge bg-danger position-absolute top-0 start-0 m-2 px-2 py-1">
                                        -{{ $product->discount }}%
                                    </span>
                                @endif

                                <img class="card-img rounded-0 img-fluid" src="{{ $product->image }}"
                                    alt="{{ $product->name }}">

                                <div
                                    class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                    <ul class="list-unstyled">
                                        <li>
                                            @php
                                                $isFavorited = Auth::check() && Auth::user()->wishlist->contains($product->id);
                                            @endphp

                                            @if($isFavorited)
                                                <form method="POST" action="{{ route('wishlist.remove', $product->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-success text-white"
                                                        title="Bỏ yêu thích">
                                                        <i class="fas fa-heart"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <form method="POST" action="{{ route('wishlist.add', $product->id) }}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success text-white"
                                                        title="Thêm vào yêu thích">
                                                        <i class="far fa-heart"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </li>
                                        <li>
                                            <a class="btn btn-success text-white mt-2"
                                                href="{{ route('product.show', $product->id) }}">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="card-body text-center">
                                <a href="{{ route('product.show', $product->id) }}"
                                    class="h3 text-decoration-none d-block mb-2">
                                    {{ $product->name }}
                                </a>
                                {{-- Hiển thị giá sau giảm và giá gốc --}}
                                @if(!empty($product->discount) && $product->discount > 0)
                                    <p class="mb-0">
                                        <span class="text-danger fw-bold">
                                            {{ number_format($product->price - ($product->price * $product->discount / 100)) }}₫
                                        </span>
                                        <del class="text-muted ms-2">{{ number_format($product->price) }}₫</del>
                                    </p>
                                @else
                                    <p class="mb-0">
                                        <span class="text-success fw-bold">
                                            {{ number_format($product->price)}}₫
                                        </span>
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Chuyển trang --}}
            <x-pagination :paginator="$products" />
        </div>
    </div>
</div>
<!-- End Content -->