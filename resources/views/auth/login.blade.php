<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laravel Web eCommerce - Login</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('home/assets/img/favicon.ico') }}">
    <link href="{{ asset('author/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('author/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('author/assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('author/assets/css/style.css') }}" rel="stylesheet">    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>

            <div>
                <h1 class="logo-name">ZAY</h1>
            </div>

            <h3>Login to Zay Shop</h3>

            <form method="POST" class="m-t" role="form" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email..." required="">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password..." required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                <p class="text-muted text-center"><small>Or login with?</small> <a href="{{ route('google.login') }}"
                        aria-label="Login with Google">
                        <i class="fab fa-google fa-lg text-danger"></i>
                    </a> </p>
                <a href="{{ route('password.request') }}"><small>Forgot password?</small></a>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="{{ route('register') }}">Create an account</a>
            </form>

            <p class="m-t"> <small>Zay Shop &copy; 2025</small> </p>

        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('author/assets/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('author/assets/js/bootstrap.min.js') }}"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        @if ($errors->any())
            @php
                $errorMessages = implode('<br>', $errors->all());
            @endphp
            Swal.fire({
                icon: 'error',
                title: "Thông báo lỗi",
                html: "{!! $errorMessages !!}"
            });
        @endif
    </script>


</body>

</html>