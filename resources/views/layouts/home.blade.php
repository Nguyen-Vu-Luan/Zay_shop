<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', 'Laravel Web eCommerce')</title>
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
    @yield('styles')
</head>

<body>

    @include('partials.topnav')
    @include('partials.header')

    @yield('content')

    @include('partials.footer')

    <script src="{{ asset('home/assets/js/bootstrap.bundle.min.js') }}"></script>
    @yield('scripts')
</body>

</html>