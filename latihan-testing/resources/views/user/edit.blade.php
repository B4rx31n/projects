@extends('layouts.app')

@section('title', 'Edit User')

@section('content')

<h1>Edit User dengan ID {{ $user->id }}</h1>

<form action="{{ route('user.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <table border="0" width="600">
        <tr>
            <td>NAMA</td>
            <td>
                <input type="text" name="name" value="{{ $user->name }}">
                @error('name')
                    <div style="color:red;">{{ $message }}</div>
                @enderror
            </td>
        </tr>

        <tr>
            <td>KOTA</td>
            <td>
                <input type="text" name="kota" value="{{ $user->kota }}">
                @error('kota')
                    <div style="color:red;">{{ $message }}</div>
                @enderror
            </td>
        </tr>

        <tr>
            <td>
                <a href="{{ route('user.index') }}">Kembali</a>
            </td>
            <td>
                <button type="submit">Update</button>
            </td>
        </tr>
    </table>
</form>

@endsection
