@extends('layouts.app')

@section('title', 'Data Kategori')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        Daftar Kategori
                    </div>
                    <div class="col-md-6 text-right">
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#tambahKategoriModal">
                            <span class="glyphicon glyphicon-plus"></span> Tambah Kategori
                        </button>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                @if($kategoris->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Kategori</th>
                                    <th>Jumlah Produk</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kategoris as $kategori)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kategori->nama_kategori }}</td>
                                    <td>{{ $kategori->produks->count() }}</td>
                                    <td style="white-space: nowrap;">
                                        <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Hapus kategori ini?')"
                                                    {{ $kategori->produks->count() > 0 ? 'disabled' : '' }}>
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
                        {{ $kategoris->links() }}
                    </div>
                @else
                    <div class="text-center" style="padding: 50px 0;">
                        <div style="font-size: 64px; color: #ddd; margin-bottom: 20px;">
                            <span class="glyphicon glyphicon-list"></span>
                        </div>
                        <h4 style="color: #999; margin-bottom: 10px;">Belum ada data kategori</h4>
                        <p style="color: #ccc; margin-bottom: 20px;">Silahkan tambah kategori pertama Anda</p>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambahKategoriModal">
                            <span class="glyphicon glyphicon-plus"></span> Tambah Kategori Pertama
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambahKategoriModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Tambah Kategori</h4>
            </div>
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
