@extends('layouts.app')

@section('content')
<h1>Detail Anggota</h1>
<a href="{{ route('anggota.index') }}">Kembali ke Daftar</a>
<hr>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <td>Kode Anggota</td>
        <td>:</td>
        <td>{{ $anggota->kode_anggota }}</td>
    </tr>
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td>{{ $anggota->nama }}</td>
    </tr>
    <tr>
        <td>Email</td>
        <td>:</td>
        <td>{{ $anggota->email }}</td>
    </tr>
    <tr>
        <td>Telepon</td>
        <td>:</td>
        <td>{{ $anggota->telepon }}</td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>:</td>
        <td>{{ $anggota->alamat }}</td>
    </tr>
    <tr>
        <td>Status</td>
        <td>:</td>
        <td>{{ $anggota->status }}</td>
    </tr>
</table>
@endsection