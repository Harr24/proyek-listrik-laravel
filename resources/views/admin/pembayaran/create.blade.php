@extends('layouts.admin')

@section('title', 'Verifikasi Pembayaran')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Verifikasi Pembayaran</h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Detail Tagihan
                </div>
                <div class="card-body">
                    <p><strong>Nama Pelanggan:</strong><br> {{ $tagihan->penggunaan->pelanggan->nama_pelanggan }}</p>
                    <p><strong>Nomor Meter:</strong><br> {{ $tagihan->penggunaan->pelanggan->nomor_meter }}</p>
                    <p><strong>Periode:</strong><br> {{ $tagihan->penggunaan->bulan }} {{ $tagihan->penggunaan->tahun }}</p>
                    <hr>
                    <p><strong>Total Tagihan:</strong></p>
                    <h3 class="card-title">Rp {{ number_format($tagihan->total_bayar, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Form Konfirmasi
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pembayaran.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_tagihan" value="{{ $tagihan->id_tagihan }}">

                        <div class="mb-3">
                            <label for="tanggal_bayar" class="form-label">Tanggal Bayar</label>
                            <input type="date" class="form-control" id="tanggal_bayar" name="tanggal_bayar"
                                value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="biaya_admin" class="form-label">Biaya Admin</label>
                            <input type="number" class="form-control" id="biaya_admin" name="biaya_admin" value="2500"
                                required>
                        </div>

                        <button type="submit" class="btn btn-success">Konfirmasi Pembayaran</button>
                        <a href="{{ route('admin.tagihan.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection