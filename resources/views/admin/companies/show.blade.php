@extends('layouts.admin')

@section('title', 'Şirket Detayı')

@section('content')
<div class="container">
    <h3 class="mb-4">📄 Şirket Detayı</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5><strong>Adı:</strong> {{ $company->company_name }}</h5>
            <p><strong>E-posta:</strong> {{ $company->user->email ?? '-' }}</p>
            <p><strong>Telefon:</strong> {{ $company->phone ?? '-' }}</p>
            <p><strong>Adres:</strong> {{ $company->address ?? '-' }}</p>
            <p><strong>Kayıt Tarihi:</strong> {{ $company->created_at->format('d.m.Y H:i') }}</p>
        </div>
    </div>

    <a href="{{ route('admin.companies.index') }}" class="btn btn-secondary mt-3">← Geri Dön</a>
</div>
@endsection