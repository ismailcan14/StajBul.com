@extends('layouts.app')

@section('title', 'Başvurularım')
@if(session('error'))
    <div class="alert alert-danger text-center">
        {{ session('error') }}
    </div>
@endif

@section('content')
<div class="container">
    <h2 class="mb-4 text-center"><i class="fas fa-file-alt me-2"></i>Başvurularım</h2>

    @if ($applications->isEmpty())
        <div class="alert alert-info text-center">
            Henüz bir başvuru yapmadınız.
        </div>
    @else
        <div class="table-responsive shadow-sm">
            <table class="table table-hover table-bordered align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th>İlan Başlığı</th>
                        <th>Şirket</th>
                        <th>Şehir</th>
                        <th>Durum</th>
                        <th>Başvuru Tarihi</th>
                        <th>İşlem</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $application)
                        <tr>
                            <td>{{ $application->internshipPosting->title }}</td>
                            <td>{{ $application->internshipPosting->company->company_name ?? '-' }}</td>
                            <td>{{ $application->internshipPosting->city }}</td>
                            <td>
                                @switch($application->status)
                                    @case('pending')
                                        <span class="badge bg-warning text-dark">Beklemede</span>
                                        @break
                                    @case('accepted')
                                        <span class="badge bg-success">Kabul Edildi</span>
                                        @break
                                    @case('rejected')
                                        <span class="badge bg-danger">Reddedildi</span>
                                        @break
                                @endswitch
                            </td>
                            <td>{{ $application->created_at->format('d.m.Y H:i') }}</td>
                            <td class="d-flex flex-column gap-1">
                                @if($application->status === 'accepted')
                                    <form method="POST" action="{{ route('applications.confirm', $application->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-success w-100">
                                            <i class="fas fa-check-circle me-1"></i>Stajı Başlat
                                        </button>
                                    </form>
                                @endif

                                <form action="{{ route('student.applications.destroy', $application->id) }}" method="POST" class="delete-form">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-outline-danger w-100">
        <i class="fas fa-trash-alt me-1"></i>İptal Et
    </button>
</form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
