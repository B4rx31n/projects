<aside
    id="sidebar"
    class="hidden md:flex w-72 min-h-screen flex-col p-4 lg:p-5
           bg-white/65 backdrop-blur-xl border-r border-slate-200
           text-slate-800 shadow-[0_12px_40px_rgba(2,6,23,.10)]"
>
    <div class="flex items-center justify-between">
        <div>
            <div class="text-sm text-slate-500">Menu</div>
            <div class="text-lg font-semibold tracking-tight text-slate-900">Navigasi</div>
        </div>
        <span class="chip px-3 py-1 text-xs text-slate-600">v1.0</span>
    </div>

    <div class="mt-4 h-px bg-gradient-to-r from-transparent via-emerald-500/25 to-transparent"></div>

    <div class="mt-4 flex items-center gap-3">
        <div class="h-10 w-10 rounded-xl bg-white border border-slate-200 shadow-sm grid place-items-center">
            <span class="text-sm font-semibold text-slate-800">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </span>
        </div>
        <div class="min-w-0">
            <div class="truncate text-sm font-medium text-slate-900">{{ auth()->user()->name }}</div>
            <div class="text-xs text-slate-500">Role: {{ auth()->user()->role }}</div>
        </div>
    </div>

    <div class="mt-6 space-y-2">
        <a href="{{ route('dashboard') }}"
           class="group flex items-center gap-3 rounded-xl px-4 py-3 transition
           {{ request()->routeIs('dashboard')
                ? 'bg-emerald-50 border border-emerald-200 text-slate-900 shadow-sm'
                : 'bg-white/40 border border-transparent text-slate-700 hover:bg-slate-50 hover:text-slate-900 hover:border-slate-200' }}">
            <span class="grid place-items-center h-9 w-9 rounded-lg border transition
                {{ request()->routeIs('dashboard')
                    ? 'bg-emerald-50 border-emerald-200 text-emerald-700'
                    : 'bg-white border-slate-200 text-slate-700 group-hover:bg-slate-50' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                </svg>
            </span>
            <span class="font-medium">Dashboard</span>
        </a>

        @if(auth()->user()->role === 'admin')
        <a href="{{ route('dashboard') }}#semua-pengaduan"
           class="group flex items-center gap-3 rounded-xl px-4 py-3 transition
                  bg-white/40 border border-transparent text-slate-700
                  hover:bg-slate-50 hover:text-slate-900 hover:border-slate-200">
            <span class="grid place-items-center h-9 w-9 rounded-lg bg-white border border-slate-200 text-slate-700 group-hover:bg-slate-50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </span>
            <span class="font-medium">Semua Pengaduan</span>
        </a>
        @endif

        @if(auth()->user()->role === 'siswa')
        <a href="{{ route('dashboard') }}#pengaduan"
           class="group flex items-center gap-3 rounded-xl px-4 py-3 transition
                  bg-white/40 border border-transparent text-slate-700
                  hover:bg-slate-50 hover:text-slate-900 hover:border-slate-200">
            <span class="grid place-items-center h-9 w-9 rounded-lg bg-white border border-slate-200 text-slate-700 group-hover:bg-slate-50">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4v16m8-8H4" />
                </svg>
            </span>
            <span class="font-medium">Ajukan Pengaduan</span>
        </a>
        @endif
    </div>

    <div class="mt-auto pt-6">
        <div class="h-px bg-slate-200"></div>
        <div class="pt-3 text-center text-xs text-slate-500">
            Pengaduan Sekolah <span class="text-slate-400">•</span> v1.0
        </div>
    </div>
</aside>
