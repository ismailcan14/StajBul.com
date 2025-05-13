@extends('layouts.app')

@section('title', 'Staj İlanları')

@section('content')
    <div class="container">
        <h2>📋 Staj İlanları</h2>

        @if($postings->isEmpty())
            <p>Şu anda aktif ilan bulunmamaktadır.</p>
        @else
            <div class="row">
                @foreach($postings as $post)
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{{ \Illuminate\Support\Str::limit($post->description, 100) }}</p>
                                <p><strong>Şehir:</strong> {{ $post->city }}</p>
                                <p><strong>Kontenjan:</strong> {{ $post->quota }}</p>
                                <p><strong>Son Başvuru:</strong> {{ $post->application_deadline }}</p>
                                <a href="{{ route('student.internships.show', $post->id) }}" class="btn btn-primary">Detay</a>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection