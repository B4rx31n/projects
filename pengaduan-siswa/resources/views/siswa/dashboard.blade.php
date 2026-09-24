@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="max-w-5xl mx-auto space-y-10">

    <!-- Page Header -->
    <div>
        <h1 class="text-2xl sm:text-3xl font-semibold tracking-tight text-slate-100">
            Dashboard Siswa
        </h1>
        <p class="mt-1 text-sm text-slate-400">
            Kelola dan pantau pengaduan yang telah Anda ajukan.
        </p>
    </div>

    <!-- Ajukan Pengaduan -->
    <section id="pengaduan" class="space-y-4">
        <h2 class="text-lg font-semibold text-slate-200">
            Ajukan Pengaduan
        </h2>

        <div class="card p-6">
            <form method="POST" action="{{ route('complaint.store') }}" class="space-y-4">
                @csrf

                <textarea
                    name="description"
                    rows="4"
                    required
                    placeholder="Tuliskan deskripsi pengaduan secara jelas dan singkat…"
                    class="w-full rounded-xl bg-slate-900/60 border border-slate-700
                           p-4 text-slate-200 placeholder-slate-500
                           focus:outline-none focus:ring-2 focus:ring-emerald-400/30 focus:border-emerald-400/30
                           transition"
                ></textarea>

                <div class="flex justify-end">
                    <button type="submit" class="btn btn-primary px-6 py-3 text-sm">
                        Ajukan Pengaduan
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Pengaduan Saya -->
    <section id="pengaduan-saya" class="space-y-4">
        <h2 class="text-lg font-semibold text-slate-200">
            Pengaduan Saya
        </h2>

        @if($complaints->isEmpty())
            <div class="card p-6 text-center">
                <p class="text-slate-400">
                    Belum ada pengaduan.
                </p>
                <p class="text-sm text-slate-500 mt-1">
                    Ajukan pengaduan pertama Anda melalui formulir di atas.
                </p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($complaints as $complaint)
                    <div class="card card-hover p-6 space-y-3">
                        <p class="text-slate-200">
                            {{ $complaint->description }}
                        </p>

                        <div class="flex flex-wrap items-center gap-2 text-sm">
                            <span class="text-slate-400">Status:</span>
                            <span class="chip px-3 py-1 text-xs font-medium
                                {{ $complaint->status === 'selesai'
                                    ? 'text-emerald-400 border-emerald-400/30 bg-emerald-400/10'
                                    : 'text-sky-400 border-sky-400/30 bg-sky-400/10' }}">
                                {{ ucfirst($complaint->status) }}
                            </span>
                        </div>

                        @if($complaint->admin_note)
                            <div class="mt-3 rounded-lg border border-slate-700 bg-slate-900/40 p-4">
                                <p class="text-xs uppercase tracking-wide text-slate-500 mb-1">
                                    Catatan Admin
                                </p>
                                <p class="text-sm text-slate-300">
                                    {{ $complaint->admin_note }}
                                </p>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </section>

</div>
@endsection
