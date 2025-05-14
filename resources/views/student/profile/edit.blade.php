@extends('layouts.app')

@section('title', 'Profili Güncelle')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg p-4 mx-auto border-0 rounded-4" style="max-width: 600px;">
        <h4 class="mb-4 text-center fw-semibold text-primary">
            <i class="fas fa-user-edit me-2"></i> Profili Güncelle
        </h4>

        <form method="POST" action="{{ route('student.profile.update') }}" enctype="multipart/form-data">
            @csrf

            {{-- Profil Fotoğrafı --}}
            <div class="text-center mb-4">
                <label for="profile_photo" class="d-inline-block position-relative" style="cursor: pointer;">
                    <img src="{{ auth()->user()->student->profile_photo 
                        ? asset('storage/' . auth()->user()->student->profile_photo) 
                        : asset('images/default-image.jpg') }}"
                        alt="Profil Fotoğrafı"
                        id="profilePreview"
                        class="rounded-circle shadow border"
                        style="width: 110px; height: 110px; object-fit: cover;">
                    <div class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-1" style="font-size: 12px;">
                        <i class="fas fa-camera"></i>
                    </div>
                </label>
                <input type="file" class="d-none" id="profile_photo" name="profile_photo" accept="image/*" onchange="previewImage(event)">
            </div>

            {{-- E-posta --}}
            <div class="mb-3">
                <label for="email" class="form-label">E-posta</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="{{ old('email', $user->email) }}" required>
            </div>

            {{-- Eski Şifre --}}
            <div class="mb-3">
                <label for="current_password" class="form-label">Mevcut Şifre</label>
                <input type="password" class="form-control" id="current_password" name="current_password"
                    placeholder="Şifrenizi doğrulamak için girin">
            </div>

            {{-- Yeni Şifre --}}
            <div class="mb-3">
                <label for="password" class="form-label">Yeni Şifre</label>
                <input type="password" class="form-control" id="password" name="password"
                    placeholder="Yeni şifrenizi girin">
            </div>

            {{-- Yeni Şifre Tekrar --}}
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Yeni Şifre (Tekrar)</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    placeholder="Yeni şifreyi tekrar yazın">
            </div>

            {{-- Sınıf --}}
            <div class="mb-3">
                <label for="class" class="form-label">Sınıf</label>
                <input type="text" class="form-control" id="class" name="class"
                    value="{{ old('class', $student->class) }}" required>
            </div>

            <button type="submit" class="btn btn-gradient w-100 mt-3">
                <i class="fas fa-save me-1"></i> Kaydet
            </button>
        </form>
    </div>
</div>
@endsection
