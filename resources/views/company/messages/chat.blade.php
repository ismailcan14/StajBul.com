@extends('layouts.app')

@section('title', 'Mesajlaşma')

@section('content')
<div class="container my-5">
    <h4 class="text-center fw-semibold mb-4 text-primary">
        💬 {{ $student->name }} ile Sohbet
    </h4>

    <div class="chat-box border rounded-4 shadow-sm p-3 mb-4 bg-white" style="height: 400px; overflow-y: auto;" id="chat-box">
        @foreach($messages as $msg)
            <div class="mb-3 d-flex flex-column {{ $msg->sender_id === Auth::id() ? 'align-items-end' : 'align-items-start' }}">
                <div class="chat-bubble bg-{{ $msg->sender_id === Auth::id() ? 'primary text-white' : 'light text-dark' }}">
                    {{ $msg->message }}
                </div>
                <small class="text-muted mt-1">
                    {{ $msg->created_at->format('H:i d.m.Y') }}
                </small>
            </div>
        @endforeach
    </div>

    <form method="POST" action="{{ route('company.messages.send') }}" id="message-form">
        @csrf
        <input type="hidden" name="receiver_id" id="receiver-id" value="{{ $student->id }}">
        <div class="input-group">
            <input type="text" name="message" class="form-control rounded-start-pill" placeholder="Mesaj yazın..." required>
            <button type="submit" class="btn btn-gradient rounded-end-pill px-4">Gönder</button>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    const receiverId = $('#receiver-id').val();

    $('#message-form').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#chat-box').append(`
                    <div class="mb-3 d-flex flex-column align-items-end">
                        <div class="chat-bubble bg-primary text-white">
                            ${response.message}
                        </div>
                        <small class="text-muted mt-1">${response.time}</small>
                    </div>
                `);
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
                $('input[name="message"]').val('');
            }
        });
    });

    setInterval(function () {
        $.ajax({
            url: "{{ route('company.messages.fetch') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}",
                receiver_id: receiverId
            },
            success: function(response) {
                $('#chat-box').html('');
                response.forEach(function(msg) {
                    $('#chat-box').append(`
                        <div class="mb-3 d-flex flex-column ${msg.is_sender ? 'align-items-end' : 'align-items-start'}">
                            <div class="chat-bubble bg-${msg.is_sender ? 'primary text-white' : 'light text-dark'}">
                                ${msg.message}
                            </div>
                            <small class="text-muted mt-1">${msg.time}</small>
                        </div>
                    `);
                });
                $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
            }
        });
    }, 3000);
});
</script>
@endsection