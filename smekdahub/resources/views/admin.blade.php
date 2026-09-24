<div class="admin-update-form">
    <form action="/admin/laporan/{{ $l->id }}" method="POST" class="update-laporan-form">
        @csrf 
        @method('PUT')
        
        <!-- Status Selection Card -->
        <div class="form-section mb-4">
            <div class="section-header">
                <i class="bi bi-gear-fill me-2"></i>
                <h6 class="mb-0">Update Status Laporan</h6>
            </div>
            <div class="section-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label fw-semibold d-flex align-items-center mb-2">
                                <i class="bi bi-info-circle me-2 text-primary"></i>
                                Status Laporan
                            </label>
                            <div class="status-selector">
                                <div class="row g-2">
                                    <div class="col-4">
                                        <input type="radio" name="status" value="pending" id="status_pending" 
                                               class="status-radio" 
                                               {{ $l->status == 'pending' ? 'checked' : '' }}>
                                        <label for="status_pending" class="status-option status-pending">
                                            <div class="status-icon">
                                                <i class="bi bi-clock"></i>
                                            </div>
                                            <div class="status-label">Pending</div>
                                            <div class="status-desc">Menunggu ditinjau</div>
                                        </label>
                                    </div>
                                    <div class="col-4">
                                        <input type="radio" name="status" value="proses" id="status_proses"
                                               class="status-radio"
                                               {{ $l->status == 'proses' ? 'checked' : '' }}>
                                        <label for="status_proses" class="status-option status-proses">
                                            <div class="status-icon">
                                                <i class="bi bi-gear"></i>
                                            </div>
                                            <div class="status-label">Proses</div>
                                            <div class="status-desc">Sedang ditangani</div>
                                        </label>
                                    </div>
                                    <div class="col-4">
                                        <input type="radio" name="status" value="selesai" id="status_selesai"
                                               class="status-radio"
                                               {{ $l->status == 'selesai' ? 'checked' : '' }}>
                                        <label for="status_selesai" class="status-option status-selesai">
                                            <div class="status-icon">
                                                <i class="bi bi-check-circle"></i>
                                            </div>
                                            <div class="status-label">Selesai</div>
                                            <div class="status-desc">Telah diselesaikan</div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="current-status-info">
                            <div class="info-card">
                                <div class="info-header d-flex align-items-center mb-2">
                                    <i class="bi bi-hourglass-split me-2"></i>
                                    <h6 class="mb-0">Status Saat Ini</h6>
                                </div>
                                <div class="info-body">
                                    @if($l->status == 'selesai')
                                        <span class="badge bg-success px-3 py-2">
                                            <i class="bi bi-check-circle me-1"></i>SELESAI
                                        </span>
                                        <p class="mt-2 mb-0 small text-muted">
                                            Laporan ini telah ditangani dan diselesaikan
                                        </p>
                                    @elseif($l->status == 'proses')
                                        <span class="badge bg-primary px-3 py-2">
                                            <i class="bi bi-gear me-1"></i>SEDANG DIPROSES
                                        </span>
                                        <p class="mt-2 mb-0 small text-muted">
                                            Tim sedang menangani laporan ini
                                        </p>
                                    @else
                                        <span class="badge bg-warning text-dark px-3 py-2">
                                            <i class="bi bi-clock me-1"></i>PENDING
                                        </span>
                                        <p class="mt-2 mb-0 small text-muted">
                                            Menunggu untuk ditinjau oleh tim
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Response Section -->
        <div class="form-section mb-4">
            <div class="section-header">
                <i class="bi bi-chat-left-text-fill me-2"></i>
                <h6 class="mb-0">Tanggapan Admin</h6>
            </div>
            <div class="section-body">
                <div class="form-group">
                    <label class="form-label fw-semibold d-flex align-items-center mb-2">
                        <i class="bi bi-pencil-square me-2 text-primary"></i>
                        Berikan Tanggapan
                    </label>
                    
                    <!-- Existing Responses -->
                    @if($l->tanggapans && $l->tanggapans->count() > 0)
                        <div class="existing-responses mb-3">
                            <div class="responses-header d-flex justify-content-between align-items-center mb-2">
                                <small class="text-muted fw-semibold">
                                    <i class="bi bi-chat-left-text me-1"></i>
                                    Tanggapan Sebelumnya ({{ $l->tanggapans->count() }})
                                </small>
                                <button type="button" class="btn btn-sm btn-outline-primary toggle-responses">
                                    <i class="bi bi-chevron-down"></i>
                                </button>
                            </div>
                            <div class="responses-list collapse show">
                                @foreach($l->tanggapans as $tanggapan)
                                    <div class="response-item mb-2 p-2 border rounded bg-light">
                                        <div class="d-flex justify-content-between align-items-start mb-1">
                                            <small class="text-muted">
                                                <i class="bi bi-person-circle me-1"></i>
                                                Admin
                                            </small>
                                            <small class="text-muted">
                                                {{ $tanggapan->created_at->format('d/m/Y H:i') }}
                                            </small>
                                        </div>
                                        <p class="mb-0 small">{{ $tanggapan->isi_tanggapan }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    <!-- Response Textarea -->
                    <div class="response-input-wrapper">
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="bi bi-chat-left-text text-primary"></i>
                            </span>
                            <textarea name="isi_tanggapan" 
                                      class="form-control response-textarea" 
                                      rows="4"
                                      placeholder="Tulis tanggapan Anda untuk laporan ini...&#10;&#10;Contoh: &#10;• Laporan telah diterima &#10;• Tim sedang melakukan pengecekan &#10;• Perbaikan akan dilakukan dalam 2 hari"
                                      required></textarea>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <div class="form-text">
                                <i class="bi bi-info-circle me-1"></i>
                                Tanggapan akan dikirimkan ke pelapor via notifikasi
                            </div>
                            <div class="char-counter">
                                <span class="char-count">0</span>/500 karakter
                            </div>
                        </div>
                        
                        <!-- Quick Responses -->
                        <div class="quick-responses mt-3">
                            <small class="text-muted d-block mb-2">
                                <i class="bi bi-lightning-fill me-1"></i>
                                Tanggapan Cepat:
                            </small>
                            <div class="btn-group btn-group-sm" role="group">
                                <button type="button" class="btn btn-outline-secondary quick-response-btn" 
                                        data-text="Laporan telah diterima dan sedang dalam proses peninjauan.">
                                    Diterima
                                </button>
                                <button type="button" class="btn btn-outline-secondary quick-response-btn" 
                                        data-text="Tim teknis sedang melakukan pemeriksaan terhadap laporan ini.">
                                    Diproses
                                </button>
                                <button type="button" class="btn btn-outline-secondary quick-response-btn" 
                                        data-text="Laporan telah diselesaikan. Terima kasih atas kontribusi Anda.">
                                    Selesai
                                </button>
                                <button type="button" class="btn btn-outline-secondary quick-response-btn" 
                                        data-text="Kami akan menghubungi Anda untuk informasi lebih lanjut.">
                                    Follow Up
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="form-actions mt-4 pt-3 border-top">
            <div class="d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="send_notification" checked>
                    <label class="form-check-label" for="send_notification">
                        <i class="bi bi-bell-fill me-1"></i>
                        Kirim notifikasi ke pelapor
                    </label>
                </div>
                <div class="btn-group">
                    <button type="reset" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle me-1"></i>
                        Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-1"></i>
                        Update & Kirim Tanggapan
                    </button>
                </div>
            </div>
            <div class="text-center mt-2">
                <small class="text-muted">
                    <i class="bi bi-exclamation-triangle me-1"></i>
                    Perubahan status dan tanggapan akan terekam dalam sistem
                </small>
            </div>
        </div>
    </form>
</div>

<style>
    .admin-update-form {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }
    
    .form-section {
        background: #f8fafc;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        overflow: hidden;
    }
    
    .section-header {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
    }
    
    .section-header i {
        color: var(--secondary-blue);
        font-size: 1.1rem;
    }
    
    .section-header h6 {
        color: #1e40af;
        font-weight: 700;
    }
    
    .section-body {
        padding: 1.25rem;
    }
    
    /* Status Selector */
    .status-selector .status-radio {
        display: none;
    }
    
    .status-option {
        display: block;
        background: white;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 1rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        height: 100%;
    }
    
    .status-option:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }
    
    .status-radio:checked + .status-option {
        border-color: var(--secondary-blue);
        background: rgba(59, 130, 246, 0.05);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
    }
    
    .status-radio:checked + .status-pending {
        border-color: #f59e0b;
        background: rgba(245, 158, 11, 0.05);
    }
    
    .status-radio:checked + .status-proses {
        border-color: var(--secondary-blue);
        background: rgba(59, 130, 246, 0.05);
    }
    
    .status-radio:checked + .status-selesai {
        border-color: #10b981;
        background: rgba(16, 185, 129, 0.05);
    }
    
    .status-icon {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        color: #9ca3af;
    }
    
    .status-radio:checked + .status-option .status-icon {
        color: inherit;
    }
    
    .status-radio:checked + .status-pending .status-icon {
        color: #f59e0b;
    }
    
    .status-radio:checked + .status-proses .status-icon {
        color: var(--secondary-blue);
    }
    
    .status-radio:checked + .status-selesai .status-icon {
        color: #10b981;
    }
    
    .status-label {
        font-weight: 700;
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
    }
    
    .status-desc {
        font-size: 0.75rem;
        color: #6b7280;
    }
    
    /* Current Status Info */
    .current-status-info .info-card {
        background: white;
        border-radius: 12px;
        padding: 1rem;
        border: 1px solid #e5e7eb;
        height: 100%;
    }
    
    .info-header {
        color: #374151;
        font-weight: 600;
    }
    
    .info-header i {
        color: var(--secondary-blue);
    }
    
    /* Response Section */
    .existing-responses {
        background: white;
        border-radius: 10px;
        padding: 1rem;
        border: 1px solid #e5e7eb;
    }
    
    .response-item {
        background: #f8fafc;
        border: 1px solid #e5e7eb !important;
    }
    
    .response-textarea {
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        resize: none;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }
    
    .response-textarea:focus {
        border-color: var(--secondary-blue);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .char-counter {
        font-size: 0.8rem;
        color: #6b7280;
        font-weight: 500;
    }
    
    .char-count {
        color: var(--secondary-blue);
    }
    
    /* Quick Responses */
    .quick-responses .btn-group {
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    
    .quick-response-btn {
        border-radius: 20px;
        padding: 0.375rem 0.75rem;
        font-size: 0.8rem;
        transition: all 0.2s ease;
    }
    
    .quick-response-btn:hover {
        background-color: var(--secondary-blue);
        color: white;
        transform: translateY(-2px);
    }
    
    /* Form Actions */
    .form-actions {
        background: #f8fafc;
        border-radius: 10px;
        padding: 1rem;
    }
    
    .form-check-input:checked {
        background-color: var(--secondary-blue);
        border-color: var(--secondary-blue);
    }
    
    .form-check-label {
        font-size: 0.9rem;
        color: #374151;
    }
    
    .form-check-label i {
        color: var(--secondary-blue);
    }
    
    /* Badges */
    .badge {
        border-radius: 10px;
        font-weight: 600;
        letter-spacing: 0.3px;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .admin-update-form {
            padding: 1rem;
        }
        
        .status-option {
            padding: 0.75rem 0.5rem;
        }
        
        .status-icon {
            font-size: 1.5rem;
        }
        
        .btn-group {
            flex-wrap: wrap;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Character counter for response textarea
        const responseTextarea = document.querySelector('.response-textarea');
        const charCount = document.querySelector('.char-count');
        
        if (responseTextarea && charCount) {
            responseTextarea.addEventListener('input', function() {
                const length = this.value.length;
                charCount.textContent = length;
                
                // Change color based on length
                if (length > 450) {
                    charCount.style.color = '#ef4444';
                } else if (length > 400) {
                    charCount.style.color = '#f59e0b';
                } else {
                    charCount.style.color = 'var(--secondary-blue)';
                }
            });
            
            // Initialize counter
            charCount.textContent = responseTextarea.value.length;
        }
        
        // Quick response buttons
        const quickResponseBtns = document.querySelectorAll('.quick-response-btn');
        quickResponseBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const text = this.getAttribute('data-text');
                responseTextarea.value = text;
                responseTextarea.dispatchEvent(new Event('input'));
                
                // Visual feedback
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 200);
            });
        });
        
        // Toggle existing responses
        const toggleResponsesBtn = document.querySelector('.toggle-responses');
        const responsesList = document.querySelector('.responses-list');
        
        if (toggleResponsesBtn && responsesList) {
            toggleResponsesBtn.addEventListener('click', function() {
                const isCollapsed = responsesList.classList.contains('show');
                
                if (isCollapsed) {
                    responsesList.classList.remove('show');
                    this.innerHTML = '<i class="bi bi-chevron-right"></i>';
                } else {
                    responsesList.classList.add('show');
                    this.innerHTML = '<i class="bi bi-chevron-down"></i>';
                }
            });
        }
        
        // Form submission
        const form = document.querySelector('.update-laporan-form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-1"></i>Memproses...';
                    submitBtn.disabled = true;
                }
            });
        }
        
        // Auto-select status based on current status
        const currentStatus = '{{ $l->status }}';
        if (currentStatus) {
            const statusRadio = document.querySelector(`input[value="${currentStatus}"]`);
            if (statusRadio) {
                statusRadio.checked = true;
            }
        }
    });
</script>