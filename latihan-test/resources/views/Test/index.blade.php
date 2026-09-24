<!DOCTYPE html>
<html>
<head>
    <title>Data Produk</title>
</head>
<body>

<h1>Data Produk</h1>

<a href="{{ route('Test.create') }}">+ Tambah Produk</a>

@if (session('success'))
    <p style="color: green; background: #d4edda; padding: 10px; border: 1px solid #c3e6cb;">
        {{ session('success') }}
    </p>
@endif

<div>
    <form action="{{ route('Test.index') }}" method="GET">
        <input type="text" name="search" placeholder="Cari nama, harga, atau stok..." 
               value="{{ $search ?? '' }}" style="padding: 8px; width: 300px;">
        <button type="submit" style="padding: 8px 15px;">Cari</button>
        @if(isset($search) && $search != '')
            <a href="{{ route('Test.index') }}" style="margin-left: 10px;">Clear Pencarian</a>
        @endif
    </form>
    
    @if(isset($search) && $search != '')
        <p>Hasil pencarian untuk: <strong>"{{ $search }}"</strong></p>
    @endif
</div>

<br><div>
    <form action="{{ route('Test.exportCSV') }}" method="GET">
        @if(isset($search) && $search != '')
            <input type="hidden" name="search" value="{{ $search }}">
        @endif
        <button type="submit">Export</button>
    </form>
</div>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>

    @forelse ($Test as $p)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $p->nama }}</td>
        <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
        <td>{{ $p->stok }}</td>
        <td>
            <a href="{{ route('Test.show', $p->id) }}">Detail</a> |
            <a href="{{ route('Test.edit', $p->id) }}">Edit</a> |
            <form action="{{ route('Test.destroy', $p->id) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Hapus data?')">Hapus</button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5" style="text-align: center; padding: 20px;">
            @if(isset($search) && $search != '')
                Tidak ditemukan data untuk pencarian "{{ $search }}"
            @else
                Tidak ada data produk
            @endif
        </td>
    </tr>
    @endforelse
</table>

@if($Test->count() > 0)
    <p><strong>Total Data: {{ $Test->count() }}</strong></p>
@endif

</body>
</html>