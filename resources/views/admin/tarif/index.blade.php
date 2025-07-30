@extends('layouts.admin')

@section('title', 'Kelola Data Tarif')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Kelola Data Tarif</h1>
    </div>

    {{-- Menampilkan pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <a href="{{ route('admin.tarif.create') }}" class="btn btn-primary mb-3">+ Tambah Data Baru</a>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Daya</th>
                    <th scope="col">Tarif / KWH</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($semua_tarif as $tarif)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tarif->daya }}</td>
                        <td>Rp {{ number_format($tarif->tarif_per_kwh, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('admin.tarif.edit', $tarif) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.tarif.destroy', $tarif) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Belum ada data tarif.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection