@extends('layouts.app')

@section('title', 'Mesajlaşma')

@section('content')
<div class="container my-5">
    <h4 class="text-center fw-semibold mb-4 text-primary">
        💬 {{ $company->company_name }} ile Sohbet
    </h4>

    <div class="chat-box border rounded-4 shadow-sm p-3 mb-4 bg-white" style="height: 400px; overflow-y: auto;">
        @forelse($messages as $msg)
            <div class="mb-3 d-flex flex-column {{ $msg->sender_id === Auth::id() ? 'align-items-end' : 'align-items-start' }}">
                <div class="chat-bubble bg-{{ $msg->sender_id === Auth::id() ? 'primary text-white' : 'light text-dark' }}">
                    {{ $msg->message }}
                </div>
                <small class="text-muted mt-1">
                    {{ $msg->created_at->format('H:i d.m.Y') }}
                </small>
            </div>
        @empty
            <p class="text-muted text-center">Henüz mesaj yok.</p>
        @endforelse
    </div>

    <form method="POST" action="{{ route('student.messages.send') }}">
        @csrf
        <input type="hidden" name="receiver_id" value="{{ $company->user_id }}">
        <div class="input-group">
            <input type="text" name="message" class="form-control rounded-start-pill" placeholder="Mesajınızı yazın..." required>
            <button type="submit" class="btn btn-gradient rounded-end-pill px-4">Gönder</button>
        </div>
    </form>
</div>
@endsection