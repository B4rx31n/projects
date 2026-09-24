<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
</head>
<body>

<h1>Edit Produk</h1>

<form action="{{ route('Tester.update', $Tester->id) }}" method="POST">
    @csrf
    @method('PUT')

    <p>
        Nama:<br>
        <input type="text" name="nama" value="{{ $Tester->nama }}">
    </p>

    <p>
        Harga:<br>
        <input type="number" name="harga" value="{{ $Tester->harga }}">
    </p>

    <p>
        Stok:<br>
        <input type="number" name="stok" value="{{ $Tester->stok }}">
    </p>

    <button type="submit">Update</button>
</form>

<a href="{{ route('Tester.index') }}">Kembali</a>

</body>
</html>
