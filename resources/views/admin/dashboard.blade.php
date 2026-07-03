@extends('admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3 shadow-sm">
            <div class="card-body">
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                    <div>
                        <h5 class="card-title mb-0">Total Kriteria</h5>
                        <h2 class="mt-2 mb-0">{{ $criteria_count }}</h2>
                    </div>
                    <i class="fas fa-list fa-3x opacity-50"></i>
                </div>
            </div>
            <div class="card-footer bg-transparent border-top border-light border-opacity-25">
                <a href="{{ route('admin.criterias.index') }}" class="text-white text-decoration-none small">Lihat Detail <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3 shadow-sm">
            <div class="card-body">
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                    <div>
                        <h5 class="card-title mb-0">Alternatif Warna</h5>
                        <h2 class="mt-2 mb-0">{{ $alternative_count }}</h2>
                    </div>
                    <i class="fas fa-palette fa-3x opacity-50"></i>
                </div>
            </div>
            <div class="card-footer bg-transparent border-top border-light border-opacity-25">
                <a href="{{ route('admin.alternatives.index') }}" class="text-white text-decoration-none small">Lihat Detail <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-white bg-info mb-3 shadow-sm">
            <div class="card-body">
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                    <div>
                        <h5 class="card-title mb-0">Riwayat Penggunaan</h5>
                        <h2 class="mt-2 mb-0">{{ $history_count }}</h2>
                    </div>
                    <i class="fas fa-history fa-3x opacity-50"></i>
                </div>
            </div>
            <div class="card-footer bg-transparent border-top border-light border-opacity-25">
                <a href="#" class="text-white text-decoration-none small">Lihat Detail <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0">Selamat Datang di Admin Sistem Rekomendasi Warna Ruangan Rumah</h5>
            </div>
            <div class="card-body">
                <p>Gunakan menu di sidebar untuk mengelola kriteria, alternatif warna, dan perhitungan AHP.</p>
                <ul>
                    <li><strong>Kriteria:</strong> Atur kriteria yang digunakan.</li>
                    <li><strong>Alternatif Warna:</strong> Tambah/Edit warna yang tersedia.</li>
                    <li><strong>Nilai Alternatif:</strong> Berikan nilai untuk masing-masing warna berdasarkan kriteria.</li>
                    <li><strong>Matriks AHP:</strong> Tentukan tingkat kepentingan antar kriteria untuk mendapatkan bobot.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection