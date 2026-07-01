@extends('admin.layouts.admin')

@section('title', 'Kelola Kriteria')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 py-3">
        <h5 class="mb-0">Daftar Kriteria</h5>
        <a href="{{ route('admin.criterias.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Kriteria
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table text-nowrap table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Kriteria</th>
                        <th>Tipe</th>
                        <th>Bobot (AHP)</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($criterias as $criteria)
                        <tr>
                            <td><strong>{{ $criteria->kode }}</strong></td>
                            <td>{{ $criteria->nama }}</td>
                            <td>
                                @if($criteria->tipe == 'benefit')
                                    <span class="badge bg-success">Benefit</span>
                                @else
                                    <span class="badge bg-danger">Cost</span>
                                @endif
                            </td>
                            <td>{{ number_format($criteria->bobot, 4) }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.criterias.edit', $criteria->id) }}" class="btn btn-sm btn-warning text-dark text-nowrap d-inline-flex align-items-center gap-1">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.criterias.destroy', $criteria->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kriteria ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger text-nowrap d-inline-flex align-items-center gap-1">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-3">Belum ada data kriteria.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
