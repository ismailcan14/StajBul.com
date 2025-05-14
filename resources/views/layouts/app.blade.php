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
<script src="{{ asset('js/student/internship-detail.js') }}" defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/student/student.js') }}" defer></script>
  
</head>
<body>

    <!-- Navbar -->
  

    <nav class="navbar fixed-top navbar-expand-lg navbar-dark py-3">
        <div class="container">
 

        <a class="navbar-brand d-flex align-items-center" href="{{ url('/student/dashboard') }}">
    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="stajbul-logo me-2">
</a>


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

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
