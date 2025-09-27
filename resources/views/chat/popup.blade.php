@if(Auth::check() && Auth::id() != 1)
    <!-- Floating Chat Button -->
    <button id="chat-toggle" class="btn btn-success rounded-circle position-fixed"
        style="bottom: 20px; right: 20px; width: 60px; height: 60px; z-index: 9999; font-size:22px; position:relative;">
        💬
        <!-- Badge thông báo -->
        <span id="chat-badge" style="display:none; position:absolute; top:8px; right:8px; width:14px; height:14px;
                         background:red; border-radius:50%;"></span>
    </button>

    <!-- Chat Popup -->
    <div id="chat-popup" class="shadow-lg" style="position: fixed; bottom: 90px; right: 20px; width: 340px; background: #fff;
                   border-radius: 12px; display:none; z-index:10000;">

        <!-- Header -->
        <div style="background: #198754; color:white; padding:12px; 
                        border-radius: 12px 12px 0 0; display:flex; justify-content:space-between; align-items:center;">
            <span style="font-weight:600;">💬 Chat với Admin</span>
            <button onclick="toggleChat()" class="btn btn-sm btn-light rounded-circle">×</button>
        </div>

        <!-- Body -->
        <div id="chat-body" style="height:320px; overflow-y:auto; padding:12px; background:#f9f9f9;">
            @php $messages = $messages ?? collect(); @endphp
            @foreach($messages as $msg)
                @if($msg->from_id == Auth::id())
                    <!-- Tin nhắn của User -->
                    <div style="display:flex; justify-content:flex-end; margin-bottom:8px;">
                        <div
                            style="max-width:70%; background:#d1f7c4; padding:8px 12px; border-radius:16px 16px 0 16px; font-size:14px;">
                            {{ $msg->message }}
                        </div>
                    </div>
                @else
                    <!-- Tin nhắn của Admin -->
                    <div style="display:flex; justify-content:flex-start; margin-bottom:8px;">
                        <div
                            style="max-width:70%; background:#e9ecef; padding:8px 12px; border-radius:16px 16px 16px 0; font-size:14px;">
                            {{ $msg->message }}
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <!-- Footer -->
        <form id="chat-form" style="display:flex; border-top:1px solid #ddd; background:#fff; padding:8px;">
            <input type="text" id="message" class="form-control border-0 shadow-none" placeholder="Nhập tin nhắn..."
                autocomplete="off">
            <button class="btn btn-success ms-2">Gửi</button>
        </form>
    </div>

    <script>
        const popup = document.getElementById('chat-popup');
        const badge = document.getElementById('chat-badge');
        const chatBody = document.getElementById('chat-body');

        function toggleChat() {
            if (popup.style.display === 'none') {
                popup.style.display = 'block';
                badge.style.display = 'none'; // tắt chấm đỏ khi mở
                chatBody.scrollTop = chatBody.scrollHeight;
            } else {
                popup.style.display = 'none';
            }
        }

        document.getElementById('chat-toggle').addEventListener('click', toggleChat);

        // Send message
        document.getElementById('chat-form').addEventListener('submit', function (e) {
            e.preventDefault();
            let input = document.getElementById('message');
            let message = input.value.trim();
            if (message === '') return;

            // Hiển thị ngay tin nhắn trong khung chat
            chatBody.innerHTML += `
                    <div style="display:flex; justify-content:flex-end; margin-bottom:8px;">
                        <div style="max-width:70%; background:#d1f7c4; padding:8px 12px; border-radius:16px 16px 0 16px; font-size:14px;">
                            ${message}
                        </div>
                    </div>
                `;
            chatBody.scrollTop = chatBody.scrollHeight;

            // Gửi lên server
            fetch("{{ route('user.chat.send') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ message })
            });

            input.value = '';
        });

        // Listen for new messages
        @if(Auth::check())
            window.Echo.private('chat.' + {{ Auth::id() }})
                .listen('MessageSent', (e) => {
                    // Tin nhắn của admin
                    chatBody.innerHTML += `
                                <div style="display:flex; justify-content:flex-start; margin-bottom:8px;">
                                    <div style="max-width:70%; background:#e9ecef; padding:8px 12px; border-radius:16px 16px 16px 0; font-size:14px;">
                                        ${e.message.message}
                                    </div>
                                </div>
                            `;
                    chatBody.scrollTop = chatBody.scrollHeight;

                    // Nếu popup đang đóng thì hiện chấm đỏ
                    if (popup.style.display === 'none') {
                        badge.style.display = 'block';
                    }
                });
        @endif
    </script>
@endif