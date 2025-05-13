@extends('layouts.app')

@section('title', 'Tamamlanan Stajlar')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Tamamlanan Stajlar</h2>

    @if($internships->isEmpty())
        <div class="alert alert-info text-center">Henüz tamamlanan staj yok.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Öğrenci Adı</th>
                    <th>Staj Başlangıç</th>
                    <th>Staj Bitiş</th>
                    <th>Rapor Belgesi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($internships as $intern)
                    <tr>
                        <td>{{ $intern->student->user->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($intern->start_date)->format('d.m.Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($intern->end_date)->format('d.m.Y') }}</td>
                        <td>
                            <a href="{{ asset($intern->report_file_url) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                Görüntüle / İndir
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
