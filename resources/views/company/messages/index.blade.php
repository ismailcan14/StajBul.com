@extends('layouts.app')

@section('title', 'Mesajlar')

@section('content')
<div class="container">
    <h4>Mesajlaştığınız Öğrenciler</h4>
    <ul class="list-group mt-3">
        @forelse($students as $student)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $student->name }}
                <a href="{{ route('company.messages.chat', $student->id) }}" class="btn btn-sm btn-primary">Sohbete Git</a>
            </li>
        @empty
            <li class="list-group-item">Henüz mesajlaşma yok.</li>
        @endforelse
    </ul>
</div>
@endsection
