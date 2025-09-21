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
        <div class="col-md-8 mx-auto">

            {{-- Thông tin tài khoản --}}
            <div class="card shadow-sm mb-4 border-0 rounded-3">
                <div class="card-header bg-primary text-white rounded-top">
                    <h5 class="mb-0"><i class="fa fa-user-circle me-2"></i>Thông tin tài khoản</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.updateProfile') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên</label>
                            <input type="text" name="name" value="{{ $user->name }}"
                                class="form-control @error('name') is-invalid @enderror" required>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" value="{{ $user->email }}"
                                class="form-control @error('email') is-invalid @enderror" required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" name="phone" value="{{ $user->phone }}"
                                class="form-control @error('phone') is-invalid @enderror" pattern="^0[0-9]{9}$"
                                placeholder="Ví dụ: 0912345678" required>
                            @error('phone')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa fa-save me-1"></i> Cập nhật
                        </button>
                    </form>
                </div>
            </div>

            {{-- Đổi mật khẩu --}}
            <div class="card shadow-sm mb-4 border-0 rounded-3">
                <div class="card-header bg-warning text-dark rounded-top">
                    <h5 class="mb-0"><i class="fa fa-lock me-2"></i>Đổi mật khẩu</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.updatePassword') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu mới</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-warning px-4">
                            <i class="fa fa-key me-1"></i> Đổi mật khẩu
                        </button>
                    </form>
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
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function () {
                const output = document.getElementById('preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
    <script>
        // Preview ảnh khi chọn file
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function () {
                document.getElementById('preview').src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        // AJAX submit form
        document.getElementById('avatarForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch("{{ route('user.updateAvatar') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('preview').src = data.avatar; // Cập nhật ảnh mới ngay
                        const msg = document.getElementById('successMessage');
                        msg.textContent = data.success;
                        msg.style.display = 'block';
                    } else if (data.error) {
                        alert(data.error);
                    }
                })
                .catch(err => alert('Có lỗi xảy ra, vui lòng thử lại'));
        });
    </script>
    <!-- End Script -->
</body>

</html>