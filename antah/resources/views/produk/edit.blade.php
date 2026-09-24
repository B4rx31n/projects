@extends('layouts.app')

@section('title', 'Edit Produk - UKK App')

@section('page-title')
    Edit Produk #{{ $produk->id }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div style="max-width: 900px; margin: 0 auto; padding: 20px; font-family: 'Segoe UI', Arial, sans-serif;">

    <!-- Header -->
    <div style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); padding: 30px; border-radius: 12px; margin-bottom: 30px; color: white;">
        <div style="display: flex; align-items: center; gap: 20px;">
            <div style="width: 70px; height: 70px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 2px solid rgba(255, 255, 255, 0.3);">
                <i class="fas fa-edit" style="font-size: 32px;"></i>
            </div>
            <div style="flex: 1;">
                <h1 style="margin: 0 0 5px 0; font-size: 28px; font-weight: 600;">Edit Produk</h1>
                <div style="display: flex; align-items: center; gap: 15px; font-size: 14px;">
                    <span style="background: rgba(255, 255, 255, 0.2); padding: 4px 12px; border-radius: 20px;">
                        <i class="fas fa-hashtag" style="margin-right: 5px;"></i>ID: {{ $produk->id }}
                    </span>
                    <span style="opacity: 0.9;">
                        <i class="fas fa-box" style="margin-right: 5px;"></i>
                        {{ $produk->nama_barang }}
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
            <div style="width: 40px; height: 40px; background: #3b82f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">
                <i class="fas fa-database" style="font-size: 18px;"></i>
            </div>
            <h3 style="margin: 0; color: #374151; font-size: 18px;">Data Saat Ini</h3>
        </div>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
            <div>
                <div style="font-size: 13px; color: #6b7280; margin-bottom: 4px;">Nama Barang</div>
                <div style="font-size: 16px; font-weight: 500; color: #1f2937;">{{ $produk->nama_barang }}</div>
            </div>
            <div>
                <div style="font-size: 13px; color: #6b7280; margin-bottom: 4px;">Stok Saat Ini</div>
                <div style="font-size: 20px; font-weight: 600; color: #10b981;">{{ $produk->jumlah }} Unit</div>
            </div>
            <div>
                <div style="font-size: 13px; color: #6b7280; margin-bottom: 4px;">Terakhir Diupdate</div>
                <div style="font-size: 14px; color: #374151;">
                    {{ $produk->updated_at->format('d M Y, H:i') }}
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
        
        <form action="{{ route('produk.update', $produk->id) }}" method="POST" id="editProdukForm">
            @csrf
            @method('PUT')
            
            <!-- Nama Barang Field -->
            <div style="margin-bottom: 30px;">
                <label for="nama_barang" style="display: block; margin-bottom: 10px; color: #374151; font-weight: 500; font-size: 16px; display: flex; align-items: center;">
                    <i class="fas fa-box" style="margin-right: 10px; color: #667eea;"></i>
                    Nama Barang Baru
                    <span style="color: #ef4444; margin-left: 4px;">*</span>
                </label>
                <div style="position: relative;">
                    <input type="text" 
                           id="nama_barang" 
                           name="nama_barang" 
                           value="{{ old('nama_barang', $produk->nama_barang) }}" 
                           placeholder="Masukkan nama barang baru"
                           required
                           style="width: 100%; 
                                  padding: 16px 20px 16px 50px; 
                                  border: 2px solid #e5e7eb; 
                                  border-radius: 10px; 
                                  font-size: 15px;
                                  transition: all 0.3s ease;
                                  background: #f9fafb;
                                  box-sizing: border-box;"
                           onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 0 4px rgba(102, 126, 234, 0.1)';"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
                    <i class="fas fa-tag" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: #9ca3af; font-size: 16px;"></i>
                </div>
                @error('nama_barang')
                <div style="color: #ef4444; font-size: 14px; margin-top: 8px; display: flex; align-items: center; padding-left: 10px;">
                    <i class="fas fa-exclamation-circle" style="margin-right: 8px;"></i>
                    {{ $message }}
                </div>
                @enderror
                <div style="color: #6b7280; font-size: 13px; margin-top: 6px; padding-left: 10px;">
                    <i class="fas fa-info-circle" style="margin-right: 6px;"></i>
                    Update nama barang jika diperlukan
                </div>
            </div>

            <!-- Jumlah Field -->
            <div style="margin-bottom: 35px;">
                <label for="jumlah" style="display: block; margin-bottom: 10px; color: #374151; font-weight: 500; font-size: 16px; display: flex; align-items: center;">
                    <i class="fas fa-layer-group" style="margin-right: 10px; color: #10b981;"></i>
                    Jumlah Barang Baru
                    <span style="color: #ef4444; margin-left: 4px;">*</span>
                </label>
                <div style="position: relative;">
                    <input type="number" 
                           id="jumlah" 
                           name="jumlah" 
                           value="{{ old('jumlah', $produk->jumlah) }}" 
                           placeholder="Masukkan jumlah barang baru"
                           min="1"
                           required
                           style="width: 100%; 
                                  padding: 16px 20px 16px 50px; 
                                  border: 2px solid #e5e7eb; 
                                  border-radius: 10px; 
                                  font-size: 15px;
                                  transition: all 0.3s ease;
                                  background: #f9fafb;
                                  box-sizing: border-box;"
                           onfocus="this.style.borderColor='#10b981'; this.style.boxShadow='0 0 0 4px rgba(16, 185, 129, 0.1)';"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
                    <i class="fas fa-hashtag" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: #9ca3af; font-size: 16px;"></i>
                </div>
                @error('jumlah')
                <div style="color: #ef4444; font-size: 14px; margin-top: 8px; display: flex; align-items: center; padding-left: 10px;">
                    <i class="fas fa-exclamation-circle" style="margin-right: 8px;"></i>
                    {{ $message }}
                </div>
                @enderror
                <div style="color: #6b7280; font-size: 13px; margin-top: 6px; padding-left: 10px;">
                    <i class="fas fa-info-circle" style="margin-right: 6px;"></i>
                    Jumlah minimum adalah 1 unit
                </div>
            </div>

            <!-- Action Buttons -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-top: 40px; padding-top: 25px; border-top: 1px solid #e5e7eb;">
                <button type="submit" 
                        style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); 
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
                
                <a href="{{ route('produk.show', $produk->id) }}" 
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
                
                <a href="{{ route('produk.index') }}" 
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
    <div style="background: #fef3c7; 
                padding: 25px; 
                border-radius: 12px; 
                margin-top: 30px;
                border: 1px solid #fde68a;">
        <div style="display: flex; gap: 15px; align-items: flex-start;">
            <div style="width: 50px; height: 50px; background: #f59e0b; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; flex-shrink: 0;">
                <i class="fas fa-history" style="font-size: 22px;"></i>
            </div>
            <div style="flex: 1;">
                <h3 style="margin: 0 0 10px 0; color: #92400e; font-size: 18px;">Informasi Perubahan</h3>
                <div style="display: grid; gap: 10px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-calendar-plus" style="color: #10b981;"></i>
                        <span style="color: #374151; font-size: 14px;">
                            Data dibuat: <strong>{{ $produk->created_at->format('d M Y, H:i') }}</strong>
                        </span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-history" style="color: #667eea;"></i>
                        <span style="color: #374151; font-size: 14px;">
                            Terakhir update: <strong>{{ $produk->updated_at->diffForHumans() }}</strong>
                        </span>
                    </div>
                    <div style="color: #6b7280; font-size: 13px; margin-top: 5px;">
                        <i class="fas fa-info-circle" style="margin-right: 6px;"></i>
                        Setelah diupdate, perubahan akan langsung tersimpan di database
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
    box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3);
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
document.getElementById('editProdukForm').addEventListener('submit', function(e) {
    const jumlah = document.getElementById('jumlah').value;
    const namaBarang = document.getElementById('nama_barang').value;
    
    if (parseInt(jumlah) < 1) {
        e.preventDefault();
        alert('Jumlah barang harus minimal 1 unit');
        document.getElementById('jumlah').focus();
        return false;
    }
    
    if (namaBarang.trim() === '') {
        e.preventDefault();
        alert('Nama barang tidak boleh kosong');
        document.getElementById('nama_barang').focus();
        return false;
    }
    
    // Show loading confirmation
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
    submitBtn.disabled = true;
    
    return true;
});

// Auto focus on first input
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('nama_barang').focus();
    document.getElementById('nama_barang').select();
});
</script>
@endsection