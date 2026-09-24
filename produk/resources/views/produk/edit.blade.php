@extends('layouts.app')

@section('title', 'Edit Produk')

@section('header-action')
<a href="{{ route('produk.index') }}" class="btn btn-secondary">
    <i class="fas fa-arrow-left me-2"></i>Kembali
</a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Produk</h5>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div style="color: green; margin-bottom: 10px;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('produk.update', $produk->id) }}" method="POST">
            @csrf
            @method('PUT')
            <table width="100%">
                <tr>
                    <td width="150"><label>NAMA BARANG</label></td>
                    <td>
                        <input type="text" name="nama_barang" class="form-control" 
                               value="{{ old('nama_barang', $produk->nama_barang) }}">
                        @error('nama_barang')
                            <br><small style="color: red;">{{ $message }}</small>
                        @enderror
                    </td>
                </tr>
                <tr><td colspan="2"><div style="height: 15px;"></div></td></tr>
                <tr>
                    <td><label>KATEGORI</label></td>
                    <td>
                        <select name="kategori_id" class="form-control">
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_id', $produk->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <br><small style="color: red;">{{ $message }}</small>
                        @enderror
                    </td>
                </tr>
                <tr><td colspan="2"><div style="height: 15px;"></div></td></tr>
                <tr>
                    <td><label>JUMLAH BARANG</label></td>
                    <td>
                        <input type="text" name="jumlah" class="form-control" 
                               value="{{ old('jumlah', $produk->jumlah) }}">
                        @error('jumlah')
                            <br><small style="color: red;">{{ $message }}</small>
                        @enderror
                    </td>
                </tr>
                <tr><td colspan="2"><div style="height: 20px;"></div></td></tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Produk
                        </button>
                        <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
@endsection