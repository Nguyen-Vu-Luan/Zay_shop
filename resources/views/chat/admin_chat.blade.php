<h2>Chat với User {{ $userId }}</h2>
<div id="chat-body" style="height:400px; overflow-y:auto; border:1px solid #ddd; padding:10px;">
    @foreach($messages as $msg)
        <div>
            <b>{{ $msg->from_id == 1 ? 'Admin' : 'User' }}:</b> {{ $msg->message }}
        </div>
    @endforeach
</div>

<form id="chat-form">
    <input type="text" id="message" class="form-control" placeholder="Nhập tin nhắn...">
    <button class="btn btn-primary">Gửi</button>
</form>

<script>
    document.getElementById('chat-form').addEventListener('submit', function (e) {
        e.preventDefault();
        let message = document.getElementById('message').value;
        fetch("{{ route('admin.chat.send', $userId) }}", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ message })
        });
        document.getElementById('message').value = '';
    });

    window.Echo.private('chat.' + {{ $userId }})
        .listen('MessageSent', (e) => {
            document.getElementById('chat-body').innerHTML += `<div><b>${e.message.from_id == 1 ? 'Admin' : 'User'}:</b> ${e.message.message}</div>`;
            document.getElementById('chat-body').scrollTop = document.getElementById('chat-body').scrollHeight;
        });
</script>