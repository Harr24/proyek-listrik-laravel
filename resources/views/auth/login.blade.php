@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <!-- Background & overlay tetap dipakai ringan -->
    <div class="login-background">
        <div class="background-overlay"></div>
    </div>

    <div class="col-md-12" style="max-width: 450px; position: relative; z-index: 10;">
        <div class="login-card">
            <div class="card-header-natural">
                <a href="{{ route('home') }}" class="brand-link">
                    <div class="brand-icon">
                        <!-- Icon rumah -->
                        <svg width="52" height="52" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 12L5 10M5 10L12 3L19 10M5 10V20A1 1 0 006 21H9M19 10L21 
                                         12M19 10V20A1 1 0 0018 21H15M9 21V16A1 1 0 0110 
                                         15H14A1 1 0 0115 16V21M9 21H15" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="brand-text">
                        <h4 class="company-name">PT Harrycahayarumah</h4>
                        <span class="tagline">Portal Pelanggan</span>
                    </div>
                </a>
            </div>

            <div class="card-body-natural">
                <div class="welcome-section">
                    <h5 class="welcome-title">Selamat Datang di Rumah Anda</h5>
                    <p class="welcome-subtitle">Masuk untuk mengakses layanan pelanggan</p>
                </div>

                @if ($errors->any())
                    <div class="alert-natural">
                        <div class="alert-content">
                            <svg width="18" height="18" class="alert-icon" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 
                                               1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 
                                               1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <div class="alert-messages">
                                @foreach ($errors->all() as $error)
                                    <div class="alert-message">{{ $error }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="login-form">
                    @csrf
                    <div class="input-group-natural">
                        <label for="email" class="input-label">
                            <svg width="18" height="18" class="label-icon" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 
                                             0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 
                                             2h12a2 2 0 002-2V8.118z" />
                            </svg>
                            Alamat Email
                        </label>
                        <input type="email" class="input-natural" id="email" name="email" value="{{ old('email') }}"
                            placeholder="Masukkan email Anda" required>
                    </div>

                    <div class="input-group-natural">
                        <label for="password" class="input-label">
                            <svg width="18" height="18" class="label-icon" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 
                                           012 2v5a2 2 0 01-2 2H5a2 2 0 
                                           01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 
                                           3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                            Password
                        </label>
                        <input type="password" class="input-natural" id="password" name="password"
                            placeholder="Masukkan password Anda" required>
                    </div>

                    <div class="button-group">
                        <button type="submit" class="btn-login-natural">
                            <svg width="18" height="18" class="btn-icon" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 011 1v12a1 1 
                                           0 11-2 0V4a1 1 0 011-1zm7.707 
                                           3.293a1 1 0 010 1.414L9.414 
                                           9H17a1 1 0 110 2H9.414l1.293 
                                           1.293a1 1 0 01-1.414 1.414l-3-3a1 
                                           1 0 010-1.414l3-3a1 1 0 
                                           011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Masuk ke Portal
                        </button>

                        <a href="{{ route('home') }}" class="btn-back-natural">
                            <svg width="18" height="18" class="btn-icon" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 
                                           01-1.414 0l-6-6a1 1 0 
                                           010-1.414l6-6a1 1 0 011.414 
                                           1.414L5.414 9H17a1 1 0 110 
                                           2H5.414l4.293 4.293a1 1 0 
                                           010 1.414z" clip-rule="evenodd" />
                            </svg>
                            Kembali ke Beranda
                        </a>
                    </div>
                </form>
            </div>

            <div class="card-footer-natural">
                <div class="footer-content">
                    <svg width="16" height="16" class="footer-icon" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 
                                   8 0 0116 0zm-7-4a1 1 0 11-2 
                                   0 1 1 0 012 0zM9 9a1 1 0 000 
                                   2v3a1 1 0 001 1h1a1 1 0 
                                   100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                    <span>Belum punya akun? Hubungi admin untuk pendaftaran</span>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Background overlay ringan */
        .login-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('images/bg-village.jpg') }}');
            background-size: cover;
            background-position: center;
            z-index: 1;
        }

        .background-overlay {
            position: absolute;
            inset: 0;
            background: rgba(44, 62, 80, 0.4);
        }

        /* Card styling simpel */
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 24px;
            box-shadow: 0 10px 20px rgba(52, 73, 94, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .card-header-natural {
            background: linear-gradient(135deg, #8B4513, #A0522D, #CD853F);
            padding: 2rem;
            text-align: center;
        }

        .brand-link {
            text-decoration: none;
            color: white;
        }

        .brand-icon {
            background: rgba(255, 255, 255, 0.1);
            padding: 12px;
            border-radius: 16px;
        }

        .company-name {
            font-size: 1.4rem;
            margin: 0;
        }

        .tagline {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .card-body-natural {
            padding: 2rem;
        }

        .welcome-title {
            color: #654321;
            font-size: 1.3rem;
        }

        .welcome-subtitle {
            color: #8B6914;
            font-size: 0.95rem;
        }

        .alert-natural {
            background: #FED7D7;
            border: 1px solid #FC8181;
            border-radius: 16px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            color: #C53030;
        }

        .login-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .input-label {
            color: #654321;
            font-weight: 600;
        }

        .input-natural {
            padding: 1rem;
            border: 2px solid #DDD6C1;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.9);
            transition: border-color 0.2s;
        }

        .input-natural:focus {
            border-color: #CD853F;
            background: white;
        }

        .btn-login-natural {
            background: linear-gradient(135deg, #8B4513, #A0522D, #CD853F);
            color: white;
            border-radius: 16px;
            padding: 1rem;
            font-size: 1.1rem;
            font-weight: 600;
            border: none;
        }

        .btn-login-natural:hover {
            background: #A0522D;
        }

        .btn-back-natural {
            background: white;
            color: #8B4513;
            border: 2px solid #DDD6C1;
            border-radius: 16px;
            padding: 0.9rem;
        }

        .btn-back-natural:hover {
            background: #fdfaf5;
        }

        .card-footer-natural {
            background: #FAEBD7;
            padding: 1.5rem;
            border-top: 1px solid rgba(139, 69, 19, 0.1);
            text-align: center;
            color: #8B4513;
        }
    </style>
@endsection