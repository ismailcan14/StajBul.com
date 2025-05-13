@extends('layouts.app')

@section('content')
    <h1>{{ $posting->title }}</h1>
    <p><strong>Şirket:</strong> {{ $posting->company->company_name }}</p>
    <p><strong>Açıklama:</strong> {{ $posting->description }}</p>
    <p><strong>Şehir:</strong> {{ $posting->city }}</p>
    <p><strong>Kontenjan:</strong> {{ $posting->quota }}</p>
    <p><strong>Son Başvuru:</strong> {{ $posting->application_deadline }}</p>

    <hr>
    <h3>Başvuru Yap</h3>
    <form method="POST" action="{{ route('student.internships.apply', $posting->id) }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="cv">CV Yükle:</label>
        <input type="file" name="cv" class="form-control" accept=".pdf,.doc,.docx" required>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Başvur</button>
</form>

@endsection