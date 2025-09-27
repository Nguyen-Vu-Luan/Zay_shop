@extends('layouts.admin')

@section('content')
    <div class="container">
        <h3>Chat với {{ $user->name }}</h3>
        <div class="card">
            <div class="card-body" id="chat-box"
                style="height:400px; overflow-y:auto; border:1px solid #ccc; padding:10px;"></div>
            <div class="card-footer">
                <form id="chat-form">
                    @csrf
                    <div class="input-group">
                        <input type="text" id="message-input" class="form-control" placeholder="Type message..." required>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let userId = {{ $user->id }};

        // Load tin nhắn trước đó
        fetch(`/admin/chats/${userId}`)
            .then(res => res.json())
            .then(data => {
                let chatBox = document.getElementById('chat-box');
                data.messages.forEach(msg => {
                    chatBox.innerHTML += `<div><b>${msg.from_name}:</b> ${msg.message}</div>`;
                });
                chatBox.scrollTop = chatBox.scrollHeight;
            });

        // Gửi tin nhắn
        document.getElementById('chat-form').addEventListener('submit', function (e) {
            e.preventDefault();
            let message = document.getElementById('message-input').value;
            if (message.trim() === '') return;

            fetch(`/admin/chats/send/${userId}`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json' },
                body: JSON.stringify({ message: message })
            })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        let chatBox = document.getElementById('chat-box');
                        chatBox.innerHTML += `<div><b>You:</b> ${message}</div>`;
                        chatBox.scrollTop = chatBox.scrollHeight;
                        document.getElementById('message-input').value = '';
                    }
                });
        });

        // Realtime Pusher
        window.Echo.private('chat.' + {{ Auth::id() }})
            .listen('.message.sent', (e) => {
                if (e.message.from_id == userId) {
                    let chatBox = document.getElementById('chat-box');
                    chatBox.innerHTML += `<div><b>${e.message.from_name}:</b> ${e.message.message}</div>`;
                    chatBox.scrollTop = chatBox.scrollHeight;
                }
            });
    </script>
@endsection