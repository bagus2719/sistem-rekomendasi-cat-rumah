@extends('admin.layouts.admin')

@section('title', 'Edit Alternatif Warna')

@section('content')
<div class="card shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('admin.alternatives.update', $alternative->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label">Nama Warna</label>
                <input type="text" name="nama_warna" class="form-control @error('nama_warna') is-invalid @enderror" value="{{ old('nama_warna', $alternative->nama_warna) }}" required>
                @error('nama_warna')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Kode Warna (Jotun)</label>
                <input type="text" name="kode_warna" class="form-control @error('kode_warna') is-invalid @enderror" value="{{ old('kode_warna', $alternative->kode_warna) }}" required>
                @error('kode_warna')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Upload Foto / Gambar Warna (Kosongkan jika tidak ingin mengubah)</label>
                @if($alternative->gambar_warna)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $alternative->gambar_warna) }}" alt="Preview" class="img-thumbnail" style="max-width: 150px;">
                    </div>
                @endif
                <input type="file" name="gambar_warna" class="form-control @error('gambar_warna') is-invalid @enderror" accept="image/*">
                @error('gambar_warna')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3">{{ old('deskripsi', $alternative->deskripsi) }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Warna</button>
            <a href="{{ route('admin.alternatives.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
