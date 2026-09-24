@extends('layouts.app')

@section('title', 'Tambah Supplier')

@section('header-action')
<a href="{{ route('supplier.index') }}" class="btn btn-secondary">
    <i class="fas fa-arrow-left me-2"></i>Kembali
</a>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Tambah Supplier Baru</h5>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div style="color: green; margin-bottom: 10px;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('warnings'))
            <div style="color: orange; background-color: #fff3cd; border: 1px solid #ffeaa7; 
                        padding: 10px 15px; border-radius: 5px; margin-bottom: 20px;">
                <strong><i class="fas fa-exclamation-triangle me-2"></i>Perhatian:</strong>
                <ul style="margin: 5px 0 0 20px; padding: 0;">
                    @foreach(session('warnings') as $warning)
                    <li>{{ $warning }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('supplier.store') }}" method="POST">
            @csrf
            <table width="100%">
                <tr>
                    <td width="150"><label>NAMA SUPPLIER</label></td>
                    <td>
                        <input type="text" name="nama_supplier" class="form-control" 
                               value="{{ old('nama_supplier') }}">
                        @error('nama_supplier')
                            <br><small style="color: red;">{{ $message }}</small>
                        @enderror
                    </td>
                </tr>
                <tr><td colspan="2"><div style="height: 15px;"></div></td></tr>
                <tr>
                    <td><label>KOTA</label></td>
                    <td>
                        <input type="text" name="kota" class="form-control" 
                               value="{{ old('kota') }}">
                        @error('kota')
                            <br><small style="color: red;">{{ $message }}</small>
                        @enderror
                    </td>
                </tr>
                <tr><td colspan="2"><div style="height: 15px;"></div></td></tr>
                <tr>
                    <td><label>NOMOR TELEPON</label></td>
                    <td>
                        <input type="text" name="nomor_telepon" class="form-control" 
                               value="{{ old('nomor_telepon') }}">
                        @error('nomor_telepon')
                            <br><small style="color: red;">{{ $message }}</small>
                        @enderror
                    </td>
                </tr>
                <tr><td colspan="2"><div style="height: 20px;"></div></td></tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Supplier
                        </button>
                        <a href="{{ route('supplier.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
@endsection