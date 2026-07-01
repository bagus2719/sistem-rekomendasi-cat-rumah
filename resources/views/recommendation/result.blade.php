@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-success text-white text-center pt-3 pb-3">
                <h4 class="mb-0">Rekomendasi Warna Terbaik</h4>
            </div>
            <div class="card-body p-4 text-center">
                @if(isset($best_alternative))
                    @if($best_alternative->gambar_warna)
                        <img src="{{ asset('storage/' . $best_alternative->gambar_warna) }}" alt="{{ $best_alternative->nama_warna }}" class="img-fluid rounded shadow-sm mb-3" style="max-height: 200px;">
                    @else
                        <div class="display-1 text-muted">
                            <i class="fas fa-paint-roller"></i>
                        </div>
                    @endif
                    <h2 class="mt-3">{{ $best_alternative->nama_warna }} ({{ $best_alternative->kode_warna }})</h2>
                    <p class="text-muted">{{ $best_alternative->deskripsi }}</p>
                    <div class="badge bg-primary fs-6 mt-2">
                        Nilai Preferensi (Vi): {{ number_format($best_score, 4) }}
                    </div>
                @else
                    <h3 class="text-muted">Data simulasi belum tersedia.</h3>
                @endif
            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0 pt-4">
                <h5 class="mb-0">Ranking Keseluruhan</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Rank</th>
                                <th>Gambar</th>
                                <th>Warna (Jotun)</th>
                                <th>Kode Warna</th>
                                <th>Nilai Preferensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($rankings) && count($rankings) > 0)
                                @foreach($rankings as $index => $rank)
                                    <tr>
                                        <td><strong>{{ $index + 1 }}</strong></td>
                                        <td>
                                            @if($rank['alternative']->gambar_warna)
                                                <img src="{{ asset('storage/' . $rank['alternative']->gambar_warna) }}" alt="{{ $rank['alternative']->nama_warna }}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 5px; border: 1px solid #ddd;">
                                            @else
                                                <div style="width: 40px; height: 40px; background-color: #eee; border-radius: 5px; border: 1px solid #ddd; display: flex; align-items: center; justify-content: center; font-size: 10px; color: #999;">No Img</div>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            {{ $rank['alternative']->nama_warna }}
                                        </td>
                                        <td class="align-middle">{{ $rank['alternative']->kode_warna }}</td>
                                        <td class="align-middle">{{ number_format($rank['score'], 4) }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center py-3 text-muted">Belum ada perhitungan.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-4">
            <a href="{{ route('recommendation.form') }}" class="btn btn-secondary">Kembali ke Form</a>
        </div>
    </div>
</div>
@endsection
