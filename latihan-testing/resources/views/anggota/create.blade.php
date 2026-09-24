@extends('layouts.app')

@section('content')
<h1>Tambah Anggota Baru</h1>
<a href="{{ route('anggota.index') }}">Kembali ke Daftar</a>
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

<form action="{{ route('anggota.store') }}" method="POST">
    @csrf

    <table cellpadding="8">
        <tr>
            <td>Kode Anggota</td>
            <td>:</td>
            <td><input type="text" name="kode_anggota" required></td>
        </tr>
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><input type="text" name="nama" required></td>
        </tr>
        <tr>
            <td>Email</td>
            <td>:</td>
            <td><input type="email" name="email" required></td>
        </tr>
        <tr>
            <td>Telepon</td>
            <td>:</td>
            <td><input type="text" name="telepon" required></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td><textarea name="alamat" required></textarea></td>
        </tr>
        <tr>
            <td>Status</td>
            <td>:</td>
            <td>
                <select name="status" required>
                    <option value="aktif">Aktif</option>
                    <option value="nonaktif">Nonaktif</option>
                </select>
            </td>
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