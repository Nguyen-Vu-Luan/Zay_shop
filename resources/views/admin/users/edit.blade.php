@extends('layouts.admin')

@section('title', 'Sửa người dùng')

@section('content')
    <h2>Sửa User</h2>
    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Tên</label>
            <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Mật khẩu (bỏ trống nếu không đổi)</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="mb-3">
            <label>Vai trò</label>
            <select name="role" class="form-control">
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        <button class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.users') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection