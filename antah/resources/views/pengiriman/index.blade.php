@extends('layouts.app')

@section('title', 'Pengiriman - UKK Management System')

@section('page-title')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title fw-bold text-dark mb-2">
                <i class="fas fa-shipping-fast text-primary me-3"></i>Data Pesanan Anggota
            </h1>
            <p class="page-subtitle text-muted mb-0">Kelola semua pesanan dan pengiriman anggota koperasi</p>
        </div>
        <div class="header-badge">
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                <i class="fas fa-box me-1"></i>{{ $data->count() }} Pesanan
            </span>
        </div>
    </div>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/') }}" class="text-decoration-none">
            <i class="fas fa-home text-muted me-2"></i>Dashboard
        </a>
    </li>
    <li class="breadcrumb-item active text-primary fw-semibold">
        <i class="fas fa-chevron-right text-muted me-2 small"></i>Pengiriman
    </li>
@endsection

@section('content')
    <!-- Header Action -->
    <div class="row mb-4">
        <div class="col-md-8">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <div class="alert-icon-wrapper me-3">
                        <i class="fas fa-check-circle text-success"></i>
                    </div>
                    <div>
                        <h6 class="alert-heading mb-1">Berhasil!</h6>
                        <p class="mb-0">{{ session('success') }}</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            
            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                <div class="d-flex align-items-center">
                    <div class="alert-icon-wrapper me-3">
                        <i class="fas fa-exclamation-circle text-danger"></i>
                    </div>
                    <div>
                        <h6 class="alert-heading mb-1">Terjadi Kesalahan</h6>
                        <p class="mb-0">{{ session('error') }}</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('pengiriman.create') }}" class="btn btn-primary btn-lg px-4">
                <i class="fas fa-plus-circle me-2"></i>Tambah Pesanan
            </a>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="stats-title text-muted mb-2">Total Pesanan</h6>
                            <h3 class="stats-count text-dark mb-0">{{ $data->count() }}</h3>
                            <div class="stats-trend mt-2">
                                <span class="text-success small">
                                    <i class="fas fa-chart-line me-1"></i>All Orders
                                </span>
                            </div>
                        </div>
                        <div class="stats-icon bg-primary bg-opacity-10">
                            <i class="fas fa-shopping-cart text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="stats-title text-muted mb-2">Sudah Dibayar</h6>
                            <h3 class="stats-count text-dark mb-0">{{ $data->where('status_pembayaran', 'sudah_dibayar')->count() }}</h3>
                            <div class="stats-trend mt-2">
                                <span class="text-success small">
                                    <i class="fas fa-check-circle me-1"></i>Completed
                                </span>
                            </div>
                        </div>
                        <div class="stats-icon bg-success bg-opacity-10">
                            <i class="fas fa-credit-card text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="stats-title text-muted mb-2">Belum Dibayar</h6>
                            <h3 class="stats-count text-dark mb-0">{{ $data->where('status_pembayaran', 'belum_dibayar')->count() }}</h3>
                            <div class="stats-trend mt-2">
                                <span class="text-warning small">
                                    <i class="fas fa-clock me-1"></i>Pending
                                </span>
                            </div>
                        </div>
                        <div class="stats-icon bg-warning bg-opacity-10">
                            <i class="fas fa-clock text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="stats-title text-muted mb-2">Total Unit</h6>
                            <h3 class="stats-count text-dark mb-0">{{ $data->sum('jumlah_kiriman') }}</h3>
                            <div class="stats-trend mt-2">
                                <span class="text-info small">
                                    <i class="fas fa-boxes me-1"></i>All Items
                                </span>
                            </div>
                        </div>
                        <div class="stats-icon bg-info bg-opacity-10">
                            <i class="fas fa-boxes text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-0 text-dark">
                        <i class="fas fa-list-ul text-primary me-2"></i>Daftar Pesanan
                    </h5>
                    <p class="text-muted small mb-0 mt-1">Semua pesanan yang tercatat dalam sistem</p>
                </div>
                <div class="d-flex gap-3">
                    <div class="input-group search-group" style="width: 300px;">
                        <span class="input-group-text bg-light border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>
                        <input type="text" class="form-control search-input" placeholder="Cari pesanan..." id="searchInput">
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-filter me-2"></i>Filter
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li><h6 class="dropdown-header">Filter Status</h6></li>
                            <li><a class="dropdown-item" href="#" onclick="filterStatus('all')">Semua Status</a></li>
                            <li><a class="dropdown-item" href="#" onclick="filterStatus('sudah_dibayar')">Sudah Dibayar</a></li>
                            <li><a class="dropdown-item" href="#" onclick="filterStatus('belum_dibayar')">Belum Dibayar</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><h6 class="dropdown-header">Urutkan</h6></li>
                            <li><a class="dropdown-item" href="#" onclick="sortTable('newest')">Terbaru</a></li>
                            <li><a class="dropdown-item" href="#" onclick="sortTable('oldest')">Terlama</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="ordersTable">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4 py-3 text-muted small text-uppercase fw-semibold">ID Pesanan</th>
                            <th class="py-3 text-muted small text-uppercase fw-semibold">Anggota</th>
                            <th class="py-3 text-muted small text-uppercase fw-semibold">Barang</th>
                            <th class="py-3 text-muted small text-uppercase fw-semibold">Jumlah</th>
                            <th class="py-3 text-muted small text-uppercase fw-semibold">Tanggal</th>
                            <th class="py-3 text-muted small text-uppercase fw-semibold">Status</th>
                            <th class="pe-4 py-3 text-muted small text-uppercase fw-semibold text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $item)
                        <tr class="order-row" data-status="{{ $item->status_pembayaran }}">
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="order-id-badge me-3">
                                        <span class="badge bg-primary bg-opacity-10 text-primary">#{{ str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</span>
                                    </div>
                                    <div>
                                        <small class="text-muted d-block">{{ $item->created_at->format('d/m/Y') }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="member-avatar me-3">
                                        <div class="avatar-circle bg-info bg-opacity-10 text-info">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">{{ $item->anggota->nama_anggota }}</div>
                                        <small class="text-muted">{{ $item->anggota->kota ?? '-' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="product-icon me-3">
                                        <div class="icon-circle bg-warning bg-opacity-10 text-warning">
                                            <i class="fas fa-box"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="fw-semibold">{{ $item->produk->nama_barang }}</div>
                                        <small class="text-muted">Stok: {{ $item->produk->jumlah }} unit</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="quantity-display">
                                    <span class="badge bg-secondary bg-opacity-10 text-dark fw-semibold px-3 py-2">
                                        {{ $item->jumlah_kiriman }} Unit
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="date-display">
                                    <div class="fw-semibold">{{ \Carbon\Carbon::parse($item->tanggal_pemesanan)->format('d M Y') }}</div>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($item->tanggal_pemesanan)->format('H:i') }}</small>
                                </div>
                            </td>
                            <td>
                                @if($item->status_pembayaran == 'belum_dibayar')
                                <div class="status-badge">
                                    <span class="badge bg-warning bg-opacity-15 text-warning border border-warning border-opacity-25 px-3 py-2">
                                        <i class="fas fa-clock me-1"></i>Belum Bayar
                                    </span>
                                </div>
                                @else
                                <div class="status-badge">
                                    <span class="badge bg-success bg-opacity-15 text-success border border-success border-opacity-25 px-3 py-2">
                                        <i class="fas fa-check-circle me-1"></i>Lunas
                                    </span>
                                </div>
                                @endif
                            </td>
                            <td class="pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    @if($item->status_pembayaran == 'belum_dibayar')
                                    <a href="{{ route('pengiriman.edit', $item->id) }}" class="btn btn-action btn-outline-primary" title="Edit Pesanan">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('pengiriman.bayar', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-action btn-success" title="Konfirmasi Pembayaran" onclick="return confirm('Apakah barang sudah dibayar?')">
                                            <i class="fas fa-credit-card"></i>
                                        </button>
                                    </form>
                                    @else
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                        <i class="fas fa-check me-1"></i>Selesai
                                    </span>
                                    @endif
                                    
                                    <a href="{{ route('pengiriman.show', $item->id) }}" class="btn btn-action btn-outline-info" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    <form action="{{ route('pengiriman.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-action btn-outline-danger" title="Hapus Pesanan">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="empty-state">
                                    <div class="empty-icon mb-4">
                                        <i class="fas fa-shopping-cart fa-4x text-muted opacity-25"></i>
                                    </div>
                                    <h5 class="text-muted mb-3">Belum ada pesanan</h5>
                                    <p class="text-muted mb-4">Mulai dengan menambahkan pesanan baru untuk anggota</p>
                                    <a href="{{ route('pengiriman.create') }}" class="btn btn-primary btn-lg px-4">
                                        <i class="fas fa-plus-circle me-2"></i>Tambah Pesanan Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="card-footer bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    Menampilkan {{ $data->count() }} pesanan
                </div>
                <div class="export-buttons">
                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="exportToExcel()" id="btnExportExcel">
                        <i class="fas fa-file-excel me-2"></i>Export Excel
                    </button>
                    <button type="button" class="btn btn-outline-danger btn-sm ms-2" onclick="exportToPDF()" id="btnExportPDF">
                        <i class="fas fa-file-pdf me-2"></i>Export PDF
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="card-title mb-0 text-dark">
                        <i class="fas fa-chart-bar text-primary me-2"></i>Ringkasan Cepat
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="quick-stat">
                                <div class="stat-label text-muted small mb-1">Total Nilai Pesanan</div>
                                @php
                                    $totalUnit = $data->sum('jumlah_kiriman');
                                @endphp
                                <div class="stat-value text-primary fw-bold">{{ number_format($totalUnit, 0, ',', '.') }} Unit</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="quick-stat">
                                <div class="stat-label text-muted small mb-1">Rata-rata Pesanan</div>
                                @php
                                    $avgOrder = $data->count() > 0 ? $totalUnit / $data->count() : 0;
                                @endphp
                                <div class="stat-value text-info fw-bold">{{ number_format($avgOrder, 1, ',', '.') }} Unit</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="quick-stat">
                                <div class="stat-label text-muted small mb-1">Pesanan Terbaru</div>
                                @php
                                    $latest = $data->sortByDesc('created_at')->first();
                                @endphp
                                <div class="stat-value text-success fw-bold">
                                    @if($latest)
                                        {{ $latest->created_at->diffForHumans() }}
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="quick-stat">
                                <div class="stat-label text-muted small mb-1">Status Sistem</div>
                                <div class="stat-value">
                                    <span class="badge bg-success bg-opacity-10 text-success px-3 py-2">
                                        <i class="fas fa-check-circle me-1"></i>Aktif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
/* General Styles */
.page-header {
    margin-bottom: 2rem;
}

.header-badge .badge {
    border-radius: 10px;
    font-weight: 500;
}

/* Stats Cards */
.stats-card {
    border-radius: 12px;
    transition: all 0.3s ease;
    border: none;
}

.stats-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
}

.stats-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.stats-count {
    font-size: 2rem;
    font-weight: 700;
}

.stats-title {
    font-size: 0.875rem;
    font-weight: 500;
}

/* Table Styles */
.card {
    border-radius: 12px;
    border: none;
}

.table {
    margin-bottom: 0;
}

.table > :not(caption) > * > * {
    padding: 1rem 0.75rem;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.table thead th {
    border-bottom: 2px solid rgba(0,0,0,0.1);
    font-weight: 600;
}

.table-hover tbody tr:hover {
    background-color: rgba(59, 130, 246, 0.03) !important;
}

/* Avatar & Icons */
.avatar-circle, .icon-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
}

/* Action Buttons */
.btn-action {
    width: 38px;
    height: 38px;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    transition: all 0.2s;
}

.btn-action:hover {
    transform: translateY(-2px);
}

.btn-primary {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    border: none;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #2563eb, #1e40af);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
}

/* Search & Filter */
.search-group {
    border-radius: 10px;
    overflow: hidden;
    border: 1px solid #dee2e6;
}

.search-group:focus-within {
    border-color: #3b82f6;
    box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.25);
}

