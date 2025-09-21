@extends('layouts.admin')

@section('title', 'Sửa sản phẩm')

@section('content')
    <h2>Sửa Sản phẩm</h2>
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Tên</label>
            <input type="text" name="name" value="{{ $product->name }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Giá</label>
            <input type="number" name="price" value="{{ $product->price }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tồn kho</label>
            <input type="number" name="stock" value="{{ $product->stock }}" class="form-control" required>
        </div>
        <button class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.products') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection