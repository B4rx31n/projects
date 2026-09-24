@extends('layouts.app')

@section('title', 'Edit Supplier - UKK App')

@section('page-title')
    Edit Supplier #{{ $supplier->id }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}">Supplier</a></li>
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
                <h1 style="margin: 0 0 5px 0; font-size: 28px; font-weight: 600;">Edit Data Supplier</h1>
                <div style="display: flex; align-items: center; gap: 15px; font-size: 14px;">
                    <span style="background: rgba(255, 255, 255, 0.2); padding: 4px 12px; border-radius: 20px;">
                        <i class="fas fa-hashtag" style="margin-right: 5px;"></i>ID: {{ $supplier->id }}
                    </span>
                    <span style="opacity: 0.9;">
                        <i class="fas fa-building" style="margin-right: 5px;"></i>
                        {{ $supplier->nama_supplier }}
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
                <div style="font-size: 13px; color: #6b7280; margin-bottom: 4px;">Nama Supplier</div>
                <div style="font-size: 15px; font-weight: 500; color: #1f2937; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-building" style="color: #f59e0b;"></i>
                    {{ $supplier->nama_supplier }}
                </div>
            </div>
            <div>
                <div style="font-size: 13px; color: #6b7280; margin-bottom: 4px;">Kota</div>
                <div style="font-size: 15px; font-weight: 500; color: #1f2937; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-map-marker-alt" style="color: #ef4444;"></i>
                    {{ $supplier->alamat_kota }}
                </div>
            </div>
            <div>
                <div style="font-size: 13px; color: #6b7280; margin-bottom: 4px;">Terakhir Diupdate</div>
                <div style="font-size: 14px; color: #374151; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-history" style="color: #8b5cf6;"></i>
                    {{ $supplier->updated_at->format('d M Y, H:i') }}
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
        
        <form action="{{ route('supplier.update', $supplier->id) }}" method="POST" id="editSupplierForm">
            @csrf
            @method('PUT')
            
            <!-- Nama Supplier Field -->
            <div style="margin-bottom: 25px;">
                <label for="nama_supplier" style="display: block; margin-bottom: 10px; color: #374151; font-weight: 500; font-size: 16px; display: flex; align-items: center;">
                    <i class="fas fa-building" style="margin-right: 10px; color: #f59e0b;"></i>
                    Nama Supplier
                    <span style="color: #ef4444; margin-left: 4px;">*</span>
                </label>
                <div style="position: relative;">
                    <input type="text" 
                           id="nama_supplier" 
                           name="nama_supplier" 
                           value="{{ old('nama_supplier', $supplier->nama_supplier) }}" 
                           placeholder="Contoh: PT. Sumber Makmur, CV. Jaya Abadi"
                           required
                           style="width: 100%; 
                                  padding: 14px 16px 14px 48px; 
                                  border: 2px solid #e5e7eb; 
                                  border-radius: 10px; 
                                  font-size: 15px;
                                  transition: all 0.3s ease;
                                  background: #f9fafb;
                                  box-sizing: border-box;"
                           onfocus="this.style.borderColor='#f59e0b'; this.style.boxShadow='0 0 0 4px rgba(245, 158, 11, 0.1)';"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
                    <i class="fas fa-industry" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: #9ca3af; font-size: 16px;"></i>
                </div>
                @error('nama_supplier')
                <div style="color: #ef4444; font-size: 14px; margin-top: 8px; display: flex; align-items: center; padding-left: 10px;">
                    <i class="fas fa-exclamation-circle" style="margin-right: 8px;"></i>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Alamat Kota Field -->
            <div style="margin-bottom: 25px;">
                <label for="alamat_kota" style="display: block; margin-bottom: 10px; color: #374151; font-weight: 500; font-size: 16px; display: flex; align-items: center;">
                    <i class="fas fa-map-marker-alt" style="margin-right: 10px; color: #ef4444;"></i>
                    Alamat Kota
                    <span style="color: #ef4444; margin-left: 4px;">*</span>
                </label>
                <div style="position: relative;">
                    <input type="text" 
                           id="alamat_kota" 
                           name="alamat_kota" 
                           value="{{ old('alamat_kota', $supplier->alamat_kota) }}" 
                           placeholder="Contoh: Jakarta, Bandung, Surabaya"
                           required
                           style="width: 100%; 
                                  padding: 14px 16px 14px 48px; 
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
                @error('alamat_kota')
                <div style="color: #ef4444; font-size: 14px; margin-top: 8px; display: flex; align-items: center; padding-left: 10px;">
                    <i class="fas fa-exclamation-circle" style="margin-right: 8px;"></i>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Contact Person Field -->
            <div style="margin-bottom: 25px;">
                <label for="contact_person" style="display: block; margin-bottom: 10px; color: #374151; font-weight: 500; font-size: 16px; display: flex; align-items: center;">
                    <i class="fas fa-user-tie" style="margin-right: 10px; color: #3b82f6;"></i>
                    Contact Person
                    <span style="color: #ef4444; margin-left: 4px;">*</span>
                </label>
                <div style="position: relative;">
                    <input type="text" 
                           id="contact_person" 
                           name="contact_person" 
                           value="{{ old('contact_person', $supplier->contact_person) }}" 
                           placeholder="Contoh: 081234567890, Budi Santoso"
                           required
                           style="width: 100%; 
                                  padding: 14px 16px 14px 48px; 
                                  border: 2px solid #e5e7eb; 
                                  border-radius: 10px; 
                                  font-size: 15px;
                                  transition: all 0.3s ease;
                                  background: #f9fafb;
                                  box-sizing: border-box;"
                           onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 4px rgba(59, 130, 246, 0.1)';"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
                    <i class="fas fa-phone-alt" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: #9ca3af; font-size: 16px;"></i>
                </div>
                @error('contact_person')
                <div style="color: #ef4444; font-size: 14px; margin-top: 8px; display: flex; align-items: center; padding-left: 10px;">
                    <i class="fas fa-exclamation-circle" style="margin-right: 8px;"></i>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Nama Barang Field -->
            <div style="margin-bottom: 25px;">
                <label for="nama_barang" style="display: block; margin-bottom: 10px; color: #374151; font-weight: 500; font-size: 16px; display: flex; align-items: center;">
                    <i class="fas fa-box" style="margin-right: 10px; color: #10b981;"></i>
                    Nama Barang
                    <span style="color: #ef4444; margin-left: 4px;">*</span>
                </label>
                <div style="position: relative;">
                    <input type="text" 
                           id="nama_barang" 
                           name="nama_barang" 
                           value="{{ old('nama_barang', $supplier->nama_barang) }}" 
                           placeholder="Contoh: Beras 5kg, Gula Pasir, Minyak Goreng"
                           required
                           style="width: 100%; 
                                  padding: 14px 16px 14px 48px; 
                                  border: 2px solid #e5e7eb; 
                                  border-radius: 10px; 
                                  font-size: 15px;
                                  transition: all 0.3s ease;
                                  background: #f9fafb;
                                  box-sizing: border-box;"
                           onfocus="this.style.borderColor='#10b981'; this.style.boxShadow='0 0 0 4px rgba(16, 185, 129, 0.1)';"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
                    <i class="fas fa-tag" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: #9ca3af; font-size: 16px;"></i>
                </div>
                @error('nama_barang')
                <div style="color: #ef4444; font-size: 14px; margin-top: 8px; display: flex; align-items: center; padding-left: 10px;">
                    <i class="fas fa-exclamation-circle" style="margin-right: 8px;"></i>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Jumlah Pasokan Field -->
            <div style="margin-bottom: 35px;">
                <label for="jumlah_pasokan" style="display: block; margin-bottom: 10px; color: #374151; font-weight: 500; font-size: 16px; display: flex; align-items: center;">
                    <i class="fas fa-layer-group" style="margin-right: 10px; color: #8b5cf6;"></i>
                    Jumlah Pasokan
                    <span style="color: #ef4444; margin-left: 4px;">*</span>
                </label>
                <div style="position: relative;">
                    <input type="number" 
                           id="jumlah_pasokan" 
                           name="jumlah_pasokan" 
                           value="{{ old('jumlah_pasokan', $supplier->jumlah_pasokan) }}" 
                           placeholder="Masukkan jumlah pasokan"
                           min="1"
                           required
                           style="width: 100%; 
                                  padding: 14px 16px 14px 48px; 
                                  border: 2px solid #e5e7eb; 
                                  border-radius: 10px; 
                                  font-size: 15px;
                                  transition: all 0.3s ease;
                                  background: #f9fafb;
                                  box-sizing: border-box;"
                           onfocus="this.style.borderColor='#8b5cf6'; this.style.boxShadow='0 0 0 4px rgba(139, 92, 246, 0.1)';"
                           onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
                    <i class="fas fa-hashtag" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: #9ca3af; font-size: 16px;"></i>
                </div>
                @error('jumlah_pasokan')
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
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 12px; margin-top: 40px; padding-top: 25px; border-top: 1px solid #e5e7eb;">
                <button type="submit" 
                        style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); 
                               color: white; 
                               padding: 15px 20px; 
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
                
                <a href="{{ route('supplier.show', $supplier->id) }}" 
                   style="background: #f3f4f6; 
                          color: #374151; 
                          padding: 15px 20px; 
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
                
                <a href="{{ route('supplier.index') }}" 
                   style="background: #fee2e2; 
                          color: #991b1b; 
                          padding: 15px 20px; 
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
    <div style="background: #fffbeb; 
                padding: 25px; 
                border-radius: 12px; 
                margin-top: 30px;
                border: 1px solid #fde68a;">
        <div style="display: flex; gap: 15px; align-items: flex-start;">
            <div style="width: 50px; height: 50px; background: #f59e0b; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; flex-shrink: 0;">
                <i class="fas fa-history" style="font-size: 22px;"></i>
            </div>
            <div style="flex: 1;">
                <h3 style="margin: 0 0 10px 0; color: #92400e; font-size: 18px;">Riwayat Perubahan</h3>
                <div style="display: grid; gap: 10px;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-calendar-plus" style="color: #10b981;"></i>
                        <span style="color: #374151; font-size: 14px;">
                            Data dibuat: <strong>{{ $supplier->created_at->format('d M Y, H:i') }}</strong>
                        </span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-history" style="color: #8b5cf6;"></i>
                        <span style="color: #374151; font-size: 14px;">
                            Terakhir update: <strong>{{ $supplier->updated_at->diffForHumans() }}</strong>
                        </span>
                    </div>
                    <div style="color: #6b7280; font-size: 13px; margin-top: 5px;">
                        <i class="fas fa-info-circle" style="margin-right: 6px;"></i>
                        Perubahan akan memperbarui data supplier di seluruh sistem
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
document.getElementById('editSupplierForm').addEventListener('submit', function(e) {
    const namaSupplier = document.getElementById('nama_supplier').value;
    const alamatKota = document.getElementById('alamat_kota').value;
    const contactPerson = document.getElementById('contact_person').value;
    const namaBarang = document.getElementById('nama_barang').value;
    const jumlahPasokan = document.getElementById('jumlah_pasokan').value;
    
    // Validate required fields
    const requiredFields = [
        {field: namaSupplier, name: 'Nama Supplier'},
        {field: alamatKota, name: 'Alamat Kota'},
        {field: contactPerson, name: 'Contact Person'},
        {field: namaBarang, name: 'Nama Barang'}
    ];
    
    for (const field of requiredFields) {
        if (field.field.trim() === '') {
            e.preventDefault();
            alert(field.name + ' tidak boleh kosong');
            document.getElementById(field.name.toLowerCase().replace(' ', '_')).focus();
            return false;
        }
    }
    
    if (parseInt(jumlahPasokan) < 1) {
        e.preventDefault();
        alert('Jumlah pasokan harus minimal 1 unit');
        document.getElementById('jumlah_pasokan').focus();
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
    document.getElementById('nama_supplier').focus();
    document.getElementById('nama_supplier').select();
});
</script>
@endsection