.search-input {
    border: none;
    padding: 0.5rem 0;
}

.search-input:focus {
    box-shadow: none;
}

/* Badges */
.badge {
    font-weight: 500;
    border-radius: 8px;
    padding: 0.5em 1em;
}

/* Empty State */
.empty-state {
    padding: 3rem 1rem;
}

.empty-icon {
    opacity: 0.3;
}

/* Order Rows */
.order-row[data-status="sudah_dibayar"] {
    background-color: rgba(16, 185, 129, 0.02);
}

.order-row[data-status="belum_dibayar"] {
    background-color: rgba(245, 158, 11, 0.02);
}

/* Quantity Display */
.quantity-display .badge {
    border-radius: 6px;
}

/* Status Badge */
.status-badge .badge {
    border-radius: 20px;
}

/* Alerts */
.alert {
    border-radius: 10px;
    border: none;
    box-shadow: 0 3px 10px rgba(0,0,0,0.05);
}

.alert-icon-wrapper {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
}

/* Quick Stats */
.quick-stat {
    padding: 1rem;
    border-radius: 10px;
    background: #f8fafc;
    height: 100%;
}

.quick-stat .stat-value {
    font-size: 1.25rem;
}

/* Print Styles */
@media print {
    .card-header, .btn, .export-buttons, .search-group, .dropdown {
        display: none !important;
    }
    
    .card {
        box-shadow: none !important;
        border: 1px solid #ddd !important;
    }
    
    .table {
        font-size: 12px;
    }
    
    .page-title {
        page-break-after: avoid;
    }
}

