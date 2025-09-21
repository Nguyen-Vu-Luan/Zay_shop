@extends('layouts.admin')

@section('title', 'Thêm người dùng')

@section('content')
    <h2>Thêm User</h2>
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Tên</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Mật khẩu</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Vai trò</label>
            <select name="role" class="form-control">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <button class="btn btn-success">Lưu</button>
        <a href="{{ route('admin.users') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection