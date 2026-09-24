@extends('layouts.app')

@section('content')
<div class="rounded-xl border bg-white p-6">
    <div class="flex items-start justify-between gap-4">
        <div>
            <h1 class="text-xl font-semibold mb-1">Histori Aspirasi</h1>
            <p class="text-sm text-slate-600">Pantau status, umpan balik, dan progres perbaikan.</p>
        </div>
        <a class="text-sm underline" href="{{ route('student.aspirations.index') }}">+ Buat aspirasi</a>
    </div>

    <form method="GET" class="mt-6 grid gap-3 md:grid-cols-6">
        <input name="q" value="{{ $filters['q'] ?? '' }}" placeholder="Cari..." class="md:col-span-2 rounded-lg border px-3 py-2">
        <select name="status" class="rounded-lg border px-3 py-2">
            <option value="">Semua status</option>
            @foreach ($statuses as $key => $label)
                <option value="{{ $key }}" @selected(($filters['status'] ?? '') === $key)>{{ $label }}</option>
            @endforeach
        </select>
        <select name="category_id" class="rounded-lg border px-3 py-2">
            <option value="">Semua kategori</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" @selected(($filters['category_id'] ?? '') == $cat->id)>{{ $cat->name }}</option>
            @endforeach
        </select>
        <input name="from" value="{{ $filters['from'] ?? '' }}" type="date" class="rounded-lg border px-3 py-2">
        <input name="to" value="{{ $filters['to'] ?? '' }}" type="date" class="rounded-lg border px-3 py-2">
        <div class="md:col-span-6 flex items-center gap-2">
            <input name="month" value="{{ $filters['month'] ?? '' }}" type="month" class="rounded-lg border px-3 py-2">
            <button class="rounded-lg bg-slate-900 text-white px-4 py-2 text-sm font-medium" type="submit">Filter</button>
            <a class="text-sm underline" href="{{ route('student.aspirations.history') }}">Reset</a>
        </div>
    </form>

    <div class="mt-6 overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left border-b">
                    <th class="py-2 pr-3">Tanggal</th>
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
                        <td class="py-2 pr-3">{{ $a->title }}</td>
                        <td class="py-2 pr-3">{{ $a->category?->name }}</td>
                        <td class="py-2 pr-3">
                            <span class="rounded-full bg-slate-100 px-2 py-1 text-xs">{{ $statuses[$a->status] ?? $a->status }}</span>
                        </td>
                        <td class="py-2 pr-3">{{ $a->progress_percent }}%</td>
                        <td class="py-2 pr-3">
                            <a class="underline" href="{{ route('student.aspirations.show', $a) }}">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-6 text-center text-slate-600">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $aspirations->links() }}
    </div>
</div>
@endsection



