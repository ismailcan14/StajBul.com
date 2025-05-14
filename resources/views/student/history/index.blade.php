@extends('layouts.app')

@section('title', 'Staj Geçmişim')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 text-center fw-semibold text-dark">
        📁 Staj Geçmişim
    </h2>

    @if($internships->isEmpty())
        <div class="alert alert-info text-center">
            Henüz bir staj geçmişi bulunmuyor.
        </div>
    @else
        <div class="table-responsive rounded shadow-sm">
            <table class="table table-hover table-bordered align-middle text-center bg-white">
                <thead class="table-light">
                    <tr class="align-middle">
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
                                    <a href="{{ asset('storage/' . $internship->report_file_url) }}"
                                       class="btn btn-sm btn-outline-primary"
                                       target="_blank">
                                        <i class="fa fa-eye me-1"></i> Görüntüle
                                    </a>
                                @else
                                    <span class="text-muted">Yok</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
