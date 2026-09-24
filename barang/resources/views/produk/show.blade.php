<!DOCTYPE html>
<html>
<head>
    <title>Detail Produk</title>
</head>
<body>

<h1>Detail Produk</h1>

<p>Nama: {{ $produk->nama }}</p>
<p>Harga: {{ $produk->harga }}</p>
<p>Stok: {{ $produk->stok }}</p>

<a href="{{ route('produk.index') }}">Kembali</a>

</body>
</html>
