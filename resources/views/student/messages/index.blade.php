@extends('layouts.app')

@section('title', 'Şirketlerle Mesajlaş')

@section('content')
<div class="container my-5">
    <h4 class="text-center fw-semibold text-primary mb-4">💬 Şirketlerle Mesajlaş</h4>

    @if($companies->isEmpty())
        <div class="alert alert-info text-center">Mesajlaşabileceğiniz bir şirket bulunmamaktadır.</div>
    @else
        <ul class="list-group shadow-sm rounded-3">
            @foreach($companies as $company)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="fw-semibold text-dark">
                        <i class="fa-solid fa-building me-2 text-secondary"></i>{{ $company->company_name }}
                    </div>
                    <a href="{{ route('student.messages.chat', $company->id) }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-comments me-1"></i> Sohbete Git
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
