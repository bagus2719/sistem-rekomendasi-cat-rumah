<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Rekomendasi Warna Ruangan Rumah</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { 
            background-color: #f8f9fa; 
            font-family: 'Inter', sans-serif;
            color: #333;
            line-height: 1.6;
        }
        .navbar { border-bottom: 1px solid rgba(255,255,255,0.1); }
        .navbar-brand { font-weight: 700; letter-spacing: -0.5px; color: #ffffff !important; }
        .nav-link { font-weight: 500; color: rgba(255,255,255,0.85) !important; }
        .nav-link:hover { color: #ffffff !important; }
        .card { border-radius: 12px; border: 1px solid #f0f0f0 !important; }
        .card-header { border-bottom: 1px solid #f0f0f0; }
        .btn { font-weight: 500; border-radius: 8px; }
        h1, h2, h3, h4, h5, h6 { font-weight: 600; color: #212529; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary py-3 mb-5 shadow-sm">
        <div class="container-fluid px-3 px-lg-5">
            <a class="navbar-brand text-truncate" style="max-width: 75vw;" href="{{ route('home') }}">
                <span class="d-none d-md-inline">Sistem Rekomendasi Warna Ruangan Rumah</span>
                <span class="d-inline d-md-none fs-6">Sistem Rekomendasi Warna</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('recommendation.form') }}">Rekomendasi</a>
                    </li>
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Panel</a>
                            </li>
                        @endif
                        <li class="nav-item ms-lg-2 mt-2 mt-lg-0">
                            <form action="{{ route('logout') }}" method="POST" class="m-0 d-flex align-items-center h-100">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm px-4 py-2 fw-bold w-100 text-start text-lg-center"><i class="bi bi-box-arrow-right"></i> Logout ({{ auth()->user()->name }})</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item ms-lg-3 d-flex align-items-center">
                            <a class="btn btn-light btn-sm px-4 py-2 text-primary fw-bold" href="{{ route('login') }}"><i class="bi bi-person-circle me-1"></i> Login Admin</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid px-3 px-lg-5 pb-5">
        @yield('content')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
