@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="col-md-12" style="width: 400px;">
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <a href="{{ route('home') }}" class="text-dark text-decoration-none">
                    <h3 class="mb-0">PT Harrycahayarumah</h3>
                </a>
            </div>
            <div class="card-body p-4">
                <h5 class="card-title text-center mb-4">Login Pelanggan</h5>
                @if ($errors->any())
                    <div class="alert alert-danger py-2">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li><small>{{ $error }}</small></li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Login</button>
                        {{-- Tombol Kembali ke Homepage --}}
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary">Kembali ke Homepage</a>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                <small>Belum punya akun? Silakan hubungi admin untuk pendaftaran.</small>
            </div>
        </div>
    </div>
@endsection