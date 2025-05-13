@extends('layouts.app')

@section('title', 'Mesajlaşma')

@section('content')
<div class="container">
    <h4>{{ $company->company_name }} ile sohbet</h4>
    <div class="chat-box border rounded p-3 mb-3" style="height: 400px; overflow-y: scroll;">
        @foreach($messages as $msg)
            <div class="mb-2 text-{{ $msg->sender_id === Auth::id() ? 'end' : 'start' }}">
                <span class="d-inline-block p-2 rounded bg-{{ $msg->sender_id === Auth::id() ? 'primary' : 'light' }} text-{{ $msg->sender_id === Auth::id() ? 'white' : 'dark' }}">
                    {{ $msg->message }}
                </span>
                <div><small class="text-muted">{{ $msg->created_at->format('H:i d.m.Y') }}</small></div>
            </div>
        @endforeach
    </div>

    <form method="POST" action="{{ route('student.messages.send') }}">
        @csrf
        <input type="hidden" name="receiver_id" value="{{ $company->user_id }}">
        <div class="input-group">
            <input type="text" name="message" class="form-control" placeholder="Mesajınızı yazın..." required>
            <button type="submit" class="btn btn-primary">Gönder</button>
        </div>
    </form>
</div>
@endsection