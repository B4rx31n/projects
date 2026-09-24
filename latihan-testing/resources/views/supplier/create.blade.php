@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')
<h1>Tambah User Baru</h1>

<form action="{{ route('supplier.store') }}" method="POST">
@csrf

<table border="0" width="600">
    <tr>
        <td>NAMA</td>
        <td>
            <input type="text" name="nama" value="{{ old('nama') }}">
            @error('nama')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </td>
    </tr>

    <tr>
        <td>KOTA</td>
        <td>
            <input type="text" name="kota" value="{{ old('kota') }}">
            @error('kota')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </td>
    </tr>

    <tr>
        <td>NOMOR TELEPON</td>
        <td>
            <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon') }}">
            @error('nomor_telepon')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </td>
    </tr>

    <tr>
        <td><a href="{{ route('supplier.index') }}">Kembali</a></td>
        <td><button type="submit">Simpan ke Database</button></td>
    </tr>
</table>

</form>
@endsection
