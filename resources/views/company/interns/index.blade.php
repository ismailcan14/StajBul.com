@extends('layouts.app')

@section('title', 'Stajyerler')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Stajyerler</h2>

    <div class="mb-3">
        <a href="?filter=active" class="btn btn-outline-success btn-sm">Aktif</a>
        <a href="?filter=completed" class="btn btn-outline-primary btn-sm">Önceki</a>
        <a href="?filter=rejected" class="btn btn-outline-danger btn-sm">Reddedilen</a>
    </div>

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
                @php
                    $status = $app->status;
                @endphp
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
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
