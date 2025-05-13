@extends('layouts.app')

@section('title', 'Mesajlaşma')

@section('content')
<div class="container">
    <h4>{{ $student->name }} ile Sohbet</h4>

    <div id="chat-box" class="chat-box border rounded p-3 mb-3" style="height: 400px; overflow-y: scroll;">
        @foreach($messages as $msg)
            <div class="mb-2 text-{{ $msg->sender_id === Auth::id() ? 'end' : 'start' }}">
                <span class="d-inline-block p-2 rounded bg-{{ $msg->sender_id === Auth::id() ? 'primary' : 'light' }} text-{{ $msg->sender_id === Auth::id() ? 'white' : 'dark' }}">
                    {{ $msg->message }}
                </span>
                <div><small class="text-muted">{{ $msg->created_at->format('H:i d.m.Y H:i') }}</small></div>
            </div>
        @endforeach
    </div>

    <form id="message-form">
        @csrf
        <input type="hidden" name="receiver_id" value="{{ $student->id }}">
        <div class="input-group">
            <input type="text" name="message" id="message-input" class="form-control" placeholder="Mesaj yaz..." required>
            <button type="submit" class="btn btn-primary">Gönder</button>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    const form = document.getElementById('message-form');
    const chatBox = document.getElementById('chat-box');
    const messageInput = document.getElementById('message-input');
    const receiverId = form.querySelector('input[name="receiver_id"]').value;
    const csrfToken = form.querySelector('input[name="_token"]').value;

    // Scroll en alta
    function scrollToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    // Yeni mesajları çek
    async function fetchMessages() {
        const response = await fetch("{{ route('company.messages.fetch') }}", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({ receiver_id: receiverId })
        });

        if (response.ok) {
            const messages = await response.json();
            chatBox.innerHTML = ''; // temizle

            messages.forEach(msg => {
                const isMine = msg.sender_id === {{ Auth::id() }};
                const wrapper = document.createElement('div');
                wrapper.className = `mb-2 text-${isMine ? 'end' : 'start'}`;
                wrapper.innerHTML = `
                    <span class="d-inline-block p-2 rounded bg-${isMine ? 'primary' : 'light'} text-${isMine ? 'white' : 'dark'}">
                        ${msg.message}
                    </span>
                    <div><small class="text-muted">${new Date(msg.created_at).toLocaleString('tr-TR')}</small></div>
                `;
                chatBox.appendChild(wrapper);
            });

            scrollToBottom();
        }
    }

    // Mesaj gönder
    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        const formData = new FormData(form);
        const message = formData.get('message');

        const response = await fetch("{{ route('company.messages.send') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            body: formData
        });

        if (response.ok) {
            messageInput.value = '';
            await fetchMessages(); // anlık güncelle
        }
    });

    // Sayfa ilk yüklendiğinde
    scrollToBottom();

    // Her 5 saniyede bir mesajları yenile
    setInterval(fetchMessages, 5000);
</script>
@endsection
