<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>StajBul | Hoşgeldiniz</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts & CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <!-- Bootstrap 5 (modal için) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="hero">
    <h1>StajBul.com'a Hoşgeldiniz</h1>
    <p>Staj fırsatlarını keşfet, başvurunu yap, süreci takip et. Öğrenciler ve işverenler için en pratik staj platformu burada!</p>
    <div class="btn-group">
        <a href="{{ route('login.form') }}" class="home-btn">Giriş Yap</a>
        <!-- Kayıt modalini tetikleyen buton -->
        <button class="home-btn" data-bs-toggle="modal" data-bs-target="#registerModal">Kayıt Ol</button>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title w-100" id="registerModalLabel">Kayıt Türünü Seç</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
            </div>
            <div class="modal-body d-flex flex-column gap-3">
                <a href="{{ route('register.student.form') }}" class="btn btn-outline-primary">👨‍🎓 Öğrenci Kaydı</a>
                <a href="{{ route('register.company.form') }}" class="btn btn-outline-success">🏢 Şirket Kaydı</a>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <h2>Neden StajBul?</h2>
    <p>
        ✅ Kolay başvuru sistemi <br>
        ✅ Şirketlerle doğrudan iletişim <br>
        ✅ Onaylı ve güvenli staj ilanları <br>
        ✅ Başvuru sürecini adım adım takip etme imkânı
    </p>
</div>

<div class="section">
    <h2>Kimler Kullanabilir?</h2>
    <p>
        👨‍🎓 Üniversite öğrencileri staj ilanlarını inceleyip başvurabilir. <br>
        🏢 Şirketler ilan açarak uygun adaylara ulaşabilir. <br>
        👨‍🏫 Admin paneli ile tüm süreç merkezi olarak yönetilir.
    </p>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
