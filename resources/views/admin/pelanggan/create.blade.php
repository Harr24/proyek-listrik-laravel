@extends('layouts.admin')

@section('title', 'Tambah Data Pelanggan')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Data Pelanggan</h1>
    </div>

    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.pelanggan.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                    <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan"
                        value="{{ old('nama_pelanggan') }}" required>
                </div>
                <div class="mb-3">
                    <label for="nomor_meter" class="form-label">Nomor Meter</label>
                    {{-- PERUBAHAN DI SINI --}}
                    <input type="text" inputmode="numeric" class="form-control" id="nomor_meter" name="nomor_meter"
                        value="{{ old('nomor_meter') }}" required oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3"
                        required>{{ old('alamat') }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="id_tarif" class="form-label">Jenis Tarif</label>
                    <select name="id_tarif" id="id_tarif" class="form-select" required>
                        <option value="">-- Pilih Tarif --</option>
                        @foreach ($semua_tarif as $tarif)
                            <option value="{{ $tarif->id_tarif }}">{{ $tarif->daya }} - (Rp
                                {{ number_format($tarif->tarif_per_kwh) }})</option>
                        @endforeach
                    </select>
                </div>

                <hr>
                <h5 class="mb-3">Buat Akun Login untuk Pelanggan</h5>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Login</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection