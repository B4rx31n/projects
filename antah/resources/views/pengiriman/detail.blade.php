@extends('layouts.app')

@section('page-title', 'Detail Pesanan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center py-4">
                    <div>
                        <h4 class="mb-0 fw-bold">
                            <i class="fas fa-info-circle me-2"></i>Detail Pesanan #{{ $pengiriman->id }}
                        </h4>
                        <small class="opacity-75">Informasi lengkap tentang pesanan pengiriman</small>
                    </div>
                    <a href="{{ route('pengiriman.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Kembali
                    </a>
                </div>
            </div>

            <div class="row">
                <!-- Informasi Utama -->
                <div class="col-lg-8">
                    <!-- Informasi Anggota -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="fas fa-user me-2 text-primary"></i>Informasi Anggota
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted small d-block mb-1">
                                        <i class="fas fa-user-circle me-1"></i>Nama Anggota
                                    </label>
                                    <p class="fs-5 fw-bold mb-0">{{ $pengiriman->anggota->nama_anggota ?? '-' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted small d-block mb-1">
                                        <i class="fas fa-map-marker-alt me-1"></i>Kota
                                    </label>
                                    <p class="fs-5 mb-0">
                                        <span class="badge bg-primary">{{ $pengiriman->anggota->kota ?? '-' }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Produk -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="fas fa-box me-2 text-success"></i>Informasi Produk
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted small d-block mb-1">
                                        <i class="fas fa-box-open me-1"></i>Nama Barang
                                    </label>
                                    <p class="fs-5 fw-bold mb-0">{{ $pengiriman->produk->nama_barang ?? '-' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted small d-block mb-1">
                                        <i class="fas fa-warehouse me-1"></i>Stok Tersedia
                                    </label>
                                    <p class="fs-5 mb-0">
                                        <span class="badge bg-info">{{ $pengiriman->produk->jumlah ?? 0 }} Unit</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Detail Pesanan -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="fas fa-clipboard-list me-2 text-info"></i>Detail Pesanan
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="text-muted small d-block mb-1">
                                        <i class="fas fa-calculator me-1"></i>Jumlah Pesanan
                                    </label>
                                    <p class="fs-4 fw-bold text-primary mb-0">
                                        {{ $pengiriman->jumlah_kiriman }} Unit
                                    </p>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="text-muted small d-block mb-1">
                                        <i class="fas fa-calendar-alt me-1"></i>Tanggal Pemesanan
                                    </label>
                                    <p class="fs-5 mb-0">
                                        {{ \Carbon\Carbon::parse($pengiriman->tanggal_pemesanan)->format('d F Y') }}
                                    </p>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="text-muted small d-block mb-1">
                                        <i class="fas fa-truck me-1"></i>Tanggal Pengiriman
                                    </label>
                                    <p class="fs-5 mb-0">
                                        @if($pengiriman->tanggal_pengiriman)
                                            <span class="badge bg-success">
                                                {{ \Carbon\Carbon::parse($pengiriman->tanggal_pengiriman)->format('d F Y') }}
                                            </span>
                                        @else
                                            <span class="badge bg-warning text-dark">Belum Dikirim</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted small d-block mb-1">
                                        <i class="fas fa-credit-card me-1"></i>Status Pembayaran
                                    </label>
                                    <p class="mb-0">
                                        @if($pengiriman->status_pembayaran == 'sudah_dibayar')
                                            <span class="badge bg-success fs-6">
                                                <i class="fas fa-check-circle me-1"></i>Sudah Dibayar
                                            </span>
                                        @else
                                            <span class="badge bg-warning text-dark fs-6">
                                                <i class="fas fa-clock me-1"></i>Belum Dibayar
                                            </span>
                                        @endif
                                    </p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="text-muted small d-block mb-1">
                                        <i class="fas fa-hashtag me-1"></i>ID Pesanan
                                    </label>
                                    <p class="fs-5 fw-bold mb-0">#{{ $pengiriman->id }}</p>
                                </div>
                            </div>

                            @if($pengiriman->keterangan)
                            <hr>
                            <div class="mb-3">
                                <label class="text-muted small d-block mb-1">
                                    <i class="fas fa-sticky-note me-1"></i>Keterangan
                                </label>
                                <div class="p-3 bg-light rounded">
                                    <p class="mb-0">{{ $pengiriman->keterangan }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Informasi Timestamp -->
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="fas fa-clock me-2 text-secondary"></i>Informasi Sistem
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="text-muted small d-block mb-1">
                                        <i class="fas fa-calendar-plus me-1"></i>Dibuat Pada
                                    </label>
                                    <p class="mb-0">
                                        {{ \Carbon\Carbon::parse($pengiriman->created_at)->format('d F Y H:i:s') }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <label class="text-muted small d-block mb-1">
                                        <i class="fas fa-calendar-edit me-1"></i>Diperbarui Pada
                                    </label>
                                    <p class="mb-0">
                                        {{ \Carbon\Carbon::parse($pengiriman->updated_at)->format('d F Y H:i:s') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Aksi -->
                <div class="col-lg-4">
                    <!-- Status Card -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="fas fa-info-circle me-2"></i>Status Pesanan
                            </h5>
                        </div>
                        <div class="card-body text-center">
                            @if($pengiriman->status_pembayaran == 'sudah_dibayar')
                                <div class="mb-3">
                                    <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                                </div>
                                <h4 class="text-success mb-2">Pesanan Selesai</h4>
                                <p class="text-muted mb-0">Pembayaran telah diterima dan pesanan telah dikonfirmasi</p>
                            @else
                                <div class="mb-3">
                                    <i class="fas fa-clock text-warning" style="font-size: 4rem;"></i>
                                </div>
                                <h4 class="text-warning mb-2">Menunggu Pembayaran</h4>
                                <p class="text-muted mb-0">Pesanan menunggu konfirmasi pembayaran</p>
                            @endif
                        </div>
                    </div>

                    <!-- Aksi Card -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="fas fa-tasks me-2"></i>Aksi
                            </h5>
                        </div>
                        <div class="card-body d-grid gap-2">
                            @if($pengiriman->status_pembayaran == 'belum_dibayar')
                                <a href="{{ route('pengiriman.edit', $pengiriman->id) }}" class="btn btn-warning">
                                    <i class="fas fa-edit me-1"></i>Edit Pesanan
                                </a>
                                
                                <form action="{{ route('pengiriman.bayar', $pengiriman->id) }}" method="POST" class="d-grid">
                                    @csrf
                                    <button type="submit" class="btn btn-success" onclick="return confirm('Apakah Anda yakin ingin mengkonfirmasi pembayaran pesanan ini?')">
                                        <i class="fas fa-check-circle me-1"></i>Konfirmasi Pembayaran
                                    </button>
                                </form>
                            @else
                                <button class="btn btn-secondary" disabled>
                                    <i class="fas fa-lock me-1"></i>Pesanan Sudah Dibayar
                                </button>
                                <small class="text-muted text-center">
                                    Pesanan yang sudah dibayar tidak dapat diedit
                                </small>
                            @endif
                            
                            <a href="{{ route('pengiriman.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-list me-1"></i>Kembali ke Daftar
                            </a>
                        </div>
                    </div>

                    <!-- Quick Info -->
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                <i class="fas fa-chart-bar me-2"></i>Ringkasan
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">Jumlah Unit</span>
                                <span class="fw-bold">{{ $pengiriman->jumlah_kiriman }} Unit</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text-muted">Status</span>
                                <span>
                                    @if($pengiriman->status_pembayaran == 'sudah_dibayar')
                                        <span class="badge bg-success">Selesai</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </span>
                            </div>
                            <hr>
                            <div class="text-center">
                                <small class="text-muted">ID: #{{ $pengiriman->id }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .card {
        border-radius: 12px;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.1) !important;
    }
    
    .card-header {
        border-radius: 12px 12px 0 0 !important;
    }
    
    .badge {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
    }
    
    .btn {
        border-radius: 8px;
        font-weight: 500;
    }
    
    .bg-light {
        background-color: #f8f9fa !important;
    }
</style>
@endsection
