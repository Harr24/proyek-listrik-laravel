<!DOCTYPE html>
<html lang="id">

<head>
    <title>Dashboard Admin</title>
    <style>
        body {
            font-family: sans-serif;
        }

        .nav-link {
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h1>Ini Halaman Dashboard ADMIN</h1>
    <p>Selamat datang, {{ Auth::user()->name }}!</p>
    <hr>

    <a href="{{ route('admin.tarif.index') }}" class="nav-link">Kelola Data Tarif</a>
    <a href="{{ route('admin.pelanggan.index') }}" class="nav-link">Kelola Data Pelanggan</a>
    <br>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>

</html>