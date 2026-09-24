<nav class="flex items-center justify-between">
    <div class="flex items-center gap-3">
        <button
            onclick="toggleSidebar()"
            class="md:hidden inline-flex items-center justify-center rounded-lg p-2
                   text-slate-600 hover:text-slate-900 hover:bg-slate-100
                   transition"
            aria-label="Toggle Sidebar"
        >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>

        <a href="{{ route('dashboard') }}"
           class="text-lg sm:text-xl font-semibold tracking-tight text-slate-900 hover:text-emerald-700 transition">
            Pengaduan Sekolah
        </a>
        <span class="chip px-3 py-1 text-xs text-slate-600 hidden sm:inline">Dashboard</span>
    </div>

    <div class="flex items-center gap-3">
        <span class="hidden sm:inline text-sm text-slate-600">
            {{ auth()->user()->name }}
        </span>

        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="btn btn-primary px-4 py-2 text-sm">
                Logout
            </button>
        </form>
    </div>
</nav>
