@extends('layouts.app')

@section('page-title', 'Tambah Pesanan Baru')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center py-4">
                    <div>
                        <h4 class="mb-0 fw-bold">
                            <i class="fas fa-plus-circle me-2"></i>Tambah Pesanan Baru
                        </h4>
                        <small class="opacity-75">Form untuk menambahkan pesanan pengiriman baru</small>
                    </div>
                    <a href="{{ route('pengiriman.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Kembali
                    </a>
                </div>
                
                <div class="card-body p-4">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                        <h5 class="alert-heading">
                            <i class="fas fa-exclamation-triangle me-2"></i>Validasi Gagal
                        </h5>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form action="{{ route('pengiriman.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">
                                            <i class="fas fa-user me-2 text-primary"></i>Informasi Anggota
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="anggota_id" class="form-label fw-semibold">
                                                <i class="fas fa-user-circle me-1 text-primary"></i>Pilih Anggota Pemesan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="anggota_id" id="anggota_id" class="form-select form-select-lg" required>
                                                <option value="">-- Pilih Anggota --</option>
                                                @foreach($anggota as $a)
                                                <option value="{{ $a->id }}" {{ old('anggota_id') == $a->id ? 'selected' : '' }}>
                                                    {{ $a->nama_anggota }} - {{ $a->kota }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <div class="form-text">Pilih anggota yang melakukan pemesanan</div>
                                            <div class="invalid-feedback">Silakan pilih anggota pemesan.</div>
                                        </div>

                                        <div class="info-box p-3 bg-light rounded">
                                            <small class="text-muted d-block mb-1">
                                                <i class="fas fa-map-marker-alt me-1"></i>Kota Anggota
                                            </small>
                                            <span id="anggota-kota" class="fw-semibold">-</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">
                                            <i class="fas fa-box me-2 text-success"></i>Informasi Produk
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="produk_id" class="form-label fw-semibold">
                                                <i class="fas fa-box-open me-1 text-success"></i>Pilih Barang
                                                <span class="text-danger">*</span>
                                            </label>
                                            <select name="produk_id" id="produk_id" class="form-select form-select-lg" required>
                                                <option value="">-- Pilih Barang --</option>
                                                @foreach($produk as $p)
                                                <option value="{{ $p->id }}" 
                                                    {{ old('produk_id') == $p->id ? 'selected' : '' }}
                                                    data-stok="{{ $p->jumlah }}">
                                                    {{ $p->nama_barang }} (Stok: {{ $p->jumlah }})
                                                </option>
                                                @endforeach
                                            </select>
                                            <div class="form-text">Pilih barang yang dipesan</div>
                                            <div class="invalid-feedback">Silakan pilih barang.</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="info-box p-3 bg-light rounded">
                                                    <small class="text-muted d-block mb-1">
                                                        <i class="fas fa-warehouse me-1"></i>Stok Tersedia
                                                    </small>
                                                    <span id="stok-produk" class="fw-bold text-success fs-5">0</span>
                                                    <span class="text-muted"> unit</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">
                                    <i class="fas fa-clipboard-list me-2 text-info"></i>Detail Pesanan
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="jumlah_kiriman" class="form-label fw-semibold">
                                                <i class="fas fa-calculator me-1 text-info"></i>Jumlah Pesanan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group input-group-lg">
                                                <input type="number" 
                                                    name="jumlah_kiriman" 
                                                    id="jumlah_kiriman" 
                                                    class="form-control" 
                                                    min="1" 
                                                    value="{{ old('jumlah_kiriman', 1) }}" 
                                                    required
                                                    oninput="cekStok()">
                                                <span class="input-group-text bg-light">Unit</span>
                                            </div>
                                            <div class="form-text">Masukkan jumlah barang yang dipesan</div>
                                            <div class="invalid-feedback">Jumlah pesanan harus minimal 1.</div>
                                            <div id="stok-warning" class="text-danger small mt-1" style="display: none;">
                                                <i class="fas fa-exclamation-triangle"></i> Stok tidak mencukupi!
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="tanggal_pemesanan" class="form-label fw-semibold">
                                                <i class="fas fa-calendar-alt me-1 text-info"></i>Tanggal Pemesanan
                                                <span class="text-danger">*</span>
                                            </label>
                                            <input type="date" 
                                                name="tanggal_pemesanan" 
                                                id="tanggal_pemesanan" 
                                                class="form-control form-control-lg" 
                                                value="{{ old('tanggal_pemesanan', date('Y-m-d')) }}" 
                                                required>
                                            <div class="form-text">Tanggal pemesanan dilakukan</div>
                                            <div class="invalid-feedback">Silakan isi tanggal pemesanan.</div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="p-3 bg-info bg-opacity-10 rounded border border-info">
                                            <small class="text-muted d-block mb-1">
                                                <i class="fas fa-info-circle me-1"></i>Status
                                            </small>
                                            <span class="badge bg-warning text-dark fs-6">
                                                <i class="fas fa-clock me-1"></i>Belum Dibayar
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="keterangan" class="form-label fw-semibold">
                                        <i class="fas fa-sticky-note me-1 text-info"></i>Keterangan
                                    </label>
                                    <textarea name="keterangan" 
                                        id="keterangan" 
                                        class="form-control" 
                                        rows="4" 
                                        placeholder="Masukkan keterangan tambahan jika ada (opsional)">{{ old('keterangan') }}</textarea>
                                    <div class="form-text">Keterangan tambahan tentang pesanan ini</div>
                                </div>
                            </div>
                        </div>

                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="konfirmasi" required>
                                        <label class="form-check-label" for="konfirmasi">
                                            Saya telah memeriksa semua data dengan benar
                                        </label>
                                        <div class="invalid-feedback">Harap konfirmasi terlebih dahulu.</div>
                                    </div>

                                    <div class="btn-group">
                                        <a href="{{ route('pengiriman.index') }}" class="btn btn-outline-secondary">
                                            <i class="fas fa-times me-1"></i>Batal
                                        </a>
                                        <button type="reset" class="btn btn-warning">
                                            <i class="fas fa-redo me-1"></i>Reset Form
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-1"></i>Simpan Pesanan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-footer bg-light">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>Pastikan semua data sudah benar sebelum menyimpan pesanan.
                    </small>
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
    
    .info-box {
        border-left: 4px solid #0d6efd;
    }
    
    .form-control-lg, .form-select-lg {
        padding: 0.75rem 1rem;
        font-size: 1rem;
        border-radius: 8px;
    }
    
    .form-label {
        font-weight: 600;
        color: #495057;
        margin-bottom: 0.5rem;
    }
    
    .btn {
        border-radius: 8px;
        padding: 0.5rem 1.5rem;
        font-weight: 500;
    }
    
    .btn-group .btn {
        border-radius: 8px;
    }
    
    .input-group-text {
        background-color: #f8f9fa;
        border-color: #dee2e6;
        border-radius: 0 8px 8px 0;
    }
    
    .alert {
        border-radius: 10px;
        border: none;
    }
    
    .badge {
        padding: 0.5rem 1rem;
    }
</style>

<script>
    // Validasi form
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
    
    // Update informasi anggota saat select berubah
    document.getElementById('anggota_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const kota = selectedOption.text.split(' - ')[1] || '-';
        document.getElementById('anggota-kota').textContent = kota || '-';
    });
    
    // Update informasi produk dan stok saat select berubah
    document.getElementById('produk_id').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const stok = parseInt(selectedOption.getAttribute('data-stok')) || 0;
        document.getElementById('stok-produk').textContent = stok.toLocaleString('id-ID');
        cekStok();
    });
    
    // Fungsi cek stok
    function cekStok() {
        const produkSelect = document.getElementById('produk_id');
        const jumlahInput = document.getElementById('jumlah_kiriman');
        const stokWarning = document.getElementById('stok-warning');
        
        if (produkSelect.value && jumlahInput.value) {
            const selectedOption = produkSelect.options[produkSelect.selectedIndex];
            const stok = parseInt(selectedOption.getAttribute('data-stok')) || 0;
            const jumlah = parseInt(jumlahInput.value) || 0;
            
            if (jumlah > stok) {
                stokWarning.style.display = 'block';
                jumlahInput.setCustomValidity('Jumlah pesanan melebihi stok yang tersedia');
            } else {
                stokWarning.style.display = 'none';
                jumlahInput.setCustomValidity('');
            }
        }
    }
    
    // Inisialisasi data saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        // Trigger change event untuk mengisi data awal
        document.getElementById('anggota_id').dispatchEvent(new Event('change'));
        document.getElementById('produk_id').dispatchEvent(new Event('change'));
        
        // Set max date untuk tanggal pemesanan ke hari ini
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('tanggal_pemesanan').max = today;
    });
</script>
@endsection
