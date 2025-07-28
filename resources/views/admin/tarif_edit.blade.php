<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-T">
    <title>Edit Data Tarif</title>
</head>

<body>
    <h1>Form Edit Data Tarif</h1>
    <a href="{{ route('admin.tarif.index') }}">Kembali ke Daftar Tarif</a>
    <hr>

    {{-- Menampilkan error validasi --}}
    @if ($errors->any())
        <div style="color: red;">
            <strong>Whoops!</strong> Ada beberapa masalah dengan input Anda.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.tarif.update', $tarif->id_tarif) }}" method="POST">
        @csrf @method('PUT') <div>
            <label for="daya">Daya</label><br>
            <input type="text" id="daya" name="daya" value="{{ $tarif->daya }}" required>
        </div>
        <br>
        <div>
            <label for="tarif_per_kwh">Tarif / KWH</label><br>
            <input type="number" id="tarif_per_kwh" name="tarif_per_kwh" value="{{ $tarif->tarif_per_kwh }}" required>
        </div>
        <br>
        <button type="submit">Update Data</button>
    </form>
</body>

</html>