@extends('layouts.app')

@section('title', 'Data Supplier')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                        Daftar Supplier
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{ route('supplier.create') }}" class="btn btn-success btn-sm">
                            <span class="glyphicon glyphicon-plus"></span> Tambah Supplier
                        </a>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                @if($suppliers->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Supplier</th>
                                    <th>Kota</th>
                                    <th>Nomor Telepon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($suppliers as $supplier)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $supplier->nama_supplier }}</td>
                                    <td>{{ $supplier->kota }}</td>
                                    <td>{{ $supplier->nomor_telepon }}</td>
                                    <td style="white-space: nowrap;">
                                        <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-warning btn-xs">
                                            <span class="glyphicon glyphicon-edit"></span> Edit
                                        </a>
                                        <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Hapus supplier ini?')">
                                                <span class="glyphicon glyphicon-trash"></span> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center" style="padding: 50px 0;">
                        <div style="font-size: 64px; color: #ddd; margin-bottom: 20px;">
                            <span class="glyphicon glyphicon-user"></span>
                        </div>
                        <h4 style="color: #999; margin-bottom: 10px;">Belum ada data supplier</h4>
                        <p style="color: #ccc; margin-bottom: 20px;">Silahkan tambah supplier pertama Anda</p>
                        <a href="{{ route('supplier.create') }}" class="btn btn-success">
                            <span class="glyphicon glyphicon-plus"></span> Tambah Supplier Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
