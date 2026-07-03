@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Sub Kriteria</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.sub-kriteria.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Kriteria Induk</label>
                            <select name="kriteria_id" class="form-select @error('kriteria_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Kriteria --</option>
                                @foreach($criterias as $criteria)
                                    <option value="{{ $criteria->id }}" {{ old('kriteria_id') == $criteria->id ? 'selected' : '' }}>
                                        {{ $criteria->kode }} - {{ $criteria->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kriteria_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Pilihan (Sub Kriteria)</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required placeholder="Contoh: Terang, Luas, Dingin">
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nilai Bobot (1-5)</label>
                            <input type="number" step="0.01" name="nilai" class="form-control @error('nilai') is-invalid @enderror" value="{{ old('nilai') }}" required placeholder="Contoh: 1, 3, 5">
                            <div class="form-text">Nilai ini digunakan untuk perhitungan Profile Matching (Gap) TOPSIS.</div>
                            @error('nilai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('admin.sub-kriteria.index') }}" class="btn btn-secondary me-2">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection