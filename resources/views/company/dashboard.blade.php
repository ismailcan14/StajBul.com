@extends('layouts.app')

@section('title', 'Şirket Paneli')

@section('content')
<div class="container mt-5">
    <div class="d-flex align-items-center justify-content-between">
        <h1>{{-- Logo gösterimi --}}
        @php
            $logo = Auth::user()->company->logo ?? null;
        @endphp

        @if ($logo)
            <img src="{{ $logo }}" alt="Logo" style="height: 60px; object-fit: contain;">
        @endif Şirket Paneli</h1>
        
        
    </div>

    <p class="mt-3">Hoş geldiniz, {{ Auth::user()->name }}!</p>

    <div class="mt-4">
        <ul>
            <li><a href="{{ route('company.internships.create') }}">Staj İlanı Oluştur</a></li>
            <li><a href="{{ route('company.internships.index') }}">İlanlarımı Görüntüle / Düzenle</a></li>
            <li><a href="{{ route('company.applications.index') }}">Başvuruları Görüntüle</a></li>
            <li><a href="{{ route('company.profile.edit') }}">Profilini Düzenle</a></li>
        </ul>
    </div>
</div>
@endsection
