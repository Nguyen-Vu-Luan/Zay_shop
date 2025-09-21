@extends('layouts.admin')

@section('title', 'Quản lý đơn hàng')

@section('content')
    <h2>Danh sách đơn hàng</h2>
    <hr>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Người dùng</th>
                <th>Tổng tiền</th>
                <th>Ngày đặt</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name ?? 'N/A' }}</td>
                    <td>{{ number_format($order->total_price, 0, ',', '.') }} đ</td>
                    <td>{{ $order->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection