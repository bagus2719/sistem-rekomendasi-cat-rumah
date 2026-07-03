@extends('admin.layouts.admin')

@section('title', 'Tambah Kriteria')

@section('content')
<div class="card shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('admin.criterias.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Kode Kriteria</label>
                <input type="text" name="kode" class="form-control @error('kode') is-invalid @enderror" value="{{ old('kode') }}" placeholder="C1" required>
                @error('kode')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Kriteria</label>
                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" placeholder="Contoh: Pencahayaan" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Tipe Kriteria</label>
                <select name="tipe" class="form-select @error('tipe') is-invalid @enderror" required>
                    <option value="">Pilih Tipe</option>
                    <option value="benefit" {{ old('tipe') == 'benefit' ? 'selected' : '' }}>Benefit (Semakin besar semakin baik)</option>
                    <option value="cost" {{ old('tipe') == 'cost' ? 'selected' : '' }}>Cost (Semakin kecil semakin baik)</option>
                </select>
                @error('tipe')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan Kriteria</button>
            <a href="{{ route('admin.criterias.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection