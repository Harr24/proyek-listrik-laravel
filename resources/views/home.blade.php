@extends('layouts.guest')

@section('title', 'Selamat Datang')

@push('styles')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        /* Warna utama: coklat tua, coklat medium, beige lembut, aksen kayu */
        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background-color: #fdfaf5;
            color: #5B3A29;
            line-height: 1.6;
        }

        /* HERO SECTION dengan Background Image */
        .hero-section {
            background: linear-gradient(135deg,
                    rgba(0, 0, 0, 0.4) 0%,
                    rgba(0, 0, 0, 0.3) 50%,
                    rgba(91, 58, 41, 0.2) 100%), url('{{ asset("images/bg-village.jpg") }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 10rem 0;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .hero-section .container {
            position: relative;
            z-index: 2;
        }

        .hero-section h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            animation: fadeInUp 1s ease-out;
        }

        .hero-section .lead {
            max-width: 800px;
            margin: auto;
            font-size: 1.3rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            animation: fadeInUp 1s ease-out 0.2s both;
        }

        .btn-primary {
            background: linear-gradient(135deg, #5B3A29 0%, #A76D4D 50%, #C2B280 100%);
            border: none;
            color: white;
            font-weight: 600;
            padding: 1rem 2rem;
            border-radius: 50px;
            box-shadow: 0 8px 25px rgba(91, 58, 41, 0.3);
            transition: all 0.3s ease;
            animation: fadeInUp 1s ease-out 0.4s both;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #A76D4D 0%, #5B3A29 100%);
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(91, 58, 41, 0.4);
        }

        /* FEATURE SECTION Improved */
        .feature-section {
            background: linear-gradient(135deg, #fdfaf5 0%, #f8f4ed 100%);
            padding: 5rem 0;
        }

        .feature-card {
            border: none;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 30px rgba(91, 58, 41, 0.1);
            overflow: hidden;
            position: relative;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #A76D4D 0%, #C2B280 100%);
        }

        .feature-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 50px rgba(91, 58, 41, 0.2);
        }

        .feature-icon {
            width: 5rem;
            height: 5rem;
            font-size: 2.5rem;
            border-radius: 50%;
            background: linear-gradient(135deg, #A76D4D 0%, #C2B280 100%);
            color: white;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 25px rgba(167, 109, 77, 0.3);
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(10deg);
        }

        /* STATISTICS SECTION */
        .stats-section {
            background: linear-gradient(135deg, #5B3A29 0%, #A76D4D 50%, #C2B280 100%);
            color: white;
            padding: 4rem 0;
            position: relative;
            overflow: hidden;
        }

        .stats-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            animation: float 6s ease-in-out infinite;
        }

        .stats-number {
            font-size: 4rem;
            font-weight: 800;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            background: linear-gradient(45deg, #fff, #C2B280);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* NEWS SECTION */
        .news-section {
            background: linear-gradient(135deg, #fdfaf5 0%, #f5f2e8 100%);
            padding: 5rem 0;
        }

        .news-card {
            background: white;
            border: none;
            border-radius: 20px;
            transition: all 0.3s ease;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(91, 58, 41, 0.1);
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(91, 58, 41, 0.15);
        }

        .news-card img {
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .news-card:hover img {
            transform: scale(1.05);
        }

        .news-card .card-title {
            color: #37290E;
            font-weight: 600;
            line-height: 1.4;
        }

        .news-card .card-text {
            color: #4E3B31;
        }

        .card-footer {
            background: linear-gradient(135deg, #f5f5dc 0%, #ecdcc3 100%);
            border-top: 1px solid #ddd0b5;
            color: #7A5A3A;
        }

        /* CONTACT SECTION */
        .contact-section {
            background: linear-gradient(135deg, #fdfaf5 0%, #f8f4ed 100%);
            padding: 5rem 0;
        }

        .btn-success {
            background: linear-gradient(135deg, #A76D4D 0%, #5B3A29 100%);
            border: none;
            color: white;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            box-shadow: 0 8px 25px rgba(167, 109, 77, 0.3);
            transition: all 0.3s ease;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #5B3A29 0%, #A76D4D 100%);
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(91, 58, 41, 0.4);
        }

        /* FOOTER */
        .footer {
            background: linear-gradient(135deg, #37290E 0%, #5B3A29 100%);
            color: #fdfaf5;
            padding: 2rem 0;
        }

        .footer .text-muted {
            color: #DBCAB2 !important;
        }

        /* ANIMATIONS */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        /* SECTION TITLES */
        .section-title {
            position: relative;
            display: inline-block;
            font-weight: 700;
            color: #37290E;
            margin-bottom: 3rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(135deg, #A76D4D 0%, #C2B280 100%);
            border-radius: 2px;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .hero-section {
                padding: 6rem 0;
                background-attachment: scroll;
            }

            .hero-section h1 {
                font-size: 2.5rem;
            }

            .stats-number {
                font-size: 3rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="hero-section">
        <div class="container" data-aos="fade-up">
            <h1>PT Harrycahayarumah</h1>
            <p class="lead col-lg-8 mx-auto">
                Solusi listrik pascabayar yang andal, transparan, dan mudah untuk rumah dan bisnis Anda.
            </p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mt-4">
                <a href="{{ route('daftar-harga') }}" class="btn btn-primary btn-lg px-4 gap-3">
                    <i class="fas fa-bolt me-2"></i>
                    Lihat Daftar Harga
                </a>
            </div>
        </div>
    </div>

    <div class="feature-section" id="features">
        <div class="container px-4">
            <h2 class="section-title text-center">Mengapa Memilih Kami?</h2>
            <div class="row g-4 row-cols-1 row-cols-lg-3">
                <div class="col" data-aos="fade-up" data-aos-delay="100">
                    <div class="card h-100 feature-card">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                    class="bi bi-lightning-charge-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09z" />
                                </svg>
                            </div>
                            <h3 class="h4 mb-3">Layanan Andal</h3>
                            <p class="mb-0">Kami menjamin pasokan listrik yang stabil dan andal untuk menunjang segala
                                aktivitas Anda tanpa gangguan.</p>
                        </div>
                    </div>
                </div>
                <div class="col" data-aos="fade-up" data-aos-delay="200">
                    <div class="card h-100 feature-card">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                    class="bi bi-cash-coin" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z" />
                                    <path
                                        d="M9.438 11.944c.047.596.518 1.06 1.062 1.06h1.062c.596 0 1.06-.518 1.06-1.06V7.77c0-.596-.518-1.06-1.06-1.06H10.5c-.596 0-1.06.518-1.06 1.06v4.174zm-2.176-4.174c0 .596-.518 1.06-1.06 1.06H4.14c-.596 0-1.06-.518-1.06-1.06V7.77c0-.596.518-1.06 1.06-1.06H6.2c.596 0 1.06.518 1.06 1.06v4.174z" />
                                    <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 0 1H12 3.5V5h1v1H1V5h1V3.5z" />
                                </svg>
                            </div>
                            <h3 class="h4 mb-3">Harga Transparan</h3>
                            <p class="mb-0">Tidak ada biaya tersembunyi. Cek tarif kami yang kompetitif dan bayar sesuai
                                pemakaian Anda.</p>
                        </div>
                    </div>
                </div>
                <div class="col" data-aos="fade-up" data-aos-delay="300">
                    <div class="card h-100 feature-card">
                        <div class="card-body text-center p-4">
                            <div class="feature-icon mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                    class="bi bi-headset" viewBox="0 0 16 16">
                                    <path
                                        d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5 1.5 0 0 0 13 12h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V6a5 5 0 0 0-5-5z" />
                                </svg>
                            </div>
                            <h3 class="h4 mb-3">Dukungan 24/7</h3>
                            <p class="mb-0">Tim kami siap membantu Anda kapan saja. Hubungi kami jika mengalami kendala atau
                                pertanyaan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="stats-section">
        <div class="container px-4 text-center">
            <div class="row">
                <div class="col-lg-8 mx-auto" data-aos="zoom-in">
                    <p class="fs-5 mb-2 opacity-75">Telah dipercaya oleh</p>
                    <h2 class="stats-number">{{ $jumlah_pelanggan }}</h2>
                    <p class="fs-4 mb-0 fw-semibold">Pelanggan Setia di Seluruh Negeri</p>
                </div>
            </div>
        </div>
    </div>

    <div class="news-section" id="berita">
        <div class="container px-4">
            <h2 class="section-title text-center">Berita & Informasi Terbaru</h2>
            <div class="row g-4">
                @forelse ($berita_terbaru as $berita)
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                        <div class="card h-100 news-card">
                            <img src="{{ asset('storage/berita/' . $berita->gambar) }}" class="card-img-top"
                                alt="{{ $berita->judul }}">
                            <div class="card-body d-flex flex-column p-4">
                                <h5 class="card-title">{{ $berita->judul }}</h5>
                                <p class="card-text text-muted flex-grow-1">
                                    {{ Str::limit($berita->deskripsi, 100) }}
                                </p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    Dipublikasikan pada {{ $berita->created_at->format('d F Y') }}
                                </small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                            <p class="text-muted fs-5">Belum ada berita terbaru saat ini.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="contact-section" id="contact">
        <div class="container px-4" data-aos="fade-up">
            <h2 class="section-title text-center">Hubungi Kami</h2>
            <p class="lead text-center mb-4">
                Tertarik layanan kami atau ada keluhan? Klik tombol di bawah untuk chat via WhatsApp.
            </p>
            <div class="text-center">
                <a href="https://wa.me/6281326740142" target="_blank" class="btn btn-success btn-lg px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" fill="currentColor"
                        class="bi bi-whatsapp me-2" viewBox="0 0 16 16">
                        <path
                            d="M13.601 2.326A7.95 7.95 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.78-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                    </svg>
                    0813-2674-0142
                </a>
            </div>
        </div>
    </div>

    <div class="footer">
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
            offset: 100
        });
    </script>
@endpush