@extends('layouts.app')

@section('title', 'İlan Düzenle')

@section('content')
<div class="container mt-5">
    <h2>Staj İlanını Düzenle</h2>

    <form action="{{ route('company.internships.update', $internship->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Başlık</label>
            <input type="text" name="title" value="{{ old('title', $internship->title) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Açıklama</label>
            <textarea name="description" class="form-control">{{ old('description', $internship->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Kontenjan</label>
            <input type="number" name="quota" value="{{ old('quota', $internship->quota) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Şehir</label>
            <input type="text" name="city" value="{{ old('city', $internship->city) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Son Başvuru Tarihi</label>
            <input type="date" name="application_deadline" value="{{ old('application_deadline', $internship->application_deadline->format('Y-m-d')) }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Güncelle</button>
    </form>
</div>
@endsection
