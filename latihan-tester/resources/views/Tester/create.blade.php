<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
</head>
<body>

<h1>Tambah Produk</h1>

<form action="{{ route('Tester.store') }}" method="POST">
    @csrf

    <p>
        Nama:<br>
        <input type="text" name="nama">
    </p>

    <p>
        Harga:<br>
        <input type="number" name="harga">
    </p>

    <p>
        Stok:<br>
        <input type="number" name="stok">
    </p>

    <button type="submit">Simpan</button>
</form>

<a href="{{ route('Tester.index') }}">Kembali</a>

</body>
</html>
