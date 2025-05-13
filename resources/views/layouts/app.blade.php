<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StajBul | @yield('title', 'Panel')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Özel Stil -->
    <link rel="stylesheet" href="{{ asset('css/student/student-dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/student/internship-detail.css') }}">
<script src="{{ asset('js/internship-detail.js') }}" defer></script>


    <style>
        body {  
            background-color: #f2f4f8;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding-top: 70px;
        }

            .navbar {
    background: linear-gradient(90deg, #2563eb 0%, #4f46e5 100%);
}

            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        

        .navbar-brand {
            font-weight: bold;
            font-size: 20px;
            color: white !important;
        }

        .nav-link {
            color: white !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            opacity: 1;
    text-decoration: underline;
        }

        .container {
            max-width: 1200px;
        }

        footer {
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>

    <!-- Navbar -->


    <nav class="navbar fixed-top navbar-expand-lg navbar-dark py-0" style="height: 70px;">
    <div class="container">

        <!-- LOGO -->
       @php
    $user = Auth::user();
    $dashboardUrl = '/'; // varsayılan: anasayfa

    if ($user && $user->student) {
        $dashboardUrl = route('student.dashboard');
    } elseif ($user && $user->company) {
        $dashboardUrl = route('company.dashboard');
    }
@endphp

<a class="navbar-brand d-flex align-items-center h-100" href="{{ $dashboardUrl }}">
    <img src="{{ asset('images/logo.png') }}" alt="StajBul Logo" class="stajbul-logo">
</a>


        <!-- Mobil Menü Butonu -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menü -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-right-from-bracket me-1"></i> Çıkış Yap
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endauth

                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login.form') }}">Giriş</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register.student.form') }}">Öğrenci Kayıt</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register.company.form') }}">Şirket Kayıt</a></li>
                @endguest
            </ul>
        </div>
    </div>
</nav>


    <!-- İçerik -->
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="mt-5">
        © {{ date('Y') }} StajBul.com — Tüm hakları saklıdır.
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
