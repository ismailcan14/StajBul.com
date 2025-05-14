@extends('layouts.app')

@section('title', $posting->title)

@section('content')
<div class="container my-5">
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h2 class="card-title text-primary">{{ $posting->title }}</h2>
                    <p class="mb-2"><strong>🏢 Şirket:</strong> {{ $posting->company->company_name }}</p>
                    <p class="mb-2"><strong>📍 Şehir:</strong> {{ $posting->city }}</p>
                    <p class="mb-2"><strong>👥 Kontenjan:</strong> {{ $posting->quota }}</p>
                    <p class="mb-2"><strong>⏳ Son Başvuru:</strong> {{ \Carbon\Carbon::parse($posting->application_deadline)->format('d.m.Y') }}</p>
                    <hr>
                    <p class="mt-3 text-muted" style="white-space: pre-line;">{{ $posting->description }}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h4 class="card-title mb-3 text-success">📄 Başvuru Yap</h4>

                    <form method="POST" action="{{ route('student.internships.apply', $posting->id) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="cover_letter" class="form-label fw-semibold">Ön Yazı</label>
                            <textarea name="cover_letter" class="form-control rounded-3" rows="4" placeholder="Kendinizden bahsedin..." required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="cv" class="form-label fw-semibold">CV Yükle (.pdf/.doc/.docx)</label>
                            <input type="file" name="cv" class="form-control rounded-3" accept=".pdf,.doc,.docx" required>
                        </div>

                        <button type="submit" class="btn btn-gradient w-100">
                            <i class="fas fa-paper-plane me-1"></i> Başvur
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
