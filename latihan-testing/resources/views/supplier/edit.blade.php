@extends('layouts.app')

@section('title', 'Edit Supplier')

@section('content')
<h1>Edit Supplier</h1>

<form action="{{ route('supplier.update', $supplier->id) }}" method="POST">
@csrf
@method('PUT')

<table border="0" width="600">
    <tr>
        <td>NAMA</td>
        <td>
            <input type="text" name="name" value="{{ old('name', $supplier->nama) }}">
            @error('name')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </td>
    </tr>

    <tr>
        <td>KOTA</td>
        <td>
            <input type="text" name="kota" value="{{ old('kota', $supplier->kota) }}">
            @error('kota')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </td>
    </tr>

    <tr>
        <td>NOMOR TELEPON</td>
        <td>
            <input type="text" name="no_hp" value="{{ old('no_hp', $supplier->no_hp) }}">
            @error('no_hp')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </td>
    </tr>

    <tr>
        <td><a href="{{ route('supplier.index') }}">Kembali</a></td>
        <td><button type="submit">Update</button></td>
    </tr>
</table>

</form>
@endsection
