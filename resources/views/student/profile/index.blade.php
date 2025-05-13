@extends('layouts.app')

@section('title', 'Profilim')

@section('content')
<div class="container text-center">
    <div class="card shadow p-4" style="max-width: 500px; margin: 0 auto;">
        <div class="mb-3">
        <img src="{{ auth()->user()->student->profile_photo 
             ? asset('storage/' . auth()->user()->student->profile_photo) 
             : asset('images/default-image.jpg') }}" 
     alt="{{ auth()->user()->name }}'nin Profil Fotoğrafı" 
     class="rounded-circle" 
     style="width: 100px; height: 100px;">

                 
        </div>
        <h4 class="mb-1">{{ $user->name }}</h4>
        <p class="text-muted">{{ $user->email }}</p>

        <hr>

        <div class="text-start">
            <p><strong>Öğrenci No:</strong> {{ $student->student_number }}</p>
            <p><strong>Bölüm:</strong> {{ $student->department->name }}</p>
            <p><strong>Sınıf:</strong> {{ $student->class }}</p>
        </div>

        <a href="{{ route('student.profile.edit') }}" class="btn btn-primary w-100 mt-3">
            <i class="fas fa-edit me-1"></i> Profili Güncelle
        </a>
    </div>
</div>
@endsection