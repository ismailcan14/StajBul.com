@extends('layouts.app')

@section('title', 'Aktif Stajım')

@section('content')
<div class="container my-5">
    <h3 class="text-center fw-semibold mb-4 text-primary">📌 Aktif Stajım</h3>

    @if($internship)
        <div class="card shadow-sm border-0 rounded-4 p-4">
            <h5 class="fw-semibold text-dark mb-3">
                🏢 Şirket: {{ $internship->company->company_name }}
            </h5>
            <p><strong>📅 Başlangıç Tarihi:</strong> {{ \Carbon\Carbon::parse($internship->start_date)->format('d.m.Y') }}</p>

            <p>
                <strong>📄 Rapor Dosyası:</strong>
                @if($internship->report_file_url)
                    <a href="{{ asset('storage/' . $internship->report_file_url) }}"
                       class="btn btn-sm btn-outline-primary ms-2"
                       target="_blank">
                        <i class="fas fa-file-alt me-1"></i> Görüntüle
                    </a>
                @else
                    <span class="text-muted ms-2">Henüz yüklenmedi.</span>
                @endif
            </p>
        </div>
    @else
        <div class="alert alert-info text-center">
            Şu anda aktif bir stajınız bulunmamaktadır.
        </div>
    @endif
</div>
@endsection