/* Responsive */
@media (max-width: 768px) {
    .stats-count {
        font-size: 1.5rem;
    }
    
    .stats-icon {
        width: 50px;
        height: 50px;
        font-size: 1.25rem;
    }
    
    .search-group {
        width: 100% !important;
        margin-bottom: 1rem;
    }
    
    .btn-action {
        width: 32px;
        height: 32px;
        font-size: 0.875rem;
    }
    
    .table-responsive {
        font-size: 0.875rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    if(searchInput) {
        searchInput.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#ordersTable tbody tr');
            
            rows.forEach(row => {
                const rowText = row.textContent.toLowerCase();
                if(rowText.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    }
    
    // Filter by status
    window.filterStatus = function(status) {
        const rows = document.querySelectorAll('.order-row');
        rows.forEach(row => {
            if(status === 'all') {
                row.style.display = '';
            } else {
                const rowStatus = row.getAttribute('data-status');
                row.style.display = rowStatus === status ? '' : 'none';
            }
        });
    };
    
});
</script>

<script>
// Export to Excel - Defined in global scope
function exportToExcel() {
    try {
        const table = document.getElementById('ordersTable');
        if (!table) {
            alert('Tabel tidak ditemukan!');
            return;
        }
        
        let csv = [];
        const rows = table.querySelectorAll('tr');
        
        if (rows.length === 0) {
            alert('Tidak ada data untuk diekspor!');
            return;
        }
        
        // Header row
        const headerRow = [];
        const headerCells = rows[0].querySelectorAll('th');
        for (let j = 0; j < headerCells.length - 1; j++) { // Exclude action column
            let header = headerCells[j].innerText.trim();
            headerRow.push('"' + header.replace(/"/g, '""') + '"');
        }
        csv.push(headerRow.join(','));
        
        // Data rows
        for (let i = 1; i < rows.length; i++) {
            const row = [];
            const cols = rows[i].querySelectorAll('td');
            
            // Skip empty rows
            if (cols.length === 0) continue;
            
            for (let j = 0; j < cols.length - 1; j++) { // Exclude action column
                let data = cols[j].innerText.trim();
                // Clean up data
                data = data.replace(/(\r\n|\n|\r)/gm, ' ').replace(/"/g, '""');
                row.push('"' + data + '"');
            }
            csv.push(row.join(','));
        }
        
        // Add BOM for Excel UTF-8 support
        const BOM = '\uFEFF';
        const csvContent = BOM + csv.join('\n');
        
        // Create blob with proper MIME type
        const blob = new Blob([csvContent], { 
            type: 'text/csv;charset=utf-8;' 
        });
        
        // Create download link
        const link = document.createElement('a');
        if (link.download !== undefined) {
            const url = URL.createObjectURL(blob);
            link.setAttribute('href', url);
            link.setAttribute('download', 'pengiriman_' + new Date().toISOString().split('T')[0] + '.csv');
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            URL.revokeObjectURL(url);
        } else {
            alert('Browser Anda tidak mendukung fitur download. Silakan gunakan browser modern.');
        }
    } catch (error) {
        console.error('Export error:', error);
        alert('Terjadi kesalahan saat mengekspor data: ' + error.message);
    }
}

// Export to PDF (using window.print)
function exportToPDF() {
    try {
        window.print();
    } catch (error) {
        console.error('Print error:', error);
        alert('Terjadi kesalahan saat mencetak: ' + error.message);
    }
}
</script>
</script>
@endpush