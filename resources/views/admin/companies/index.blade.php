@extends('layouts.admin')

@section('title', 'Şirketler')

@section('content')
<div class="container">
    <h3 class="mb-4">🏢 Kayıtlı Şirketler</h3>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if($companies->isEmpty())
        <div class="alert alert-info text-center">Kayıtlı şirket bulunmamaktadır.</div>
    @else
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-light">
                <tr>
                    <th>Şirket Adı</th>
                    <th>E-posta</th>
                    <th>Kayıt Tarihi</th>
                    <th>İşlem</th>
                </tr>
            </thead>
            <tbody>
                @foreach($companies as $company)
                    <tr>
                        <td>{{ $company->company_name }}</td>
                        <td>{{ $company->user->email ?? '-' }}</td>
                        <td>{{ $company->created_at->format('d.m.Y') }}</td>
                        <td class="d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.companies.show', $company->id) }}" class="btn btn-info btn-sm">Detay</a>
                            <form action="{{ route('admin.companies.destroy', $company->id) }}" method="POST" onsubmit="return confirm('Silmek istediğinize emin misiniz?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Sil</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection