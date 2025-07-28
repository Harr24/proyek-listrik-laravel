<!DOCTYPE html>
<html lang="id">

<head>
    <title>Dashboard Pelanggan</title>
</head>

<body>
    <h1>Ini Halaman Dashboard PELANGGAN</h1>
    <p>Selamat datang, {{ Auth::user()->name }}!</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>

</html>