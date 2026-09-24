<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
</head>
<body>

<h1>Edit Produk</h1>

<form action="{{ route('produk.update', $produk->id) }}" method="POST">
    @csrf
    @method('PUT')

    <p>
        Nama:<br>
        <input type="text" name="nama" value="{{ $produk->nama }}">
    </p>

    <p>
        Harga:<br>
        <input type="number" name="harga" value="{{ $produk->harga }}">
    </p>

    <p>
        Stok:<br>
        <input type="number" name="stok" value="{{ $produk->stok }}">
    </p>

    <button type="submit">Update</button>
</form>

<a href="{{ route('produk.index') }}">Kembali</a>

</body>
</html>
