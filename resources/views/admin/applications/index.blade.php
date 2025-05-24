@extends('layouts.admin')
@section('title', 'İlan Onayları')

@section('content')
<div class="container">
    <h3 class="mb-4">🛠 Onay Bekleyen İlanlar</h3>

    @if($postings->isEmpty())
        <div class="alert alert-info">Şu anda onay bekleyen ilan yok.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>İlan Başlığı</th>
                    <th>Şirket</th>
                    <th>Şehir</th>
                    <th>Son Başvuru</th>
                    <th>İşlem</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($postings as $posting)
                    <tr>
                        <td>{{ $posting->title }}</td>
                        <td>{{ $posting->company->company_name ?? '-' }}</td>
                        <td>{{ $posting->city }}</td>
                        <td>{{ $posting->application_deadline }}</td>
                        <td class="d-flex gap-2">
                        <a href="{{ route('admin.applications.show', $posting->id) }}" class="btn btn-info btn-sm">Detay</a>

                            <form action="{{ route('admin.applications.approve', $posting->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-success btn-sm">Onayla</button>
                            </form>
                            <form action="{{ route('admin.applications.reject', $posting->id) }}" method="POST" onsubmit="return confirm('Reddetmek istediğinize emin misiniz?');">
                                @csrf
                                <button class="btn btn-danger btn-sm">Reddet</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection