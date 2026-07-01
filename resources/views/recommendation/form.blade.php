@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white text-center pt-4 pb-0 border-0">
                <h4 class="mb-0">Form Rekomendasi</h4>
                <p class="text-muted small">Pilih kondisi ruangan Anda</p>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('recommendation.process') }}" method="POST">
                    @csrf
                    
                    @foreach($criterias as $criteria)
                    <div class="mb-4">
                        <label class="form-label fw-bold">{{ $criteria->nama }}</label>
                        <select name="c{{ $criteria->id }}" class="form-select" required>
                            <option value="">Pilih {{ $criteria->nama }}...</option>
                            @foreach($criteria->subKriteria as $sub)
                                <option value="{{ $sub->nilai }}">{{ $sub->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endforeach

                    <button type="submit" class="btn btn-primary w-100 mt-2">Proses Rekomendasi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
