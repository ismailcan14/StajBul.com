<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StajBul Admin | @yield('title', 'Panel')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>

    <div class="sidebar">
        <h4><i class="fa-solid fa-user-shield me-2"></i>Admin Paneli</h4>
        <a href="{{ route('admin.dashboard') }}"><i class="fas fa-chart-line me-2"></i> Dashboard</a>
        <a href="{{ route('admin.applications.index') }}"><i class="fas fa-clipboard-check me-2"></i> İlan Onayları</a>
        <a href="{{ route('admin.companies.index') }}" class="nav-link">
        <i class="fa-solid fa-building me-2"></i> Şirketler
    </a>
    <a class="nav-link" href="{{ route('admin.users.index') }}">
            <i class="fa fa-users me-1"></i> Kullanıcılar
        </a>
        <a class="nav-link" href="{{ route('admin.settings.edit') }}"><i class="fas fa-cog"></i> Oturum Süresi</a>
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt me-2"></i> Çıkış Yap
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    </div>

    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>