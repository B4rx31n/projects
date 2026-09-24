@extends('layouts.app')

@section('content')
<div class="rounded-xl border bg-white p-6">
    <div class="flex items-start justify-between gap-4">
        <div>
            <h1 class="text-xl font-semibold mb-1">Dashboard Admin</h1>
            <p class="text-sm text-slate-600">Daftar aspirasi + filter (tanggal, bulan, siswa, kategori) dan rekap cepat.</p>
        </div>
    </div>

    <form method="GET" class="mt-6 grid gap-3 lg:grid-cols-12">
        <input name="q" value="{{ $filters['q'] ?? '' }}" placeholder="Cari judul/deskripsi..." class="lg:col-span-3 rounded-lg border px-3 py-2">
        <select name="status" class="lg:col-span-2 rounded-lg border px-3 py-2">
            <option value="">Semua status</option>
            @foreach ($statuses as $key => $label)
                <option value="{{ $key }}" @selected(($filters['status'] ?? '') === $key)>{{ $label }}</option>
            @endforeach
        </select>
        <select name="category_id" class="lg:col-span-2 rounded-lg border px-3 py-2">
            <option value="">Semua kategori</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" @selected(($filters['category_id'] ?? '') == $cat->id)>{{ $cat->name }}</option>
            @endforeach
        </select>
        <select name="user_id" class="lg:col-span-2 rounded-lg border px-3 py-2">
            <option value="">Semua siswa</option>
            @foreach ($students as $s)
                <option value="{{ $s->id }}" @selected(($filters['user_id'] ?? '') == $s->id)>{{ $s->name }}</option>
            @endforeach
        </select>
        <input name="from" value="{{ $filters['from'] ?? '' }}" type="date" class="lg:col-span-1 rounded-lg border px-3 py-2">
        <input name="to" value="{{ $filters['to'] ?? '' }}" type="date" class="lg:col-span-1 rounded-lg border px-3 py-2">
        <input name="month" value="{{ $filters['month'] ?? '' }}" type="month" class="lg:col-span-1 rounded-lg border px-3 py-2">
        <div class="lg:col-span-12 flex items-center gap-2">
            <button class="rounded-lg bg-slate-900 text-white px-4 py-2 text-sm font-medium" type="submit">Filter</button>
            <a class="text-sm underline" href="{{ route('admin.aspirations.index') }}">Reset</a>
        </div>
    </form>
</div>

<div class="grid gap-6 mt-6 lg:grid-cols-2">
    <div class="rounded-xl border bg-white p-6">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold">Rekap ({{ $rekap['from'] }} s/d {{ $rekap['to'] }})</h2>
            <form method="GET" class="flex items-center gap-2">
                <input type="hidden" name="q" value="{{ $filters['q'] ?? '' }}">
                <input type="hidden" name="status" value="{{ $filters['status'] ?? '' }}">
                <input type="hidden" name="category_id" value="{{ $filters['category_id'] ?? '' }}">
                <input type="hidden" name="user_id" value="{{ $filters['user_id'] ?? '' }}">
                <input name="from_rekap" type="date" value="{{ $rekap['from'] }}" class="rounded-lg border px-3 py-2 text-sm">
                <input name="to_rekap" type="date" value="{{ $rekap['to'] }}" class="rounded-lg border px-3 py-2 text-sm">
                <button class="rounded-lg bg-slate-900 text-white px-3 py-2 text-sm font-medium" type="submit">Terapkan</button>
            </form>
        </div>

        <div class="mt-4 grid gap-4 md:grid-cols-2">
            <div class="rounded-lg border p-4">
                <div class="font-medium mb-2">Per Tanggal</div>
                <div class="text-sm text-slate-700 space-y-1 max-h-48 overflow-auto">
                    @forelse ($rekap['perTanggal'] as $row)
                        <div class="flex justify-between"><span>{{ $row->tanggal ?? $row['tanggal'] ?? '' }}</span><span class="font-semibold">{{ $row->total ?? $row['total'] ?? 0 }}</span></div>
                    @empty
                        <div class="text-slate-600">Tidak ada data.</div>
                    @endforelse
                </div>
            </div>
            <div class="rounded-lg border p-4">
                <div class="font-medium mb-2">Per Bulan</div>
                <div class="text-sm text-slate-700 space-y-1 max-h-48 overflow-auto">
                    @forelse ($rekap['perBulan'] as $row)
                        <div class="flex justify-between"><span>{{ $row->bulan ?? $row['bulan'] ?? '' }}</span><span class="font-semibold">{{ $row->total ?? $row['total'] ?? 0 }}</span></div>
                    @empty
                        <div class="text-slate-600">Tidak ada data.</div>
                    @endforelse
                </div>
            </div>
            <div class="rounded-lg border p-4">
                <div class="font-medium mb-2">Per Siswa</div>
                <div class="text-sm text-slate-700 space-y-1 max-h-48 overflow-auto">
                    @forelse ($rekap['perSiswa'] as $row)
                        <div class="flex justify-between"><span>{{ $row->siswa ?? $row['siswa'] ?? '' }}</span><span class="font-semibold">{{ $row->total ?? $row['total'] ?? 0 }}</span></div>
                    @empty
                        <div class="text-slate-600">Tidak ada data.</div>
                    @endforelse
                </div>
            </div>
            <div class="rounded-lg border p-4">
                <div class="font-medium mb-2">Per Kategori</div>
                <div class="text-sm text-slate-700 space-y-1 max-h-48 overflow-auto">
                    @forelse ($rekap['perKategori'] as $row)
                        <div class="flex justify-between"><span>{{ $row->kategori ?? $row['kategori'] ?? '' }}</span><span class="font-semibold">{{ $row->total ?? $row['total'] ?? 0 }}</span></div>
                    @empty
                        <div class="text-slate-600">Tidak ada data.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="rounded-xl border bg-white p-6">
        <h2 class="text-lg font-semibold mb-3">Daftar Aspirasi</h2>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left border-b">
                        <th class="py-2 pr-3">Tanggal</th>
                        <th class="py-2 pr-3">Siswa</th>
                        <th class="py-2 pr-3">Judul</th>
                        <th class="py-2 pr-3">Kategori</th>
                        <th class="py-2 pr-3">Status</th>
                        <th class="py-2 pr-3">Progres</th>
                        <th class="py-2 pr-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($aspirations as $a)
                        <tr class="border-b">
                            <td class="py-2 pr-3 whitespace-nowrap">{{ $a->created_at->format('Y-m-d') }}</td>
                            <td class="py-2 pr-3">{{ $a->user?->name }}</td>
                            <td class="py-2 pr-3">{{ $a->title }}</td>
                            <td class="py-2 pr-3">{{ $a->category?->name }}</td>
                            <td class="py-2 pr-3"><span class="rounded-full bg-slate-100 px-2 py-1 text-xs">{{ $statuses[$a->status] ?? $a->status }}</span></td>
                            <td class="py-2 pr-3">{{ $a->progress_percent }}%</td>
                            <td class="py-2 pr-3"><a class="underline" href="{{ route('admin.aspirations.show', $a) }}">Detail</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="py-6 text-center text-slate-600">Tidak ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $aspirations->links() }}
        </div>
    </div>
</div>
@endsection



