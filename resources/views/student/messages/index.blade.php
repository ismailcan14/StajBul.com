@extends('layouts.app')

@section('title', 'Şirketlerle Mesajlaş')

@section('content')
<div class="container">
    <h4>Mesajlaşmak istediğiniz şirketi seçin:</h4>
    <ul class="list-group mt-3">
        @foreach($companies as $company)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $company->company_name }}
                <a href="{{ route('student.messages.chat', $company->id) }}" class="btn btn-sm btn-primary">Sohbete Git</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection