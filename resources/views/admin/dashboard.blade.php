@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h2>Dashboard</h2>
    <hr>
    <div class="row text-center">
        <div class="col-md-3">
            <div class="p-4 bg-light rounded shadow-sm">
                <h5>Người dùng</h5>
                <p class="fs-4 fw-bold">{{ $stats['users'] }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-4 bg-light rounded shadow-sm">
                <h5>Sản phẩm</h5>
                <p class="fs-4 fw-bold">{{ $stats['products'] }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-4 bg-light rounded shadow-sm">
                <h5>Đơn hàng</h5>
                <p class="fs-4 fw-bold">{{ $stats['orders'] }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-4 bg-light rounded shadow-sm">
                <h5>Doanh thu</h5>
                <p class="fs-4 fw-bold">${{ number_format($stats['revenue'], 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
@endsection