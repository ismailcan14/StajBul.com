@extends('layouts.admin')

@section('title', 'Yönetim Paneli')

@section('content')
<div class="container">
    <h3 class="mb-4 text-center fw-bold">📊 Yönetim Paneli</h3>

    <div class="row g-4">
        <!-- Kullanıcı Sayısı -->
        <div class="col-md-3">
            <div class="card text-white bg-primary shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Toplam Kullanıcı</h5>
                    <h2>{{ $userCount }}</h2>
                </div>
            </div>
        </div>

        <!-- Şirket Sayısı -->
        <div class="col-md-3">
            <div class="card text-white bg-success shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Toplam Şirket</h5>
                    <h2>{{ $companyCount }}</h2>
                </div>
            </div>
        </div>

        <!-- Aktif İlan -->
        <div class="col-md-3">
            <div class="card text-white bg-warning shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Onaylı İlan</h5>
                    <h2>{{ $approvedPostings }}</h2>
                </div>
            </div>
        </div>

        <!-- Onay Bekleyen İlan -->
        <div class="col-md-3">
            <div class="card text-white bg-danger shadow">
                <div class="card-body text-center">
                    <h5 class="card-title">Bekleyen İlan</h5>
                    <h2>{{ $pendingPostings }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection