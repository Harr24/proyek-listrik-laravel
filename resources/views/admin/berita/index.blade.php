@extends('layouts.admin')
@section('title', 'Kelola Berita')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Kelola Berita</h1>
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <a href="{{ route('admin.berita.create') }}" class="btn btn-primary mb-3">+ Tambah Berita Baru</a>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($semua_berita as $berita)
                    <tr>
                        <td>{{ $semua_berita->firstItem() + $loop->index }}</td>
                        <td><img src="{{ asset('storage/berita/' . $berita->gambar) }}" alt="{{ $berita->judul }}" width="100">
                        </td>
                        <td>{{ $berita->judul }}</td>
                        <td>
                            <a href="{{ route('admin.berita.edit', $berita) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.berita.destroy', $berita) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus berita ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Belum ada berita.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        {{ $semua_berita->links() }}
    </div>
@endsection