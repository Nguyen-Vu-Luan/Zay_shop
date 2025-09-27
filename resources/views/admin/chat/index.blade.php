@extends('layouts.admin')
@section('title', 'Chat')
@section('content')
    <div class="container">
        <h3 class="mb-4">Danh sách User Chat</h3>

        <div class="card">
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @foreach($users as $user)
                        <li class="list-group-item d-flex align-items-center justify-content-between hover-shadow">
                            <div class="d-flex align-items-center">
                                <!-- Avatar giả lập -->
                                <div class="avatar rounded-circle bg-primary text-white text-center me-3"
                                    style="width:40px; height:40px; line-height:40px;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <a href="{{ route('admin.chat.user', $user->id) }}"
                                        class="text-decoration-none fw-bold">{{ $user->name }}</a>
                                    <div class="text-muted" style="font-size:0.85rem;">{{ $user->email }}</div>
                                </div>
                            </div>

                            <!-- Trạng thái online/offline giả lập -->
                            <span class="status-dot"
                                style="width:10px; height:10px; border-radius:50%; background-color: green;"></span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <style>
        .hover-shadow:hover {
            background-color: #f8f9fa;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .status-dot {
            display: inline-block;
        }

        .avatar {
            font-weight: bold;
        }
    </style>
@endsection