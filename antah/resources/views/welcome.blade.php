@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center">
                <h1 class="mb-4">Selamat Datang di UKK Management System</h1>
                <p class="mb-5">Silakan pilih opsi login atau register sesuai peran Anda.</p>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow">
                            <div class="card-body text-center">
                                <i class="fas fa-sign-in-alt fa-3x text-primary mb-3"></i>
                                <h5 class="card-title">Login</h5>
                                <p class="card-text">Login sebagai Admin atau User</p>
                                <a href="{{ route('admin.login') }}" class="btn btn-primary btn-lg">Login</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card shadow">
                            <div class="card-body text-center">
                                <i class="fas fa-user-plus fa-3x text-success mb-3"></i>
                                <h5 class="card-title">Register User</h5>
                                <p class="card-text">Daftar akun user baru</p>
                                <a href="{{ route('user.register') }}" class="btn btn-success btn-lg">Register</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <p>Sudah punya akun user? <a href="{{ route('user.login') }}">Login di sini</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection