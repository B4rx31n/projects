<!DOCTYPE html>
<html>
<head>
    <title>Detail Produk</title>
</head>
<body>

<h1>Detail Produk</h1>

<p>Nama: {{ $Tester->nama }}</p>
<p>Harga: {{ $Tester->harga }}</p>
<p>Stok: {{ $Tester->stok }}</p>

<a href="{{ route('Tester.index') }}">Kembali</a>

</body>
</html>
