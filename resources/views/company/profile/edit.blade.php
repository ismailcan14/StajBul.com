@extends('layouts.app')

@section('title', 'Profil Düzenle')

@section('content')
<div class="container mt-5">
    <h2>Profil Bilgilerini Düzenle</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('company.profile.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Şirket Adı</label>
            <input type="text" name="company_name" class="form-control" value="{{ old('company_name', $company->company_name) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Vergi Numarası</label>
            <input type="text" name="tax_number" class="form-control" value="{{ old('tax_number', $company->tax_number) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Yetkili Kişi</label>
            <input type="text" name="authorized_person" class="form-control" value="{{ old('authorized_person', $company->authorized_person) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Adres</label>
            <textarea name="address" class="form-control" rows="3">{{ old('address', $company->address) }}</textarea>
        </div>

        <div class="mb-3">
    <label class="form-label">Logo URL (isteğe bağlı)</label>
    @if ($company->logo)
        <div class="mb-2">
            <img src="{{ $company->logo }}" alt="Logo" height="80">
        </div>
    @endif
    <input type="url" name="logo" class="form-control" value="{{ old('logo', $company->logo) }}">
</div>


        <button type="submit" class="btn btn-primary">Güncelle</button>
    </form>
</div>
@endsection
