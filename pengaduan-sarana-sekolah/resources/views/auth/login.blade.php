@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto">
    <div class="rounded-xl border bg-white p-6">
        <h1 class="text-xl font-semibold mb-1">Login</h1>
        <p class="text-sm text-slate-600 mb-6">Masuk untuk mengisi aspirasi atau memproses umpan balik.</p>

        <form method="POST" action="{{ route('login.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input name="email" type="email" value="{{ old('email') }}" class="w-full rounded-lg border px-3 py-2" required autofocus>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Password</label>
                <input name="password" type="password" class="w-full rounded-lg border px-3 py-2" required>
            </div>
            <div class="flex items-center justify-between">
                <label class="inline-flex items-center gap-2 text-sm text-slate-700">
                    <input type="checkbox" name="remember" class="rounded border">
                    Remember
                </label>
                <a class="text-sm text-slate-700 underline" href="{{ route('register') }}">Buat akun siswa</a>
            </div>
            <button class="w-full rounded-lg bg-slate-900 text-white px-4 py-2 font-medium" type="submit">Login</button>
        </form>

        <div class="mt-6 text-xs text-slate-600">
            Akun demo:
            <div class="mt-1">
                Admin: <span class="font-mono">admin@demo.test</span> / <span class="font-mono">password</span><br>
                Siswa: <span class="font-mono">siswa@demo.test</span> / <span class="font-mono">password</span>
            </div>
        </div>
    </div>
</div>
@endsection



