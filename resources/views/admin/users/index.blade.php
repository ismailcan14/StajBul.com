@extends('layouts.admin')

@section('title', 'Kullanıcılar')

@section('content')
<div class="container">
    <h3 class="mb-4">👤 Kullanıcı Listesi</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark text-white text-center">
            <tr>
                <th>Ad Soyad</th>
                <th>E-posta</th>
                <th>Rol</th>
                <th>İşlem</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-info">Detay</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Sil</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection