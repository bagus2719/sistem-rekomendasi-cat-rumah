@extends('admin.layouts.admin')

@section('title', 'Perhitungan Matriks AHP')

@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3">
                <div>
                    <h5 class="mb-0">Matriks Perbandingan Kriteria (AHP)</h5>
                    <small class="text-muted">Skala Penilaian: 1 (Sama penting), 3 (Cukup penting), 5 (Lebih penting), 7 (Sangat penting), 9 (Mutlak lebih penting). Gunakan nilai desimal (contoh: 0.33) untuk kebalikannya.</small>
                </div>
                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#uploadCsvModal">
                    <i class="fas fa-file-csv"></i> Upload CSV (Multi-Responden)
                </button>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.ahp.calculate') }}" method="POST">
                    @csrf
                    <div class="table-responsive">
                        <table class="table text-nowrap table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center align-middle" style="width: 150px;">Kriteria</th>
                                    @foreach($criterias as $c)
                                        <th class="text-center align-middle">{{ $c->kode }}<br><small class="fw-normal">{{ $c->nama }}</small></th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($criterias as $i => $c1)
                                    <tr>
                                        <td class="fw-bold align-middle">{{ $c1->kode }} - {{ $c1->nama }}</td>
                                        @foreach($criterias as $j => $c2)
                                            <td>
                                                @if($i == $j)
                                                    <input type="number" class="form-control text-center" value="1" disabled>
                                                @elseif($i < $j)
                                                    <select name="matrix[{{ $c1->id }}][{{ $c2->id }}]" class="form-select text-center matrix-select" style="min-width: 120px;" data-c1="{{ $c1->id }}" data-c2="{{ $c2->id }}">
                                                        @php
                                                            $options = [
                                                                '1' => '1 - Sama Penting',
                                                                '2' => '2',
                                                                '3' => '3 - Cukup Penting',
                                                                '4' => '4',
                                                                '5' => '5 - Lebih Penting',
                                                                '6' => '6',
                                                                '7' => '7 - Sangat Penting',
                                                                '8' => '8',
                                                                '9' => '9 - Mutlak Lebih Penting',
                                                                '0.5' => '1/2',
                                                                '0.3333' => '1/3',
                                                                '0.25' => '1/4',
                                                                '0.2' => '1/5',
                                                                '0.1667' => '1/6',
                                                                '0.1429' => '1/7',
                                                                '0.125' => '1/8',
                                                                '0.1111' => '1/9',
                                                            ];
                                                            $currentVal = isset($matrix[$c1->id][$c2->id]) ? round($matrix[$c1->id][$c2->id], 4) : 1;
                                                            $hasMatch = false;
                                                        @endphp
                                                        @foreach($options as $val => $label)
                                                            @php 
                                                                $isSelected = abs((float)$val - $currentVal) < 0.001; 
                                                                if($isSelected) $hasMatch = true;
                                                            @endphp
                                                            <option value="{{ $val }}" {{ $isSelected ? 'selected' : '' }}>{{ $label }}</option>
                                                        @endforeach
                                                        @if(!$hasMatch)
                                                            <option value="{{ $currentVal }}" selected>{{ $currentVal }} (Nilai CSV)</option>
                                                        @endif
                                                    </select>
                                                @else
                                                    @php
                                                        $inverseVal = isset($matrix[$c1->id][$c2->id]) ? round($matrix[$c1->id][$c2->id], 4) : 1;
                                                        $hasInvMatch = false;
                                                    @endphp
                                                    <select id="matrix_{{ $c1->id }}_{{ $c2->id }}" class="form-select text-center bg-light text-muted" style="min-width: 120px;" disabled>
                                                        @foreach($options as $val => $label)
                                                            @php 
                                                                $isSelected = abs((float)$val - (float)$inverseVal) < 0.001; 
                                                                if($isSelected) $hasInvMatch = true;
                                                            @endphp
                                                            <option value="{{ $val }}" {{ $isSelected ? 'selected' : '' }}>{{ $label }}</option>
                                                        @endforeach
                                                        @if(!$hasInvMatch)
                                                            <option value="{{ $inverseVal }}" selected>{{ $inverseVal }} (Nilai CSV)</option>
                                                        @endif
                                                    </select>
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-calculator"></i> Hitung Matriks AHP
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const selects = document.querySelectorAll('.matrix-select');
        selects.forEach(select => {
            select.addEventListener('change', function() {
                const c1 = this.dataset.c1;
                const c2 = this.dataset.c2;
                const val = parseFloat(this.value);
                
                // Calculate inverse value
                const inverseVal = 1 / val;
                
                // Find closest option value for inverse
                const inverseSelect = document.getElementById('matrix_' + c2 + '_' + c1);
                if (inverseSelect) {
                    let closestOption = inverseSelect.options[0];
                    let minDiff = Math.abs(parseFloat(closestOption.value) - inverseVal);
                    
                    for (let i = 1; i < inverseSelect.options.length; i++) {
                        let diff = Math.abs(parseFloat(inverseSelect.options[i].value) - inverseVal);
                        if (diff < minDiff) {
                            minDiff = diff;
                            closestOption = inverseSelect.options[i];
                        }
                    }
                    
                    inverseSelect.value = closestOption.value;
                }
            });
        });
    });
    </script>
        </div>
    </div>

    @if($results)
    <div class="col-md-12">
        <div class="card shadow-sm mb-4">
            <div class="card-header {{ $results['is_consistent'] ? 'bg-success text-white' : 'bg-danger text-white' }} py-3">
                <h5 class="mb-0">
                    Hasil Perhitungan 
                    @if($results['is_consistent'])
                        <span class="badge bg-white text-success ms-2">Konsisten</span>
                    @else
                        <span class="badge bg-white text-danger ms-2">Tidak Konsisten (Mohon perbaiki nilai matriks)</span>
                    @endif
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="alert alert-light border">
                            <strong>Consistency Index (CI):</strong> {{ number_format($results['ci'], 4) }}<br>
                            <strong>Consistency Ratio (CR):</strong> {{ number_format($results['cr'], 4) }}<br>
                            <strong>Lambda Max (λmax):</strong> {{ number_format($results['lambdaMax'], 4) }}
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h6>Bobot Kriteria (Eigenvector)</h6>
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                                <tr>
                                    @foreach($results['kodes'] as $kode)
                                        <th class="text-center">{{ $kode }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach($results['weights'] as $weight)
                                        <td class="text-center fw-bold text-primary">{{ number_format($weight, 4) }}</td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Modal Upload CSV -->
    <div class="modal fade" id="uploadCsvModal" tabindex="-1" aria-labelledby="uploadCsvModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.ahp.uploadCsv') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-h5" id="uploadCsvModalLabel">Upload Dataset AHP (Multi-Responden)</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="small text-muted">Sistem akan otomatis menghitung <strong>Rata-rata Geometrik (Geometric Mean)</strong> dari seluruh baris responden di file CSV Anda.</p>
                        <div class="mb-3">
                            <label class="form-label">File CSV Dataset</label>
                            <input class="form-control" type="file" name="csv_file" accept=".csv" required>
                        </div>
                        <small class="d-block mb-2"><strong>Format Kolom Header yang Diwajibkan:</strong></small>
                        <pre class="bg-light p-2 rounded small">C1/C2,C1/C3,C1/C4,C1/C5,C2/C3,C2/C4,C2/C5,C3/C4,C3/C5,C4/C5</pre>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Proses & Hitung AHP</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
