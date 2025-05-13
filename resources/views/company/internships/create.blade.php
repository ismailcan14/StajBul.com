@extends('layouts.app')

@section('title', 'Yeni Staj İlanı')

@section('content')
<div class="container mt-5">
    <h2>Yeni Staj İlanı Oluştur</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Hata!</strong> Lütfen formu doğru doldurduğunuzdan emin olun.
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('company.internships.store') }}">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Pozisyon Başlığı</label>
            <input type="text" class="form-control" name="title" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Açıklama</label>
            <textarea class="form-control" name="description" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="quota" class="form-label">Kontenjan</label>
            <input type="number" class="form-control" name="quota" min="1" required>
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">Şehir</label>
            <input type="text" class="form-control" name="city" required>
        </div>

        <div class="mb-3">
            <label for="application_deadline" class="form-label">Son Başvuru Tarihi</label>
            <input type="date" class="form-control" name="application_deadline" required>
        </div>

        <button type="submit" class="btn btn-primary">İlanı Oluştur</button>
    </form>
</div>
@endsection
