@extends('layouts.app')

@section('title', 'Öğrenci Paneli')

@section('content')

<div class="student-dashboard">
    <h2 class="student-name">{{ Auth::user()->name }} {{ Auth::user()->surname }}</h2>

    <div class="dashboard-grid">
        <a href="{{ route('student.profile') }}" class="dashboard-card">
            <i class="fa fa-user"></i>
            <span>Profilim</span>
        </a>
        <a href="{{ route('student.internships.index') }}" class="dashboard-card">
            <i class="fa fa-briefcase"></i>
            <span>İlanlar</span>
        </a>
        <a href="{{ route('student.applications.index') }}" class="dashboard-card">
            <i class="fa fa-file-alt"></i>
            <span>Başvurularım</span>
        </a>
        <a href="{{ route('student.internship.active') }}" class="dashboard-card">
            <i class="fa-solid fa-briefcase"></i>
            <span>Aktif Stajım</span>
        </a>
        <a href="{{ route('student.messages.index') }}" class="dashboard-card">
            <i class="fa fa-envelope"></i>
            <span>Mesajlar</span>
        </a>
        <a href="{{ route('student.history.index') }}" class="dashboard-card">
            <i class="fa fa-history"></i>
            <span>Staj Geçmişim</span>
        </a>
    </div>
</div>


@endsection
