@extends('layouts.app')

@section('title', 'Kelola Laporan')
@section('page-title', 'Kelola Laporan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Kelola Laporan</li>
@endsection

@section('content')
<div class="fade-in">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="text-gradient-blue mb-1">
                        <i class="bi bi-shield-check me-2"></i>Kelola Laporan
                    </h2>
                    <p class="text-muted mb-0">Manajemen semua laporan dari pengguna sistem</p>
                </div>
                <div class="alert alert-primary-grad border-0 shadow-sm">
                    <div class="d-flex align-items-center">
                        <div class="alert-icon-admin">
                            <i class="bi bi-info-circle-fill"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="alert-title mb-1">Total Laporan</h6>
                            <p class="mb-0"><strong>{{ $laporans->count() }}</strong> laporan ditemukan dalam sistem</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="row g-3">
                <div class="col-md-2">
                    <div class="admin-stat-card stat-card-blue-1">
                        <div class="stat-icon">
                            <i class="bi bi-files"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number">{{ $laporans->count() }}</h3>
                            <p class="stat-label">Total Laporan</p>
                            <div class="stat-progress">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-white" style="width: 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="admin-stat-card stat-card-red">
                        <div class="stat-icon">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number">{{ $laporans->where('prioritas', 'tinggi')->count() }}</h3>
                            <p class="stat-label">Prioritas Tinggi</p>
                            <div class="stat-progress">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-white" style="width: {{ $laporans->count() > 0 ? ($laporans->where('prioritas', 'tinggi')->count() / $laporans->count() * 100) : 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="admin-stat-card stat-card-orange">
                        <div class="stat-icon">
                            <i class="bi bi-exclamation-circle-fill"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number">{{ $laporans->where('prioritas', 'sedang')->count() }}</h3>
                            <p class="stat-label">Prioritas Sedang</p>
                            <div class="stat-progress">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-white" style="width: {{ $laporans->count() > 0 ? ($laporans->where('prioritas', 'sedang')->count() / $laporans->count() * 100) : 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="admin-stat-card stat-card-yellow">
                        <div class="stat-icon">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number">{{ $laporans->where('status', 'pending')->count() }}</h3>
                            <p class="stat-label">Laporan Pending</p>
                            <div class="stat-progress">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-white" style="width: {{ $laporans->count() > 0 ? ($laporans->where('status', 'pending')->count() / $laporans->count() * 100) : 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="admin-stat-card stat-card-green">
                        <div class="stat-icon">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number">{{ $laporans->where('status', 'selesai')->count() }}</h3>
                            <p class="stat-label">Laporan Selesai</p>
                            <div class="stat-progress">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-white" style="width: {{ $laporans->count() > 0 ? ($laporans->where('status', 'selesai')->count() / $laporans->count() * 100) : 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="admin-stat-card stat-card-purple">
                        <div class="stat-icon">
                            <i class="bi bi-gear-fill"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number">{{ $laporans->where('status', 'proses')->count() }}</h3>
                            <p class="stat-label">Sedang Diproses</p>
                            <div class="stat-progress">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-white" style="width: {{ $laporans->count() > 0 ? ($laporans->where('status', 'proses')->count() / $laporans->count() * 100) : 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reports Table -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-gradient-primary text-white border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="bi bi-table me-2"></i>
                            <h5 class="mb-0">Daftar Laporan</h5>
                            <p class="mb-0 opacity-75 small">Monitoring dan manajemen semua laporan</p>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ route('admin.export.pdf') }}" class="btn btn-light btn-sm shadow-sm">
                                <i class="bi bi-file-earmark-pdf me-1"></i>Export PDF
                            </a>
                            <div class="dropdown">
                                <button class="btn btn-light btn-sm dropdown-toggle shadow-sm" type="button" data-bs-toggle="dropdown">
                                    <i class="bi bi-filter me-1"></i>Filter Status
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="?filter=all"><i class="bi bi-list-check me-2"></i>Semua</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="?filter=pending"><i class="bi bi-clock me-2"></i>Pending</a></li>
                                    <li><a class="dropdown-item" href="?filter=proses"><i class="bi bi-gear me-2"></i>Proses</a></li>
                                    <li><a class="dropdown-item" href="?filter=selesai"><i class="bi bi-check-circle me-2"></i>Selesai</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    @if($laporans->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless align-middle">
                                <thead>
                                    <tr class="admin-table-header">
                                        <th class="ps-4">#</th>
                                        <th>Pelapor</th>
                                        <th>Judul Laporan</th>
                                        <th>Prioritas</th>
                                        <th>Status</th>
                                        <th>Tanggapan</th>
                                        <th>Tanggal</th>
                                        <th class="pe-4">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($laporans as $index => $laporan)
                                    <tr class="admin-table-row">
                                        <td class="ps-4">
                                            <div class="report-index">
                                                {{ $index + 1 }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="user-avatar-report me-2">
                                                    {{ strtoupper(substr($laporan->user->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">{{ $laporan->user->name }}</div>
                                                    <small class="badge badge-role">{{ ucfirst($laporan->user->role) }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <div class="fw-semibold text-dark">{{ Str::limit($laporan->judul, 30) }}</div>
                                                <small class="text-muted">{{ Str::limit($laporan->isi_laporan, 40) }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            @if($laporan->prioritas == 'tinggi')
                                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25">
                                                    <i class="bi bi-exclamation-triangle me-1"></i>Tinggi
                                                </span>
                                            @elseif($laporan->prioritas == 'sedang')
                                                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25">
                                                    <i class="bi bi-arrow-up me-1"></i>Sedang
                                                </span>
                                            @else
                                                <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25">
                                                    <i class="bi bi-arrow-down me-1"></i>Rendah
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($laporan->status == 'pending')
                                                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25">
                                                    <i class="bi bi-clock me-1"></i>Pending
                                                </span>
                                            @elseif($laporan->status == 'proses')
                                                <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25">
                                                    <i class="bi bi-gear me-1"></i>Proses
                                                </span>
                                            @else
                                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">
                                                    <i class="bi bi-check-circle me-1"></i>Selesai
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($laporan->tanggapans->count() > 0)
                                                <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25">
                                                    {{ $laporan->tanggapans->count() }} tanggapan
                                                </span>
                                            @else
                                                <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25">
                                                    Belum ada
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="text-nowrap">
                                                <div class="fw-semibold">{{ $laporan->created_at->format('d/m/Y') }}</div>
                                                <small class="text-muted">{{ $laporan->created_at->format('H:i') }}</small>
                                            </div>
                                        </td>
                                        <td class="pe-4">
                                            <div class="d-flex align-items-center gap-2">
                                                <a href="{{ route('admin.laporan.show', $laporan->id) }}" class="btn btn-sm btn-outline-primary view-btn">
                                                    <i class="bi bi-eye"></i>
                                                </a>

                                                <a href="{{ route('admin.laporan.show', $laporan->id) }}" class="btn btn-sm btn-outline-info tanggapi-btn">
                                                    <i class="bi bi-reply"></i>
                                                </a>

                                                @if($laporan->status != 'selesai')
                                                    <div class="status-selector">
                                                        <form action="{{ route('admin.laporan.update', $laporan->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('PUT')
                                                            <select name="status" class="form-select form-select-sm status-dropdown"
                                                                    onchange="this.form.submit()">
                                                                <option value="pending" {{ $laporan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                                <option value="proses" {{ $laporan->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                                                <option value="selesai" {{ $laporan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                            </select>
                                                        </form>
                                                    </div>
                                                @endif

                                                <form action="{{ route('admin.laporan.destroy', $laporan->id) }}" method="POST"
                                                      class="d-inline delete-form"
                                                      onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="empty-state-admin">
                                <i class="bi bi-inbox display-1 text-light-blue"></i>
                                <h4 class="mt-4 text-dark">Belum ada laporan</h4>
                                <p class="text-muted mb-4">Tidak ada laporan dari pengguna saat ini</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>



<style>
    /* Custom Styles for Admin Page */
    .text-gradient-blue {
        background: linear-gradient(135deg, var(--dark-blue) 0%, var(--secondary-blue) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .alert-primary-grad {
        background: linear-gradient(135deg, #e0f2fe 0%, #dbeafe 100%);
        border: none;
        border-left: 4px solid var(--secondary-blue);
    }
    
    .alert-icon-admin {
        width: 40px;
        height: 40px;
        background: var(--secondary-blue);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
    }
    
    .alert-title {
        color: var(--dark-blue);
        font-weight: 700;
        font-size: 1rem;
    }
    
    /* Admin Stat Cards */
    .admin-stat-card {
        border-radius: 16px;
        padding: 1.5rem;
        color: white;
        height: 100%;
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease;
    }
    
    .admin-stat-card:hover {
        transform: translateY(-5px);
    }
    
    .admin-stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: translate(30px, -30px);
    }
    
    .stat-card-blue-1 {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
    }
    
    .stat-card-red {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    }
    
    .stat-card-orange {
        background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
    }
    
    .stat-card-yellow {
        background: linear-gradient(135deg, #eab308 0%, #ca8a04 100%);
    }
    
    .stat-card-green {
        background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
    }
    
    .stat-card-purple {
        background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    }
    
    .admin-stat-card .stat-icon {
        font-size: 2rem;
        margin-bottom: 1rem;
        opacity: 0.9;
    }
    
    .admin-stat-card .stat-number {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }
    
    .admin-stat-card .stat-label {
        font-size: 0.9rem;
        opacity: 0.95;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    
    .admin-stat-card .stat-content h3,
    .admin-stat-card .stat-content p,
    .admin-stat-card .stat-icon {
        color: white !important;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
    }
    
    /* Table Styles */
    .admin-table-header {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    }
    
    .admin-table-header th {
        color: var(--dark-blue);
        font-weight: 700;
        padding: 1rem 0.75rem;
        border-bottom: 2px solid var(--border-color);
    }
    
    .admin-table-row {
        cursor: pointer;
        transition: background-color 0.2s ease;
        border-radius: 8px;
    }
    
    .admin-table-row:hover {
        background: linear-gradient(90deg, rgba(219, 234, 254, 0.3) 0%, rgba(219, 234, 254, 0.1) 100%);
    }
    
    .report-index {
        width: 32px;
        height: 32px;
        background: var(--light-blue);
        color: white;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
    }
    
    .user-avatar-report {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: linear-gradient(135deg, var(--accent-blue) 0%, var(--light-blue) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 1.1rem;
    }
    
    .badge-role {
        background: rgba(59, 130, 246, 0.1);
        color: var(--secondary-blue);
        font-weight: 500;
        padding: 0.25em 0.75em;
        border-radius: 20px;
        font-size: 0.75rem;
        border: 1px solid rgba(59, 130, 246, 0.2);
    }
    
    .status-dropdown {
        width: 120px;
        border-radius: 8px;
        border: 1px solid var(--border-color);
        background-color: white;
        transition: all 0.3s ease;
    }
    
    .status-dropdown:focus {
        border-color: var(--secondary-blue);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .view-btn, .delete-form button {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.2s ease;
    }
    
    .view-btn:hover {
        background-color: var(--secondary-blue);
        color: white;
        transform: translateY(-2px);
    }

    .tanggapi-btn:hover {
        background-color: #17a2b8;
        color: white;
        transform: translateY(-2px);
    }

    .delete-form button:hover {
        background-color: #ef4444;
        color: white;
        transform: translateY(-2px);
    }
    
    /* Modal Styles */
    .info-card {
        background: white;
        padding: 1.25rem;
        border-radius: 12px;
        border: 1px solid var(--border-color);
        margin-bottom: 1rem;
    }
    
    .info-card h6 {
        color: var(--dark-blue);
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    
    .user-avatar-modal {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        background: linear-gradient(135deg, var(--secondary-blue) 0%, var(--accent-blue) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 1.5rem;
    }
    
    .laporan-content {
        background: #f8fafc;
        padding: 1.25rem;
        border-radius: 10px;
        border-left: 4px solid var(--secondary-blue);
        line-height: 1.6;
    }
    
    .tanggapan-card {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        padding: 1rem;
        transition: transform 0.2s ease;
    }
    
    .tanggapan-card:hover {
        transform: translateX(5px);
        border-color: var(--secondary-blue);
    }
    
    .tanggapan-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.75rem;
    }
    
    .tanggapan-body {
        color: #334155;
        line-height: 1.5;
    }
    
    .empty-state-admin {
        padding: 3rem 2rem;
    }
    
    .text-light-blue {
        color: var(--light-blue);
        opacity: 0.7;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, var(--dark-blue) 0%, var(--secondary-blue) 100%) !important;
    }
    
    .btn-close-white {
        filter: invert(1) grayscale(100%) brightness(200%);
    }
    
    .table-borderless tbody tr {
        border-radius: 10px;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .admin-stat-card {
            padding: 1rem;
        }
        
        .admin-stat-card .stat-number {
            font-size: 1.5rem;
        }
        
        .admin-stat-card .stat-icon {
            font-size: 1.5rem;
        }
        
        .status-selector {
            width: 100px;
        }
        
        .view-btn, .delete-form button {
            width: 32px;
            height: 32px;
        }
    }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate stats numbers
        const stats = document.querySelectorAll('.admin-stat-card .stat-number');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const stat = entry.target;
                    const target = parseInt(stat.textContent);
                    let current = 0;
                    const increment = target / 50;
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= target) {
                            stat.textContent = target;
                            clearInterval(timer);
                        } else {
                            stat.textContent = Math.floor(current);
                        }
                    }, 20);
                    observer.unobserve(stat);
                }
            });
        }, { threshold: 0.5 });
        
        stats.forEach(stat => observer.observe(stat));
        
        // Enhance dropdowns
        const statusDropdowns = document.querySelectorAll('.status-dropdown');
        statusDropdowns.forEach(dropdown => {
            dropdown.addEventListener('change', function() {
                const form = this.closest('form');
                const submitBtn = document.createElement('button');
                submitBtn.type = 'submit';
                submitBtn.style.display = 'none';
                form.appendChild(submitBtn);
                submitBtn.click();
            });
        });
    });
</script>
@endpush
@endsection