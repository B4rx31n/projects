@extends('layouts.app')

@section('title', 'Data Produk')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        Daftar Produk
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('produk.create') }}" class="btn btn-primary btn-sm">
                            <span class="glyphicon glyphicon-plus"></span> Tambah Produk
                        </a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                @if($produks->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Produk</th>
                                    <th>Kategori</th>
                                    <th>Jumlah</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produks as $produk)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $produk->nama_barang }}</td>
                                    <td>{{ $produk->kategori->nama_kategori ?? '-' }}</td>
                                    <td>{{ $produk->jumlah }}</td>
                                    <td>{{ $produk->created_at->format('d/m/Y') }}</td>
                                    <td style="white-space: nowrap;">
                                        <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-warning btn-xs">
                                            <span class="glyphicon glyphicon-edit"></span> Edit
                                        </a>
                                        <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Hapus produk ini?')">
                                                <span class="glyphicon glyphicon-trash"></span> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="text-center">
                        {{ $produks->links() }}
                    </div>
                @else
                    <div class="text-center" style="padding: 50px 0;">
                        <div style="font-size: 64px; color: #ddd; margin-bottom: 20px;">
                            <span class="glyphicon glyphicon-inbox"></span>
                        </div>
                        <h4 style="color: #999; margin-bottom: 10px;">Belum ada data produk</h4>
                        <p style="color: #ccc; margin-bottom: 20px;">Silahkan tambah produk pertama Anda</p>
                        <a href="{{ route('produk.create') }}" class="btn btn-primary">
                            <span class="glyphicon glyphicon-plus"></span> Tambah Produk Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
