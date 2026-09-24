@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto">
    <div class="rounded-xl border bg-white p-6">
        <h1 class="text-xl font-semibold mb-1">Register Siswa</h1>
        <p class="text-sm text-slate-600 mb-6">Buat akun untuk mengirim aspirasi.</p>

        <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Nama</label>
                <input name="name" type="text" value="{{ old('name') }}" class="w-full rounded-lg border px-3 py-2" required autofocus>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input name="email" type="email" value="{{ old('email') }}" class="w-full rounded-lg border px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Password</label>
                <input name="password" type="password" class="w-full rounded-lg border px-3 py-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Konfirmasi Password</label>
                <input name="password_confirmation" type="password" class="w-full rounded-lg border px-3 py-2" required>
            </div>
            <button class="w-full rounded-lg bg-slate-900 text-white px-4 py-2 font-medium" type="submit">Register</button>
        </form>

        <div class="mt-4 text-sm text-slate-700">
            Sudah punya akun? <a class="underline" href="{{ route('login') }}">Login</a>
        </div>
    </div>
</div>
@endsection



