@extends('layouts.app')

@section('title', 'Şirket Paneli')

@section('content')

<div class="student-dashboard text-center">
    <h2 class="student-name">
        @php
            $logo = Auth::user()->company->logo ?? null;
        @endphp

        @if ($logo)
            <img src="{{ $logo }}" alt="Logo" style="height: 60px; object-fit: contain;" class="mb-3 d-block mx-auto">
        @endif
        {{ Auth::user()->company->company_name }}
    </h2>

    <div class="dashboard-grid mt-4">
        <a href="{{ route('company.internships.create') }}" class="dashboard-card">
            <i class="fa fa-plus"></i>
            <span>İlan Oluştur</span>
        </a>
        <a href="{{ route('company.internships.index') }}" class="dashboard-card">
            <i class="fa fa-list"></i>
            <span>İlanlarım</span>
        </a>
        <a href="{{ route('company.applications.index') }}" class="dashboard-card">
            <i class="fa fa-file-alt"></i>
            <span>Başvurular</span>
        </a>
        <a href="{{ route('company.interns.index') }}" class="dashboard-card">
            <i class="fa fa-users"></i>
            <span>Stajyerler</span>
        </a>
        <a href="{{ route('company.internships.completed') }}" class="dashboard-card">
            <i class="fa fa-check-circle"></i>
            <span>Tamamlananlar</span>
        </a>
        <a href="{{ route('company.messages.index') }}" class="dashboard-card">
            <i class="fa fa-envelope"></i>
            <span>Mesajlar</span>
        </a>
        <a href="{{ route('company.profile.edit') }}" class="dashboard-card">
            <i class="fa fa-pen"></i>
            <span>Profili Düzenle</span>
        </a>
    </div>
</div>

@endsection
