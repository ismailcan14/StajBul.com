@extends('layouts.admin')

@section('title', 'İlan Detayı')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">📄 İlan Detayları</h3>

    <div class="card shadow">
        <div class="card-body">
            <h5 class="card-title">{{ $posting->title }}</h5>
            <p><strong>Şirket:</strong> {{ $posting->company->company_name ?? '-' }}</p>
            <p><strong>Şehir:</strong> {{ $posting->city }}</p>
            <p><strong>Kontenjan:</strong> {{ $posting->quota }}</p>
            <p><strong>Son Başvuru:</strong> {{ $posting->application_deadline }}</p>
            <p><strong>Açıklama:</strong><br>{{ $posting->description }}</p>
        </div>
    </div>

    <div class="mt-4 d-flex gap-2">
       
        <a href="{{ route('admin.applications.index') }}" class="btn btn-secondary">Geri Dön</a>
    </div>
</div>
@endsection