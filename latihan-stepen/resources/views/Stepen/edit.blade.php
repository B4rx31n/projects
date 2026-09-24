<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
</head>
<body>

<h1>Edit Produk</h1>

<form action="{{ route('Stepen.update', $Stepen->id) }}" method="POST">
    @csrf
    @method('PUT')

    <p>
        Nama:<br>
        <input type="text" name="nama" value="{{ $Stepen->nama }}">
    </p>

    <p>
        Harga:<br>
        <input type="number" name="harga" value="{{ $Stepen->harga }}">
    </p>

    <p>
        Stok:<br>
        <input type="number" name="stok" value="{{ $Stepen->stok }}">
    </p>

    <button type="submit">Update</button>
</form>

<a href="{{ route('Stepen.index') }}">Kembali</a>

</body>
</html>
