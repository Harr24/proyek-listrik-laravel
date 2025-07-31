@extends('layouts.admin')

@section('title', 'Pelanggan Belum Diinput')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pelanggan Belum Diinput Penggunaan</h1>
        <a href="{{ route('admin.penggunaan.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    {{-- FORM FILTER BARU --}}
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.penggunaan.belum_input') }}" method="GET">
                <div class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <label for="bulan" class="form-label">Pilih Bulan</label>
                        <select name="bulan" id="bulan" class="form-select" required>
                            <option value="Januari" @if($bulanIni == 'Januari') selected @endif>Januari</option>
                            <option value="Februari" @if($bulanIni == 'Februari') selected @endif>Februari</option>
                            <option value="Maret" @if($bulanIni == 'Maret') selected @endif>Maret</option>
                            <option value="April" @if($bulanIni == 'April') selected @endif>April</option>
                            <option value="Mei" @if($bulanIni == 'Mei') selected @endif>Mei</option>
                            <option value="Juni" @if($bulanIni == 'Juni') selected @endif>Juni</option>
                            <option value="Juli" @if($bulanIni == 'Juli') selected @endif>Juli</option>
                            <option value="Agustus" @if($bulanIni == 'Agustus') selected @endif>Agustus</option>
                            <option value="September" @if($bulanIni == 'September') selected @endif>September</option>
                            <option value="Oktober" @if($bulanIni == 'Oktober') selected @endif>Oktober</option>
                            <option value="November" @if($bulanIni == 'November') selected @endif>November</option>
                            <option value="Desember" @if($bulanIni == 'Desember') selected @endif>Desember</option>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="number" class="form-control" id="tahun" name="tahun" placeholder="Contoh: 2024"
                            value="{{ $tahunIni }}" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Daftar Pelanggan (Periode: {{ $bulanIni }} {{ $tahunIni }})
        </div>
        <div class="card-body">
            @if($pelanggan_belum_input->isEmpty())
                <p class="text-success">Semua pelanggan sudah diinput penggunaannya untuk periode ini.</p>
            @else
                <ul class="list-group">
                    @foreach ($pelanggan_belum_input as $pelanggan)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $pelanggan->nama_pelanggan }} ({{ $pelanggan->nomor_meter }})</span>
                            <a href="{{ route('admin.penggunaan.create', ['pelanggan_id' => $pelanggan->id_pelanggan]) }}"
                                class="btn btn-primary btn-sm">Input Sekarang</a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection