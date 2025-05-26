@extends('layouts.app')

@section('title', 'Reddedilen Başvurular')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">❌ Reddedilen Başvurular</h2>

    <div class="mb-3">
        <a href="?filter=active" class="btn btn-sm btn-outline-success">Aktif</a>
        <a href="?filter=accepted" class="btn btn-sm btn-outline-primary">Onaylı Ama Başlamamış</a>
        <a href="?filter=rejected" class="btn btn-sm btn-danger">Reddedilenler</a>
    </div>

    @if($applications->isEmpty())
        <div class="alert alert-info text-center">Reddedilen başvuru bulunmamaktadır.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ad Soyad</th>
                    <th>İlan</th>
                    <th>Reddetme Tarihi</th>
                    <th>Ön Yazı</th>
                    <th>CV</th>
                </tr>
            </thead>
            <tbody>
                @foreach($applications as $app)
                    <tr>
                        <td>{{ $app->student->user->name }}</td>
                        <td>{{ $app->internshipPosting->title }}</td>
                        <td>{{ $app->updated_at->format('d.m.Y H:i') }}</td>
                        <td>{{ $app->cover_letter ?? 'Yok' }}</td>
                        <td>
                            @if($app->cv_path)
                                <a href="{{ asset('storage/' . $app->cv_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    CV'yi Görüntüle
                                </a>
                            @else
                                Yok
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
