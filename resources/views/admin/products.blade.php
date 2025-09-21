@extends('layouts.admin')

@section('title', 'Quản lý sản phẩm')

@section('content')
    <h2>Danh sách sản phẩm</h2>
    <hr>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Giá</th>
                <th>Tồn kho</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ number_format($product->price, 0, ',', '.') }} đ</td>
                    <td>{{ $product->stock }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection