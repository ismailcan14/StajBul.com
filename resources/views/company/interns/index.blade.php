@extends('layouts.app')

@section('title', 'Aktif Stajyerler')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">🎓 Aktif Stajyerler</h2>

    <div class="mb-3">
        <a href="{{ route('company.interns.index', ['filter' => 'active']) }}" class="btn btn-sm {{ $currentFilter === 'active' ? 'btn-success' : 'btn-outline-success' }}">Aktif</a>
        <a href="{{ route('company.interns.index', ['filter' => 'accepted']) }}" class="btn btn-sm {{ $currentFilter === 'accepted' ? 'btn-primary' : 'btn-outline-primary' }}">Onaylı Ama Başlamamış</a>
        <a href="{{ route('company.interns.index', ['filter' => 'rejected']) }}" class="btn btn-sm {{ $currentFilter === 'rejected' ? 'btn-danger' : 'btn-outline-danger' }}">Reddedilenler</a>
    </div>

    @if($internships->isEmpty())
        <div class="alert alert-info text-center">Henüz aktif stajyer yok.</div>
    @else
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>👤 Ad Soyad</th>
                    <th>📄 İlan</th>
                    <th>📅 Başlangıç Tarihi</th>
                    <th>🛠 İşlem</th>
                </tr>
            </thead>
            <tbody>
                @foreach($internships as $intern)
                    <tr>
                        <td>{{ $intern->student->user->name }}</td>
                        <td>{{ $intern->internshipPosting->title ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($intern->start_date)->format('d.m.Y') }}</td>
                        <td>
                            <a href="{{ route('company.internships.complete', $intern->id) }}" class="btn btn-sm btn-outline-secondary">
                                Stajı Bitir
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
