@extends('layouts.app')

@section('title', 'Onaylı Ama Başlamamış Başvurular')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">🕓 Onaylı Ama Başlamamış Öğrenciler</h2>

    <div class="mb-3">
        <a href="?filter=active" class="btn btn-sm btn-outline-success">Aktif</a>
        <a href="?filter=accepted" class="btn btn-sm btn-primary">Onaylı Ama Başlamamış</a>
        <a href="?filter=rejected" class="btn btn-sm btn-outline-danger">Reddedilenler</a>
    </div>

    @if($applications->isEmpty())
        <div class="alert alert-info text-center">Henüz staja başlamamış onaylı öğrenci yok.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ad Soyad</th>
                    <th>İlan</th>
                    <th>Durum</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $app)
                    <tr>
                        <td>{{ $app->student->user->name }}</td>
                        <td>{{ $app->internshipPosting->title }}</td>
                        <td><span class="badge bg-success">Kabul Edildi</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
