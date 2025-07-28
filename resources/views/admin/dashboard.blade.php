<!DOCTYPE html>
<html lang="id">

<head>
    <title>Dashboard Admin</title>
</head>

<body>
    <h1>Ini Halaman Dashboard ADMIN</h1>
    <p>Selamat datang, {{ Auth::user()->name }}!</p>

    <a href="{{ route('admin.tarif.index') }}">Kelola Data Tarif</a>
    <br><br>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>

</html>