@extends('layouts.app')

@section('content')
<h1>Data Produk</h1>
<a href="{{ route('produk.create') }}">[+] Tambah Produk Baru</a>
<hr>

@if(session('success'))
<p style="color: green;">{{ session('success') }}</p>
@endif

@if(session('error'))
<p style="color: red;">{{ session('error') }}</p>
@endif

@if($produks->count() > 0)
<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Kategori</th>
            <th>Supplier</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produks as $produk)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $produk->nama_barang }}</td>
            <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
            <td>{{ $produk->jumlah }}</td>
            <td>{{ $produk->kategori ? $produk->kategori->nama : '-' }}</td>
            <td>{{ $produk->supplier ? $produk->supplier->nama : '-' }}</td>
            <td>
                <a href="{{ route('produk.show', $produk->id) }}">Lihat</a> |
                <a href="{{ route('produk.edit', $produk->id) }}">Edit</a> |
                <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>Tidak ada data produk. <a href="{{ route('produk.create') }}">Tambah produk pertama</a></p>
@endif

@endsection