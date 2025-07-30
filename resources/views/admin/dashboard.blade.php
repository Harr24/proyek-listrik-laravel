@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
    </div>

    <div class="alert alert-info">
        <h5 class="alert-heading">Selamat Datang, {{ Auth::user()->name }}!</h5>
        <p class="mb-0">Anda berhasil login sebagai Admin. Gunakan menu di samping untuk mengelola data aplikasi.</p>
    </div>

    {{-- KARTU REKAPITULASI BARU --}}
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Pelanggan</h5>
                    <p class="card-text fs-2 fw-bold">{{ $jumlah_pelanggan }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Tagihan Belum Lunas</h5>
                    <p class="card-text fs-2 fw-bold">{{ $tagihan_belum_lunas }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Pendapatan Bulan Ini</h5>
                    <p class="card-text fs-2 fw-bold">Rp {{ number_format($pendapatan_bulan_ini, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection