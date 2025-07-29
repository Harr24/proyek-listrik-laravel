@extends('layouts.admin')

@section('title', 'Kelola Data Penggunaan')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Kelola Data Penggunaan</h1>
    </div>

    {{-- Menampilkan pesan sukses atau error --}}
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

    <a href="{{ route('admin.penggunaan.create') }}" class="btn btn-primary mb-3">+ Input Penggunaan Baru</a>

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
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $penggunaan->pelanggan->nama_pelanggan ?? 'Pelanggan Dihapus' }}</td>
                        <td>{{ $penggunaan->bulan }} {{ $penggunaan->tahun }}</td>
                        <td>{{ $penggunaan->meter_awal }}</td>
                        <td>{{ $penggunaan->meter_akhir }}</td>
                        <td>
                            <form action="{{ route('admin.tagihan.generate', $penggunaan) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Generate Tagihan</button>
                            </form>
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
                        <td colspan="6" class="text-center">Belum ada data penggunaan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection