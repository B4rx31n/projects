@extends('layouts.app')

@section('title', 'Tambah User')
@section('page-title', 'Tambah User') <!-- Tambahkan ini untuk breadcrumb -->

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Tambah User Baru</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('user.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">NAMA *</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">KOTA *</label>
                <input type="text" name="kota" class="form-control @error('kota') is-invalid @enderror" 
                       value="{{ old('kota') }}" required>
                @error('kota')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">EMAIL *</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                       value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">PASSWORD *</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                       required>
                <small class="text-muted">Minimal 8 karakter</small>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">KONFIRMASI PASSWORD *</label>
                <input type="password" name="password_confirmation" class="form-control" required>
                <small class="text-muted">Ketik ulang password</small>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan ke Database
                </button>
                <a href="{{ route('user.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection