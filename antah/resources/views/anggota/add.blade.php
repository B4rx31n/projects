@extends('layouts.app')

@section('title', 'Tambah Anggota - UKK App')

@section('page-title')
    Tambah Anggota Baru
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('anggota.index') }}">Anggota</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
<div style="max-width: 800px; margin: 0 auto; padding: 20px; font-family: 'Segoe UI', Arial, sans-serif;">

    <!-- Header -->
    <div style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); padding: 25px; border-radius: 12px; margin-bottom: 30px; color: white;">
        <div style="display: flex; align-items: center; gap: 15px;">
            <div style="width: 60px; height: 60px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 2px solid rgba(255, 255, 255, 0.3);">
                <i class="fas fa-user-plus" style="font-size: 28px;"></i>
            </div>
            <div>
                <h1 style="margin: 0 0 5px 0; font-size: 26px; font-weight: 600;">Tambah Anggota Baru</h1>
                <p style="margin: 0; opacity: 0.9; font-size: 15px;">Isi data anggota baru untuk koperasi UKK</p>
            </div>
        </div>
    </div>

    <!-- Error Message -->
    @if(session('error'))
    <div style="background: linear-gradient(135deg, #fee2e2, #fecaca); 
                color: #991b1b; 
                padding: 18px 22px; 
                border-radius: 10px; 
                margin-bottom: 25px; 
                border-left: 4px solid #ef4444;
                display: flex;
                align-items: flex-start;
                box-shadow: 0 4px 12px rgba(239, 68, 68, 0.1);">
        <i class="fas fa-exclamation-triangle" style="margin-right: 12px; font-size: 20px; margin-top: 2px;"></i>
        <div style="flex: 1;">
            <strong style="display: block; margin-bottom: 4px;">Terjadi Kesalahan</strong>
            {{ session('error') }}
        </div>
    </div>
    @endif

    <!-- Form Container -->
    <div style="background: white; 
                padding: 35px; 
                border-radius: 12px; 
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                border: 1px solid #e5e7eb;">
        
        <form action="{{ route('anggota.store') }}" method="POST" id="anggotaForm">
            @csrf
            
            <!-- Nama Anggota Field -->
            <div style="margin-bottom: 30px;">
                <label for="nama_anggota" style="display: block; margin-bottom: 10px; color: #374151; font-weight: 500; font-size: 16px; display: flex; align-items: center;">
                    <i class="fas fa-user" style="margin-right: 10px; color: #3b82f6;"></i>
                    Nama Anggota
                    <span style="color: #ef4444; margin-left: 4px;">*</span>
                </label>
                <div style="position: relative;">
                    <input type="text" 
                           id="nama_anggota" 
                           name="nama_anggota" 
                           value="{{ old('nama_anggota') }}" 
                           placeholder="Contoh: Budi Santoso, Siti Rahayu, Ahmad Wijaya"
                           required
                           style="width: 100%; 
                                  padding: 16px 20px 16px 50px; 
                                  border: 2px solid #e5e7eb; 
                                  border-radius: 10px; 
                                  font-size: 15px;
                                  transition: all 0.3s ease;
                                  background: #f9fafb;
                                  box-sizing: border-box;"
                           onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 4px rgba(59, 130, 246, 0.1)';"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
                    <i class="fas fa-id-card" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: #9ca3af; font-size: 16px;"></i>
                </div>
                @error('nama_anggota')
                <div style="color: #ef4444; font-size: 14px; margin-top: 8px; display: flex; align-items: center; padding-left: 10px;">
                    <i class="fas fa-exclamation-circle" style="margin-right: 8px;"></i>
                    {{ $message }}
                </div>
                @enderror
                <div style="color: #6b7280; font-size: 13px; margin-top: 6px; padding-left: 10px;">
                    <i class="fas fa-info-circle" style="margin-right: 6px;"></i>
                    Masukkan nama lengkap anggota
                </div>
            </div>

            <!-- Kota Field -->
            <div style="margin-bottom: 35px;">
                <label for="kota" style="display: block; margin-bottom: 10px; color: #374151; font-weight: 500; font-size: 16px; display: flex; align-items: center;">
                    <i class="fas fa-map-marker-alt" style="margin-right: 10px; color: #ef4444;"></i>
                    Kota
                    <span style="color: #ef4444; margin-left: 4px;">*</span>
                </label>
                <div style="position: relative;">
                    <input type="text" 
                           id="kota" 
                           name="kota" 
                           value="{{ old('kota') }}" 
                           placeholder="Contoh: Jakarta, Bandung, Surabaya, Yogyakarta"
                           required
                           style="width: 100%; 
                                  padding: 16px 20px 16px 50px; 
                                  border: 2px solid #e5e7eb; 
                                  border-radius: 10px; 
                                  font-size: 15px;
                                  transition: all 0.3s ease;
                                  background: #f9fafb;
                                  box-sizing: border-box;"
                           onfocus="this.style.borderColor='#ef4444'; this.style.boxShadow='0 0 0 4px rgba(239, 68, 68, 0.1)';"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
                    <i class="fas fa-city" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: #9ca3af; font-size: 16px;"></i>
                </div>
                @error('kota')
                <div style="color: #ef4444; font-size: 14px; margin-top: 8px; display: flex; align-items: center; padding-left: 10px;">
                    <i class="fas fa-exclamation-circle" style="margin-right: 8px;"></i>
                    {{ $message }}
                </div>
                @enderror
                <div style="color: #6b7280; font-size: 13px; margin-top: 6px; padding-left: 10px;">
                    <i class="fas fa-info-circle" style="margin-right: 6px;"></i>
                    Masukkan kota tempat tinggal anggota
                </div>
            </div>

            <!-- Action Buttons -->
            <div style="display: flex; gap: 15px; margin-top: 40px; padding-top: 25px; border-top: 1px solid #e5e7eb;">
                <button type="submit" 
                        style="flex: 1; 
                               background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); 
                               color: white; 
                               padding: 16px 24px; 
                               border: none; 
                               border-radius: 10px; 
                               font-size: 16px; 
                               font-weight: 600; 
                               cursor: pointer;
                               display: flex;
                               align-items: center;
                               justify-content: center;
                               gap: 10px;
                               transition: all 0.3s ease;">
                    <i class="fas fa-save"></i>
                    Simpan Anggota
                </button>
                
                <a href="{{ route('anggota.index') }}" 
                   style="flex: 1; 
                          background: #f3f4f6; 
                          color: #374151; 
                          padding: 16px 24px; 
                          border-radius: 10px; 
                          text-decoration: none; 
                          text-align: center;
                          font-size: 16px; 
                          font-weight: 500;
                          display: flex;
                          align-items: center;
                          justify-content: center;
                          gap: 10px;
                          transition: all 0.3s ease;
                          border: 2px solid #e5e7eb;">
                    <i class="fas fa-times"></i>
                    Batal
                </a>
            </div>

        </form>
    </div>

    <!-- Help Section -->
    <div style="background: #f0f9ff; 
                padding: 25px; 
                border-radius: 12px; 
                margin-top: 30px;
                border: 1px solid #bae6fd;">
        <div style="display: flex; gap: 15px;">
            <div style="width: 50px; height: 50px; background: #0ea5e9; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; flex-shrink: 0;">
                <i class="fas fa-lightbulb" style="font-size: 22px;"></i>
            </div>
            <div>
                <h3 style="margin: 0 0 10px 0; color: #0369a1; font-size: 18px;">Panduan Pengisian</h3>
                <ul style="margin: 0; padding-left: 20px; color: #374151;">
                    <li style="margin-bottom: 8px;">Gunakan nama lengkap untuk identifikasi yang jelas</li>
                    <li style="margin-bottom: 8px;">Kota harus sesuai dengan KTP atau domisili anggota</li>
                    <li>Anggota baru akan langsung aktif dalam sistem setelah disimpan</li>
                </ul>
            </div>
        </div>
    </div>

