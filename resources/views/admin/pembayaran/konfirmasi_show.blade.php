@extends('layouts.admin')

@section('title', 'Proses Konfirmasi Pembayaran')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Proses Konfirmasi Pembayaran</h1>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Detail Tagihan</div>
                <div class="card-body">
                    <p><strong>Nama Pelanggan:</strong><br> {{ $tagihan->penggunaan->pelanggan->nama_pelanggan }}</p>
                    <p><strong>Periode:</strong><br> {{ $tagihan->penggunaan->bulan }} {{ $tagihan->penggunaan->tahun }}</p>
                    <p><strong>Tanggal Bayar:</strong><br>
                        {{ \Carbon\Carbon::parse($tagihan->pembayaran->tanggal_bayar)->format('d F Y') }}</p>
                    <hr>
                    <p><strong>Total Bayar:</strong></p>
                    <h3 class="card-title">Rp {{ number_format($tagihan->pembayaran->total_akhir, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Bukti Pembayaran</div>
                <div class="card-body text-center">
                    @if ($tagihan->pembayaran->bukti_pembayaran)
                        <img src="{{ asset('storage/bukti_pembayaran/' . $tagihan->pembayaran->bukti_pembayaran) }}"
                            alt="Bukti Pembayaran" class="img-fluid rounded">
                    @else
                        <p class="text-muted">Tidak ada bukti pembayaran yang diunggah.</p>
                    @endif
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <form action="{{ route('admin.pembayaran.konfirmasi.reject', $tagihan) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Apakah Anda yakin ingin menolak pembayaran ini?')">Tolak</button>
                    </form>
                    <form action="{{ route('admin.pembayaran.konfirmasi.approve', $tagihan) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Setujui & Lunaskan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection