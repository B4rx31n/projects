@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Animated Background Elements -->
    <div class="dashboard-background">
        <div class="bg-gradient gradient-1"></div>
        <div class="bg-gradient gradient-2"></div>
        <div class="bg-circle circle-1"></div>
        <div class="bg-circle circle-2"></div>
        <div class="bg-circle circle-3"></div>
        <div class="bg-shape shape-1"></div>
        <div class="bg-shape shape-2"></div>
    </div>

    <!-- Top Bar with User Info and Logout -->
    <div class="row justify-content-center mb-4">
        <div class="col-xxl-10 col-12">
            <div class="card glass-card top-bar-card animated-card">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="brand-logo">
                                <i class="bi bi-building"></i>
                                <span class="ms-2 fw-bold text-gradient-primary">SmekdaHub</span>
                                <div class="logo-glow"></div>
                            </div>
                            <div class="ms-4">
                                <div class="system-status">
                                    <span class="status-dot online"></span>
                                    <small class="text-muted">System Online</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center gap-3">
                            <!-- Notifications -->
                            <div class="notification-wrapper">
                                <button class="btn btn-icon btn-glass" id="notificationBtn">
                                    <i class="bi bi-bell"></i>
                                    <span class="notification-badge">3</span>
                                </button>
                                <div class="notification-dropdown">
                                    <div class="notification-header">
                                        <h6>Notifikasi</h6>
                                        <a href="#" class="small text-primary">Lihat semua</a>
                                    </div>
                                    <div class="notification-list">
                                        <div class="notification-item unread">
                                            <div class="notification-icon bg-primary">
                                                <i class="bi bi-chat-text"></i>
                                            </div>
                                            <div class="notification-content">
                                                <p class="mb-1">Ada tanggapan baru untuk laporan Anda</p>
                                                <small class="text-muted">2 menit lalu</small>
                                            </div>
                                        </div>
                                        <div class="notification-item">
                                            <div class="notification-icon bg-success">
                                                <i class="bi bi-check-circle"></i>
                                            </div>
                                            <div class="notification-content">
                                                <p class="mb-1">Laporan Anda telah selesai</p>
                                                <small class="text-muted">1 jam lalu</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- User Profile Dropdown -->
                            <div class="dropdown user-dropdown">
                                <button class="btn btn-profile" type="button" data-bs-toggle="dropdown">
                                    <div class="user-avatar-sm pulse-animation">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                    </div>
                                    <div class="user-info ms-2 me-1 d-none d-md-block">
                                        <span class="d-block fw-semibold text-dark">{{ Auth::user()->name }}</span>
                                        <small class="text-muted">{{ ucfirst(Auth::user()->role) }}</small>
                                    </div>
                                    <i class="bi bi-chevron-down ms-1"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-person me-2"></i>Profil Saya
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-gear me-2"></i>Pengaturan
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <!-- Logout Button in Dropdown -->
                                    <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                                        @csrf
                                        <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                                            <i class="bi bi-box-arrow-right me-2"></i>Keluar
                                        </a>
                                    </form>
                                </div>
                            </div>
                            
                            <!-- Floating Logout Button (Desktop) -->
                            <form method="POST" action="{{ route('logout') }}" class="d-none d-lg-block">
                                @csrf
                                <button type="submit" class="btn btn-logout btn-glass" title="Keluar">
                                    <i class="bi bi-power"></i>
                                    <div class="logout-glow"></div>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Welcome Card with Glass Effect -->
    <div class="row justify-content-center mb-5">
        <div class="col-xxl-10 col-12">
            <div class="card glass-card welcome-card animated-card">
                <div class="card-body p-4 p-md-5 position-relative overflow-hidden">
                    <!-- Animated Particles -->
                    <div class="particles">
                        <div class="particle particle-1"></div>
                        <div class="particle particle-2"></div>
                        <div class="particle particle-3"></div>
                        <div class="particle particle-4"></div>
                        <div class="particle particle-5"></div>
                    </div>
                    
                    <div class="row align-items-center">
                        <div class="col-lg-6 text-center text-lg-start mb-4 mb-lg-0">
                            <div class="d-flex align-items-center justify-content-center justify-content-lg-start mb-4">
                                <div class="user-avatar-welcome pulse-animation">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                    <div class="avatar-ring"></div>
                                    <div class="avatar-glow"></div>
                                </div>
                                <div class="ms-4">
                                    <h2 class="mb-1 text-gradient-animated">Halo, {{ Auth::user()->name }}! 👋</h2>
                                    <p class="text-muted mb-0">
                                        Selamat datang kembali di Dashboard SmekdaHub
                                    </p>
                                    <div class="mt-2">
                                        <span class="badge badge-role animated-role">
                                            <i class="bi bi-person-badge me-1"></i>{{ ucfirst(Auth::user()->role) }}
                                        </span>
                                        <span class="badge bg-light text-dark ms-2">
                                            <i class="bi bi-calendar3 me-1"></i>{{ now()->format('d M Y') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Quick Stats Mini -->
                            <div class="quick-stats-mini">
                                <div class="row g-3">
                                    <div class="col-4">
                                        <div class="stat-mini bg-primary-glow hover-lift">
                                            <div class="stat-mini-icon">
                                                <i class="bi bi-file-earmark-text"></i>
                                            </div>
                                            <div class="stat-mini-content">
                                                <h4 class="mb-0 count-up">{{ $laporans->count() }}</h4>
                                                <small>Total Laporan</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="stat-mini bg-warning-glow hover-lift">
                                            <div class="stat-mini-icon">
                                                <i class="bi bi-clock-history"></i>
                                            </div>
                                            <div class="stat-mini-content">
                                                <h4 class="mb-0 count-up">{{ $laporans->where('status', 'proses')->count() }}</h4>
                                                <small>Dalam Proses</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="stat-mini bg-success-glow hover-lift">
                                            <div class="stat-mini-icon">
                                                <i class="bi bi-check2-circle"></i>
                                            </div>
                                            <div class="stat-mini-content">
                                                <h4 class="mb-0 count-up">{{ $laporans->where('status', 'selesai')->count() }}</h4>
                                                <small>Selesai</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 text-center text-lg-end">
                            <div class="performance-card animated-glow">
                                <div class="performance-icon">
                                    <i class="bi bi-graph-up-arrow"></i>
                                </div>
                                <div class="performance-content">
                                    <h5 class="mb-3">Statistik Performa</h5>
                                    <div class="progress-container">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="small">Progress Laporan</span>
                                            <span class="small fw-bold text-gradient-primary">
                                                {{ $laporans->count() > 0 ? number_format(($laporans->where('status', 'selesai')->count() / $laporans->count() * 100), 1) : 0 }}%
                                            </span>
                                        </div>
                                        <div class="progress progress-lg">
                                            <div class="progress-bar progress-bar-animated" 
                                                 style="width: {{ $laporans->count() > 0 ? ($laporans->where('status', 'selesai')->count() / $laporans->count() * 100) : 0 }}%">
                                                <div class="progress-dot"></div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-6">
                                                <div class="stat-indicator">
                                                    <div class="indicator-dot bg-danger"></div>
                                                    <div class="indicator-text">
                                                        <small>Prioritas Tinggi</small>
                                                        <strong>{{ $laporans->where('prioritas', 'tinggi')->count() }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="stat-indicator">
                                                    <div class="indicator-dot bg-info"></div>
                                                    <div class="indicator-text">
                                                        <small>Tanggapan</small>
                                                        <strong>{{ $laporans->sum(fn($laporan) => $laporan->tanggapans->count()) }}</strong>
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
            </div>
        </div>
    </div>

    <!-- Quick Stats Cards with Hover Effects -->
    <div class="row justify-content-center mb-5">
        <div class="col-xxl-10 col-12">
            <div class="row g-4">
                <div class="col-md-3 col-sm-6">
                    <div class="stat-card-3d blue-1 hover-3d">
                        <div class="card-inner">
                            <div class="stat-icon-3d">
                                <i class="bi bi-clock"></i>
                                <div class="icon-shadow"></div>
                            </div>
                            <div class="stat-content">
                                <h3 class="stat-number count-up">{{ $laporans->where('status', 'pending')->count() }}</h3>
                                <p class="stat-label">Menunggu</p>
                                <div class="sparkline-container">
                                    <div class="sparkline"></div>
                                </div>
                            </div>
                            <div class="stat-badge">
                                <span class="badge bg-white-blur text-primary">Pending</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stat-card-3d blue-2 hover-3d">
                        <div class="card-inner">
                            <div class="stat-icon-3d">
                                <i class="bi bi-gear-fill"></i>
                                <div class="icon-shadow"></div>
                            </div>
                            <div class="stat-content">
                                <h3 class="stat-number count-up">{{ $laporans->where('status', 'proses')->count() }}</h3>
                                <p class="stat-label">Diproses</p>
                                <div class="sparkline-container">
                                    <div class="sparkline"></div>
                                </div>
                            </div>
                            <div class="stat-badge">
                                <span class="badge bg-white-blur text-warning">Active</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stat-card-3d blue-3 hover-3d">
                        <div class="card-inner">
                            <div class="stat-icon-3d">
                                <i class="bi bi-check-circle-fill"></i>
                                <div class="icon-shadow"></div>
                            </div>
                            <div class="stat-content">
                                <h3 class="stat-number count-up">{{ $laporans->where('status', 'selesai')->count() }}</h3>
                                <p class="stat-label">Selesai</p>
                                <div class="sparkline-container">
                                    <div class="sparkline"></div>
                                </div>
                            </div>
                            <div class="stat-badge">
                                <span class="badge bg-white-blur text-success">Done</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stat-card-3d blue-4 hover-3d">
                        <div class="card-inner">
                            <div class="stat-icon-3d">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                <div class="icon-shadow"></div>
                            </div>
                            <div class="stat-content">
                                <h3 class="stat-number count-up">{{ $laporans->where('prioritas', 'tinggi')->count() }}</h3>
                                <p class="stat-label">Prioritas Tinggi</p>
                                <div class="sparkline-container">
                                    <div class="sparkline sparkline-danger"></div>
                                </div>
                            </div>
                            <div class="stat-badge">
                                <span class="badge bg-white-blur text-danger">Urgent</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Cards Grid -->
    <div class="row justify-content-center mb-5">
        <div class="col-xxl-10 col-12">
            <div class="row g-4">
                <!-- Create Report Card -->
                <div class="col-xl-6">
                    <div class="card glass-card action-card hover-lift-3d">
                        <div class="card-header card-header-gradient-primary">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="header-icon">
                                        <i class="bi bi-plus-circle-fill"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="mb-0">Buat Laporan Baru</h5>
                                        <small class="opacity-75">Laporkan masalah atau kebutuhan sekolah</small>
                                    </div>
                                </div>
                                <span class="badge bg-white-blur text-primary pulse-badge">New</span>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('laporan.store') }}" method="POST" id="laporanForm">
                                @csrf
                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-dark">
                                        <i class="bi bi-card-heading me-2"></i>Judul Laporan
                                    </label>
                                    <div class="input-group input-group-lg input-group-neon">
                                        <span class="input-group-text">
                                            <i class="bi bi-pencil text-primary"></i>
                                        </span>
                                        <input type="text" name="judul" class="form-control"
                                               placeholder="Contoh: Kerusakan Kursi Kelas 10A" required>
                                        <div class="input-glow"></div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-dark">
                                        <i class="bi bi-text-paragraph me-2"></i>Deskripsi Laporan
                                    </label>
                                    <div class="form-group">
                                        <div class="textarea-container">
                                            <textarea name="isi_laporan" class="form-control textarea-glow" rows="4"
                                                      placeholder="Deskripsikan masalah secara detail..."
                                                      oninput="checkPriority(this)" required></textarea>
                                            <div class="textarea-focus"></div>
                                        </div>
                                        <div class="form-text mt-3 d-flex align-items-center">
                                            <i class="bi bi-info-circle me-2 text-primary"></i>
                                            Gunakan kata <span class="text-danger fw-bold mx-1">"mendesak"</span> atau 
                                            <span class="text-danger fw-bold mx-1">"darurat"</span> untuk prioritas tinggi
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-dark">
                                        <i class="bi bi-flag me-2"></i>Pilih Prioritas
                                    </label>
                                    <div class="priority-selector">
                                        <div class="priority-option active" data-priority="rendah">
                                            <div class="priority-icon">
                                                <i class="bi bi-arrow-down-right"></i>
                                            </div>
                                            <div class="priority-content">
                                                <span class="priority-label">Rendah</span>
                                                <small class="text-muted">Masalah ringan</small>
                                            </div>
                                            <div class="priority-indicator">
                                                <div class="indicator-dot bg-info"></div>
                                            </div>
                                        </div>
                                        <div class="priority-option" data-priority="sedang">
                                            <div class="priority-icon">
                                                <i class="bi bi-arrow-right"></i>
                                            </div>
                                            <div class="priority-content">
                                                <span class="priority-label">Sedang</span>
                                                <small class="text-muted">Perlu penanganan</small>
                                            </div>
                                            <div class="priority-indicator">
                                                <div class="indicator-dot bg-warning"></div>
                                            </div>
                                        </div>
                                        <div class="priority-option" data-priority="tinggi">
                                            <div class="priority-icon">
                                                <i class="bi bi-arrow-up-right"></i>
                                            </div>
                                            <div class="priority-content">
                                                <span class="priority-label">Tinggi</span>
                                                <small class="text-muted">Mendesak & Darurat</small>
                                            </div>
                                            <div class="priority-indicator">
                                                <div class="indicator-dot bg-danger"></div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="prioritas" id="selectedPriority" value="rendah">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-lg w-100 btn-neon">
                                    <i class="bi bi-send-fill me-2"></i>Kirim Laporan Sekarang
                                    <div class="btn-glow"></div>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Forum & Quick Actions Card -->
                <div class="col-xl-6">
                    <div class="card glass-card action-card hover-lift-3d">
                        <div class="card-header card-header-gradient-success">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <div class="header-icon">
                                        <i class="bi bi-chat-dots-fill"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h5 class="mb-0">Forum Diskusi & Quick Actions</h5>
                                        <small class="opacity-75">Diskusi dan aksi cepat</small>
                                    </div>
                                </div>
                                <span class="badge bg-white-blur text-success">
                                    <i class="bi bi-lightning-fill me-1"></i>Quick
                                </span>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <!-- Forum Section -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold text-dark">
                                    <i class="bi bi-chat-left-text me-2"></i>Tulis Pesan Forum
                                </label>
                                <form action="{{ route('forum.store') }}" method="POST" id="forumForm">
                                    @csrf
                                    <div class="form-group">
                                        <div class="textarea-container">
                                            <textarea name="pesan" class="form-control textarea-glow forum-textarea" rows="3"
                                                      placeholder="Bagikan ide atau diskusi..."
                                                      oninput="updateCharCount(this)" maxlength="300" required></textarea>
                                            <div class="textarea-focus"></div>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mt-2">
                                            <small class="text-muted d-flex align-items-center">
                                                <i class="bi bi-incognito me-1 text-success"></i> Anonim
                                            </small>
                                            <div class="char-counter">
                                                <span class="char-count">0</span>/300
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success btn-sm mt-3 w-100 btn-neon">
                                            <i class="bi bi-send me-2"></i>Post ke Forum
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Quick Actions -->
                            <div class="quick-actions">
                                <label class="form-label fw-semibold text-dark mb-3">
                                    <i class="bi bi-lightning me-2"></i>Aksi Cepat
                                </label>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <a href="{{ route('laporan.index') }}" class="btn btn-action btn-primary">
                                            <i class="bi bi-list-check"></i>
                                            <span>Lihat Laporan</span>
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('forum.index') }}" class="btn btn-action btn-info">
                                            <i class="bi bi-chat-square-text"></i>
                                            <span>Forum Diskusi</span>
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-action btn-warning" data-bs-toggle="modal" data-bs-target="#helpModal">
                                            <i class="bi bi-question-circle"></i>
                                            <span>Bantuan</span>
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <!-- Logout Button (Mobile) -->
                                        <form method="POST" action="{{ route('logout') }}" class="h-100">
                                            @csrf
                                            <button type="submit" class="btn btn-action btn-danger h-100 w-100">
                                                <i class="bi bi-power"></i>
                                                <span>Keluar</span>
                                            </button>
                                        </form>
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
    <div class="row justify-content-center">
        <div class="col-xxl-10 col-12">
            <div class="card glass-card">
                <div class="card-header card-header-gradient-info">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="header-icon">
                                <i class="bi bi-activity"></i>
                            </div>
                            <div class="ms-3">
                                <h5 class="mb-0">Aktivitas Terbaru</h5>
                                <small class="opacity-75">Riwayat laporan dan diskusi Anda</small>
                            </div>
                        </div>
                        <a href="{{ route('laporan.index') }}" class="btn btn-light btn-glass">
                            Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($laporans->count() > 0)
                        <div class="activity-timeline">
                            @foreach($laporans->take(5) as $index => $laporan)
                                <div class="activity-item" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                                    <div class="activity-icon-wrapper">
                                        <div class="activity-icon bg-{{ $laporan->status == 'selesai' ? 'success' : ($laporan->status == 'proses' ? 'warning' : 'secondary') }}-glow">
                                            <i class="bi bi-{{ $laporan->status == 'selesai' ? 'check-circle' : ($laporan->status == 'proses' ? 'gear' : 'clock') }}"></i>
                                        </div>
                                        @if($index < 4)
                                            <div class="activity-line"></div>
                                        @endif
                                    </div>
                                    <div class="activity-content">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="mb-0">{{ $laporan->judul }}</h6>
                                            <small class="text-muted">
                                                <i class="bi bi-clock me-1"></i>
                                                {{ $laporan->created_at->diffForHumans() }}
                                            </small>
                                        </div>
                                        <p class="text-muted mb-3 small">{{ Str::limit($laporan->isi_laporan, 120) }}</p>
                                        <div class="d-flex gap-2 flex-wrap">
                                            <span class="badge status-badge status-{{ $laporan->status }}">
                                                <i class="bi bi-circle-fill me-1"></i>
                                                {{ ucfirst($laporan->status) }}
                                            </span>
                                            <span class="badge priority-badge priority-{{ $laporan->prioritas }}">
                                                <i class="bi bi-flag me-1"></i>
                                                {{ ucfirst($laporan->prioritas) }}
                                            </span>
                                            @if($laporan->tanggapans->count() > 0)
                                                <span class="badge bg-info-glow">
                                                    <i class="bi bi-chat-left-text me-1"></i>
                                                    {{ $laporan->tanggapans->count() }} Tanggapan
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="bi bi-inbox"></i>
                                </div>
                                <h4 class="mt-4 text-dark">Belum ada aktivitas</h4>
                                <p class="text-muted mb-4">Mulai dengan membuat laporan pertama Anda</p>
                                <a href="#" class="btn btn-primary btn-neon">
                                    <i class="bi bi-plus-circle me-2"></i>Buat Laporan Pertama
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Help Modal -->
<div class="modal fade" id="helpModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content glass-card">
            <div class="modal-header card-header-gradient-primary">
                <h5 class="modal-title">
                    <i class="bi bi-question-circle me-2"></i>Bantuan & Panduan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="help-content">
                    <div class="help-item">
                        <div class="help-icon bg-primary">
                            <i class="bi bi-plus-circle"></i>
                        </div>
                        <div class="help-text">
                            <h6>Buat Laporan</h6>
                            <p class="small text-muted mb-0">Laporkan masalah dengan detail dan pilih prioritas sesuai urgensi</p>
                        </div>
                    </div>
                    <div class="help-item">
                        <div class="help-icon bg-success">
                            <i class="bi bi-chat-text"></i>
                        </div>
                        <div class="help-text">
                            <h6>Forum Diskusi</h6>
                            <p class="small text-muted mb-0">Bagikan ide dan diskusi secara anonim dengan komunitas</p>
                        </div>
                    </div>
                    <div class="help-item">
                        <div class="help-icon bg-warning">
                            <i class="bi bi-bell"></i>
                        </div>
                        <div class="help-text">
                            <h6>Notifikasi</h6>
                            <p class="small text-muted mb-0">Dapatkan pemberitahuan real-time untuk laporan Anda</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a href="#" class="btn btn-primary">Lihat Panduan Lengkap</a>
            </div>
        </div>
    </div>
