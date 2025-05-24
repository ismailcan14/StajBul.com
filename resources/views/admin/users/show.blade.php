@extends('layouts.admin')

@section('title', 'Kullanıcı Detay')

@section('content')
<div class="container">
    <h3 class="mb-4">👤 {{ $user->name }}</h3>

    <ul class="list-group">
        <li class="list-group-item"><strong>E-posta:</strong> {{ $user->email }}</li>
        <li class="list-group-item"><strong>Rol:</strong> {{ ucfirst($user->role) }}</li>

        @if($user->role === 'student')
            <li class="list-group-item"><strong>Öğrenci No:</strong> {{ $user->student->student_number ?? '-' }}</li>
            <li class="list-group-item"><strong>Sınıf:</strong> {{ $user->student->class ?? '-' }}</li>
        @elseif($user->role === 'company')
            <li class="list-group-item"><strong>Şirket Adı:</strong> {{ $user->company->company_name ?? '-' }}</li>
            <li class="list-group-item"><strong>Yetkili:</strong> {{ $user->company->authorized_person ?? '-' }}</li>
        @endif
    </ul>
</div>
@endsection