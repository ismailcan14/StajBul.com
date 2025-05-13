@extends('layouts.app')

@section('title', 'Öğrenci Paneli')

@section('content')

    <div class="text-center mb-5">
        <h2 class="fw-bold">
             {{ Auth::user()->name }} {{ Auth::user()->surname }}<br>
        </h2>
    </div>

    <div class="d-flex flex-wrap justify-content-center gap-4">
        <a href="{{ route('student.profile') }}" class="btn btn-lg btn-gradient">
            <i class="fa fa-user mb-2"></i><br>Profilim
        </a>
        <a href="{{ route('student.internships.index') }}" class="btn btn-lg btn-gradient">
            <i class="fa fa-briefcase mb-2"></i><br>İlanlar
        </a>
        <a href="{{ route('student.applications.index') }}" class="btn btn-lg btn-gradient">
            <i class="fa fa-file-alt mb-2"></i><br>Başvurularım
        </a>
        <a href="{{ route('student.messages.index') }}" class="btn btn-lg btn-gradient">
            <i class="fa fa-envelope mb-2"></i><br>Mesajlar
        </a>
        <a href="{{ route('student.history.index') }}" class="btn btn-lg btn-gradient">
            <i class="fa fa-history mb-2"></i><br>Staj Geçmişim
        </a>
    </div>
@endsection