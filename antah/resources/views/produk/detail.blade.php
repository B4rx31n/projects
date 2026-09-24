@extends('layouts.app')

@section('title', 'Detail Produk - UKK App')

@section('page-title')
    Detail Produk
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Produk</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<div style="max-width: 900px; margin: 0 auto; padding: 20px; font-family: 'Segoe UI', Arial, sans-serif;">

    <!-- Header -->
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px; border-radius: 12px; margin-bottom: 30px; color: white;">
        <div style="display: flex; align-items: center; gap: 20px;">
            <div style="width: 70px; height: 70px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 2px solid rgba(255, 255, 255, 0.3);">
                <i class="fas fa-box-open" style="font-size: 32px;"></i>
            </div>
            <div style="flex: 1;">
                <h1 style="margin: 0 0 5px 0; font-size: 28px; font-weight: 600;">Detail Produk</h1>
                <div style="display: flex; align-items: center; gap: 15px; font-size: 14px;">
                    <span style="background: rgba(255, 255, 255, 0.2); padding: 4px 12px; border-radius: 20px;">
                        <i class="fas fa-hashtag" style="margin-right: 5px;"></i>ID: {{ $produk->id }}
                    </span>
                    <span style="opacity: 0.9;">
                        <i class="fas fa-calendar-alt" style="margin-right: 5px;"></i>
                        Dibuat: {{ $produk->created_at->format('d M Y') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px; margin-bottom: 30px;">
        
        <!-- Product Information -->
        <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); border: 1px solid #e5e7eb;">
            <h2 style="margin: 0 0 25px 0; color: #374151; font-size: 22px; display: flex; align-items: center; gap: 10px; padding-bottom: 15px; border-bottom: 2px solid #f3f4f6;">
                <i class="fas fa-info-circle" style="color: #667eea;"></i>
                Informasi Produk
            </h2>
            
            <div style="display: grid; gap: 25px;">
                <!-- Nama Barang -->
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; flex-shrink: 0;">
                        <i class="fas fa-tag" style="font-size: 20px;"></i>
                    </div>
                    <div style="flex: 1;">
                        <div style="font-size: 13px; color: #6b7280; margin-bottom: 4px;">Nama Barang</div>
                        <div style="font-size: 18px; font-weight: 600; color: #1f2937;">{{ $produk->nama_barang }}</div>
                    </div>
                </div>

                <!-- Jumlah Stok -->
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; flex-shrink: 0;">
                        <i class="fas fa-layer-group" style="font-size: 20px;"></i>
                    </div>
                    <div style="flex: 1;">
                        <div style="font-size: 13px; color: #6b7280; margin-bottom: 4px;">Jumlah Stok</div>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span style="font-size: 24px; font-weight: 700; color: #10b981;">{{ $produk->jumlah }}</span>
                            <span style="background: #d1fae5; color: #065f46; padding: 4px 12px; border-radius: 20px; font-size: 14px; font-weight: 500;">
                                Unit
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Timeline -->
                <div style="position: relative; padding-left: 25px;">
                    <div style="position: absolute; left: 0; top: 0; bottom: 0; width: 2px; background: linear-gradient(to bottom, #667eea, #10b981);"></div>
                    
                    <div style="margin-bottom: 20px; position: relative;">
                        <div style="position: absolute; left: -33px; top: 0; width: 12px; height: 12px; background: #10b981; border-radius: 50%; border: 3px solid white; box-shadow: 0 0 0 2px #10b981;"></div>
                        <div style="font-size: 13px; color: #6b7280; margin-bottom: 4px;">Dibuat Pada</div>
                        <div style="font-size: 15px; color: #374151; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-calendar-plus" style="color: #10b981;"></i>
                            {{ $produk->created_at->format('d F Y') }}
                            <span style="background: #f3f4f6; color: #6b7280; padding: 2px 8px; border-radius: 4px; font-size: 13px;">
                                {{ $produk->created_at->format('H:i:s') }}
                            </span>
                        </div>
                    </div>

                    <div style="position: relative;">
                        <div style="position: absolute; left: -33px; top: 0; width: 12px; height: 12px; background: #667eea; border-radius: 50%; border: 3px solid white; box-shadow: 0 0 0 2px #667eea;"></div>
                        <div style="font-size: 13px; color: #6b7280; margin-bottom: 4px;">Diperbarui Pada</div>
                        <div style="font-size: 15px; color: #374151; display: flex; align-items: center; gap: 8px;">
                            <i class="fas fa-history" style="color: #667eea;"></i>
                            {{ $produk->updated_at->format('d F Y') }}
                            <span style="background: #f3f4f6; color: #6b7280; padding: 2px 8px; border-radius: 4px; font-size: 13px;">
                                {{ $produk->updated_at->format('H:i:s') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Panel -->
        <div>
            <div style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); border: 1px solid #e5e7eb; margin-bottom: 20px;">
                <h3 style="margin: 0 0 20px 0; color: #374151; font-size: 18px; display: flex; align-items: center; gap: 10px;">
                    <i class="fas fa-cogs" style="color: #f59e0b;"></i>
                    Aksi
                </h3>
                <div style="display: grid; gap: 12px;">
                    <a href="{{ route('produk.edit', $produk->id) }}" 
                       style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); 
                              color: white; 
                              padding: 14px 20px; 
                              border-radius: 8px; 
                              text-decoration: none; 
                              text-align: center;
                              font-weight: 500;
                              display: flex;
                              align-items: center;
                              justify-content: center;
                              gap: 10px;
                              transition: all 0.3s ease;">
                        <i class="fas fa-edit"></i>
                        Edit Produk
                    </a>
                    
                    <a href="{{ route('produk.index') }}" 
                       style="background: #f3f4f6; 
                              color: #374151; 
                              padding: 14px 20px; 
                              border-radius: 8px; 
                              text-decoration: none; 
                              text-align: center;
                              font-weight: 500;
                              display: flex;
                              align-items: center;
                              justify-content: center;
                              gap: 10px;
                              transition: all 0.3s ease;
                              border: 2px solid #e5e7eb;">
                        <i class="fas fa-list"></i>
                        Kembali ke Daftar
                    </a>
                </div>
            </div>

            <!-- Quick Stats -->
            <div style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); 
                        padding: 20px; 
                        border-radius: 12px; 
                        border: 1px solid #e5e7eb;">
                <h4 style="margin: 0 0 15px 0; color: #374151; font-size: 16px; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-chart-pie" style="color: #8b5cf6;"></i>
                    Status
                </h4>
                <div style="display: grid; gap: 12px;">
                    <div style="background: white; padding: 12px; border-radius: 8px; display: flex; align-items: center; gap: 10px; border: 1px solid #e5e7eb;">
                        <div style="width: 10px; height: 10px; background: #10b981; border-radius: 50%;"></div>
                        <div style="font-size: 14px; color: #374151;">Produk Aktif</div>
                    </div>
                    <div style="background: white; padding: 12px; border-radius: 8px; display: flex; align-items: center; gap: 10px; border: 1px solid #e5e7eb;">
                        <div style="width: 10px; height: 10px; background: #3b82f6; border-radius: 50%;"></div>
                        <div style="font-size: 14px; color: #374151;">Stok Tersedia</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Info -->
    <div style="background: #f0f9ff; 
                padding: 25px; 
                border-radius: 12px; 
                border: 1px solid #bae6fd;">
        <div style="display: flex; gap: 15px; align-items: flex-start;">
            <div style="width: 50px; height: 50px; background: #0ea5e9; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; flex-shrink: 0;">
                <i class="fas fa-database" style="font-size: 22px;"></i>
            </div>
            <div style="flex: 1;">
                <h3 style="margin: 0 0 10px 0; color: #0369a1; font-size: 18px;">Informasi Database</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                    <div>
                        <div style="font-size: 13px; color: #6b7280; margin-bottom: 4px;">ID Database</div>
                        <div style="font-family: monospace; background: #1e293b; color: #e2e8f0; padding: 8px 12px; border-radius: 6px; font-size: 14px;">
                            {{ $produk->id }}
                        </div>
                    </div>
                    <div>
                        <div style="font-size: 13px; color: #6b7280; margin-bottom: 4px;">Waktu Update</div>
                        <div style="display: flex; align-items: center; gap: 8px; color: #374151; font-size: 14px;">
                            <i class="fas fa-clock" style="color: #667eea;"></i>
                            {{ $produk->updated_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
a:hover {
    opacity: 0.9;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

/* Responsive */
@media (max-width: 768px) {
    .container {
        padding: 15px;
    }
    
    .main-content {
        grid-template-columns: 1fr;
    }
    
    .header-content {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    
    .timeline {
        padding-left: 20px;
    }
    
    .timeline::before {
        left: 7px;
    }
    
    .timeline-item::before {
        left: -25px;
    }
}
</style>
@endsection