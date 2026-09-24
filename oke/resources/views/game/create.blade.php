<!DOCTYPE html>
<html>
<head>
    <title>Tambah Game</title>
</head>
<body>

<h1>Form Tambah Game</h1>

<form action="{{ route('game.store') }}" method="POST">
    @csrf

    <label>Judul Game</label><br>
    <input type="text" name="judul" required>
    <br><br>

    <label>Genre</label><br>
    <input type="text" name="genre" required>
    <br><br>

    <label>Tahun Rilis</label><br>
    <input type="number" name="tahun_rilis" required>
    <br><br>

    <button type="submit">Simpan</button>
</form>

<br>

<a href="{{ route('game.index') }}">
    <button>Kembali</button>
</a>

</body>
</html>
