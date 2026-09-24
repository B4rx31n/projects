<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pelanggan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="alert alert-primary">
                    <a href="{{ route('pelanggan.create') }}" class="btn btn-success"><i class="bi bi-plus me-2"></i>Tambah Data</a>
                    <a href="{{ route('pelanggan.print') }}" class="btn btn-warning"><i class="bi bi-printer me-2"></i>Print</a>
                </div>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="p-6 text-gray-900">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama</td>
                                <td>Email</td>
                                <td>No. Telepon</td>
                                <td>Kota</td>
                                <td>Option</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @forelse($pelanggans as $pelanggan)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $pelanggan->nama }}</td>
                                    <td>{{ $pelanggan->email }}</td>
                                    <td>{{ $pelanggan->no_telepon ?? '-' }}</td>
                                    <td>{{ $pelanggan->kota ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('pelanggan.edit', $pelanggan->id) }}" class="btn btn-primary"><i class="bi bi-pen me-2"></i>Edit</a>
                                        <form action="{{ route('pelanggan.destroy', $pelanggan->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash me-2"></i>Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data pelanggan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
