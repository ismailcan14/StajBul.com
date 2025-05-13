@extends('layouts.app')

@section('title', 'Profili Güncelle')

@section('content')
<div class="container">
    <div class="card shadow p-4 mx-auto" style="max-width: 600px;">
        <h4 class="mb-4 text-center"><i class="fas fa-user-edit me-2"></i>Profili Güncelle</h4>

        <form method="POST" action="{{ route('student.profile.update') }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">E-posta</label>
        <input type="email" class="form-control" id="email" name="email"
               value="{{ old('email', $user->email) }}" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Yeni Şifre</label>
        <input type="password" class="form-control" id="password" name="password"
               placeholder="Boş bırakırsan değişmez">
    </div>

    <div class="mb-3">
        <label for="class" class="form-label">Sınıf</label>
        <input type="text" class="form-control" id="class" name="class"
               value="{{ old('class', $student->class) }}" required>
    </div>

    <div class="mb-3">
        <label for="profile_photo" class="form-label">Profil Fotoğrafı Yükle</label>
        <input type="file" class="form-control" id="profile_photo" name="profile_photo">
    </div>

    <button type="submit" class="btn btn-primary w-100">
        <i class="fas fa-save me-1"></i> Kaydet
    </button>
</form>
    </div>
</div>
@endsection