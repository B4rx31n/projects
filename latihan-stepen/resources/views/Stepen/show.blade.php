<!DOCTYPE html>
<html>
<head>
    <title>Detail Stepen</title>
</head>
<body>

<h1>Detail Stepen</h1>

<p>Nama: {{ $Stepen->nama }}</p>
<p>Harga: {{ $Stepen->harga }}</p>
<p>Stok: {{ $Stepen->stok }}</p>

<a href="{{ route('Stepen.index') }}">Kembali</a>

</body>
</html>
