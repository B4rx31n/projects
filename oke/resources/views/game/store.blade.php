<!DOCTYPE html>
<html>
<head>
    <title>Detail Game</title>
</head>
<body>

<h1>Game Berhasil Ditambahkan</h1>
<hr>
<p><strong>Judul Game:</strong> {{ $judul }}</p>
<p><strong>Genre:</strong> {{ $genre }}</p>
<p><strong>Tahun Rilis:</strong> {{ $tahun }}</p>
<hr>

<a href="{{ route('game.index') }}">
    <button>Kembali ke Toko Game</button></a>

</body>
</html>
