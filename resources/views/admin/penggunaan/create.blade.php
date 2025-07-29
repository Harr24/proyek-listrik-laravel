@extends('layouts.admin')

@section('title', 'Input Data Penggunaan')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Input Data Penggunaan</h1>
    </div>

    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.penggunaan.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="id_pelanggan" class="form-label">Pilih Pelanggan</label>
                    <select name="id_pelanggan" id="id_pelanggan" class="form-select" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach ($semua_pelanggan as $pelanggan)
                            <option value="{{ $pelanggan->id_pelanggan }}">{{ $pelanggan->nomor_meter }} -
                                {{ $pelanggan->nama_pelanggan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="bulan" class="form-label">Bulan</label>
                        <input type="text" class="form-control" id="bulan" name="bulan" value="{{ old('bulan') }}" required
                            placeholder="Contoh: Januari">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="number" class="form-control" id="tahun" name="tahun"
                            value="{{ old('tahun', date('Y')) }}" required placeholder="Contoh: 2024">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="meter_awal" class="form-label">Meter Awal (KWH)</label>
                        <input type="number" class="form-control" id="meter_awal" name="meter_awal"
                            value="{{ old('meter_awal') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="meter_akhir" class="form-label">Meter Akhir (KWH)</label>
                        <input type="number" class="form-control" id="meter_akhir" name="meter_akhir"
                            value="{{ old('meter_akhir') }}" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.penggunaan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection