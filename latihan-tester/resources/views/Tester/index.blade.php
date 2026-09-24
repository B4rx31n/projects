<!DOCTYPE html>
<html>
<head>
    <title>Data Produk</title>
</head>
<body>

<h1>Data Produk</h1>

<a href="{{ route('Tester.create') }}">+ Tambah Produk</a>

@if (session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>

    @foreach ($Tester as $p)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $p->nama }}</td>
        <td>{{ $p->harga }}</td>
        <td>{{ $p->stok }}</td>
        <td>
            <a href="{{ route('Tester.show', $p->id) }}">Detail</a> |
            <a href="{{ route('Tester.edit', $p->id) }}">Edit</a> |

            <form action="{{ route('Tester.destroy', $p->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Hapus data?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

</body>
</html>
