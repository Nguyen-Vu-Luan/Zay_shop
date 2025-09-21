@extends('layouts.admin')

@section('title', 'Quản lý người dùng')

@section('content')
    <h2>Danh sách người dùng</h2>
    <a href="{{ route('admin.users.create') }}" class="btn btn-success mb-3">+ Thêm User</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Vai trò</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $u)
                <tr>
                    <td>{{ $u->id }}</td>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->role }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $u->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('admin.users.delete', $u->id) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Xóa user này?')" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection