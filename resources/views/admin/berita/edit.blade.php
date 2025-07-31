@extends('layouts.admin')
@section('title', 'Edit Berita')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Berita</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.berita.update', $berita) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Berita</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ $berita->judul }}" required>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Ganti Gambar (Opsional)</label>
                    <input class="form-control" type="file" id="gambar" name="gambar">
                    <small class="form-text text-muted">Gambar saat ini:</small><br>
                    <img src="{{ asset('storage/berita/' . $berita->gambar) }}" alt="{{ $berita->judul }}" width="150"
                        class="mt-2">
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5"
                        required>{{ $berita->deskripsi }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection