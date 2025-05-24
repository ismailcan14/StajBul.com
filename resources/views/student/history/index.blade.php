@extends('layouts.app')

@section('title', 'Staj Geçmişim')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 text-center fw-semibold text-dark">📁 Staj Geçmişim</h2>

    {{-- Aktif Stajlar --}}
    <div class="mb-5">
        <h4 class="text-success mb-3">🟢 Aktif Stajlar</h4>

        @php
            $activeInternships = $internships->filter(fn($i) => $i->end_date === null);
        @endphp

        @if($activeInternships->isEmpty())
            <div class="alert alert-info text-center">Aktif staj bulunmuyor.</div>
        @else
            <div class="table-responsive rounded shadow-sm">
                <table class="table table-hover table-bordered align-middle text-center bg-white">
                    <thead class="table-light">
                        <tr>
                            <th>Şirket</th>
                            <th>Başlangıç</th>
                            <th>Durum</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activeInternships as $internship)
                            <tr>
                                <td>{{ $internship->company->company_name ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($internship->start_date)->format('d.m.Y') }}</td>
                                <td><span class="badge bg-success">Devam Ediyor</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- Tamamlanan Stajlar --}}
    <div>
        <h4 class="text-primary mb-3">✅ Tamamlanan Stajlar</h4>

        @php
            $completedInternships = $internships->filter(fn($i) => $i->end_date !== null);
        @endphp

        @if($completedInternships->isEmpty())
            <div class="alert alert-info text-center">Tamamlanan staj bulunmuyor.</div>
        @else
            <div class="table-responsive rounded shadow-sm">
                <table class="table table-hover table-bordered align-middle text-center bg-white">
                    <thead class="table-light">
                        <tr>
                            <th>Şirket</th>
                            <th>Başlangıç</th>
                            <th>Bitiş</th>
                            <th>Rapor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($completedInternships as $internship)
                            <tr>
                                <td>{{ $internship->company->company_name ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($internship->start_date)->format('d.m.Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($internship->end_date)->format('d.m.Y') }}</td>
                                <td>
                                    @if($internship->report_file_url)
                                        <a href="{{ asset($internship->report_file_url) }}"
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
</div>
@endsection
