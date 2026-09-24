<!DOCTYPE html>
<html lang="en" class="min-h-screen bg-slate-50 text-slate-900 antialiased">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Pengaduan Sekolah')</title>

    {{-- IMPORTANT: Pastikan ini benar, biar Tailwind jalan --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Background halus + grid tipis (light mode) */
        body{
            background:
              radial-gradient(900px 520px at 10% 0%, rgba(16,185,129,.10), transparent 60%),
              radial-gradient(820px 520px at 92% 8%, rgba(14,165,233,.08), transparent 55%),
              linear-gradient(180deg, #f8fafc 0%, #f8fafc 100%);
        }
        .bg-grid{
            background-image:
              linear-gradient(to right, rgba(15,23,42,.06) 1px, transparent 1px),
              linear-gradient(to bottom, rgba(15,23,42,.06) 1px, transparent 1px);
            background-size: 44px 44px;
            mask-image: radial-gradient(ellipse at center, black 60%, transparent 82%);
        }

        /* Scrollbar light */
        ::-webkit-scrollbar { width: 10px; height: 10px; }
        ::-webkit-scrollbar-track { background: rgba(15,23,42,.04); }
        ::-webkit-scrollbar-thumb { background: rgba(15,23,42,.18); border-radius: 999px; }
        ::-webkit-scrollbar-thumb:hover { background: rgba(15,23,42,.26); }

        /* “Design tokens” sederhana */
        .card{
            background: linear-gradient(180deg, rgba(255,255,255,.92), rgba(241,245,249,.92));
            border: 1px solid rgba(15,23,42,.10);
            box-shadow: 0 10px 26px rgba(2,6,23,.08);
            border-radius: 16px;
        }
        .card-hover{
            transition: transform .15s ease, border-color .15s ease, box-shadow .15s ease;
        }
        .card-hover:hover{
            transform: translateY(-2px);
            border-color: rgba(16,185,129,.30);
            box-shadow: 0 14px 34px rgba(2,6,23,.10);
        }
        .chip{
            border: 1px solid rgba(15,23,42,.12);
            background: rgba(15,23,42,.04);
            border-radius: 999px;
        }
        .btn{
            border: 1px solid rgba(15,23,42,.14);
            background: rgba(15,23,42,.04);
            border-radius: 12px;
            transition: transform .12s ease, background .12s ease, border-color .12s ease, box-shadow .12s ease;
        }
        .btn:hover{
            background: rgba(15,23,42,.06);
            border-color: rgba(16,185,129,.30);
        }
        .btn:active{ transform: scale(.98); }

        .btn-primary{
            background: rgba(16,185,129,.14);
            border-color: rgba(16,185,129,.34);
            box-shadow: 0 10px 22px rgba(16,185,129,.10);
        }
        .btn-primary:hover{
            background: rgba(16,185,129,.18);
            border-color: rgba(16,185,129,.44);
            box-shadow: 0 14px 30px rgba(16,185,129,.12);
        }
    </style>
</head>

<body class="min-h-screen">
    <div class="relative min-h-screen">
        <div class="pointer-events-none absolute inset-0 bg-grid opacity-60"></div>

        <div class="relative z-10 flex min-h-screen">
            {{-- Sidebar --}}
            @include('layouts.sidebar')

            {{-- Main --}}
            <div class="flex-1 flex flex-col min-h-screen">
                {{-- Navbar --}}
                <header class="sticky top-0 z-30 px-4 sm:px-6 pt-4">
                    <div class="card px-4 py-3">
                        @include('layouts.navbar')
                    </div>
                </header>

                {{-- Content --}}
                <main class="flex-1 px-4 sm:px-6 py-6">
                    <div class="card card-hover p-5 sm:p-6">
                        @yield('content')
                    </div>
                </main>

                {{-- Footer --}}
                <footer class="px-4 sm:px-6 pb-4">
                    <div class="card px-4 py-3">
                        @include('layouts.footer')
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
        }
    </script>
</body>
</html>
