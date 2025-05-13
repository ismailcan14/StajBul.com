<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Şirket Kayıt</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font & CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

<div class="login-container">
    <form method="POST" action="{{ route('register.company') }}" class="login-box animate">
        @csrf
        <h2>Şirket Kayıt</h2>

        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <input name="name" type="text" placeholder="Ad Soyad (Yetkili)" required>
        <input name="email" type="email" placeholder="E-posta" required>
        <input name="password" type="password" placeholder="Şifre" required>
        <input name="password_confirmation" type="password" placeholder="Şifre (Tekrar)" required>
        <input name="company_name" type="text" placeholder="Şirket Adı" required>
        <input name="tax_number" type="text" placeholder="Vergi Numarası" required>
        <input name="authorized_person" type="text" placeholder="Yetkili Kişi" required>
        <input name="address" type="text" placeholder="Adres" required>

        <button type="submit">Kayıt Ol</button>
    </form>
</div>

<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
