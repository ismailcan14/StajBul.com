@extends('layouts.app')

@section('title', 'Stajı Tamamla')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4">Stajı Tamamla: {{ $application->student->user->name }}</h3>

    <form action="{{ route('company.internships.store', $application->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="start_date" class="form-label">Staj Başlangıç Tarihi</label>
            <input type="date" class="form-control" name="start_date" required>
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">Staj Bitiş Tarihi</label>
            <input type="date" class="form-control" name="end_date" required>
        </div>

        <div class="mb-3">
            <label for="report_file" class="form-label">Staj Raporu / Belgesi</label>
            <input type="file" class="form-control" name="report_file" accept=".pdf,.doc,.docx" required>
        </div>

        <button type="submit" class="btn btn-success">Stajı Kaydet</button>
        <a href="{{ route('company.interns.index') }}" class="btn btn-secondary">Geri Dön</a>
    </form>
</div>
@endsection
