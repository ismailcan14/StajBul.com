@extends('layouts.app')

@section('title', 'İlanlarım')

@section('content')
<div class="container mt-5">
    <h2>Yayınladığınız Staj İlanları</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse($internships as $internship)
        <div class="card mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong>{{ $internship->title }}</strong>
                <div>
                   <a href="{{ route('company.internships.edit', $internship->id) }}" class="btn btn-sm btn-warning">Düzenle</a>

                   <form action="{{ route('company.internships.destroy', $internship->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Sil</button>
</form>

                </div>
            </div>
            <div class="card-body">
                <p><strong>Şehir:</strong> {{ $internship->city }}</p>
                <p><strong>Kontenjan:</strong> {{ $internship->quota }}</p>
                <p><strong>Son Başvuru:</strong> {{ $internship->application_deadline }}</p>
                <p>{{ $internship->description }}</p>
            </div>
        </div>
    @empty
        <p>Henüz ilan yayınlamadınız.</p>
    @endforelse
</div>
@endsection
