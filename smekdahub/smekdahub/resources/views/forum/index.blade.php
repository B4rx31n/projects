@extends('layouts.app')

@section('title', 'Forum Diskusi')
@section('page-title', 'Forum Diskusi')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Forum Diskusi</li>
@endsection

@section('content')
<div class="fade-in">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="text-gradient-blue mb-1">
                        <i class="bi bi-chat-dots-fill me-2"></i>Forum Diskusi
                    </h2>
                    <p class="text-muted mb-0">Berbagi informasi dan diskusi secara anonim dengan komunitas sekolah</p>
                </div>
                <div class="alert alert-primary-grad border-0 shadow-sm">
                    <div class="d-flex align-items-center">
                        <div class="alert-icon-forum">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <div class="ms-3">
                            <h6 class="alert-title mb-1">100% Anonim</h6>
                            <p class="mb-0">Semua identitas pengirim disembunyikan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <!-- Post Form Section -->
        <div class="col-xl-8 mb-4">
            <div class="card border-0 shadow-lg hover-lift">
                <div class="card-header bg-gradient-primary text-white border-0">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-pencil-square me-2 fs-4"></i>
                        <h5 class="mb-0">Tulis Pesan Baru</h5>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('forum.store') }}" method="POST" id="forumForm">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark d-flex align-items-center">
                                <i class="bi bi-chat-text me-2 text-primary"></i>Pesan Anda
                            </label>
                            <div class="form-group">
                                <textarea name="pesan" class="form-control forum-textarea" rows="5" 
                                          placeholder="Apa yang ingin Anda diskusikan hari ini? (Maksimal 500 karakter)" 
                                          maxlength="500" required></textarea>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <div class="char-counter text-muted">
                                        <span id="charCount">0</span>/500 karakter
                                    </div>
                                    <div class="form-text">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Pesan akan ditampilkan secara anonim
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="anonim" checked disabled>
                                <label class="form-check-label" for="anonim">
                                    <i class="bi bi-incognito me-1"></i>
                                    <span class="fw-semibold">Kirim sebagai anonim</span>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                                <i class="bi bi-send-fill me-2"></i>Kirim Pesan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Section -->
        <div class="col-xl-4 mb-4">
            <!-- Forum Rules -->
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0 d-flex align-items-center">
                        <i class="bi bi-info-circle-fill me-2 text-primary"></i>
                        Peraturan Forum
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item border-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="rule-icon bg-success bg-opacity-10 text-success rounded-circle p-2 me-3">
                                    <i class="bi bi-shield-check"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Anonimitas Terjaga</h6>
                                    <p class="text-muted mb-0 small">Semua identitas disembunyikan</p>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item border-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="rule-icon bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3">
                                    <i class="bi bi-chat-text"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Diskusi Sopan</h6>
                                    <p class="text-muted mb-0 small">Gunakan bahasa yang baik dan edukatif</p>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item border-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="rule-icon bg-danger bg-opacity-10 text-danger rounded-circle p-2 me-3">
                                    <i class="bi bi-ban"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Larangan Keras</h6>
                                    <p class="text-muted mb-0 small">Dilarang kata kasar, SARA, dan bullying</p>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item border-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="rule-icon bg-warning bg-opacity-10 text-warning rounded-circle p-2 me-3">
                                    <i class="bi bi-lightbulb"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Konten Positif</h6>
                                    <p class="text-muted mb-0 small">Sampaikan ide dan masukan yang membangun</p>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item border-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="rule-icon bg-info bg-opacity-10 text-info rounded-circle p-2 me-3">
                                    <i class="bi bi-flag"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1">Laporkan Pelanggaran</h6>
                                    <p class="text-muted mb-0 small">Bantu kami menjaga forum tetap aman</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Forum Stats -->
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0 d-flex align-items-center">
                        <i class="bi bi-bar-chart-fill me-2 text-primary"></i>
                        Statistik Forum
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="stat-card-forum bg-primary bg-opacity-10 border border-primary border-opacity-25 rounded-3 p-3 text-center">
                                <div class="stat-number text-primary fw-bold display-6">{{ $forums->total() }}</div>
                                <div class="stat-label text-muted small">Total Pesan</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-card-forum bg-success bg-opacity-10 border border-success border-opacity-25 rounded-3 p-3 text-center">
                                <div class="stat-number text-success fw-bold display-6">{{ auth()->user()->forums()->count() }}</div>
                                <div class="stat-label text-muted small">Pesan Anda</div>
                            </div>
                        </div>
                    </div>
                    <div class="progress mt-4" style="height: 8px;">
                        <div class="progress-bar bg-primary" style="width: {{ $forums->total() > 0 ? (auth()->user()->forums()->count() / $forums->total() * 100) : 0 }}%"></div>
                    </div>
                    <p class="text-center text-muted small mt-2 mb-0">
                        Kontribusi Anda: {{ $forums->total() > 0 ? number_format((auth()->user()->forums()->count() / $forums->total() * 100), 1) : 0 }}%
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Messages List -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-white border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0 d-flex align-items-center">
                                <i class="bi bi-chat-left-text-fill me-2 text-primary"></i>
                                Diskusi Terkini
                            </h5>
                            <p class="text-muted mb-0 small">Percakapan anonim dari komunitas</p>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-primary rounded-pill px-3 py-2">
                                {{ $forums->total() }} pesan
                            </span>
                            <button class="btn btn-outline-primary btn-sm" id="refreshBtn">
                                <i class="bi bi-arrow-clockwise"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    @if($forums->count() > 0)
                        <div class="forum-messages">
                            @foreach($forums as $forum)
                            <div class="forum-message-card mb-4">
                                <div class="message-header d-flex justify-content-between align-items-start mb-3">
                                    <div class="d-flex align-items-center">
                                        <!-- Anonim Avatar -->
                                        <div class="anonim-avatar me-3">
                                            <div class="avatar-circle bg-{{ $forum->avatar_color }} text-white d-flex align-items-center justify-content-center">
                                                <i class="bi bi-person-fill"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold">{{ $forum->nama_anonim }}</h6>
                                            <small class="text-muted d-flex align-items-center">
                                                <i class="bi bi-clock me-1"></i>
                                                {{ $forum->created_at->diffForHumans() }}
                                                @if($forum->created_at->diffInHours() < 24)
                                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 ms-2">
                                                        <i class="bi bi-star-fill me-1"></i>Baru
                                                    </span>
                                                @endif
                                            </small>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" 
                                                type="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#reportModal{{ $forum->id }}">
                                                    <i class="bi bi-flag me-2 text-warning"></i>Laporkan
                                                </a>
                                            </li>
                                            @admin
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <a class="dropdown-item text-danger delete-forum" 
                                                   href="#" 
                                                   data-id="{{ $forum->id }}"
                                                   data-message="{{ $forum->pesan }}">
                                                    <i class="bi bi-trash me-2"></i>Hapus Pesan
                                                </a>
                                            </li>
                                            @endadmin
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="message-body">
                                    <p class="mb-0">{{ $forum->pesan }}</p>
                                </div>
                                
                                <div class="message-footer mt-3 pt-3 border-top border-light d-flex justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <button class="btn btn-sm btn-outline-primary like-btn" data-id="{{ $forum->id }}">
                                            <i class="bi bi-hand-thumbs-up me-1"></i>Suka
                                            <span class="badge bg-primary bg-opacity-10 text-primary ms-1">0</span>
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary reply-btn" data-id="{{ $forum->id }}">
                                            <i class="bi bi-reply me-1"></i>Balas
                                        </button>
                                    </div>
                                    <div class="text-muted small">
                                        <i class="bi bi-eye me-1"></i>Dilihat oleh {{ rand(5, 50) }} orang
                                    </div>
                                </div>
                                
                                <!-- Reply Form (Hidden by default) -->
                                <div class="reply-form mt-3 d-none" id="replyForm{{ $forum->id }}">
                                    <form class="reply-form-inner">
                                        <div class="mb-2">
                                            <textarea class="form-control form-control-sm" rows="2" placeholder="Tulis balasan Anda..."></textarea>
                                        </div>
                                        <div class="d-flex justify-content-end gap-2">
                                            <button type="button" class="btn btn-sm btn-outline-secondary cancel-reply">Batal</button>
                                            <button type="submit" class="btn btn-sm btn-primary">Kirim Balasan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if($forums->hasPages())
                        <div class="mt-4">
                            <nav aria-label="Forum pagination">
                                <ul class="pagination justify-content-center">
                                    @if($forums->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="bi bi-chevron-left"></i></span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $forums->previousPageUrl() }}">
                                                <i class="bi bi-chevron-left"></i>
                                            </a>
                                        </li>
                                    @endif

                                    @foreach(range(1, $forums->lastPage()) as $page)
                                        @if($page == $forums->currentPage())
                                            <li class="page-item active">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $forums->url($page) }}">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach

                                    @if($forums->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $forums->nextPageUrl() }}">
                                                <i class="bi bi-chevron-right"></i>
                                            </a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="bi bi-chevron-right"></i></span>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                        @endif
                    @else
                        <div class="text-center py-5">
                            <div class="empty-forum">
                                <i class="bi bi-chat-square-text display-1 text-light-blue"></i>
                                <h4 class="mt-4 text-dark">Belum ada diskusi</h4>
                                <p class="text-muted mb-4">Jadilah yang pertama memulai diskusi!</p>
                                <button class="btn btn-primary" onclick="document.querySelector('.forum-textarea').focus()">
                                    <i class="bi bi-plus-circle me-1"></i>Mulai Diskusi
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Report Modal Template -->
@foreach($forums as $forum)
<div class="modal fade" id="reportModal{{ $forum->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title"><i class="bi bi-flag me-2"></i>Laporkan Pesan</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Anda akan melaporkan pesan ini:</p>
                <div class="alert alert-light border mb-3">
                    <p class="mb-0">"{{ Str::limit($forum->pesan, 100) }}"</p>
                </div>
                <form>
                    <div class="mb-3">
                        <label class="form-label">Alasan pelaporan</label>
                        <select class="form-select">
                            <option selected>Pilih alasan...</option>
                            <option value="spam">Spam atau iklan</option>
                            <option value="harassment">Kata-kata kasar</option>
                            <option value="sara">Konten SARA</option>
                            <option value="bullying">Bullying atau pelecehan</option>
                            <option value="other">Lainnya</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan (opsional)</label>
                        <textarea class="form-control" rows="3" placeholder="Berikan penjelasan tambahan..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-warning">Kirim Laporan</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<style>
    /* Custom Styles for Forum */
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
    
    .alert-icon-forum {
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
    
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15) !important;
    }
    
    .forum-textarea {
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        resize: none;
        transition: all 0.3s ease;
        padding: 1rem;
    }
    
    .forum-textarea:focus {
        border-color: var(--secondary-blue);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .char-counter {
        font-size: 0.85rem;
        font-weight: 500;
    }
    
    .rule-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .stat-card-forum {
        transition: transform 0.3s ease;
    }
    
    .stat-card-forum:hover {
        transform: translateY(-3px);
    }
    
    .forum-message-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        padding: 1.5rem;
        transition: all 0.3s ease;
    }
    
    .forum-message-card:hover {
        border-color: var(--light-blue);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }
    
    .anonim-avatar .avatar-circle {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        font-size: 1.5rem;
        transition: transform 0.3s ease;
    }
    
    .forum-message-card:hover .avatar-circle {
        transform: scale(1.1);
    }
    
    .bg-primary { background-color: #3b82f6 !important; }
    .bg-success { background-color: #10b981 !important; }
    .bg-danger { background-color: #ef4444 !important; }
    .bg-warning { background-color: #f59e0b !important; }
    .bg-info { background-color: #06b6d4 !important; }
    .bg-purple { background-color: #8b5cf6 !important; }
    
    .bg-primary.bg-opacity-10 { background-color: rgba(59, 130, 246, 0.1) !important; }
    .bg-success.bg-opacity-10 { background-color: rgba(16, 185, 129, 0.1) !important; }
    .bg-danger.bg-opacity-10 { background-color: rgba(239, 68, 68, 0.1) !important; }
    .bg-warning.bg-opacity-10 { background-color: rgba(245, 158, 11, 0.1) !important; }
    .bg-info.bg-opacity-10 { background-color: rgba(6, 182, 212, 0.1) !important; }
    
    .border-primary.border-opacity-25 { border-color: rgba(59, 130, 246, 0.25) !important; }
    .border-success.border-opacity-25 { border-color: rgba(16, 185, 129, 0.25) !important; }
    .border-danger.border-opacity-25 { border-color: rgba(239, 68, 68, 0.25) !important; }
    .border-warning.border-opacity-25 { border-color: rgba(245, 158, 11, 0.25) !important; }
    .border-info.border-opacity-25 { border-color: rgba(6, 182, 212, 0.25) !important; }
    
    .message-body {
        font-size: 1rem;
        line-height: 1.6;
        color: #374151;
    }
    
    .like-btn, .reply-btn {
        transition: all 0.2s ease;
    }
    
    .like-btn:hover {
        background-color: var(--secondary-blue);
        color: white;
        transform: translateY(-2px);
    }
    
    .reply-btn:hover {
        background-color: #6b7280;
        color: white;
        transform: translateY(-2px);
    }
    
    .empty-forum {
        padding: 3rem 2rem;
    }
    
    .text-light-blue {
        color: var(--light-blue);
        opacity: 0.7;
    }
    
    .reply-form-inner textarea {
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        resize: none;
        transition: all 0.3s ease;
    }
    
    .reply-form-inner textarea:focus {
        border-color: var(--secondary-blue);
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
    }
    
    .form-switch .form-check-input {
        width: 3em;
        height: 1.5em;
        cursor: pointer;
    }
    
    .form-switch .form-check-input:checked {
        background-color: var(--secondary-blue);
        border-color: var(--secondary-blue);
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, var(--dark-blue) 0%, var(--secondary-blue) 100%) !important;
    }
    
    /* Animation for new messages */
    @keyframes highlight {
        0% { background-color: rgba(59, 130, 246, 0.1); }
        100% { background-color: white; }
    }
    
    .new-message {
        animation: highlight 2s ease;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .forum-message-card {
            padding: 1rem;
        }
        
        .message-footer {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }
        
        .stat-card-forum .display-6 {
            font-size: 2rem;
        }
    }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Character counter for message textarea
        const textarea = document.querySelector('.forum-textarea');
        const charCount = document.getElementById('charCount');
        
        if (textarea && charCount) {
            textarea.addEventListener('input', function() {
                charCount.textContent = this.value.length;
                
                // Change color based on length
                if (this.value.length > 450) {
                    charCount.style.color = '#ef4444';
                } else if (this.value.length > 400) {
                    charCount.style.color = '#f59e0b';
                } else {
                    charCount.style.color = '#6b7280';
                }
            });
            
            // Initialize counter
            charCount.textContent = textarea.value.length;
        }
        
        // Like button functionality
        const likeBtns = document.querySelectorAll('.like-btn');
        likeBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const badge = this.querySelector('.badge');
                let count = parseInt(badge.textContent);
                count++;
                badge.textContent = count;
                
                // Visual feedback
                this.classList.add('btn-primary');
                this.classList.remove('btn-outline-primary');
                this.querySelector('i').classList.remove('bi-hand-thumbs-up');
                this.querySelector('i').classList.add('bi-hand-thumbs-up-fill');
                
                // Disable after clicking
                this.disabled = true;
            });
        });
        
        // Reply button functionality
        const replyBtns = document.querySelectorAll('.reply-btn');
        replyBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const forumId = this.getAttribute('data-id');
                const replyForm = document.getElementById('replyForm' + forumId);
                
                // Hide all other reply forms
                document.querySelectorAll('.reply-form').forEach(form => {
                    form.classList.add('d-none');
                });
                
                // Show this reply form
                replyForm.classList.remove('d-none');
                
                // Focus on textarea
                replyForm.querySelector('textarea').focus();
            });
        });
        
        // Cancel reply functionality
        const cancelReplyBtns = document.querySelectorAll('.cancel-reply');
        cancelReplyBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const replyForm = this.closest('.reply-form');
                replyForm.classList.add('d-none');
                replyForm.querySelector('textarea').value = '';
            });
        });
        
        // Refresh button
        const refreshBtn = document.getElementById('refreshBtn');
        if (refreshBtn) {
            refreshBtn.addEventListener('click', function() {
                this.querySelector('i').classList.add('spin');
                setTimeout(() => {
                    this.querySelector('i').classList.remove('spin');
                }, 500);
                // In real application, this would reload the page or fetch new messages
                location.reload();
            });
        }
        
        // Delete forum message (admin only)
        const deleteBtns = document.querySelectorAll('.delete-forum');
        deleteBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const message = this.getAttribute('data-message');
                
                if (confirm('Apakah Anda yakin ingin menghapus pesan ini?\n\n"' + message + '"')) {
                    // In real application, this would submit a delete request
                    const forumId = this.getAttribute('data-id');
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/forum/${forumId}`;
                    
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'DELETE';
                    
                    form.appendChild(csrfToken);
                    form.appendChild(methodInput);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
        
        // Auto-scroll to new message if URL has hash
        if (window.location.hash) {
            const messageId = window.location.hash.substring(1);
            const messageElement = document.getElementById('message-' + messageId);
            if (messageElement) {
                messageElement.scrollIntoView({ behavior: 'smooth' });
                messageElement.classList.add('new-message');
            }
        }
    });
</script>
@endpush
@endsection