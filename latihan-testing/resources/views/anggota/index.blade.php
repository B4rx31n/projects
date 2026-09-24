@extends('layouts.app')

@section('content')
<h1>Data Anggota</h1>
<a href="{{ route('anggota.create') }}">[+] Tambah Anggota Baru</a>
<hr>

@if(session('success'))
<p style="color: green;">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Anggota</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>Alamat</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($anggota as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->kode_anggota }}</td>
            <td>{{ $item->nama }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->telepon }}</td>
            <td>{{ $item->alamat }}</td>
            <td>{{ $item->status }}</td>
            <td>
                <a href="{{ route('anggota.show', $item->id) }}">Lihat</a> |
                <a href="{{ route('anggota.edit', $item->id) }}">Edit</a> |
                <form action="{{ route('anggota.destroy', $item->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection