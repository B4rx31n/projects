@extends('layouts.app')

@section('title', 'Detail Laporan')
@section('page-title', 'Detail Laporan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.kelola') }}">Kelola Laporan</a></li>
    <li class="breadcrumb-item active">Detail Laporan</li>
@endsection

@section('content')
<div class="fade-in">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-gradient-primary text-white border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="bi bi-file-earmark-text me-2"></i>
                            <h5 class="mb-0">Detail Laporan</h5>
                            <p class="mb-0 opacity-75 small">Informasi lengkap laporan</p>
                        </div>
                        <a href="{{ route('admin.kelola') }}" class="btn btn-light btn-sm shadow-sm">
                            <i class="bi bi-arrow-left me-1"></i>Kembali
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="info-card">
                                <h6><i class="bi bi-person me-2 text-primary"></i>Pelapor</h6>
                                <div class="d-flex align-items-center mt-2">
                                    <div class="user-avatar-modal me-3">
                                        {{ strtoupper(substr($laporan->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h5 class="mb-1">{{ $laporan->user->name }}</h5>
                                        <span class="badge badge-role">{{ ucfirst($laporan->user->role) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-card">
                                <h6><i class="bi bi-calendar me-2 text-primary"></i>Tanggal & Waktu</h6>
                                <p class="mt-2 mb-0 fw-semibold">{{ $laporan->created_at->format('d F Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="info-card">
                                <h6><i class="bi bi-tags me-2 text-primary"></i>Prioritas</h6>
                                <p class="mt-2">
                                    @if($laporan->prioritas == 'tinggi')
                                        <span class="badge bg-danger px-3 py-2">
                                            <i class="bi bi-exclamation-triangle me-1"></i>Tinggi
                                        </span>
                                    @elseif($laporan->prioritas == 'sedang')
                                        <span class="badge bg-warning text-dark px-3 py-2">
                                            <i class="bi bi-arrow-up me-1"></i>Sedang
                                        </span>
                                    @else
                                        <span class="badge bg-info px-3 py-2">
                                            <i class="bi bi-arrow-down me-1"></i>Rendah
                                        </span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-card">
                                <h6><i class="bi bi-info-circle me-2 text-primary"></i>Status</h6>
                                <p class="mt-2">
                                    @if($laporan->status == 'pending')
                                        <span class="badge bg-warning text-dark px-3 py-2">Pending</span>
                                    @elseif($laporan->status == 'proses')
                                        <span class="badge bg-primary px-3 py-2">Proses</span>
                                    @else
                                        <span class="badge bg-success px-3 py-2">Selesai</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="info-card mb-4">
                        <h6><i class="bi bi-card-heading me-2 text-primary"></i>Judul Laporan</h6>
                        <p class="mt-2 fw-semibold">{{ $laporan->judul }}</p>
                    </div>

                    <div class="info-card mb-4">
                        <h6><i class="bi bi-text-paragraph me-2 text-primary"></i>Isi Laporan</h6>
                        <div class="laporan-content mt-2">
                            {{ $laporan->isi_laporan }}
                        </div>
                    </div>

                    @if($laporan->gambar)
                        <div class="info-card mb-4">
                            <h6><i class="bi bi-image me-2 text-primary"></i>Lampiran Gambar</h6>
                            <div class="mt-3">
                                <img src="{{ asset('storage/' . $laporan->gambar) }}"
                                     class="img-fluid rounded shadow-sm"
                                     alt="Gambar Laporan"
                                     style="max-height: 300px;">
                            </div>
                        </div>
                    @endif

                    <div class="info-card mb-4">
                        <h6><i class="bi bi-chat-left-text me-2 text-primary"></i>Tanggapan</h6>
                        <div class="mt-3">
                            @if($laporan->tanggapans->count() > 0)
                                @foreach($laporan->tanggapans as $tanggapan)
                                    <div class="tanggapan-card mb-3">
                                        <div class="tanggapan-header">
                                            <span class="badge bg-primary">Admin</span>
                                            <small class="text-muted">{{ $tanggapan->created_at->format('d/m/Y H:i') }}</small>
                                        </div>
                                        <div class="tanggapan-body">
                                            {{ $tanggapan->isi_tanggapan }}
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="text-center py-4">
                                    <i class="bi bi-chat-left display-4 text-muted"></i>
                                    <p class="text-muted mt-2">Belum ada tanggapan untuk laporan ini</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <div class="info-card">
                        <h6><i class="bi bi-reply me-2 text-primary"></i>Berikan Tanggapan</h6>
                        <form action="{{ route('admin.laporan.tanggapan', $laporan->id) }}" method="POST" class="mt-3">
                            @csrf
                            <div class="mb-3">
                                <textarea name="isi_tanggapan" class="form-control" rows="4"
                                          placeholder="Ketik tanggapan Anda di sini..." required></textarea>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.kelola') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle me-1"></i>Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-send me-1"></i>Kirim Tanggapan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Styles for Detail Page */
    .text-gradient-blue {
        background: linear-gradient(135deg, var(--dark-blue) 0%, var(--secondary-blue) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

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

    .badge-role {
        background: rgba(59, 130, 246, 0.1);
        color: var(--secondary-blue);
        font-weight: 500;
        padding: 0.25em 0.75em;
        border-radius: 20px;
        font-size: 0.75rem;
        border: 1px solid rgba(59, 130, 246, 0.2);
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, var(--dark-blue) 0%, var(--secondary-blue) 100%) !important;
    }
</style>
@endsection
