@extends('layouts.home')

@section('title', 'Trang chủ')

@section('content')
    <!-- Start Banner Hero -->
    <div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="{{ asset('home/assets/img/banner_img_01.jpg') }}" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left align-self-center">
                                <h1 class="h1 text-success"><b>Zay</b> Shop</h1>
                                <h3 class="h2">Phong Cách Thời Trang Tinh Tế</h3>
                                <p>
                                    Zay Shop là cửa hàng thời trang trực tuyến mang đến phong cách hiện đại, tinh tế và
                                    phù hợp với mọi cá tính. Mua sắm dễ
                                    dàng, chọn lựa chuẩn gu.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="{{ asset('home/assets/img/banner_img_02.jpg') }}" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h3 class="h2">Chọn Zay, Chọn Chất</h3>
                                <p>
                                    Zay Shop mang đến cho bạn những sản phẩm thời trang tinh tế, hiện đại và đầy cá
                                    tính. Mỗi lựa chọn đều được tuyển chọn
                                    kỹ lưỡng để đảm bảo chất lượng, phong cách và sự thoải mái tối đa. Mua sắm tại
                                    <strong>Zay</strong> là cách bạn khẳng định gu thời trang
                                    riêng một cách tự tin và đẳng cấp.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="{{ asset('home/assets/img/banner_img_03.jpg') }}" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h3 class="h2">Zay Shop – Nơi Phong Cách Bắt Đầu</h3>
                                <p>
                                    <strong>Zay Shop</strong> mang đến những sản phẩm thời trang hiện đại, tinh tế và
                                    phù hợp với mọi cá tính. Mỗi thiết kế đều được chọn lọc
                                    kỹ lưỡng để đảm bảo chất lượng và sự thoải mái tối đa.
                                </p>
                                <p>
                                    <strong>Chọn Zay, chọn chất</strong> – vì bạn xứng đáng với phong cách riêng đầy ấn
                                    tượng.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel"
            role="button" data-bs-slide="prev">
            <i class="fas fa-chevron-left"></i>
        </a>
        <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel"
            role="button" data-bs-slide="next">
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
    <!-- End Banner Hero -->
    <!-- Start Categories of The Month -->
    <section class="container py-5">
        <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Danh Mục Nổi Bật</h1>
                <p>
                    Cập nhật xu hướng mới nhất với những lựa chọn thời trang được yêu thích nhất!
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="#"><img src="{{ asset('home/assets/img/category_img_01.avif') }}"
                        class="rounded-circle img-fluid border"></a>
                <h5 class="text-center mt-3 mb-3">Quần áo</h5>
                <p class="text-center"><a class="btn btn-success">Go Shop</a></p>
            </div>
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="#"><img src="{{ asset('home/assets/img/category_img_02.avif') }}"
                        class="rounded-circle img-fluid border"></a>
                <h2 class="h5 text-center mt-3 mb-3">Giày dép</h2>
                <p class="text-center"><a class="btn btn-success">Go Shop</a></p>
            </div>
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="#"><img src="{{ asset('home/assets/img/category_img_03.avif') }}"
                        class="rounded-circle img-fluid border"></a>
                <h2 class="h5 text-center mt-3 mb-3">Phụ kiện</h2>
                <p class="text-center"><a class="btn btn-success">Go Shop</a></p>
            </div>
        </div>
    </section>
    <!-- End Categories of The Month -->

@endsection