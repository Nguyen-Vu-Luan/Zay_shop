<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laravel Web eCommerce - Register</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('home/assets/img/favicon.ico') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('home/assets/img/favicon.ico') }}">
    <link href="{{ asset('author/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('author/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('author/assets/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('author/assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('author/assets/css/style.css') }}" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">ZAY</h1>

            </div>
            <h3>Register to Zay Shop</h3>

            @if ($errors->any())
                <div style="color: red;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" class="m-t" role="form" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Name...">
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Email...">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password...">
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control"
                        placeholder="Confirm Password..." required>
                </div>

                <div class="form-group">
                    <div class="checkbox i-checks"><label> <input name="agree" type="checkbox"><i></i> Agree the terms
                            and policy </label></div>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Register</button>

                <p class="text-muted text-center"><small>Already have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="{{ route('login') }}">Login</a>
            </form>
            <p class="m-t"> <small>Zay Shop &copy; 2025</small> </p>
        </div>
    </div>

    <script src="{{ asset('author/assets/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('author/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('author/assets/js/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
</body>

</html>