<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laravel Web eCommerce - Reset password</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('home/assets/img/favicon.ico') }}">
    <link href="{{ asset('author/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('author/assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('author/assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('author/assets/css/style.css') }}" rel="stylesheet">

</head>

<body class="gray-bg">
    <div class="passwordBox animated fadeInDown">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox-content">
                    <h2 class="font-bold">Reset password</h2>
                    <p>
                        Enter and confirm your new password.
                    </p>
                    <div class="row">
                        <div class="col-lg-12">
                            <form method="POST" action="{{ route('password.store') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <input type="hidden" name="email" value="{{ $email }}">
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control"
                                        placeholder="Mật khẩu mới..." required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password_confirmation" class="form-control"
                                        placeholder="Xác nhận mật khẩu..." required>
                                </div>
                                <button type="submit" class="btn btn-primary block full-width m-b">Đặt lại mật
                                    khẩu</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-6">
                Zay Shop
            </div>
            <div class="col-md-6 text-right">
                <small>&copy; 2025</small>
            </div>
        </div>
    </div>
</body>

</html>