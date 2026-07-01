@extends('admin.layouts.admin')

@section('title', 'Nilai Alternatif')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0">Input Nilai Alternatif Terhadap Kriteria</h5>
        <small class="text-muted">Masukkan nilai riil (angka) untuk masing-masing warna berdasarkan kriteria yang ada.</small>
    </div>
    <div class="card-body p-0">
        @if($alternatives->isEmpty() || $criterias->isEmpty())
            <div class="p-4 text-center text-muted">
                Silakan tambahkan data Kriteria dan Alternatif Warna terlebih dahulu.
            </div>
        @else
            <form action="{{ route('admin.alternative-values.store') }}" method="POST">
                @csrf
                <div class="table-responsive">
                    <table class="table text-nowrap table-bordered table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="align-middle">Alternatif / Warna</th>
                                @foreach($criterias as $criteria)
                                    <th class="text-center align-middle" style="min-width: 120px;">
                                        {{ $criteria->kode }}<br>
                                        <small class="text-muted fw-normal">{{ $criteria->nama }}</small>
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($alternatives as $alt)
                                <tr>
                                    <td class="align-middle fw-bold">{{ $alt->nama_warna }}</td>
                                    @foreach($criterias as $criteria)
                                        @php
                                            $key = $alt->id . '-' . $criteria->id;
                                            $val = isset($values[$key]) ? $values[$key]->nilai : '';
                                        @endphp
                                        <td>
                                            <input type="number" step="0.01" name="nilai[{{ $alt->id }}][{{ $criteria->id }}]" class="form-control text-center" value="{{ $val }}" placeholder="0" required>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-3 bg-light text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Nilai
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection
