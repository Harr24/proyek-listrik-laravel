@extends('layouts.admin')

@section('title', 'Kelola Data Tagihan')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Kelola Data Tagihan</h1>
    </div>

    {{-- Menampilkan pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row mb-3">
        <div class="col-md-6">
            {{-- Kosong untuk saat ini, bisa diisi tombol lain nanti --}}
        </div>
        <div class="col-md-6">
            {{-- FORM PENCARIAN BARU --}}
            <form action="{{ route('admin.tagihan.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari pelanggan, periode, status..." name="search"
                        value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                </div>
            </form>
            {{-- AKHIR FORM PENCARIAN --}}
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Pelanggan</th>
                    <th scope="col">Periode</th>
                    <th scope="col">Jumlah Meter</th>
                    <th scope="col">Total Bayar</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($semua_tagihan as $tagihan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tagihan->penggunaan->pelanggan->nama_pelanggan ?? 'N/A' }}</td>
                        <td>{{ $tagihan->penggunaan->bulan ?? 'N/A' }} {{ $tagihan->penggunaan->tahun ?? '' }}</td>
                        <td>{{ $tagihan->jumlah_meter }} KWH</td>
                        <td>Rp {{ number_format($tagihan->total_bayar, 0, ',', '.') }}</td>
                        <td>
                            @if($tagihan->status == 'Lunas')
                                <span class="badge bg-success">Lunas</span>
                            @else
                                <span class="badge bg-danger">Belum Lunas</span>
                            @endif
                        </td>
                        <td>
                            @if($tagihan->status == 'Belum Lunas')
                                <a href="{{ route('admin.pembayaran.create', $tagihan) }}"
                                    class="btn btn-info btn-sm">Verifikasi</a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Data tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection