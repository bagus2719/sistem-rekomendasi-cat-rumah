@extends('admin.layouts.admin')

@section('title', 'Kelola Alternatif Warna')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 py-3">
        <h5 class="mb-0">Daftar Alternatif Warna</h5>
        <a href="{{ route('admin.alternatives.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Warna
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table text-nowrap table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Warna (Jotun)</th>
                        <th>Kode Warna</th>
                        <th>Deskripsi</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($alternatives as $index => $alternative)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if($alternative->gambar_warna)
                                    <img src="{{ asset('storage/' . $alternative->gambar_warna) }}" alt="{{ $alternative->nama_warna }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px; border: 1px solid #ddd;">
                                @else
                                    <div style="width: 50px; height: 50px; background-color: #eee; border-radius: 5px; border: 1px solid #ddd; display: flex; align-items: center; justify-content: center; font-size: 10px; color: #999;">No Img</div>
                                @endif
                            </td>
                            <td class="align-middle">{{ $alternative->nama_warna }}</td>
                            <td class="align-middle">{{ $alternative->kode_warna }}</td>
                            <td class="align-middle">{{ Str::limit($alternative->deskripsi, 50) }}</td>
                            <td class="align-middle">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.alternatives.edit', $alternative->id) }}" class="btn btn-sm btn-warning text-dark text-nowrap d-inline-flex align-items-center gap-1">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.alternatives.destroy', $alternative->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus alternatif ini?')">
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
                            <td colspan="5" class="text-center py-3">Belum ada alternatif warna.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