</div>

<style>
    /* CSS Variables - Enhanced */
    :root {
        --primary-blue: #3b82f6;
        --secondary-blue: #2563eb;
        --dark-blue: #1e40af;
        --light-blue: #60a5fa;
        --accent-blue: #93c5fd;
        --glass-bg: rgba(255, 255, 255, 0.92);
        --glass-border: rgba(255, 255, 255, 0.3);
        --glass-shadow: 0 8px 32px rgba(31, 38, 135, 0.1);
        --primary-glow: linear-gradient(135deg, rgba(59, 130, 246, 0.15), transparent);
        --success-glow: linear-gradient(135deg, rgba(16, 185, 129, 0.15), transparent);
        --warning-glow: linear-gradient(135deg, rgba(245, 158, 11, 0.15), transparent);
        --danger-glow: linear-gradient(135deg, rgba(239, 68, 68, 0.15), transparent);
        --blur-intensity: blur(20px);
    }

    /* Enhanced Animated Background */
    .dashboard-background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
        overflow: hidden;
        pointer-events: none;
    }

    .bg-gradient {
        position: absolute;
        width: 80%;
        height: 60%;
        border-radius: 50%;
        filter: blur(100px);
        opacity: 0.15;
    }

    .gradient-1 {
        background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
        top: -10%;
        right: -20%;
        animation: gradient-move 20s infinite alternate;
    }

    .gradient-2 {
        background: linear-gradient(135deg, var(--accent-blue), var(--secondary-blue));
        bottom: -10%;
        left: -20%;
        animation: gradient-move 25s infinite alternate-reverse;
    }

    .bg-circle, .bg-shape {
        position: absolute;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), transparent);
        animation: float 25s infinite linear;
        filter: blur(40px);
    }

    .bg-shape {
        border-radius: 30px;
    }

    .circle-1 {
        width: 300px;
        height: 300px;
        top: 10%;
        left: 5%;
        animation-delay: 0s;
    }

    .circle-2 {
        width: 200px;
        height: 200px;
        bottom: 15%;
        right: 10%;
        animation-delay: -8s;
    }

    .circle-3 {
        width: 150px;
        height: 150px;
        top: 50%;
        left: 85%;
        animation-delay: -15s;
    }

    .shape-1 {
        width: 200px;
        height: 200px;
        top: 70%;
        left: 15%;
        animation-delay: -20s;
    }

    .shape-2 {
        width: 100px;
        height: 100px;
        top: 20%;
        right: 15%;
        animation-delay: -10s;
    }

    /* Top Bar */
    .top-bar-card {
        backdrop-filter: var(--blur-intensity);
        background: var(--glass-bg);
        border: 1px solid var(--glass-border);
        box-shadow: var(--glass-shadow);
        border-radius: 15px;
        margin-bottom: 1.5rem;
    }

    .brand-logo {
        display: flex;
        align-items: center;
        font-size: 1.5rem;
        color: var(--dark-blue);
        position: relative;
        padding: 0.5rem 1rem;
        border-radius: 12px;
        background: rgba(59, 130, 246, 0.1);
    }

    .logo-glow {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.2) 0%, transparent 70%);
        border-radius: 12px;
        z-index: -1;
    }

    .system-status {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        position: relative;
    }

    .status-dot.online {
        background: #10b981;
        box-shadow: 0 0 10px #10b981;
        animation: pulse 2s infinite;
    }

    /* Enhanced Glass Card */
    .glass-card {
        background: var(--glass-bg);
        backdrop-filter: var(--blur-intensity);
        border: 1px solid var(--glass-border);
        box-shadow: var(--glass-shadow);
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .glass-card:hover {
        transform: translateY(-5px);
        box-shadow: 
            0 20px 40px rgba(31, 38, 135, 0.15),
            0 8px 16px rgba(0, 0, 0, 0.1),
            inset 0 1px 0 rgba(255, 255, 255, 0.6);
    }

    /* Card Headers - Enhanced */
    .card-header-gradient-primary {
        background: linear-gradient(135deg, var(--dark-blue) 0%, var(--secondary-blue) 100%);
        border-bottom: none;
        padding: 1.5rem;
        position: relative;
        overflow: hidden;
    }

    .card-header-gradient-primary::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.6), transparent);
        animation: shimmer 3s infinite;
    }

    .card-header-gradient-success {
        background: linear-gradient(135deg, #059669 0%, #10b981 100%);
        border-bottom: none;
        padding: 1.5rem;
    }

    .card-header-gradient-info {
        background: linear-gradient(135deg, #0e7490 0%, #06b6d4 100%);
        border-bottom: none;
        padding: 1.5rem;
    }

    .header-icon {
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        backdrop-filter: blur(10px);
    }

    /* User Profile & Logout */
    .user-dropdown .btn-profile {
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(59, 130, 246, 0.2);
        border-radius: 15px;
        padding: 0.5rem 1rem;
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .user-dropdown .btn-profile:hover {
        background: white;
        border-color: var(--light-blue);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(59, 130, 246, 0.2);
    }

    .user-avatar-sm {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, var(--secondary-blue), var(--accent-blue));
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        font-weight: 700;
        color: white;
        box-shadow: 0 5px 15px rgba(59, 130, 246, 0.3);
    }

    .btn-logout {
        width: 45px;
        height: 45px;
        border-radius: 15px;
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        border: none;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .btn-logout:hover {
        transform: translateY(-3px) scale(1.1);
        box-shadow: 0 10px 25px rgba(239, 68, 68, 0.4);
    }

    .logout-glow {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border-radius: inherit;
        box-shadow: 0 0 30px rgba(239, 68, 68, 0.6);
        opacity: 0;
        transition: opacity 0.3s ease;
        pointer-events: none;
    }

    .btn-logout:hover .logout-glow {
        opacity: 1;
    }

    .btn-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(59, 130, 246, 0.2);
        color: var(--dark-blue);
        position: relative;
        transition: all 0.3s ease;
    }

    .btn-icon:hover {
        background: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.2);
    }

    .notification-badge {
        position: absolute;
        top: -5px;
        right: -5px;
        width: 20px;
        height: 20px;
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        border-radius: 50%;
        font-size: 0.7rem;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: pulse 2s infinite;
    }

    /* Notifications Dropdown */
    .notification-wrapper {
        position: relative;
    }

    .notification-dropdown {
        position: absolute;
        top: 100%;
        right: 0;
        width: 350px;
        background: var(--glass-bg);
        backdrop-filter: var(--blur-intensity);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        box-shadow: var(--glass-shadow);
        padding: 1rem;
        opacity: 0;
        visibility: hidden;
        transform: translateY(10px);
        transition: all 0.3s ease;
        z-index: 1000;
    }

    .notification-wrapper:hover .notification-dropdown {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .notification-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .notification-item {
        display: flex;
        align-items: flex-start;
        padding: 0.75rem;
        border-radius: 12px;
        margin-bottom: 0.5rem;
        transition: background 0.3s ease;
    }

    .notification-item:hover {
        background: rgba(59, 130, 246, 0.1);
    }

    .notification-item.unread {
        background: rgba(59, 130, 246, 0.08);
    }

    .notification-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        margin-right: 1rem;
        flex-shrink: 0;
    }

    /* Quick Actions */
    .quick-actions {
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
    }

    .btn-action {
        height: 80px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border-radius: 15px;
        border: none;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn-action i {
        font-size: 1.5rem;
        margin-bottom: 0.5rem;
    }

    .btn-action span {
        font-size: 0.85rem;
    }

    .btn-action:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .btn-action::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s ease;
    }

    .btn-action:hover::before {
        left: 100%;
    }

    /* Progress Bar Enhancements */
    .progress-bar-animated {
        position: relative;
        overflow: hidden;
        background: linear-gradient(90deg, 
            var(--light-blue) 0%, 
            var(--secondary-blue) 25%, 
            var(--primary-blue) 50%, 
            var(--secondary-blue) 75%, 
            var(--light-blue) 100%);
        background-size: 200% 100%;
        animation: progress-shimmer 2s infinite linear;
    }

    /* Stat Indicators */
    .stat-indicator {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .indicator-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        position: relative;
    }

    .indicator-dot::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: inherit;
        opacity: 0.3;
        animation: pulse 2s infinite;
    }

    .indicator-text {
        display: flex;
        flex-direction: column;
    }

    .indicator-text strong {
        font-size: 1.2rem;
        line-height: 1;
    }

    /* Empty State */
    .empty-state {
        max-width: 400px;
        margin: 0 auto;
    }

    .empty-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, var(--light-blue), var(--accent-blue));
        border-radius: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: white;
        margin: 0 auto;
        box-shadow: 0 15px 35px rgba(59, 130, 246, 0.3);
    }

    /* Modal Styling */
    .modal-content.glass-card {
        border: none;
        backdrop-filter: blur(30px);
        background: rgba(255, 255, 255, 0.95);
    }

    .help-content {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .help-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        border-radius: 12px;
        background: rgba(59, 130, 246, 0.05);
        transition: transform 0.3s ease;
    }

    .help-item:hover {
        transform: translateX(5px);
        background: rgba(59, 130, 246, 0.1);
    }

    .help-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    /* Enhanced Animations */
    @keyframes gradient-move {
        0% { transform: translate(0, 0) scale(1); }
        100% { transform: translate(50px, 50px) scale(1.1); }
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }

    @keyframes progress-shimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }

    @keyframes float {
        0%, 100% { 
            transform: translateY(0) rotate(0deg) scale(1); 
            filter: blur(40px);
        }
        50% { 
            transform: translateY(-30px) rotate(180deg) scale(1.1); 
            filter: blur(50px);
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .user-info {
            display: none !important;
        }
        
        .btn-logout {
            display: none;
        }
        
        .notification-dropdown {
            width: 300px;
            right: -50px;
        }
        
        .stat-card-3d .card-inner {
            transform: none !important;
        }
        
        .quick-stats-mini .row {
            gap: 10px;
        }
        
        .quick-stats-mini .col-4 {
            flex: 0 0 calc(33.333% - 10px);
        }
        
        .btn-action {
            height: 70px;
        }
        
        .btn-action i {
            font-size: 1.2rem;
        }
        
        .btn-action span {
            font-size: 0.75rem;
        }
    }

    @media (max-width: 576px) {
        .brand-logo {
            font-size: 1.2rem;
            padding: 0.3rem 0.8rem;
        }
        
        .notification-dropdown {
            width: 280px;
            right: -80px;
        }
        
        .user-avatar-welcome {
            width: 70px;
            height: 70px;
            font-size: 1.8rem;
        }
        
        .performance-card {
            margin-top: 2rem;
        }
        
        .activity-timeline {
            padding-left: 40px;
        }
        
        .activity-icon-wrapper {
            left: -40px;
        }
        
        .priority-selector {
            gap: 8px;
        }
        
        .priority-option {
            padding: 0.75rem 1rem;
        }
    }

    @media (max-width: 400px) {
        .notification-dropdown {
            width: 250px;
            right: -100px;
        }
        
        .btn-action {
            height: 60px;
        }
        
        .btn-action i {
            font-size: 1rem;
            margin-bottom: 0.3rem;
        }
        
        .btn-action span {
            font-size: 0.7rem;
        }
    }
</style>

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/countup.js@1.9.3/dist/countUp.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });

        // Initialize CountUp for statistics
        const countUpOptions = {
            duration: 2,
            separator: ','
        };
        
        document.querySelectorAll('.count-up').forEach(element => {
            const target = parseInt(element.textContent);
            const countUp = new CountUp(element, target, countUpOptions);
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        countUp.start();
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            
            observer.observe(element);
        });

        // Priority selector
        const priorityOptions = document.querySelectorAll('.priority-option');
        const selectedPriorityInput = document.getElementById('selectedPriority');

        priorityOptions.forEach(option => {
            option.addEventListener('click', function() {
                priorityOptions.forEach(opt => {
                    opt.classList.remove('active');
                    opt.style.transform = '';
                });
                this.classList.add('active');
                this.style.transform = 'translateX(5px)';
                selectedPriorityInput.value = this.dataset.priority;
                
                // Add click animation
                this.style.animation = 'none';
                setTimeout(() => {
                    this.style.animation = 'pulse 0.5s';
                }, 10);
            });
        });

        // Check priority from text
        window.checkPriority = function(textarea) {
            const text = textarea.value.toLowerCase();
            const priorityOptions = document.querySelectorAll('.priority-option');

            if (text.includes('mendesak') || text.includes('darurat')) {
                priorityOptions.forEach(opt => {
                    opt.classList.remove('active');
                    opt.style.transform = '';
                });
                priorityOptions[2].classList.add('active');
                priorityOptions[2].style.transform = 'translateX(5px)';
                selectedPriorityInput.value = 'tinggi';
                
                // Add warning animation
                priorityOptions[2].style.animation = 'pulse 1s infinite';
                setTimeout(() => {
                    priorityOptions[2].style.animation = '';
                }, 1000);
            } else if (text.includes('penting') || text.includes('segera')) {
                priorityOptions.forEach(opt => {
                    opt.classList.remove('active');
                    opt.style.transform = '';
                });
                priorityOptions[1].classList.add('active');
                priorityOptions[1].style.transform = 'translateX(5px)';
                selectedPriorityInput.value = 'sedang';
            }
        };

        // Character counter for forum textarea
        window.updateCharCount = function(textarea) {
            const charCount = textarea.value.length;
            const charCountElement = textarea.closest('.form-group').querySelector('.char-count');
            
            if (charCountElement) {
                charCountElement.textContent = charCount;
                
                // Change color based on length
                if (charCount > 250) {
                    charCountElement.style.color = '#ef4444';
                } else if (charCount > 200) {
                    charCountElement.style.color = '#f59e0b';
                } else {
                    charCountElement.style.color = 'var(--secondary-blue)';
                }
            }
        };

        // Notifications dropdown toggle
        const notificationBtn = document.getElementById('notificationBtn');
        const notificationDropdown = document.querySelector('.notification-dropdown');

        if (notificationBtn) {
            notificationBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                notificationDropdown.classList.toggle('show');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!notificationBtn.contains(e.target) && !notificationDropdown.contains(e.target)) {
                    notificationDropdown.classList.remove('show');
                }
            });
        }

        // Form submission loading states
        const forms = document.querySelectorAll('#laporanForm, #forumForm');
        forms.forEach(form => {
            form.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Memproses...';
                    submitBtn.disabled = true;
                    
                    // Re-enable button after 5 seconds if form submission fails
                    setTimeout(() => {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }, 5000);
                }
            });
        });

        // Add floating effect to cards on mouse move
        const cards = document.querySelectorAll('.hover-3d');
        cards.forEach(card => {
            card.addEventListener('mousemove', function(e) {
                if (window.innerWidth > 768) { // Only on desktop
                    const rect = this.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    const centerX = rect.width / 2;
                    const centerY = rect.height / 2;
                    
                    const rotateY = (x - centerX) / 30;
                    const rotateX = (centerY - y) / 30;
                    
                    this.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;
                }
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) scale3d(1, 1, 1)';
            });
        });

        // Particle animation
        const particles = document.querySelectorAll('.particle');
        particles.forEach(particle => {
            particle.style.animationDelay = Math.random() * 15 + 's';
        });

        // Add ripple effect to buttons
        const buttons = document.querySelectorAll('.btn-neon, .btn-action');
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                const ripple = document.createElement('span');
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.cssText = `
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(255, 255, 255, 0.5);
                    transform: scale(0);
                    animation: ripple 0.6s linear;
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                    pointer-events: none;
                `;
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });

        // Add CSS for ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
            
            .show {
                opacity: 1 !important;
                visibility: visible !important;
                transform: translateY(0) !important;
            }
        `;
        document.head.appendChild(style);

        // Logout confirmation
        const logoutForms = document.querySelectorAll('form[action*="logout"]');
        logoutForms.forEach(form => {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.addEventListener('click', function(e) {
                    if (!confirm('Apakah Anda yakin ingin keluar?')) {
                        e.preventDefault();
                    }
                });
            }
        });

        // Initialize forum textarea character count
        const forumTextarea = document.querySelector('.forum-textarea');
        if (forumTextarea) {
            updateCharCount(forumTextarea);
        }
    });
</script>
@endpush
@endsection