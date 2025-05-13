@extends('layouts.app')

@section('title', 'Staj Geçmişim')

@section('content')
<div class="container">
    <h2>📁 Staj Geçmişim</h2>

    @if($internships->isEmpty())
        <p>Henüz bir staj geçmişi bulunmuyor.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Şirket</th>
                    <th>Başlangıç</th>
                    <th>Bitiş</th>
                    <th>Rapor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($internships as $internship)
                    <tr>
                        <td>{{ $internship->company->company_name ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($internship->start_date)->format('d.m.Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($internship->end_date)->format('d.m.Y') }}</td>
                        <td>
                            @if($internship->report_file_url)
                                <a href="{{ asset('storage/' . $internship->report_file_url) }}" target="_blank">Raporu Görüntüle</a>
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