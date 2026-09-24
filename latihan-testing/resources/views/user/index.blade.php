@extends('layouts.app')

@section('title', 'Users')

@section('content')

<h2>Data User</h2>

<a href="{{ route('user.create') }}">Tambah User Baru</a>

<table border="1">
    <tr>
        <th>NAMA</th>
        <th>KOTA</th>
        <th>EMAIL</th>
        <th>AKSI</th>
    </tr>

    @forelse ($users as $user)
    <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->kota }}</td>
        <td>{{ $user->email }}</td>
        <td>
            <a href="{{ route('user.show', $user->id) }}">Detail</a> |
            <a href="{{ route('user.edit', $user->id) }}">Edit</a> |
            <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
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
