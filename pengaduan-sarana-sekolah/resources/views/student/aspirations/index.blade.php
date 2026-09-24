@extends('layouts.app')

@section('content')
<div class="grid gap-6 lg:grid-cols-2">
    <div class="rounded-xl border bg-white p-6">
        <h1 class="text-xl font-semibold mb-1">Form Aspirasi Siswa</h1>
        <p class="text-sm text-slate-600 mb-6">Sampaikan pengaduan/masukan terkait sarana dan prasarana sekolah.</p>

        <form method="POST" action="{{ route('student.aspirations.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium mb-1">Kategori</label>
                <select name="category_id" class="w-full rounded-lg border px-3 py-2" required>
                    <option value="">-- pilih kategori --</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Judul</label>
                <input name="title" type="text" value="{{ old('title') }}" class="w-full rounded-lg border px-3 py-2" maxlength="150" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full rounded-lg border px-3 py-2" required>{{ old('description') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Lokasi (opsional)</label>
                <input name="location" type="text" value="{{ old('location') }}" class="w-full rounded-lg border px-3 py-2" maxlength="150">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Foto (opsional)</label>
                <input name="photo" type="file" accept="image/*" class="w-full rounded-lg border px-3 py-2">
                <div class="text-xs text-slate-600 mt-1">Max 2MB. Jika ingin menampilkan foto, jalankan: <span class="font-mono">php artisan storage:link</span></div>
            </div>
            <button class="rounded-lg bg-slate-900 text-white px-4 py-2 font-medium" type="submit">Kirim Aspirasi</button>
        </form>
    </div>

    <div class="rounded-xl border bg-white p-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold">Aspirasi Terbaru Saya</h2>
            <a class="text-sm underline" href="{{ route('student.aspirations.history') }}">Lihat semua histori</a>
        </div>

        @if ($recent->isEmpty())
            <div class="text-sm text-slate-600">Belum ada aspirasi.</div>
        @else
            <div class="space-y-3">
                @foreach ($recent as $a)
                    <a href="{{ route('student.aspirations.show', $a) }}" class="block rounded-lg border p-4 hover:bg-slate-50">
                        <div class="flex items-center justify-between gap-3">
                            <div class="font-medium">{{ $a->title }}</div>
                            <div class="text-xs rounded-full bg-slate-100 px-2 py-1">
                                {{ $statuses[$a->status] ?? $a->status }}
                            </div>
                        </div>
                        <div class="text-sm text-slate-600 mt-1">
                            Kategori: {{ $a->category?->name }} • Progres: {{ $a->progress_percent }}%
                        </div>
                        @if ($a->latestFeedback)
                            <div class="text-sm mt-2">
                                <div class="text-slate-600">Umpan balik terakhir:</div>
                                <div class="text-slate-800 line-clamp-2">{{ $a->latestFeedback->message }}</div>
                            </div>
                        @endif
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection



