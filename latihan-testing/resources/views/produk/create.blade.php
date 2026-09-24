@extends('layouts.app')

@section('content')
<h1>Tambah Produk Baru</h1>
<a href="{{ route('produk.index') }}">Kembali ke Daftar</a>
<hr>

@if ($errors->any())
<div style="color: red;">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('produk.store') }}" method="POST">
    @csrf

    <table cellpadding="8">
        <tr>
            <td>Nama Barang</td>
            <td>:</td>
            <td><input type="text" name="nama_barang" value="{{ old('nama_barang') }}" required></td>
        </tr>
        <tr>
            <td>Jumlah</td>
            <td>:</td>
            <td><input type="number" name="jumlah" value="{{ old('jumlah') }}" min="0" required></td>
        </tr>
        <tr>
            <td>Kategori</td>
            <td>:</td>
            <td>
                <select name="kategori_id" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama ?? 'Kategori ' . $kategori->id }}
                        </option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td>Supplier</td>
            <td>:</td>
            <td>
                <select name="supplier_id">
                    <option value="">Pilih Supplier (Opsional)</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->nama }}
                        </option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td>Harga</td>
            <td>:</td>
            <td><input type="number" name="harga" step="0.01" value="{{ old('harga') }}" min="0" required></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <button type="submit">Simpan</button>
                <button type="reset">Reset</button>
            </td>
        </tr>
    </table>
</form>

@endsection