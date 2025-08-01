@extends('layouts.pelanggan')

@section('title', 'Buat Tiket Keluhan Baru')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Buat Tiket Keluhan Baru</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('pelanggan.keluhan.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Keluhan</label>
                            <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}"
                                required placeholder="Contoh: Tagihan bulan Juli tidak sesuai">
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsikan Keluhan Anda</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5"
                                required>{{ old('deskripsi') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Keluhan</button>
                        <a href="{{ route('pelanggan.keluhan.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection