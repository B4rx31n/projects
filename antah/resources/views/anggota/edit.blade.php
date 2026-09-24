@extends('layouts.app')

@section('title', 'Edit Anggota - UKK App')

@section('page-title')
    Edit Anggota #{{ $anggota->id }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('anggota.index') }}">Anggota</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div style="max-width: 900px; margin: 0 auto; padding: 20px; font-family: 'Segoe UI', Arial, sans-serif;">

    <!-- Header -->
    <div style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); padding: 30px; border-radius: 12px; margin-bottom: 30px; color: white;">
        <div style="display: flex; align-items: center; gap: 20px;">
            <div style="width: 70px; height: 70px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 2px solid rgba(255, 255, 255, 0.3);">
                <i class="fas fa-user-edit" style="font-size: 32px;"></i>
            </div>
            <div style="flex: 1;">
                <h1 style="margin: 0 0 5px 0; font-size: 28px; font-weight: 600;">Edit Data Anggota</h1>
                <div style="display: flex; align-items: center; gap: 15px; font-size: 14px;">
                    <span style="background: rgba(255, 255, 255, 0.2); padding: 4px 12px; border-radius: 20px;">
                        <i class="fas fa-hashtag" style="margin-right: 5px;"></i>ID: {{ $anggota->id }}
                    </span>
                    <span style="opacity: 0.9;">
                        <i class="fas fa-user" style="margin-right: 5px;"></i>
                        {{ $anggota->nama_anggota }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Current Data -->
    <div style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); 
                padding: 25px; 
                border-radius: 12px; 
                margin-bottom: 30px;
                border: 1px solid #e5e7eb;">
        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
            <div style="width: 40px; height: 40px; background: #10b981; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">
                <i class="fas fa-database" style="font-size: 18px;"></i>
            </div>
            <h3 style="margin: 0; color: #374151; font-size: 18px;">Data Saat Ini</h3>
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
            <div>
                <div style="font-size: 13px; color: #6b7280; margin-bottom: 4px;">Nama Anggota</div>
                <div style="font-size: 16px; font-weight: 500; color: #1f2937; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-user" style="color: #3b82f6;"></i>
                    {{ $anggota->nama_anggota }}
                </div>
            </div>
            <div>
                <div style="font-size: 13px; color: #6b7280; margin-bottom: 4px;">Kota</div>
                <div style="font-size: 16px; font-weight: 500; color: #1f2937; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-map-marker-alt" style="color: #ef4444;"></i>
                    {{ $anggota->kota }}
                </div>
            </div>
            <div>
                <div style="font-size: 13px; color: #6b7280; margin-bottom: 4px;">Terakhir Diupdate</div>
                <div style="font-size: 14px; color: #374151; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-history" style="color: #8b5cf6;"></i>
                    {{ $anggota->updated_at->format('d M Y, H:i') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Error/Success Messages -->
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
            <strong style="display: block; margin-bottom: 4px;">Gagal Update Data</strong>
            {{ session('error') }}
        </div>
    </div>
    @endif

    @if(session('success'))
    <div style="background: linear-gradient(135deg, #d1fae5, #a7f3d0); 
                color: #065f46; 
                padding: 18px 22px; 
                border-radius: 10px; 
                margin-bottom: 25px; 
                border-left: 4px solid #10b981;
                display: flex;
                align-items: flex-start;
                box-shadow: 0 4px 12px rgba(16, 185, 129, 0.1);">
        <i class="fas fa-check-circle" style="margin-right: 12px; font-size: 20px; margin-top: 2px;"></i>
        <div style="flex: 1;">
            <strong style="display: block; margin-bottom: 4px;">Berhasil!</strong>
            {{ session('success') }}
        </div>
    </div>
    @endif

    <!-- Form Container -->
    <div style="background: white; 
                padding: 35px; 
                border-radius: 12px; 
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
                border: 1px solid #e5e7eb;">
        
        <form action="{{ route('anggota.update', $anggota->id) }}" method="POST" id="editAnggotaForm">
            @csrf
            @method('PUT')
            
            <!-- Nama Anggota Field -->
            <div style="margin-bottom: 30px;">
                <label for="nama_anggota" style="display: block; margin-bottom: 10px; color: #374151; font-weight: 500; font-size: 16px; display: flex; align-items: center;">
                    <i class="fas fa-user" style="margin-right: 10px; color: #3b82f6;"></i>
                    Nama Anggota Baru
                    <span style="color: #ef4444; margin-left: 4px;">*</span>
                </label>
                <div style="position: relative;">
                    <input type="text" 
                           id="nama_anggota" 
                           name="nama_anggota" 
                           value="{{ old('nama_anggota', $anggota->nama_anggota) }}" 
                           placeholder="Masukkan nama anggota baru"
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
                    Update nama anggota sesuai data terbaru
                </div>
            </div>

            <!-- Kota Field -->
            <div style="margin-bottom: 35px;">
                <label for="kota" style="display: block; margin-bottom: 10px; color: #374151; font-weight: 500; font-size: 16px; display: flex; align-items: center;">
                    <i class="fas fa-map-marker-alt" style="margin-right: 10px; color: #ef4444;"></i>
                    Kota Baru
                    <span style="color: #ef4444; margin-left: 4px;">*</span>
                </label>
                <div style="position: relative;">
                    <input type="text" 
                           id="kota" 
                           name="kota" 
                           value="{{ old('kota', $anggota->kota) }}" 
                           placeholder="Masukkan kota baru"
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
                    Masukkan nama kota tempat tinggal anggota
                </div>
            </div>

            <!-- Action Buttons -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-top: 40px; padding-top: 25px; border-top: 1px solid #e5e7eb;">
                <button type="submit" 
                        style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); 
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
                    Update Data
                </button>
                
                <a href="{{ route('anggota.show', $anggota->id) }}" 
                   style="background: #f3f4f6; 
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
                    <i class="fas fa-eye"></i>
                    Lihat Detail
                </a>
                
                <a href="{{ route('anggota.index') }}" 
                   style="background: #fee2e2; 
                          color: #991b1b; 
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
                          border: 2px solid #fecaca;">
                    <i class="fas fa-times"></i>
                    Batalkan
                </a>
            </div>

        </form>
    </div>

    <!-- Change History -->
    <div style="background: #dbeafe; 
                padding: 25px; 
                border-radius: 12px; 
                margin-top: 30px;
                border: 1px solid #93c5fd;">
        <div style="display: flex; gap: 15px; align-items: flex-start;">
            <div style="width: 50px; height: 50px; background: #3b82f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; flex-shrink: 0;">
                <i class="fas fa-history" style="font-size: 22px;"></i>
            </div>
            <div style="flex: 1;">
                <h3 style="margin: 0 0 10px 0; color: #1e40af; font-size: 18px;">Riwayat Perubahan</h3>
                <div style="display: grid; gap: 10px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-calendar-plus" style="color: #10b981;"></i>
                        <span style="color: #374151; font-size: 14px;">
                            Data dibuat: <strong>{{ $anggota->created_at->format('d M Y, H:i') }}</strong>
                        </span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-history" style="color: #8b5cf6;"></i>
                        <span style="color: #374151; font-size: 14px;">
                            Terakhir update: <strong>{{ $anggota->updated_at->diffForHumans() }}</strong>
                        </span>
                    </div>
                    <div style="color: #6b7280; font-size: 13px; margin-top: 5px;">
                        <i class="fas fa-info-circle" style="margin-right: 6px;"></i>
                        Perubahan akan memperbarui data anggota di seluruh sistem
                    </div>
                </div>
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
        grid-template-columns: 1fr;
    }
    
    .header-content {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    
    .current-data-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<script>
document.getElementById('editAnggotaForm').addEventListener('submit', function(e) {
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
    
    // Show loading confirmation
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
    submitBtn.disabled = true;
    
    return true;
});

// Auto focus and select on first input
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('nama_anggota').focus();
    document.getElementById('nama_anggota').select();
});
</script>
@endsection