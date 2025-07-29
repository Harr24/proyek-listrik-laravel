@extends('layouts.admin')

@section('title', 'Edit Data Tarif')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Data Tarif</h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.tarif.update', $tarif) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="daya" class="form-label">Daya</label>
                    <input type="text" class="form-control @error('daya') is-invalid @enderror" id="daya" name="daya"
                        value="{{ old('daya', $tarif->daya) }}" required>
                    @error('daya')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tarif_per_kwh" class="form-label">Tarif / KWH</label>
                    <input type="number" class="form-control @error('tarif_per_kwh') is-invalid @enderror"
                        id="tarif_per_kwh" name="tarif_per_kwh" value="{{ old('tarif_per_kwh', $tarif->tarif_per_kwh) }}"
                        required>
                    @error('tarif_per_kwh')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.tarif.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection