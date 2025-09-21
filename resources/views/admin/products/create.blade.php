@extends('layouts.admin')

@section('title', 'Thêm sản phẩm')

@section('content')
    <h2>Thêm Sản phẩm</h2>
    <form action="{{ route('admin.products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Tên</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Giá</label>
            <input type="number" name="price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tồn kho</label>
            <input type="number" name="stock" class="form-control" required>
        </div>
        <button class="btn btn-success">Lưu</button>
        <a href="{{ route('admin.products') }}" class="btn btn-secondary">Quay lại</a>
    </form>
@endsection