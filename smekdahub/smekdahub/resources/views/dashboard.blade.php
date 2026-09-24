@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
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
                                    <i class="bi bi-emoji-smile"></i>
                                </div>
                                <div class="ms-3">
                                    <h2 class="mb-1 text-gradient-blue">Selamat datang, {{ Auth::user()->name }}!</h2>
                                    <p class="text-muted mb-0">
                                        Selamat datang kembali di SmekdaHub. Anda login sebagai 
                                        <span class="badge badge-role">{{ ucfirst(Auth::user()->role) }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="stats-summary">
                                <div class="d-flex flex-wrap gap-3">
                                    <div class="stat-item">
                                        <div class="stat-number text-primary">{{ $laporans->count() }}</div>
                                        <div class="stat-label">Total Laporan</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number text-warning">{{ $laporans->where('status', 'proses')->count() }}</div>
                                        <div class="stat-label">Dalam Proses</div>
                                    </div>
                                    <div class="stat-item">
                                        <div class="stat-number text-success">{{ $laporans->where('status', 'selesai')->count() }}</div>
                                        <div class="stat-label">Selesai</div>
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
                                        <h5 class="alert-title mb-1">Statistik Anda</h5>
                                        <p class="mb-0">Total <strong>{{ $laporans->count() }}</strong> laporan telah dikirim</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <!-- Create Report Card -->
        <div class="col-xl-6 mb-4">
            <div class="card h-100 border-0 shadow-lg hover-lift">
                <div class="card-header bg-gradient-primary text-white border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="bi bi-plus-circle-fill me-2"></i>
                            <h5 class="mb-0">Buat Laporan Baru</h5>
                        </div>
                        <span class="badge bg-white text-primary">Baru</span>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('laporan.store') }}" method="POST" id="laporanForm">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                <i class="bi bi-card-heading me-1"></i>Judul Laporan
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-pencil text-primary"></i>
                                </span>
                                <input type="text" name="judul" class="form-control border-start-0"
                                       placeholder="Contoh: Kerusakan Kursi Kelas 10A" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                <i class="bi bi-text-paragraph me-1"></i>Deskripsi Laporan
                            </label>
                            <div class="form-group">
                                <textarea name="isi_laporan" class="form-control" rows="4"
                                          placeholder="Deskripsikan masalah secara detail..."
                                          oninput="checkPriority(this)" required></textarea>
                                <div class="form-text mt-2">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Gunakan kata <span class="text-danger fw-bold">"mendesak"</span> atau <span class="text-danger fw-bold">"darurat"</span> untuk prioritas tinggi
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                <i class="bi bi-tags me-1"></i>Prioritas
                            </label>
                            <div class="priority-indicator" id="priorityIndicator">
                                <div class="priority-option active" data-priority="rendah">
                                    <span class="priority-dot bg-info"></span>
                                    <span class="priority-label">Rendah</span>
                                </div>
                                <div class="priority-option" data-priority="sedang">
                                    <span class="priority-dot bg-warning"></span>
                                    <span class="priority-label">Sedang</span>
                                </div>
                                <div class="priority-option" data-priority="tinggi">
                                    <span class="priority-dot bg-danger"></span>
                                    <span class="priority-label">Tinggi</span>
                                </div>
                                <input type="hidden" name="prioritas" id="selectedPriority" value="rendah">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm">
                            <i class="bi bi-send-fill me-2"></i>Kirim Laporan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Forum Card -->
        <div class="col-xl-6 mb-4">
            <div class="card h-100 border-0 shadow-lg hover-lift">
                <div class="card-header bg-gradient-success text-white border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="bi bi-chat-dots-fill me-2"></i>
                            <h5 class="mb-0">Tulis Pesan Baru</h5>
                        </div>
                        <span class="badge bg-white text-success">Forum</span>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('forum.store') }}" method="POST" id="forumForm">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark">
                                <i class="bi bi-pencil-square me-1"></i>Pesan Anda
                            </label>
                            <div class="form-group">
                                <textarea name="pesan" class="form-control" rows="4"
                                          placeholder="Bagikan pesan atau diskusi Anda di sini..."
                                          oninput="checkBadWords(this)" required></textarea>
                                <div class="form-text mt-2">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Pesan akan diposting secara anonim
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success btn-lg w-100 shadow-sm">
                            <i class="bi bi-send-fill me-2"></i>Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(Auth::user()->role === 'admin')
    <!-- Admin Only Content -->
    <div class="row">
        <!-- Reports List Card -->
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-white border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="bi bi-clipboard-data me-2 text-primary"></i>
                            <h5 class="mb-0">Status Laporan Anda</h5>
                            <p class="text-muted mb-0 small">Monitoring laporan yang Anda kirimkan</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="badge bg-primary rounded-pill me-3">{{ $laporans->count() }} laporan</span>
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
                    @if($laporans->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover table-borderless">
                                <thead>
                                    <tr class="table-light">
                                        <th class="ps-4">Judul Laporan</th>
                                        <th>Status</th>
                                        <th>Prioritas</th>
                                        <th>Tanggapan</th>
                                        <th class="pe-4">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($laporans as $laporan)
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
                                <p class="text-muted mb-4">Mulai buat laporan pertama Anda sekarang!</p>
                                <button class="btn btn-primary" onclick="document.querySelector('form').scrollIntoView()">
                                    <i class="bi bi-plus-circle me-1"></i>Buat Laporan Pertama
                                </button>
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
                            <h3 class="stat-number text-white">{{ $laporans->where('status', 'pending')->count() }}</h3>
                            <p class="stat-label text-white">Laporan Pending</p>
                            <div class="stat-progress">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-white" style="width:
                                        {{ $laporans->count() > 0 ? ($laporans->where('status', 'pending')->count() / $laporans->count() * 100) : 0 }}%">
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
                            <h3 class="stat-number text-white">{{ $laporans->where('status', 'proses')->count() }}</h3>
                            <p class="stat-label text-white">Dalam Proses</p>
                            <div class="stat-progress">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-white" style="width:
                                        {{ $laporans->count() > 0 ? ($laporans->where('status', 'proses')->count() / $laporans->count() * 100) : 0 }}%">
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
                            <h3 class="stat-number text-white">{{ $laporans->where('status', 'selesai')->count() }}</h3>
                            <p class="stat-label text-white">Selesai</p>
                            <div class="stat-progress">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-white" style="width:
                                        {{ $laporans->count() > 0 ? ($laporans->where('status', 'selesai')->count() / $laporans->count() * 100) : 0 }}%">
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
                            <h3 class="stat-number text-white">{{ $laporans->where('prioritas', 'tinggi')->count() }}</h3>
                            <p class="stat-label text-white">Prioritas Tinggi</p>
                            <div class="stat-progress">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-white" style="width:
                                        {{ $laporans->count() > 0 ? ($laporans->where('prioritas', 'tinggi')->count() / $laporans->count() * 100) : 0 }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @endif

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
                            <h3 class="stat-number text-white">{{ $laporans->where('status', 'pending')->count() }}</h3>
                            <p class="stat-label text-white">Laporan Pending</p>
                            <div class="stat-progress">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-white" style="width: 
                                        {{ $laporans->count() > 0 ? ($laporans->where('status', 'pending')->count() / $laporans->count() * 100) : 0 }}%">
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
                            <h3 class="stat-number text-white">{{ $laporans->where('status', 'proses')->count() }}</h3>
                            <p class="stat-label text-white">Dalam Proses</p>
                            <div class="stat-progress">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-white" style="width: 
                                        {{ $laporans->count() > 0 ? ($laporans->where('status', 'proses')->count() / $laporans->count() * 100) : 0 }}%">
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
                            <h3 class="stat-number text-white">{{ $laporans->where('status', 'selesai')->count() }}</h3>
                            <p class="stat-label text-white">Selesai</p>
                            <div class="stat-progress">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-white" style="width: 
                                        {{ $laporans->count() > 0 ? ($laporans->where('status', 'selesai')->count() / $laporans->count() * 100) : 0 }}%">
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
                            <h3 class="stat-number text-white">{{ $laporans->where('prioritas', 'tinggi')->count() }}</h3>
                            <p class="stat-label text-white">Prioritas Tinggi</p>
                            <div class="stat-progress">
                                <div class="progress" style="height: 4px;">
                                    <div class="progress-bar bg-white" style="width: 
                                        {{ $laporans->count() > 0 ? ($laporans->where('prioritas', 'tinggi')->count() / $laporans->count() * 100) : 0 }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<style>
    /* Custom Styles for Dashboard */
    .user-welcome-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--secondary-blue) 0%, var(--accent-blue) 100%);
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
    
    .badge-role {
        background: linear-gradient(135deg, var(--accent-blue) 0%, var(--light-blue) 100%);
        color: white;
        font-weight: 600;
        padding: 0.4em 1em;
        border-radius: 20px;
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
    
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 35px rgba(30, 58, 138, 0.15) !important;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, var(--dark-blue) 0%, var(--secondary-blue) 100%) !important;
    }
    
    .priority-indicator {
        display: flex;
        gap: 1rem;
    }
    
    .priority-option {
        flex: 1;
        padding: 1rem;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .priority-option:hover {
        border-color: var(--light-blue);
        background: rgba(96, 165, 250, 0.1);
    }
    
    .priority-option.active {
        border-color: var(--secondary-blue);
        background: rgba(59, 130, 246, 0.1);
    }
    
    .priority-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 8px;
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
        
        // Priority selector
        const priorityOptions = document.querySelectorAll('.priority-option');
        const selectedPriorityInput = document.getElementById('selectedPriority');
        
        priorityOptions.forEach(option => {
            option.addEventListener('click', function() {
                priorityOptions.forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');
                selectedPriorityInput.value = this.dataset.priority;
            });
        });
        
        // Check priority from text
        window.checkPriority = function(textarea) {
            const text = textarea.value.toLowerCase();
            const priorityIndicator = document.getElementById('priorityIndicator');
            const priorityOptions = document.querySelectorAll('.priority-option');
            
            if (text.includes('mendesak') || text.includes('darurat')) {
                priorityOptions.forEach(opt => opt.classList.remove('active'));
                priorityOptions[2].classList.add('active');
                selectedPriorityInput.value = 'tinggi';
            } else if (text.includes('penting') || text.includes('segera')) {
                priorityOptions.forEach(opt => opt.classList.remove('active'));
                priorityOptions[1].classList.add('active');
                selectedPriorityInput.value = 'sedang';
            }
        };
        
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