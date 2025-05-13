@extends('layouts.app')

@section('title', 'Stajyerler')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Stajyerler</h2>

    @php
        $currentFilter = request('filter');
    @endphp

    <div class="mb-3">
        <a href="?filter=active" class="btn btn-sm {{ $currentFilter === 'active' ? 'btn-success' : 'btn-outline-success' }}">Aktif</a>
        <a href="?filter=completed" class="btn btn-sm {{ $currentFilter === 'completed' ? 'btn-primary' : 'btn-outline-primary' }}">Bekleyen</a>
        <a href="?filter=rejected" class="btn btn-sm {{ $currentFilter === 'rejected' ? 'btn-danger' : 'btn-outline-danger' }}">Reddedilen</a>
    </div>

    <table class="table table-bordered">
       <thead>
    <tr>
        <th>Ad Soyad</th>
        <th>İlan</th>
        <th>Durum</th>
        <th>İşlem</th>
    </tr>
</thead>
<tbody>
    @forelse($applications as $app)
        @php $status = $app->status; @endphp
        <tr>
            <td>{{ $app->student->user->name }}</td>
            <td>{{ $app->internshipPosting->title }}</td>
            <td>
                @if($status === 'accepted')
                    <span class="badge bg-success">Aktif</span>
                @elseif($status === 'rejected')
                    <span class="badge bg-danger">Reddedildi</span>
                @else
                    <span class="badge bg-warning text-dark">Bekliyor</span>
                @endif
            </td>
            <td>
                @if($status === 'accepted')
                    <a href="{{ route('company.internships.complete', ['application' => $app->id]) }}" class="btn btn-sm btn-outline-secondary">
                        Stajı Bitir
                    </a>
                @endif
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4" class="text-center">Bu filtreye uygun stajyer bulunamadı.</td>
        </tr>
    @endforelse
</tbody>

    </table>
</div>
@endsection
