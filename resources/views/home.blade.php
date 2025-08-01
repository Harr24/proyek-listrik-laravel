@extends('layouts.guest').

@section('title', 'Selamat Datang')

@push('styles')
    {{-- CDN untuk Animasi AOS --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    {{-- CSS baru untuk desain homepage --}}
    <style>
        /* PERUBAHAN TOTAL PADA HERO SECTION */
        .hero-section {
            background-color: #e9ecef;
            padding: 8rem 0;
            text-align: center;
        }

        .hero-section .container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .feature-card {
            border: none;
            transition: transform .2s ease-in-out, box-shadow .2s ease-in-out;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
        }

        .feature-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 4rem;
            height: 4rem;
            margin-bottom: 1rem;
            font-size: 2rem;
            color: #fff;
            border-radius: 50%;
        }

        .stats-section {
            background-color: #0d6efd;
            color: white;
        }

        .news-card img {
            height: 200px;
            object-fit: cover;
        }

        .footer {
            background-color: #343a40;
            color: white;
        }
    </style>
@endpush

@section('content')
    {{-- Bagian Hero Banner Baru --}}
    <div class="hero-section">
        <div class="container" data-aos="fade-up">
            <p class="lead col-lg-8 mx-auto">
                Solusi listrik pascabayar yang andal, transparan, dan mudah untuk rumah dan bisnis Anda.
            </p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mt-4">
                <a href="{{ route('daftar-harga') }}" class="btn btn-primary btn-lg px-4 gap-3">
                    Lihat Daftar Harga
                </a>
            </div>
        </div>
    </div>

    {{-- Bagian Fitur Unggulan --}}
    <div class="container px-4 py-5" id="features">
        <h2 class="pb-2 border-bottom text-center">Mengapa Memilih Kami?</h2>
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
            <div class="col" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 shadow-sm feature-card">
                    <div class="card-body text-center">
                        <div class="feature-icon bg-primary bg-gradient mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                class="bi bi-lightning-charge-fill" viewBox="0 0 16 16">
                                <path
                                    d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09z" />
                            </svg>
                        </div>
                        <h3 class="h5">Layanan Andal</h3>
                        <p>Kami menjamin pasokan listrik yang stabil dan andal untuk menunjang segala aktivitas Anda tanpa
                            gangguan.</p>
                    </div>
                </div>
            </div>
            <div class="col" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 shadow-sm feature-card">
                    <div class="card-body text-center">
                        <div class="feature-icon bg-success bg-gradient mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                class="bi bi-cash-coin" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z" />
                                <path
                                    d="M9.438 11.944c.047.596.518 1.06 1.062 1.06h1.062c.596 0 1.06-.518 1.06-1.06V7.77c0-.596-.518-1.06-1.06-1.06H10.5c-.596 0-1.06.518-1.06 1.06v4.174zm-2.176-4.174c0 .596-.518 1.06-1.06 1.06H4.14c-.596 0-1.06-.518-1.06-1.06V7.77c0-.596.518-1.06 1.06-1.06H6.2c.596 0 1.06.518 1.06 1.06v4.174z" />
                                <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1v1H1V5h1V3.5z" />
                            </svg>
                        </div>
                        <h3 class="h5">Harga Transparan</h3>
                        <p>Tidak ada biaya tersembunyi. Cek tarif kami yang kompetitif dan bayar sesuai dengan pemakaian
                            Anda setiap bulan.</p>
                    </div>
                </div>
            </div>
            <div class="col" data-aos="fade-up" data-aos-delay="300">
                <div class="card h-100 shadow-sm feature-card">
                    <div class="card-body text-center">
                        <div class="feature-icon bg-warning bg-gradient mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                class="bi bi-headset" viewBox="0 0 16 16">
                                <path
                                    d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5 1.5 0 0 0 13 12h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V6a5 5 0 0 0-5-5z" />
                            </svg>
                        </div>
                        <h3 class="h5">Dukungan 24/7</h3>
                        <p>Tim kami siap membantu Anda kapan saja. Hubungi kami jika Anda mengalami kendala atau memiliki
                            pertanyaan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bagian Statistik Pengguna --}}
    <div class="stats-section">
        <div class="container px-4 py-5 text-center">
            <div class="row">
                <div class="col-lg-8 mx-auto" data-aos="zoom-in">
                    <p class="fs-5 mb-0">Telah dipercaya oleh</p>
                    <h2 class="display-4 fw-bold">{{ $jumlah_pelanggan }}</h2>
                    <p class="fs-5">Pelanggan Setia di Seluruh Negeri</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Bagian Berita --}}
    <div class="container px-4 py-5" id="berita">
        <h2 class="pb-2 border-bottom text-center">Berita & Informasi Terbaru</h2>
        <div class="row g-4 py-5">
            @forelse ($berita_terbaru as $berita)
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="card h-100 shadow-sm news-card">
                        <img src="{{ asset('storage/berita/' . $berita->gambar) }}" class="card-img-top"
                            alt="{{ $berita->judul }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $berita->judul }}</h5>
                            <p class="card-text text-muted flex-grow-1">
                                {{ Str::limit($berita->deskripsi, 100) }}
                            </p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">
                                Dipublikasikan pada {{ $berita->created_at->format('d F Y') }}
                            </small>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">Belum ada berita terbaru saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Bagian Hubungi Kami --}}
    <div class="container px-4 py-5" id="contact" data-aos="fade-up">
        <h2 class="pb-2 border-bottom text-center">Hubungi Kami</h2>
        <p class="lead text-center">
            Tertarik layanan kami atau ada keluhan? Klik tombol di bawah untuk chat via WhatsApp.
        </p>
        <div class="text-center mt-4">
            <a href="https://wa.me/6281326740142" target="_blank" class="btn btn-success btn-lg px-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" fill="currentColor"
                    class="bi bi-whatsapp me-2" viewBox="0 0 16 16">
                    <path
                        d="M13.601 2.326A7.95 7.95 0 0 0 8.06.012 7.95 7.95 0 0 0 2.8 2.206 7.944 7.944 0 0 0 .013 8.06c0 1.383.357 2.728 1.037 3.92L0 16l3.983-1.033a7.948 7.948 0 0 0 3.927 1.037h.003c4.41 0 8-3.59 8-8a7.95 7.95 0 0 0-1.312-4.677zm-5.54 11.073h-.002a6.07 6.07 0 0 1-3.096-.835l-.222-.132-2.366.613.632-2.304-.144-.235a6.04 6.04 0 0 1-.93-3.26 6.06 6.06 0 0 1 6.06-6.06c1.62 0 3.14.63 4.284 1.775A6.017 6.017 0 0 1 14.06 8.06a6.07 6.07 0 0 1-6.0 6.0zm3.304-3.85c-.18-.09-1.065-.527-1.23-.587-.165-.06-.285-.09-.405.09s-.465.587-.57.71c-.105.12-.21.135-.39.045-.18-.09-.76-.28-1.45-.885-.537-.48-.9-1.07-1.005-1.25-.105-.18-.012-.28.08-.37.082-.082.18-.21.272-.315.09-.105.12-.18.18-.3.06-.12.03-.225-.015-.315-.045-.09-.405-.975-.555-1.335-.147-.36-.297-.32-.405-.325-.105-.005-.225-.005-.345-.005-.12 0-.315.045-.48.225-.165.18-.63.615-.63 1.5s.645 1.735.735 1.855c.09.12 1.27 1.94 3.075 2.72.43.185.765.295 1.03.38.433.145.83.125 1.143.075.348-.057 1.065-.435 1.216-.855.15-.42.15-.78.105-.855-.045-.075-.165-.12-.345-.21z" />
                </svg>
                0813-2674-0142
            </a>
        </div>
    </div>

    {{-- Footer --}}
    <div class="footer mt-auto py-3">
        <div class="container text-center">
            <span class="text-muted">© {{ date('Y') }} PT Harrycahayarumah. Semua Hak Cipta Dilindungi.</span>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- CDN dan inisialisasi AOS --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
        });
    </script>
@endpush
```