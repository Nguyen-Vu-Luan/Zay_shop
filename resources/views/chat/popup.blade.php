{{-- @if(Auth::check() && Auth::id() != 1)
    <!-- Floating Chat Button -->
    <button id="chat-toggle" class="btn btn-success rounded-circle"
        style="position: fixed; bottom: 20px; right: 20px; width: 60px; height: 60px; z-index: 9999;">
        💬
    </button>

    <!-- Chat Popup -->
    <div id="chat-popup"
        style="position: fixed; bottom: 90px; right: 20px; width: 320px; background: white;
                border: 1px solid #ccc; border-radius: 8px; display:none; z-index:10000; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
        <div style="background: #198754; color:white; padding:10px; cursor:pointer;
                    border-radius: 8px 8px 0 0; display:flex; justify-content:space-between; align-items:center;">
            <span>Chat với Admin</span>
            <button onclick="toggleChat()" class="btn btn-sm btn-light">×</button>
        </div>

        <div id="chat-body" style="height:300px; overflow-y:auto; padding:10px;">
            @foreach($messages ?? [] as $msg)
                <div style="margin-bottom:5px;">
                    <b>{{ $msg->from_id == Auth::id() ? 'Bạn' : 'Admin' }}:</b> {{ $msg->message }}
                </div>
            @endforeach
        </div>

        <form id="chat-form" style="display:flex; border-top:1px solid #ddd;">
            <input type="text" id="message" class="form-control border-0" placeholder="Nhập tin nhắn...">
            <button class="btn btn-success">Gửi</button>
        </form>
    </div>

    <script>
        // Toggle chat popup
        function toggleChat() {
            let popup = document.getElementById('chat-popup');
            popup.style.display = popup.style.display === 'none' ? 'block' : 'none';
        }

        document.getElementById('chat-toggle').addEventListener('click', toggleChat);

        // Send message
        document.getElementById('chat-form').addEventListener('submit', function (e) {
            e.preventDefault();
            let message = document.getElementById('message').value.trim();
            if (message === '') return;
            fetch("{{ route('user.chat.send') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ message })
            });
            document.getElementById('message').value = '';
        });

        // Listen for new messages
        @if(Auth::check())
            window.Echo.private('chat.' + {{ Auth::id() }})
                .listen('MessageSent', (e) => {
                    let chatBody = document.getElementById('chat-body');
                    chatBody.innerHTML += `<div style="margin-bottom:5px;">
                        <b>${e.message.from_id == {{ Auth::id() }} ? 'Bạn' : 'Admin'}:</b> ${e.message.message}
                    </div>`;
                    chatBody.scrollTop = chatBody.scrollHeight;
                });
        @endif
    </script>
@endif --}}