</div>

<style>
input, button, a {
    transition: all 0.3s ease;
}

button:hover {
    opacity: 0.9;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
}

a:hover {
    opacity: 0.9;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

input::placeholder {
    color: #9ca3af;
    font-size: 14px;
}

/* Responsive */
@media (max-width: 768px) {
    .container {
        padding: 15px;
    }
    
    .form-container {
        padding: 25px 20px;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .header-content {
        flex-direction: column;
        text-align: center;
    }
    
    .help-section {
        flex-direction: column;
        text-align: center;
    }
    
    .help-section > div:first-child {
        margin: 0 auto 15px;
    }
}
</style>

<script>
document.getElementById('anggotaForm').addEventListener('submit', function(e) {
    const namaAnggota = document.getElementById('nama_anggota').value;
    const kota = document.getElementById('kota').value;
    
    if (namaAnggota.trim() === '') {
        e.preventDefault();
        alert('Nama anggota tidak boleh kosong');
        document.getElementById('nama_anggota').focus();
        return false;
    }
    
    if (kota.trim() === '') {
        e.preventDefault();
        alert('Kota tidak boleh kosong');
        document.getElementById('kota').focus();
        return false;
    }
    
    // Show loading
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
    submitBtn.disabled = true;
    
    return true;
});

// Auto focus on first input
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('nama_anggota').focus();
});
</script>
@endsection