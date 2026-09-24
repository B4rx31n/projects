<!DOCTYPE html>
<html>
<head>
    <title>Detail Produk</title>
</head>
<body>

<h1>Detail Produk</h1>

<p>Nama: {{ $Test->nama }}</p>
<p>Harga: {{ $Test->harga }}</p>
<p>Stok: {{ $Test->stok }}</p>

<a href="{{ route('Test.index') }}">Kembali</a>

</body>
</html>
