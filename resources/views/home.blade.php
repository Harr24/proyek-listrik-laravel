@extends('layouts.app')

@section('title', 'Selamat Datang')

@push('styles')
    {{-- CSS khusus untuk carousel berita --}}
    <style>
        .news-carousel {
            overflow: hidden;
            position: relative;
            width: 100%;
            padding: 2rem 0;
        }

        .news-carousel-track {
            display: flex;
            /* Lebar dihitung dari (jumlah berita * 2) * (lebar per item + margin) */
            animation: scroll 40s linear infinite;
        }

        .news-carousel:hover .news-carousel-track {
            animation-play-state: paused;
        }

        .news-carousel-item {
            flex-shrink: 0;
            width: 350px;
            /* Lebar setiap kartu berita */
            margin-right: 20px;
            /* Jarak antar kartu */
        }

        @keyframes scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                /* Pindahkan ke kiri sejauh setengah dari total lebar track */
                transform: translateX(-50%);
            }
        }
    </style>
@endpush

@section('content')
    {{-- Bagian Hero Banner --}}
    <div class="px-4 py-5 text-center">
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

    {{-- Bagian Statistik Pengguna --}}
    <div class="container px-4 py-5 text-center bg-light rounded-3">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <p class="fs-5 mb-0">Telah dipercaya oleh</p>
                <h2 class="display-4 fw-bold">{{ $jumlah_pelanggan }}</h2>
                <p class="fs-5">Pelanggan Setia</p>
            </div>
        </div>
    </div>

    {{-- Bagian Berita Carousel --}}
    <div class="container px-4 py-5" id="berita">
        <h2 class="pb-2 border-bottom text-center">Berita & Informasi Terbaru</h2>

        @if($berita_terbaru->isNotEmpty())
            <div class="news-carousel">
                <div class="news-carousel-track">
                    {{-- Loop pertama untuk set awal --}}
                    @foreach ($berita_terbaru as $berita)
                        <div class="news-carousel-item">
                            <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg"
                                style="background-image: url('{{ asset('storage/berita/' . $berita->gambar) }}'); background-size: cover; background-position: center;">
                                <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1"
                                    style="background-color: rgba(0,0,0,0.5);">
                                    <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">{{ Str::limit($berita->judul, 50) }}</h3>
                                    <ul class="d-flex list-unstyled mt-auto">
                                        <li class="me-auto"></li>
                                        <li class="d-flex align-items-center">
                                            <small>{{ $berita->created_at->format('d M Y') }}</small>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- Loop kedua untuk menciptakan ilusi tak terbatas --}}
                    @foreach ($berita_terbaru as $berita)
                        <div class="news-carousel-item">
                            <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg"
                                style="background-image: url('{{ asset('storage/berita/' . $berita->gambar) }}'); background-size: cover; background-position: center;">
                                <div class="d-flex flex-column h-100 p-5 pb-3 text-white text-shadow-1"
                                    style="background-color: rgba(0,0,0,0.5);">
                                    <h3 class="pt-5 mt-5 mb-4 display-6 lh-1 fw-bold">{{ Str::limit($berita->judul, 50) }}</h3>
                                    <ul class="d-flex list-unstyled mt-auto">
                                        <li class="me-auto"></li>
                                        <li class="d-flex align-items-center">
                                            <small>{{ $berita->created_at->format('d M Y') }}</small>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="col-12 py-5">
                <p class="text-center text-muted">Belum ada berita terbaru saat ini.</p>
            </div>
        @endif
    </div>
@endsection