<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Öğrenci Kayıt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font & CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}"> {{-- Girişle aynı CSS --}}
</head>
<body>

<div class="login-container">
    <form method="POST" action="{{ route('register.student') }}" class="login-box animate">
        @csrf
        <h2>Öğrenci Kayıt</h2>

        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <input name="name" type="text" placeholder="Ad Soyad" required>
        <input name="email" type="email" placeholder="E-posta" required>
        <input name="password" type="password" placeholder="Şifre" required>
        <input name="password_confirmation" type="password" placeholder="Şifre (Tekrar)" required>
        <input name="student_number" type="text" placeholder="Öğrenci No" required>

        <select name="department_id" required>
            <option value="">Bölüm Seçiniz</option>
            @foreach($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        </select>

        <input name="class" type="text" placeholder="Sınıf" required>

        <button type="submit">Kayıt Ol</button>
    </form>
</div>

<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
