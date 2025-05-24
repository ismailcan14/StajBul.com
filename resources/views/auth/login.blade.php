<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>

    <!-- Harici CSS -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <!-- Google Font (opsiyonel) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

<div class="login-container">
 <form method="POST" action="{{ route('login') }}" class="login-box animate">
    @csrf

    {{-- Logo üstte ortalı --}}
    <div class="logo-wrapper">
        <img src="{{ asset('images/stajbul-logo.png') }}" alt="StajBul Logo">
    </div>

    <h2>Giriş Yap</h2>

    @if ($errors->any())
        <div class="error-message">
            {{ $errors->first() }}
        </div>
    @endif

    <input name="email" type="email" placeholder="E-posta" required>
    <input name="password" type="password" placeholder="Şifre" required>

    {{-- ✅ Beni Hatırla kutusu --}}
    <div class="remember-me-wrapper">
    <input type="checkbox" name="remember" id="remember">
    <label for="remember">Beni Hatırla</label>
</div>

    <button type="submit">Giriş Yap</button>
</form>

</div>

<!-- Harici JS -->
<script src="{{ asset('js/script.js') }}"></script>

</body>
</html>
