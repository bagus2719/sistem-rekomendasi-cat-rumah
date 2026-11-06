@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white text-center pt-4 pb-0 border-0">
                <h4 class="mb-0">Form Rekomendasi</h4>
                <p class="text-muted small">Pilih kondisi ruangan Anda</p>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('recommendation.process') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">Kategori Warna (Opsional)</label>
                        <style>
                        .color-circle {
                            width: 45px;
                            height: 45px;
                            border-radius: 50%;
                            cursor: pointer;
                            transition: transform 0.2s, box-shadow 0.2s;
                            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                        }
                        .color-circle:hover {
                            transform: scale(1.15);
                        }
                        .color-choice input:checked + .color-circle {
                            box-shadow: 0 0 0 3px white, 0 0 0 6px #0d6efd;
                            transform: scale(1.15);
                        }
                        </style>
                        <div class="d-flex flex-wrap gap-3 mt-2 mb-2 p-1">
                            @php
                                $colorMap = [
                                    'Abu-abu' => '#95a5a6',
                                    'Beige' => '#F5F5DC',
                                    'Biru' => '#3498db',
                                    'Putih' => '#ffffff',
                                    'Cokelat' => '#8B4513',
                                    'Pink' => '#ff9ff3',
                                    'Oranye' => '#f39c12',
                                    'Hijau' => '#2ecc71',
                                    'Kuning' => '#f1c40f',
                                    'Ungu' => '#9b59b6',
                                    'Merah' => '#e74c3c'
                                ];
                            @endphp

                            <!-- Semua Kategori -->
                            <label class="color-choice" title="Semua Kategori">
                                <input type="radio" name="kategori" value="" checked class="d-none">
                                <div class="color-circle" style="background: conic-gradient(red, yellow, lime, aqua, blue, magenta, red); border: 2px solid transparent;"></div>
                            </label>

                            @foreach($categories as $cat)
                                @php
                                    $hex = $colorMap[$cat] ?? '#ccc';
                                    $border = ($hex == '#ffffff' || $hex == '#F5F5DC') ? '#ddd' : 'transparent';
                                @endphp
                                <label class="color-choice" title="{{ $cat }}">
                                    <input type="radio" name="kategori" value="{{ $cat }}" class="d-none">
                                    <div class="color-circle" style="background-color: {{ $hex }}; border: 1px solid {{ $border }};"></div>
                                </label>
                            @endforeach
                        </div>
                        <small class="text-muted d-block mt-2"><i class="bi bi-info-circle"></i> Klik lingkaran warna di atas untuk memfilter hasil. Default: Semua Warna.</small>
                    </div>

                    @foreach($criterias as $criteria)
                    <div class="mb-4">
                        <label class="form-label fw-bold">{{ $criteria->nama }}</label>
                        <select name="c{{ $criteria->id }}" class="form-select" required>
                            <option value="">Pilih {{ $criteria->nama }}...</option>
                            @foreach($criteria->subKriteria as $sub)
                                <option value="{{ $sub->nilai }}">{{ $sub->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endforeach

                    <button type="submit" class="btn btn-primary w-100 mt-2">Proses Rekomendasi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
