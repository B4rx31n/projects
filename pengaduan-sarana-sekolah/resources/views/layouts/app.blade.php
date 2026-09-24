<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name', 'Aplikasi Pengaduan Sarana Sekolah') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
    <nav class="border-b bg-white">
        <div class="mx-auto max-w-6xl px-4 py-3 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('home') }}" class="font-semibold">Pengaduan Sarana Sekolah</a>
                @auth
                    <span class="text-xs rounded-full bg-slate-100 px-2 py-1 text-slate-600">
                        {{ auth()->user()->role }}
                    </span>
                @endauth
            </div>
            <div class="flex items-center gap-2">
                @auth
                    @if (auth()->user()->isAdmin())
                        <a class="px-3 py-2 text-sm hover:bg-slate-100 rounded" href="{{ route('admin.aspirations.index') }}">Dashboard Admin</a>
                    @else
                        <a class="px-3 py-2 text-sm hover:bg-slate-100 rounded" href="{{ route('student.aspirations.index') }}">Form Aspirasi</a>
                        <a class="px-3 py-2 text-sm hover:bg-slate-100 rounded" href="{{ route('student.aspirations.history') }}">Histori</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="px-3 py-2 text-sm hover:bg-slate-100 rounded" type="submit">Logout</button>
                    </form>
                @else
                    <a class="px-3 py-2 text-sm hover:bg-slate-100 rounded" href="{{ route('login') }}">Login</a>
                    <a class="px-3 py-2 text-sm hover:bg-slate-100 rounded" href="{{ route('register') }}">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="mx-auto max-w-6xl px-4 py-6">
        @if (session('success'))
            <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-900">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-rose-900">
                <div class="font-semibold mb-1">Periksa input:</div>
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{ $slot ?? '' }}
        @yield('content')
    </main>
</body>
</html>



