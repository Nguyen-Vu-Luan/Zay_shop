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
    <link rel="stylesheet" type="text/css" href="{{ asset('home/assets/css/shop-single-review.css') }}">
</head>

<body>
    @include('partials.topnav')
    @include('partials.shop-header')
    @include('partials.shop-single-content')
    @include('partials.footer')
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