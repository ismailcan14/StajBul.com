@extends('layouts.admin')

@section('title', 'Oturum Süresi Ayarı')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">🕒 Oturum Süresi Ayarı</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form method="POST" action="{{ route('admin.settings.update') }}">

    @csrf
    <!-- @method('PUT') yok! -->
    <div class="mb-3">
        <label for="value" class="form-label">Oturum Süresi (dakika):</label>
        <input type="number" name="value" id="value" class="form-control" value="{{ old('value', $setting->value) }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Kaydet</button>
</form>


</div>
@endsection