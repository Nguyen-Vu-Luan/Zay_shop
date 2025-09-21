@extends('layouts.admin')

@section('title', 'Quản lý đơn hàng')

@section('content')
    <h2>Danh sách đơn hàng</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Người dùng</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Ngày đặt</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $o)
                <tr>
                    <td>{{ $o->id }}</td>
                    <td>{{ $o->user->name ?? 'N/A' }}</td>
                    <td>{{ number_format($o->total_price, 0, ',', '.') }} đ</td>
                    <td>{{ $o->status }}</td>
                    <td>{{ $o->created_at }}</td>
                    <td>
                        <a href="{{ route('admin.orders.view', $o->id) }}" class="btn btn-info btn-sm">Xem</a>
                        <form action="{{ route('admin.orders.delete', $o->id) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Xóa đơn hàng này?')" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection