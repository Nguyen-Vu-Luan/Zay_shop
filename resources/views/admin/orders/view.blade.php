@extends('layouts.admin')

@section('title', 'Chi tiết đơn hàng')

@section('content')
    <h2>Chi tiết Đơn hàng #{{ $order->id }}</h2>
    <p><strong>Người dùng:</strong> {{ $order->user->name ?? 'N/A' }}</p>
    <p><strong>Tổng tiền:</strong> {{ number_format($order->total_price, 0, ',', '.') }} đ</p>
    <p><strong>Trạng thái:</strong> {{ $order->status }}</p>
    <p><strong>Ngày đặt:</strong> {{ $order->created_at }}</p>

    <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
        @csrf @method('PATCH')
        <div class="mb-3">
            <label>Cập nhật trạng thái</label>
            <select name="status" class="form-control">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Đã hủy</option>
            </select>
        </div>
        <button class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.orders') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection