@extends('layouts.app')

@section('title', 'Detail User')

@section('content')

<h1>Detail Data dengan ID {{ $user->id }}</h1>

<table border="0" width="600">
    <tr>
        <td>NAMA</td>
        <td>
            <input type="text" value="{{ $user->name }}" readonly>
        </td>
    </tr>

    <tr>
        <td>KOTA</td>
        <td>
            <input type="text" value="{{ $user->kota }}" readonly>
        </td>
    </tr>

    <tr>
        <td>EMAIL</td>
        <td>
            <input type="email" value="{{ $user->email }}" readonly>
        </td>
    </tr>

    <tr>
        <td>
            <a href="{{ route('user.index') }}">Kembali</a>
        </td>
        <td>&nbsp;</td>
    </tr>
</table>

@endsection
