@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-5 mb-5">
    <div class="col-md-8 text-center">
        <h1 class="display-5 fw-bold mb-3">Sistem Rekomendasi Warna Ruangan Rumah</h1>
        <p class="lead mb-4">Temukan warna terbaik untuk ruangan Anda berdasarkan pencahayaan, luas, preferensi, dan psikologi warna menggunakan metode AHP dan TOPSIS.</p>
        
        <a href="{{ route('recommendation.form') }}" class="btn btn-primary btn-lg px-4 shadow-sm">Mulai Rekomendasi Sekarang</a>
    </div>
</div>

<div class="row mt-5 text-center">
    <div class="col-md-4 mb-4">
        <div class="card h-100 border-0 shadow-sm p-4">
            <h1 class="display-4 text-primary mb-3"><i class="bi bi-house-door"></i></h1>
            <h5 class="fw-bold">Kesesuaian Ruangan</h5>
            <p class="text-muted small">Rekomendasi disesuaikan dengan fungsi ruangan (Kamar Tidur, Ruang Tamu, dll).</p>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card h-100 border-0 shadow-sm p-4">
            <h1 class="display-4 text-warning mb-3"><i class="bi bi-sun"></i></h1>
            <h5 class="fw-bold">Kondisi Pencahayaan & Luas</h5>
            <p class="text-muted small">Warna yang direkomendasikan menyesuaikan tingkat cahaya dan luas ruangan Anda agar terasa lebih lega.</p>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card h-100 border-0 shadow-sm p-4">
            <h1 class="display-4 text-info mb-3"><i class="bi bi-emoji-smile"></i></h1>
            <h5 class="fw-bold">Psikologi Warna</h5>
            <p class="text-muted small">Menciptakan kesan yang Anda inginkan, apakah itu menenangkan, ceria, hangat, atau elegan.</p>
        </div>
    </div>
</div>
@endsection
