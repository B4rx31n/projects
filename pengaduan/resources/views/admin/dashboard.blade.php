@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-blue-400">Dashboard Admin</h1>
        <div id="semua-pengaduan">
            <h2 class="text-2xl font-semibold text-gray-200 mb-4">Semua Pengaduan</h2>
            @if($complaints->isEmpty())
                <div class="bg-gray-800 p-6 rounded-lg shadow-lg border border-gray-700 text-center">
                    <p class="text-gray-400">Belum ada pengaduan dari siswa.</p>
                </div>
            @else
                <div class="bg-gray-800 rounded-lg shadow-lg border border-gray-700 overflow-hidden">
                    <table class="w-full table-auto text-gray-200">
                        <thead class="bg-gray-700">
                            <tr>
                                <th class="px-6 py-3 text-left font-semibold">Nama Siswa</th>
                                <th class="px-6 py-3 text-left font-semibold">Deskripsi</th>
                                <th class="px-6 py-3 text-left font-semibold">Status</th>
                                <th class="px-6 py-3 text-left font-semibold">Keterangan Admin</th>
                                <th class="px-6 py-3 text-left font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($complaints as $complaint)
                                <tr class="border-t border-gray-600 hover:bg-gray-700 transition duration-200">
                                    <td class="px-6 py-4">{{ $complaint->user->name }}</td>
                                    <td class="px-6 py-4">{{ Str::limit($complaint->description, 50) }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded text-sm font-semibold 
                                            {{ $complaint->status == 'pending' ? 'bg-yellow-600' : 
                                               ($complaint->status == 'diproses' ? 'bg-blue-600' : 'bg-green-600') }}">
                                            {{ ucfirst($complaint->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">{{ $complaint->admin_note ?: '-' }}</td>
                                    <td class="px-6 py-4">
                                        <form method="POST" action="{{ route('complaint.update', $complaint) }}" class="inline-flex space-x-2">
                                            @csrf @method('PUT')
                                            <select name="status" class="bg-gray-600 text-white p-2 rounded border border-gray-500 focus:ring-2 focus:ring-blue-500">
                                                <option value="pending" {{ $complaint->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="diproses" {{ $complaint->status == 'diproses' ? 'selected' : '' }}>Dalam Proses</option>
                                                <option value="selesai" {{ $complaint->status == 'selesai' ? 'selected' : '' }}>Sudah Dikerjakan</option>
                                            </select>
                                            <textarea name="admin_note" placeholder="Keterangan (opsional)" class="bg-gray-600 text-white p-2 rounded border border-gray-500 focus:ring-2 focus:ring-blue-500" rows="1">{{ $complaint->admin_note }}</textarea>
                                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded transition duration-200">Update</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection