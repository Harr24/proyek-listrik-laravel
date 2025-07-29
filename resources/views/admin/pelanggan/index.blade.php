@extends('layouts.admin')

@section('title', 'Kelola Data Pelanggan')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Kelola Data Pelanggan</h1>
    </div>

    {{-- Menampilkan pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <a href="{{ route('admin.pelanggan.create') }}" class="btn btn-primary mb-3">+ Tambah Pelanggan Baru</a>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nomor Meter</th>
                    <th scope="col">Nama Pelanggan</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Daya Tarif</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($semua_pelanggan as $pelanggan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pelanggan->nomor_meter }}</td>
                        <td>{{ $pelanggan->nama_pelanggan }}</td>
                        <td>{{ $pelanggan->alamat }}</td>
                        <td>{{ $pelanggan->tarif->daya ?? 'Tarif Dihapus' }}</td>
                        <td>
                            <a href="{{ route('admin.pelanggan.edit', $pelanggan) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.pelanggan.destroy', $pelanggan) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini? Akun login terkait juga akan terhapus.')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data pelanggan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection