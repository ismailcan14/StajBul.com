@extends('layouts.app')

@section('title', 'Başvurularım')

@section('content')
    <div class="container">
        <h2>📨 Başvurularım</h2>

        @if($applications->isEmpty())
            <p>Henüz bir başvuru yapmadınız.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>İlan Başlığı</th>
                        <th>Şirket</th>
                        <th>Şehir</th>
                        <th>Durum</th>
                        <th>Başvuru Tarihi</th>
                        <th>İşlem</th> <!-- Yeni sütun -->
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
                                        Beklemede
                                        @break
                                    @case('accepted')
                                        <span class="text-success">Kabul Edildi</span>
                                        @break
                                    @case('rejected')
                                        <span class="text-danger">Reddedildi</span>
                                        @break
                                @endswitch
                            </td>
                            <td>{{ $application->created_at->format('d.m.Y H:i') }}</td>
                            <td>
                                <form action="{{ route('student.applications.destroy', $application->id) }}" method="POST" onsubmit="return confirm('Başvuruyu iptal etmek istediğinize emin misiniz?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">İptal Et</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
