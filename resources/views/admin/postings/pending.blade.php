@extends('layouts.admin')
@section('title', 'Onay Bekleyen İlanlar')

@section('content')
<div class="container">
    <h3 class="mb-4">📋 Onay Bekleyen İlanlar</h3>

    @if($postings->isEmpty())
        <div class="alert alert-info">Şu anda onay bekleyen ilan yok.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Başlık</th>
                    <th>Şirket</th>
                    <th>Şehir</th>
                    <th>Son Başvuru</th>
                    <th>İşlem</th>
                </tr>
            </thead>
            <tbody>
                @foreach($postings as $posting)
                    <tr>
                        <td>{{ $posting->title }}</td>
                        <td>{{ $posting->company->company_name }}</td>
                        <td>{{ $posting->city }}</td>
                        <td>{{ $posting->application_deadline }}</td>
                        <td>
                            <a href="{{ route('admin.internship-postings.show', $posting->id) }}" class="btn btn-sm btn-primary">Detay</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection