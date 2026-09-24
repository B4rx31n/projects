@extends('layouts.app')

@section('content')
<div class="grid gap-6 lg:grid-cols-3">
    <div class="lg:col-span-2 rounded-xl border bg-white p-6">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h1 class="text-xl font-semibold">{{ $aspiration->title }}</h1>
                <div class="text-sm text-slate-600 mt-1">
                    {{ $aspiration->created_at->format('Y-m-d H:i') }} • Kategori: {{ $aspiration->category?->name }}
                </div>
            </div>
            <div class="text-right">
                <div class="text-xs rounded-full bg-slate-100 px-2 py-1 inline-block">
                    {{ $statuses[$aspiration->status] ?? $aspiration->status }}
                </div>
                <div class="text-sm text-slate-700 mt-2">Progres: <span class="font-semibold">{{ $aspiration->progress_percent }}%</span></div>
            </div>
        </div>

        <div class="mt-6">
            <div class="font-medium mb-1">Deskripsi</div>
            <div class="text-sm text-slate-800 whitespace-pre-line">{{ $aspiration->description }}</div>
        </div>

        @if ($aspiration->location)
            <div class="mt-4">
                <div class="font-medium mb-1">Lokasi</div>
                <div class="text-sm text-slate-800">{{ $aspiration->location }}</div>
            </div>
        @endif

        @if ($photoUrl)
            <div class="mt-4">
                <div class="font-medium mb-1">Foto</div>
                <img src="{{ $photoUrl }}" alt="Foto aspirasi" class="rounded-lg border max-h-80 object-contain bg-slate-50">
            </div>
        @endif
    </div>

    <div class="rounded-xl border bg-white p-6">
        <h2 class="text-lg font-semibold mb-3">Umpan Balik</h2>

        @if ($aspiration->feedbacks->isEmpty())
            <div class="text-sm text-slate-600">Belum ada umpan balik dari admin.</div>
        @else
            <div class="space-y-3">
                @foreach ($aspiration->feedbacks as $fb)
                    <div class="rounded-lg border p-4">
                        <div class="text-xs text-slate-600">
                            {{ $fb->created_at->format('Y-m-d H:i') }} • Admin: {{ $fb->admin?->name }}
                        </div>
                        <div class="mt-2 text-sm whitespace-pre-line">{{ $fb->message }}</div>
                        <div class="mt-2 text-xs text-slate-700">
                            Status: <span class="font-semibold">{{ $statuses[$fb->status_after] ?? $fb->status_after }}</span>
                            • Progres: <span class="font-semibold">{{ $fb->progress_percent_after }}%</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection



