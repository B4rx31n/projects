@extends('layouts.app')

@section('title', 'Detail User')

@section('content')

<h1>Detail Supplier dengan ID {{ $supplier->id }}</h1>

<table border="0" width="600">
    <tr>
        <td>NAMA</td>
        <td>
            <input type="text" value="{{ $supplier->nama }}" readonly>
        </td>
    </tr>

    <tr>
        <td>KOTA</td>
        <td>
            <input type="text" value="{{ $supplier->kota }}" readonly>
        </td>
    </tr>

    <tr>
        <td>
            <a href="{{ route('supplier.index') }}">Kembali</a>
        </td>
        <td>&nbsp;</td>
    </tr>
</table>

<h2>Riwayat Pengiriman</h2>
@if($supplier->pengirimans->count() > 0)
<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Tanggal Kirim</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($supplier->pengirimans as $kirim)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $kirim->produk->nama_barang }}</td>
            <td>{{ $kirim->jumlah_kirim }}</td>
            <td>{{ $kirim->tanggal_kirim }}</td>
            <td>{{ $kirim->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>Tidak ada riwayat pengiriman.</p>
@endif

@endsection
