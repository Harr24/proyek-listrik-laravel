<!DOCTYPE html>
<html>

<head>
    <title>Registrasi</title>
</head>

<body>
    <h2>Form Registrasi</h2>
    <form method="POST" action="/register">
        @csrf <div>
            <label>Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name') <div>{{ $message }}</div> @enderror
        </div>
        <br>
        <div>
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email') <div>{{ $message }}</div> @enderror
        </div>
        <br>
        <div>
            <label>Password</label>
            <input type="password" name="password" required>
            @error('password') <div>{{ $message }}</div> @enderror
        </div>
        <br>
        <div>
            <label>Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required>
        </div>
        <br>
        <button type="submit">Daftar</button>
    </form>
    <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
</body>

</html>