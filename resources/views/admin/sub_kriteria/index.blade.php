@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Sub Kriteria</h1>
        <a href="{{ route('admin.sub-kriteria.create') }}" class="btn btn-primary btn-sm px-3">
            <i class="bi bi-plus-lg"></i> Tambah Sub Kriteria
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        @foreach($criterias as $criteria)
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $criteria->kode }} - {{ $criteria->nama }}</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table text-nowrap table-striped table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Pilihan</th>
                                <th>Nilai (Bobot)</th>
                                <th width="120" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($criteria->subKriteria as $sub)
                                <tr>
                                    <td>{{ $sub->nama }}</td>
                                    <td><span class="badge bg-secondary">{{ $sub->nilai }}</span></td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('admin.sub-kriteria.edit', $sub->id) }}" class="btn btn-sm btn-warning text-dark text-nowrap d-inline-flex align-items-center gap-1" style="height: 31px; padding: 0.25rem 0.75rem;" title="Edit">
                                                <i class="bi bi-pencil-square"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.sub-kriteria.destroy', $sub->id) }}" class="m-0" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger text-nowrap d-inline-flex align-items-center gap-1" style="height: 31px; padding: 0.25rem 0.75rem;" title="Hapus">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-3">Belum ada pilihan sub-kriteria.</td>
                                </tr>
                            @endforelse
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection