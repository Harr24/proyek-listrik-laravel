@extends('layouts.admin')

@section('title', 'Konfirmasi Pembayaran')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Konfirmasi Pembayaran</h1>
    </div>

    {{-- Menampilkan pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Pelanggan</th>
                    <th scope="col">Periode</th>
                    <th scope="col">Tanggal Bayar</th>
                    <th scope="col">Total Bayar</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($semua_tagihan as $tagihan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tagihan->penggunaan->pelanggan->nama_pelanggan ?? 'N/A' }}</td>
                        <td>{{ $tagihan->penggunaan->bulan ?? 'N/A' }} {{ $tagihan->penggunaan->tahun ?? '' }}</td>
                        <td>{{ \Carbon\Carbon::parse($tagihan->pembayaran->tanggal_bayar)->format('d F Y') }}</td>
                        <td>Rp {{ number_format($tagihan->pembayaran->total_akhir, 0, ',', '.') }}</td>
                        <td>
                            {{-- Tombol Proses yang menuju ke halaman detail konfirmasi --}}
                            <a href="{{ route('admin.pembayaran.konfirmasi.show', $tagihan->id_tagihan) }}"
                                class="btn btn-primary btn-sm">
                                Proses
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada pembayaran yang menunggu konfirmasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection