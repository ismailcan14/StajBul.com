@extends('layouts.app')

@section('title', 'Şirket Paneli')

@section('content')
<div class="text-center mb-5">
    <h2 class="fw-bold">
        @php
            $logo = Auth::user()->company->logo ?? null;
        @endphp

        @if ($logo)
            <img src="{{ $logo }}" alt="Logo" style="height: 60px; object-fit: contain;" class="mb-3">
        @endif
        <br>
        {{ Auth::user()->company->company_name }}
    </h2>
</div>

<div class="d-flex flex-wrap justify-content-center gap-4">
    <a href="{{ route('company.internships.create') }}" class="btn btn-lg btn-gradient text-center">
        <i class="fa fa-plus mb-2"></i><br>İlan Oluştur
    </a>

    <a href="{{ route('company.internships.index') }}" class="btn btn-lg btn-gradient text-center">
        <i class="fa fa-list mb-2"></i><br>İlanlarım
    </a>

    <a href="{{ route('company.applications.index') }}" class="btn btn-lg btn-gradient text-center">
        <i class="fa fa-file-alt mb-2"></i><br>Başvurular
    </a>

    <a href="{{ route('company.interns.index') }}" class="btn btn-lg btn-gradient text-center">
        <i class="fa fa-users mb-2"></i><br>Stajyerler
    </a>

    <a href="{{ route('company.internships.completed') }}" class="btn btn-lg btn-gradient text-center">
        <i class="fa fa-check-circle mb-2"></i><br>Tamamlanan Stajlar
    </a>

    <a href="{{ route('company.messages.index') }}" class="btn btn-lg btn-gradient text-center">
        <i class="fa fa-envelope mb-2"></i><br>Mesajlar
    </a>

    <a href="{{ route('company.profile.edit') }}" class="btn btn-lg btn-gradient text-center">
        <i class="fa fa-pen mb-2"></i><br>Profili Düzenle
    </a>
</div>
@endsection
