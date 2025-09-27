@extends('layouts.admin')
@section('title', 'Comment')
@section('content')
    <div class="container">
        <h3 class="mb-4">Quản lý Đánh giá</h3>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Id</th>
                            <th>User</th>
                            <th>Product</th>
                            <th>Nội dung</th>
                            <th>Rating</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $comment)
                            <tr class="align-middle">
                                <td>{{ $comment->id }}</td>
                                <td class="d-flex align-items-center">
                                    <div class="avatar rounded-circle bg-primary text-white text-center me-2"
                                        style="width:35px; height:35px; line-height:35px; font-weight:bold;">
                                        {{ strtoupper(substr($comment->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    {{ $comment->user->name ?? 'Unknown' }}
                                </td>
                                <td>{{ $comment->product->name ?? 'Unknown' }}</td>
                                <td>{{ $comment->comment }}</td>
                                <td>
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $comment->rating)
                                            <i class="fa fa-star text-warning"></i>
                                        @else
                                            <i class="fa fa-star text-secondary"></i>
                                        @endif
                                    @endfor
                                </td>
                                <td>{{ $comment->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <form action="{{ route('admin.comments.delete', $comment->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit"
                                            onclick="return confirm('Bạn có chắc muốn xóa đánh giá này?')">
                                            <i class="fa fa-trash-alt me-1"></i> Xóa
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if($comments->isEmpty())
                            <tr>
                                <td colspan="7" class="text-center text-muted py-3">Chưa có đánh giá nào</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        .avatar {
            font-size: 0.9rem;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
            transition: background-color 0.2s;
        }
    </style>
@endsection