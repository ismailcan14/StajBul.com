@extends('layouts.app')

@section('title', 'Staj İlanları')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 text-center fw-semibold text-dark">
        📋 Staj İlanları
    </h2>

    @if($postings->isEmpty())
        <div class="alert alert-info text-center">
            Şu anda aktif ilan bulunmamaktadır.
        </div>
    @else
        <div class="row g-4">
            @foreach($postings as $post)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0 rounded-3">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-semibold text-primary">{{ $post->title }}</h5>
                            <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit($post->description, 100) }}</p>

                            <ul class="list-unstyled mb-3 small">
                                <li><strong>📍 Şehir:</strong> {{ $post->city }}</li>
                                <li><strong>👥 Kontenjan:</strong> {{ $post->quota }}</li>
                                <li><strong>⏳ Son Başvuru:</strong> {{ \Carbon\Carbon::parse($post->application_deadline)->format('d.m.Y') }}</li>
                            </ul>

                            <a href="{{ route('student.internships.show', $post->id) }}" class="btn btn-outline-primary mt-auto">
                                <i class="fas fa-arrow-right me-1"></i> Detay
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
