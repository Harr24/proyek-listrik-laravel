@extends('layouts.admin')

@section('title', 'Kelola Data Penggunaan')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Kelola Data Penggunaan</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row mb-3">
        <div class="col-md-7">
            {{-- Tombol Baru --}}
            <a href="{{ route('admin.penggunaan.create') }}" class="btn btn-primary">+ Input Penggunaan Baru</a>
            <a href="{{ route('admin.penggunaan.belum_input') }}" class="btn btn-info">Lihat Pelanggan Belum Diinput</a>
        </div>
        <div class="col-md-5">
            <form action="{{ route('admin.penggunaan.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari pelanggan, bulan, tahun..." name="search"
                        value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Pelanggan</th>
                    <th scope="col">Periode</th>
                    <th scope="col">Meter Awal (KWH)</th>
                    <th scope="col">Meter Akhir (KWH)</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($semua_penggunaan as $penggunaan)
                    <tr>
                        <td>{{ $semua_penggunaan->firstItem() + $loop->index }}</td>
                        <td>{{ $penggunaan->pelanggan->nama_pelanggan ?? 'Pelanggan Dihapus' }}</td>
                        <td>{{ $penggunaan->bulan }} {{ $penggunaan->tahun }}</td>
                        <td>{{ $penggunaan->meter_awal }}</td>
                        <td>{{ $penggunaan->meter_akhir }}</td>
                        <td>
                            @if ($penggunaan->tagihan)
                                @if ($penggunaan->tagihan->status == 'Lunas')
                                    <span class="badge bg-success">Sudah Lunas</span>
                                @elseif ($penggunaan->tagihan->status == 'Menunggu Konfirmasi')
                                    <span class="badge bg-warning me-1">Menunggu Konfirmasi</span>
                                    <a href="{{ route('admin.pembayaran.konfirmasi.show', $penggunaan->tagihan) }}"
                                        class="btn btn-primary btn-sm">Proses</a>
                                @else
                                    <span class="badge bg-danger me-1">Belum Lunas</span>
                                    <a href="{{ route('admin.pembayaran.create', $penggunaan->tagihan) }}"
                                        class="btn btn-info btn-sm">Lunaskan</a>
                                @endif
                            @else
                                <form action="{{ route('admin.tagihan.generate', $penggunaan) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Generate Tagihan</button>
                                </form>
                            @endif

                            <a href="{{ route('admin.penggunaan.edit', $penggunaan) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.penggunaan.destroy', $penggunaan) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Data tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $semua_penggunaan->appends(request()->query())->links() }}
    </div>
@endsection