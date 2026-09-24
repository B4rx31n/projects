<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
</head>
<body>

<h1>Edit Produk</h1>

<form action="{{ route('Test.update', $Test->id) }}" method="POST">
    @csrf
    @method('PUT')

    <p>
        Nama:<br>
        <input type="text" name="nama" value="{{ $Test->nama }}">
    </p>

    <p>
        Harga:<br>
        <input type="number" name="harga" value="{{ $Test->harga }}">
    </p>

    <p>
        Stok:<br>
        <input type="number" name="stok" value="{{ $Test->stok }}">
    </p>

    <button type="submit">Update</button>
</form>

<a href="{{ route('Test.index') }}">Kembali</a>

</body>
</html>
