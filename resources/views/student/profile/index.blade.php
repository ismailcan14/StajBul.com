@extends('layouts.app')

@section('title', 'Profilim')

@section('content')
<div class="container my-5 d-flex justify-content-center">
    <div class="card shadow-lg border-0 rounded-4 p-4" style="max-width: 420px; width: 100%;">
        <div class="text-center mb-4">
            <img src="{{ auth()->user()->student->profile_photo 
                ? asset('storage/' . auth()->user()->student->profile_photo) 
                : asset('images/default-image.jpg') }}"
                alt="{{ $user->name }}'nin Profil Fotoğrafı"
                class="rounded-circle shadow-sm border"
                style="width: 110px; height: 110px; object-fit: cover;">
        </div>

        <h4 class="text-center fw-bold mb-1">{{ $user->name }}</h4>
        <p class="text-center text-muted">{{ $user->email }}</p>

        <hr class="my-3">

        <div class="px-2">
            <p><i class="fas fa-user-graduate me-2 text-purple"></i><strong>Öğrenci No:</strong> {{ $student->student_number }}</p>
            <p><i class="fas fa-university me-2 text-orange"></i><strong>Bölüm:</strong> {{ $student->department->name }}</p>
            <p><i class="fas fa-layer-group me-2 text-cyan"></i><strong>Sınıf:</strong> {{ $student->class }}</p>
        </div>

        <a href="{{ route('student.profile.edit') }}" class="btn btn-gradient w-100 mt-4">
            <i class="fas fa-pen-to-square me-2"></i> Profili Güncelle
        </a>
    </div>
</div>
@endsection
