@extends('layouts.app')

@section('title', 'Supplier')

@section('content')

<h2>Data Supplier</h2>

<a href="{{ route('supplier.create') }}">Tambah Supplier Baru</a>

<table border="1">
    <tr>
        <th>NAMA</th>
        <th>KOTA</th>
        <th>NOMOR TELEPON</th>
        <th>AKSI</th>
    </tr>

    @forelse ($suppliers as $supplier)
    <tr>
        <td>{{ $supplier->nama }}</td>
        <td>{{ $supplier->kota }}</td>
        <td>{{ $supplier->nomor_telepon }}</td>
        <td>
            <a href="{{ route('supplier.show', $supplier->id) }}">Detail</a> |
            <a href="{{ route('supplier.edit', $supplier->id) }}">Edit</a> |
            <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
            </form>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="4">Data tidak tersedia</td>
    </tr>
    @endforelse
</table>

@endsection
