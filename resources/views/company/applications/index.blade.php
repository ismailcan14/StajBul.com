@extends('layouts.app')

@section('title', 'Başvurular')

@section('content')
<div class="container mt-5">
    <h2>Başvurular</h2>

    @forelse($internshipPostings as $posting)
        <div class="card mt-4">
            <div class="card-header">
                <strong>{{ $posting->title }}</strong> - {{ $posting->city }}
            </div>
            <div class="card-body">
                @if($posting->applications->isEmpty())
                    <p>Henüz başvuru yapılmamış.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Öğrenci Adı</th>
                                <th>Öğrenci Numarası</th>
                                <th>Bölüm</th>
                                <th>Durum</th>
                                <th>Ön Yazı</th>
                                <th>CV</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posting->applications as $app)
                                <tr>
                                    <td>{{ $app->student->user->name }}</td>
                                    <td>{{ $app->student->student_number }}</td>
                                    <td>{{ $app->student->department->name ?? '-' }}</td>
                                    <td>{{ ucfirst($app->status) }}</td>
                                    <td>{{ $app->cover_letter ?? 'Yok' }}</td>
                                    <td>
    @if($app->cv_path)
       <a href="{{ asset('storage/' . $app->cv_path) }}" target="_blank" class="btn btn-sm btn-outline-primary">CV'yi Görüntüle</a>

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
        </div>
    @empty
        <p>Henüz ilan oluşturmadınız.</p>
    @endforelse
</div>
@endsection
