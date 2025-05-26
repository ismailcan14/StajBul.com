@extends('layouts.app')

@section('title', 'Şirket Profilini Güncelle')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg p-4 mx-auto border-0 rounded-4" style="max-width: 600px;">
        <h4 class="mb-4 text-center fw-semibold text-primary">
            <i class="fas fa-building me-2"></i> Şirket Profilini Güncelle
        </h4>

        @if (session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('company.profile.update') }}" enctype="multipart/form-data">
            @csrf

            <div class="text-center mb-4">
                <label for="logo" class="d-inline-block position-relative" style="cursor: pointer;">
                    <img src="{{ $company->logo ? asset('storage/' . $company->logo) : asset('images/default-image.jpg') }}"
                        alt="Şirket Logosu"
                        id="profilePreview"
                        class="rounded-circle shadow border"
                        style="width: 110px; height: 110px; object-fit: cover;">
                    <div class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-1" style="font-size: 12px;">
                        <i class="fas fa-camera"></i>
                    </div>
                </label>
                <input type="file" class="d-none" id="logo" name="logo" accept="image/*" onchange="previewImage(event)">
            </div>

            <div class="mb-3">
                <label class="form-label">Şirket Adı</label>
                <input type="text" name="company_name" class="form-control"
                    value="{{ old('company_name', $company->company_name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Vergi Numarası</label>
                <input type="text" name="tax_number" class="form-control"
                    value="{{ old('tax_number', $company->tax_number) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Yetkili Kişi</label>
                <input type="text" name="authorized_person" class="form-control"
                    value="{{ old('authorized_person', $company->authorized_person) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Adres</label>
                <textarea name="address" class="form-control" rows="3">{{ old('address', $company->address) }}</textarea>
            </div>

            <button type="submit" class="btn btn-gradient w-100 mt-3">
                <i class="fas fa-save me-1"></i> Güncelle
            </button>
        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const output = document.getElementById('profilePreview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
