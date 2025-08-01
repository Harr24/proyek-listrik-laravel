@extends('layouts.guest')

@section('title', 'Selamat Datang')

@push('styles')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        /* Warna utama: coklat tua, coklat medium, beige lembut, aksen kayu */
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #fdfaf5;
            /* beige natural */
            color: #5B3A29;
            /* brown earth tone */
        }

        /* HERO SECTION */
        .hero-section {
            background: linear-gradient(135deg, #E4CDAF 0%, #D9CBAE 100%);
            padding: 8rem 0;
            text-align: center;
            color: #37290E;
        }

        .hero-section .lead {
            max-width: 800px;
            margin: auto;
            color: #4E3B31;
        }

        .btn-primary {
            background: linear-gradient(135deg, #5B3A29 0%, #A76D4D 50%, #C2B280 100%);
            border: none;
            color: white;
            font-weight: 600;
        }

        .btn-primary:hover {
            background: #A76D4D;
            box-shadow: 0 10px 20px rgba(52, 73, 94, 0.3);
        }

        /* FEATURE SECTION */
        .feature-card {
            border: none;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 16px;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 2rem rgba(52, 73, 94, 0.15);
        }

        .feature-icon {
            width: 4rem;
            height: 4rem;
            font-size: 2rem;
            border-radius: 50%;
            background: #A76D4D;
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* STATISTICS SECTION */
        .stats-section {
            background: linear-gradient(135deg, #5B3A29 0%, #A76D4D 50%, #C2B280 100%);
            color: white;
        }

        /* NEWS SECTION */
        .news-card {
            background: #fdfaf5;
            border: 1px solid #ecdcc3;
            border-radius: 12px;
            transition: transform 0.2s;
        }

        .news-card:hover {
            transform: translateY(-3px);
        }

        .news-card img {
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .news-card .card-title {
            color: #37290E;
        }

        .news-card .card-text {
            color: #4E3B31;
        }

        .card-footer {
            background: #f5f5dc;
            border-top: 1px solid #ddd0b5;
            color: #7A5A3A;
        }

        /* CONTACT SECTION */
        .btn-success {
            background: #A76D4D;
            border: none;
            color: white;
        }

        .btn-success:hover {
            background: #5B3A29;
        }

        /* FOOTER */
        .footer {
            background-color: #37290E;
            color: #fdfaf5;
        }

        .footer .text-muted {
            color: #DBCAB2 !important;
        }
    </style>
@endpush

@section('content')
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

    <div class="container px-4 py-5" id="features">
        <h2 class="pb-2 border-bottom text-center">Mengapa Memilih Kami?</h2>
        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
            <div class="col" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 shadow-sm feature-card">
                    <div class="card-body text-center">
                        <div class="feature-icon mb-3">
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
                        <div class="feature-icon mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                class="bi bi-cash-coin" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z" />
                                <path
                                    d="M9.438 11.944c.047.596.518 1.06 1.062 1.06h1.062c.596 0 1.06-.518 1.06-1.06V7.77c0-.596-.518-1.06-1.06-1.06H10.5c-.596 0-1.06.518-1.06 1.06v4.174zm-2.176-4.174c0 .596-.518 1.06-1.06 1.06H4.14c-.596 0-1.06-.518-1.06-1.06V7.77c0-.596.518-1.06 1.06-1.06H6.2c.596 0 1.06.518 1.06 1.06v4.174z" />
                                <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5.1.5 1H12 3.5V5h1v1H1V5h1V3.5z" />
                            </svg>
                        </div>
                        <h3 class="h5">Harga Transparan</h3>
                        <p>Tidak ada biaya tersembunyi. Cek tarif kami yang kompetitif dan bayar sesuai pemakaian Anda.</p>
                    </div>
                </div>
            </div>
            <div class="col" data-aos="fade-up" data-aos-delay="300">
                <div class="card h-100 shadow-sm feature-card">
                    <div class="card-body text-center">
                        <div class="feature-icon mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                class="bi bi-headset" viewBox="0 0 16 16">
                                <path
                                    d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0-1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5.1.5 0 0 0 13 12h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V6a5 5 0 0 0-5-5z" />
                            </svg>
                        </div>
                        <h3 class="h5">Dukungan 24/7</h3>
                        <p>Tim kami siap membantu Anda kapan saja. Hubungi kami jika mengalami kendala atau pertanyaan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

    <div class="container px-4 py-5" id="contact" data-aos="fade-up">
        <h2 class="pb-2 border-bottom text-center">Hubungi Kami</h2>
        <p class="lead text-center">
            Tertarik layanan kami atau ada keluhan? Klik tombol di bawah untuk chat via WhatsApp.
        </p>
        <div class="text-center mt-4">
            <a href="https://wa.me/6281326740142" target="_blank" class="btn btn-success btn-lg px-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" fill="currentColor"
                    class="bi bi-whatsapp me-2" viewBox="0 0 16 16">
                    <path d="M13.601 2.326A7.95 7.95 0 0 0 8.06.012 7.95 7.95 0 0 0 2.8 2.206 7.944 7.944 0 0 0 .013 8.06c0 1.383...
                    " />
                </svg>
                0813-2674-0142
            </a>
        </div>
    </div>

    <div class="footer mt-auto py-3">
        <div class="container text-center">
            <span class="text-muted">© {{ date('Y') }} PT Harrycahayarumah. Semua Hak Cipta Dilindungi.</span>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
        });
    </script>
@endpush