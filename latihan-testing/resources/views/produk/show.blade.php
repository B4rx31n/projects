@extends('layouts.app')

@section('content')
<h1>Detail Produk</h1>
<a href="{{ route('produk.index') }}">Kembali ke Daftar</a>
<hr>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <td>Nama Barang</td>
        <td>:</td>
        <td>{{ $produk->nama_barang }}</td>
    </tr>
    <tr>
        <td>Kategori</td>
        <td>:</td>
        <td>{{ $produk->kategori ? $produk->kategori->nama : '-' }}</td>
    </tr>
    <tr>
        <td>Stok Tersedia</td>
        <td>:</td>
        <td>{{ $produk->jumlah }}</td>
    </tr>
    <tr>
        <td>Harga</td>
        <td>:</td>
        <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <td>Status</td>
        <td>:</td>
        <td>
            @if($produk->jumlah > 0)
                <span style="color: green;">Tersedia</span>
            @else
                <span style="color: red;">Habis</span>
            @endif
        </td>
    </tr>
</table>

<h2>Riwayat Pengiriman</h2>
@if($pengiriman->count() > 0)
<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Supplier</th>
            <th>Jumlah</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pengiriman as $kirim)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $kirim->tanggal_kirim }}</td>
            <td>{{ $kirim->supplier->nama }}</td>
            <td>{{ $kirim->jumlah_kirim }}</td>
            <td>{{ $kirim->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>Belum ada riwayat pengiriman.</p>
@endif

@endsection