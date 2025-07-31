@extends('layouts.app')

@section('title', 'Selamat Datang')

@section('content')
    {{-- Bagian Hero Banner --}}
    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold">PT Harrycahayarumah</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Penyedia layanan listrik pascabayar terpercaya. Cek daftar harga terbaru kami dan nikmati
                kemudahan pembayaran tagihan bulanan Anda.</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                <a href="{{ route('daftar-harga') }}" class="btn btn-primary btn-lg px-4 gap-3">Lihat Daftar Harga</a>
                <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg px-4">Login Pelanggan</a>
            </div>
        </div>
    </div>
@endsection