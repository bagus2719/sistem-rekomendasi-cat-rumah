<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Sistem Rekomendasi Warna Ruangan Rumah</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f6f9; color: #2c3e50; }
        .card { border-radius: 10px; border: 1px solid #e9ecef !important; }
        .card-header { border-bottom: 1px solid #e9ecef; }
        .btn { font-weight: 500; border-radius: 6px; }
        .sidebar { position: fixed; top: 0; left: 0; bottom: 0; z-index: 1000; overflow-y: auto; background-color: #343a40; width: 250px; transition: all 0.3s; }
        .sidebar a { color: #c2c7d0; text-decoration: none; padding: 12px 15px; display: block; border-radius: 6px; margin-bottom: 5px; font-weight: 500; }
        .sidebar a:hover, .sidebar a.active { background-color: #495057; color: #fff; }
        .sidebar .brand { font-size: 1.25rem; font-weight: bold; color: #fff; padding: 15px; text-align: center; border-bottom: 1px solid #4f5962; margin-bottom: 15px; }
        .content { margin-left: 250px; padding: 20px; width: calc(100% - 250px); transition: all 0.3s; }
        .wrapper { display: flex; }
        .hamburger-btn { display: none; border: none; background: transparent; font-size: 1.5rem; color: #333; margin-right: 15px; cursor: pointer; }
        
        @media (max-width: 768px) {
            .sidebar { position: fixed; width: 250px !important; left: -250px; z-index: 1050; transition: left 0.3s ease; }
            .sidebar.show { left: 0; }
            .content { margin-left: 0; width: 100%; padding: 10px; }
            .sidebar-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1040; }
            .sidebar-overlay.show { display: block; }
            .hamburger-btn { display: inline-block; }
        }
    </style>
</head>
<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar p-3" style="width: 250px;">
            <div class="brand">Admin Panel</div>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-home me-2"></i> Dashboard
            </a>
            <a href="{{ route('admin.criterias.index') }}" class="{{ request()->routeIs('admin.criterias.*') ? 'active' : '' }}">
                <i class="fas fa-list me-2"></i> Kriteria
            </a>
            <a href="{{ route('admin.sub-kriteria.index') }}" class="{{ request()->routeIs('admin.sub-kriteria.*') ? 'active' : '' }}">
                <i class="fas fa-tags me-2"></i> Sub Kriteria
            </a>
            <a href="{{ route('admin.alternatives.index') }}" class="{{ request()->routeIs('admin.alternatives.*') ? 'active' : '' }}">
                <i class="fas fa-palette me-2"></i> Alternatif Warna
            </a>
            <a href="{{ route('admin.alternative-values.index') }}" class="{{ request()->routeIs('admin.alternative-values.*') ? 'active' : '' }}">
                <i class="fas fa-star-half-alt me-2"></i> Nilai Alternatif
            </a>
            <a href="{{ route('admin.ahp.index') }}" class="{{ request()->routeIs('admin.ahp.*') ? 'active' : '' }}">
                <i class="fas fa-calculator me-2"></i> Matriks AHP
            </a>
            
            <hr class="text-secondary mt-5">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger text-start w-100" style="padding: 10px 15px;">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded mb-4 p-3">
                <div class="container-fluid">
                    <div class="d-flex align-items-center">
                        <button class="hamburger-btn" id="sidebarToggle"><i class="fas fa-bars"></i></button>
                        <span class="navbar-brand mb-0 h1">@yield('title', 'Dashboard')</span>
                    </div>
                    <div class="d-flex">
                        <span class="me-3 mt-1 text-muted"><i class="fas fa-user-circle"></i> {{ Auth::user()->name }}</span>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="container-fluid p-0">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.add('show');
            document.getElementById('sidebarOverlay').classList.add('show');
        });
        document.getElementById('sidebarOverlay').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.remove('show');
            this.classList.remove('show');
        });
    </script>
</body>
</html>
