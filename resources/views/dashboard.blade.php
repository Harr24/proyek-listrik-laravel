<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>

<body>
    <h1>Selamat Datang, {{ Auth::user()->name }}!</h1>
    <p>Anda berhasil login. Role Anda adalah: <strong>{{ Auth::user()->role }}</strong></p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>

</html>