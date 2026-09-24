@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Admin</li>
@endsection

@section('content')
<div class="fade-in">
    <!-- Welcome Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="d-flex align-items-center mb-3">
                                <div class="user-welcome-icon">
                                    <i class="bi bi-shield-check"></i>
                                </div>
                                <div class="ms-3">
                                    <h2 class="mb-1 text-gradient-blue">Selamat datang, Admin {{ Auth::user()->name }}!</h2>
                                    <p class="text-muted mb-0">
                                        Anda memiliki akses penuh ke sistem SmekdaHub sebagai Administrator
                                    </p>
                                </div>
                            </div>
                            <div class="stats-summary">
                                <div class="d-flex flex-wrap gap-3">
                                    <div class="stat-item">
                                        <div class="stat-number text-primary">{{ $allLaporans->count() }}</div>
                                        <div class="stat-label">Total Laporan</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number text-warning">{{ $allLaporans->where('status', 'proses')->count() }}</div>
                                        <div class="stat-label">Dalam Proses</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number text-success">{{ $allLaporans->where('status', 'selesai')->count() }}</div>
                                        <div class="stat-label">Selesai</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number text-danger">{{ $allLaporans->where('prioritas', 'tinggi')->count() }}</div>
                                        <div class="stat-label">Prioritas Tinggi</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                            <div class="alert alert-primary-grad border-0 shadow-sm">
                                <div class="d-flex align-items-center">
                                    <div class="alert-icon">
                                        <i class="bi bi-info-circle-fill"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="alert-title mb-1">Ringkasan Sistem</h5>
                                        <p class="mb-0">Total <strong>{{ $allLaporans->count() }}</strong> laporan dari semua pengguna</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Admin Only Content -->
    <div class="row">
        <!-- Reports List Card -->
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-white border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="bi bi-clipboard-data me-2 text-primary"></i>
                            <h5 class="mb-0">Kelola Laporan</h5>
                            <p class="text-muted mb-0 small">Monitoring semua laporan dari pengguna</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="badge bg-primary rounded-pill me-3">{{ $allLaporans->count() }} laporan</span>
                            <div class="dropdown">
                                <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown">
                                    <i class="bi bi-filter me-1"></i>Filter
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Semua Status</a></li>
                                    <li><a class="dropdown-item" href="#">Pending</a></li>
                                    <li><a class="dropdown-item" href="#">Proses</a></li>
                                    <li><a class="dropdown-item" href="#">Selesai</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if($allLaporans->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless">
                                <thead>
                                    <tr class="table-light">
                                        <th class="ps-4">Judul Laporan</th>
                                        <th>Pengirim</th>
                                        <th>Status</th>
                                        <th>Prioritas</th>
                                        <th>Tanggapan</th>
                                        <th class="pe-4">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($allLaporans as $laporan)
                                    <tr class="report-row" data-bs-toggle="modal" data-bs-target="#detailModal{{ $laporan->id }}">
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="report-icon me-3">
                                                    @if($laporan->status == 'selesai')
                                                        <i class="bi bi-check-circle-fill text-success"></i>
                                                    @elseif($laporan->status == 'proses')
                                                        <i class="bi bi-gear-fill text-warning"></i>
                                                    @else
                                                        <i class="bi bi-clock-fill text-danger"></i>
                                                    @endif
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">{{ Str::limit($laporan->judul, 40) }}</h6>
                                                    <p class="text-muted mb-0 small">{{ Str::limit($laporan->isi_laporan, 50) }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="user-avatar-sm me-2">
                                                    {{ strtoupper(substr($laporan->user->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <div class="fw-semibold">{{ $laporan->user->name }}</div>
                                                    <small class="text-muted">{{ ucfirst($laporan->user->role) }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($laporan->status == 'selesai')
                                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">
                                                    <i class="bi bi-check-circle me-1"></i>Selesai
                                                </span>
                                            @elseif($laporan->status == 'proses')
                                                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25">
                                                    <i class="bi bi-gear me-1"></i>Proses
                                                </span>
                                            @else
                                                <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25">
                                                    <i class="bi bi-clock me-1"></i>Pending
                                                </span>
                                            @endif
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
                                            @if($laporan->tanggapans->count() > 0)
                                                <span class="text-success" data-bs-toggle="tooltip" title="{{ $laporan->tanggapans->first()->isi_tanggapan }}">
                                                    <i class="bi bi-chat-left-text-fill me-1"></i>Ada
                                                </span>
                                            @else
                                                <span class="text-muted"><i class="bi bi-hourglass me-1"></i>Menunggu</span>
                                            @endif
                                        </td>
                                        <td class="pe-4">
                                            <div class="text-end">
                                                <div class="fw-semibold">{{ $laporan->created_at->format('d/m/Y') }}</div>
                                                <small class="text-muted">{{ $laporan->created_at->format('H:i') }}</small>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="empty-state">
                                <i class="bi bi-inbox display-1 text-light-blue"></i>
                                <h4 class="mt-4 text-dark">Belum ada laporan</h4>
                                <p class="text-muted mb-4">Belum ada laporan yang dikirim oleh pengguna</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row">
        <div class="col-12 mb-4">
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="stat-card blue-1 shadow-sm">
                        <div class="stat-icon">
                            <i class="bi bi-clock-history text-white"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number text-white">{{ $allLaporans->where('status', 'pending')->count() }}</h3>
                            <p class="stat-label text-white">Laporan Pending</p>
                            <div class="stat-progress">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-white" style="width:
                                        {{ $allLaporans->count() > 0 ? ($allLaporans->where('status', 'pending')->count() / $allLaporans->count() * 100) : 0 }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card blue-2 shadow-sm">
                        <div class="stat-icon">
                            <i class="bi bi-gear text-white"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number text-white">{{ $allLaporans->where('status', 'proses')->count() }}</h3>
                            <p class="stat-label text-white">Dalam Proses</p>
                            <div class="stat-progress">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-white" style="width:
                                        {{ $allLaporans->count() > 0 ? ($allLaporans->where('status', 'proses')->count() / $allLaporans->count() * 100) : 0 }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card blue-3 shadow-sm">
                        <div class="stat-icon">
                            <i class="bi bi-check-circle text-white"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number text-white">{{ $allLaporans->where('status', 'selesai')->count() }}</h3>
                            <p class="stat-label text-white">Selesai</p>
                            <div class="stat-progress">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-white" style="width:
                                        {{ $allLaporans->count() > 0 ? ($allLaporans->where('status', 'selesai')->count() / $allLaporans->count() * 100) : 0 }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card blue-4 shadow-sm">
                        <div class="stat-icon">
                            <i class="bi bi-exclamation-triangle text-white"></i>
                        </div>
                        <div class="stat-content">
                            <h3 class="stat-number text-white">{{ $allLaporans->where('prioritas', 'tinggi')->count() }}</h3>
                            <p class="stat-label text-white">Prioritas Tinggi</p>
                            <div class="stat-progress">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-white" style="width:
                                        {{ $allLaporans->count() > 0 ? ($allLaporans->where('prioritas', 'tinggi')->count() / $allLaporans->count() * 100) : 0 }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0">
                        <i class="bi bi-activity me-2 text-primary"></i>Aktivitas Terbaru
                    </h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        @foreach($allLaporans->take(5) as $activity)
                        <div class="timeline-item">
                            <div class="timeline-icon">
                                @if($activity->status == 'selesai')
                                    <i class="bi bi-check-circle-fill text-success"></i>
                                @elseif($activity->status == 'proses')
                                    <i class="bi bi-gear-fill text-warning"></i>
                                @else
                                    <i class="bi bi-clock-fill text-danger"></i>
                                @endif
                            </div>
                            <div class="timeline-content">
                                <div class="d-flex justify-content-between">
                                    <h6 class="mb-1">{{ $activity->judul }}</h6>
                                    <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="text-muted mb-0">{{ Str::limit($activity->isi_laporan, 80) }}</p>
                                <div class="mt-2">
                                    <span class="badge bg-light text-dark me-2">
                                        <i class="bi bi-tag me-1"></i>{{ ucfirst($activity->prioritas) }}
                                    </span>
                                    <span class="badge bg-light text-dark">
                                        <i class="bi bi-calendar me-1"></i>{{ $activity->created_at->format('d M Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Styles for Admin Dashboard */
    .user-welcome-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: white;
    }

    .text-gradient-blue {
        background: linear-gradient(135deg, var(--dark-blue) 0%, var(--secondary-blue) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .stats-summary .stat-item {
        background: white;
        padding: 1rem;
        border-radius: 12px;
        min-width: 140px;
        box-shadow: 0 4px 15px rgba(30, 58, 138, 0.08);
        transition: transform 0.3s ease;
    }

    .stats-summary .stat-item:hover {
        transform: translateY(-3px);
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        line-height: 1;
    }

    .stat-label {
        font-size: 0.9rem;
        color: #64748b;
        font-weight: 500;
    }

    .alert-primary-grad {
        background: linear-gradient(135deg, #e0f2fe 0%, #dbeafe 100%);
        border: none;
        border-left: 4px solid var(--secondary-blue);
    }

    .alert-icon {
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
    }

    .report-row {
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .report-row:hover {
        background-color: rgba(219, 234, 254, 0.3);
    }

    .report-icon {
        width: 40px;
        height: 40px;
        background: rgba(59, 130, 246, 0.1);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .user-avatar-sm {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--accent-blue) 0%, var(--light-blue) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 0.9rem;
        flex-shrink: 0;
    }

    .empty-state {
        padding: 3rem 2rem;
    }

    .text-light-blue {
        color: var(--light-blue);
        opacity: 0.7;
    }

    .stat-card {
        border-radius: 16px;
        padding: 1.5rem;
        color: white;
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        wid th: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: translate(30px, -30px);
    }

    .stat-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        opacity: 0.9;
    }

    .stat-number {
        font-size: 2.2rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }

    /* Perbaikan: Semua teks di stat cards menjadi putih */
    .stat-card .stat-content h3,
    .stat-card .stat-content p,
    .stat-card .stat-icon,
    .stat-card .stat-label {
        color: white !important;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
    }

    .stat-card .stat-label {
        opacity: 0.95;
        font-weight: 600;
        font-size: 1rem;
        letter-spacing: 0.3px;
        margin-bottom: 0.5rem;
    }

    .stat-progress {
        margin-top: 1rem;
    }

    .timeline {
        position: relative;
        padding-left: 2rem;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 10px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(180deg, var(--light-blue) 0%, transparent 100%);
    }

    .timeline-item {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .timeline-icon {
        position: absolute;
        left: -2rem;
        top: 0;
        width: 40px;
        height: 40px;
        background: white;
        border: 2px solid var(--border-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        z-index: 1;
    }

    .timeline-content {
        background: white;
        padding: 1.25rem;
        border-radius: 12px;
        border: 1px solid var(--border-color);
        margin-left: 1rem;
    }

    .table-borderless tbody tr {
        border-radius: 10px;
        overflow: hidden;
    }

    .table-borderless tbody tr:hover {
        background: linear-gradient(90deg, rgba(219, 234, 254, 0.3) 0%, rgba(219, 234, 254, 0.1) 100%);
    }

    /* Text Shadow untuk meningkatkan readability */
    .stat-card h3,
    .stat-card .stat-number,
    .stat-card p,
    .stat-card .stat-label,
    .stat-card i {
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    }
</style>

@push('scripts')
<script>
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Animate stats on scroll
        const stats = document.querySelectorAll('.stat-number');
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
                    }, 30);
                    observer.unobserve(stat);
                }
            });
        }, { threshold: 0.5 });

        stats.forEach(stat => observer.observe(stat));
    });
</script>
@endpush
@endsection
