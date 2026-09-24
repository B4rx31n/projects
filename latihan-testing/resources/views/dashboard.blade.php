@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h1 class="display-4">{{ $total_produk ?? 0 }}</h1>
                <p class="card-text">Total Produk</p>
                <a href="{{ route('produk.index') }}" class="btn btn-primary">Lihat Produk</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h1 class="display-4">{{ $total_supplier ?? 0 }}</h1>
                <p class="card-text">Total Supplier</p>
                <a href="{{ route('supplier.index') }}" class="btn btn-primary">Lihat Supplier</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h1 class="display-4">{{ $total_user ?? 0 }}</h1>
                <p class="card-text">Total Pengguna</p>
                <a href="{{ route('user.index') }}" class="btn btn-primary">Lihat Pengguna</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Produk Terbaru</h5>
            </div>
            <div class="card-body">
                @if(isset($recent_produk) && $recent_produk->count() > 0)
                    <div class="list-group">
                        @foreach($recent_produk as $produk)
                            <div class="list-group-item">
                                <h6>{{ $produk->nama }}</h6>
                                <small>Stok: {{ $produk->stok ?? 0 }}</small>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">Tidak ada produk terbaru</p>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Supplier Terbaru</h5>
            </div>
            <div class="card-body">
                @if(isset($recent_supplier) && $recent_supplier->count() > 0)
                    <div class="list-group">
                        @foreach($recent_supplier as $supplier)
                            <div class="list-group-item">
                                <h6>{{ $supplier->nama }}</h6>
                                <small>{{ $supplier->kota ?? 'Tidak ada kota' }}</small>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">Tidak ada supplier terbaru</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection