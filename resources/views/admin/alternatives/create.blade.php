@extends('admin.layouts.admin')

@section('title', 'Tambah Alternatif Warna')

@section('content')
<div class="card shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('admin.alternatives.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Nama Warna</label>
                <input type="text" name="nama_warna" class="form-control @error('nama_warna') is-invalid @enderror" value="{{ old('nama_warna') }}" placeholder="Contoh: Jotun Egg White" required>
                @error('nama_warna')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Kode Warna (Jotun)</label>
                <input type="text" name="kode_warna" class="form-control @error('kode_warna') is-invalid @enderror" value="{{ old('kode_warna') }}" placeholder="Contoh: 1001" required>
                @error('kode_warna')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Upload Foto / Gambar Warna</label>
                <input type="file" name="gambar_warna" class="form-control @error('gambar_warna') is-invalid @enderror" accept="image/*">
                <small class="text-muted">Format yang diizinkan: JPG, JPEG, PNG, WEBP. Maksimal 2MB.</small>
                @error('gambar_warna')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3" placeholder="Kesan atau deskripsi warna">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan Warna</button>
            <a href="{{ route('admin.alternatives.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
