@extends('layouts.app')

@section('title', 'Detail Anggota - UKK App')

@section('page-title')
    Detail Anggota
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('anggota.index') }}">Anggota</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<div style="max-width: 900px; margin: 0 auto; padding: 20px; font-family: 'Segoe UI', Arial, sans-serif;">

    <!-- Header -->
    <div style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); padding: 30px; border-radius: 12px; margin-bottom: 30px; color: white;">
        <div style="display: flex; align-items: center; gap: 20px;">
            <div style="width: 80px; height: 80px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 3px solid rgba(255, 255, 255, 0.3);">
                <i class="fas fa-user-circle" style="font-size: 36px;"></i>
            </div>
            <div style="flex: 1;">
                <h1 style="margin: 0 0 8px 0; font-size: 28px; font-weight: 600;">Detail Anggota</h1>
                <div style="display: flex; align-items: center; gap: 15px; font-size: 15px;">
                    <span style="background: rgba(255, 255, 255, 0.2); padding: 6px 14px; border-radius: 20px; display: flex; align-items: center; gap: 6px;">
                        <i class="fas fa-hashtag"></i>ID: {{ $anggota->id }}
                    </span>
                    <span style="opacity: 0.9; display: flex; align-items: center; gap: 6px;">
                        <i class="fas fa-user-tag"></i>
                        {{ $anggota->nama_anggota }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px; margin-bottom: 30px;">
        
        <!-- Anggota Information -->
        <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); border: 1px solid #e5e7eb;">
            <h2 style="margin: 0 0 25px 0; color: #374151; font-size: 22px; display: flex; align-items: center; gap: 10px; padding-bottom: 15px; border-bottom: 2px solid #f3f4f6;">
                <i class="fas fa-user" style="color: #3b82f6;"></i>
                Informasi Anggota
            </h2>
            
            <div style="display: grid; gap: 25px;">
                <!-- Nama Anggota -->
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="width: 55px; height: 55px; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; flex-shrink: 0;">
                        <i class="fas fa-id-card" style="font-size: 22px;"></i>
                    </div>
                    <div style="flex: 1;">
                        <div style="font-size: 14px; color: #6b7280; margin-bottom: 4px;">Nama Anggota</div>
                        <div style="font-size: 20px; font-weight: 600; color: #1f2937;">{{ $anggota->nama_anggota }}</div>
                    </div>
                </div>

                <!-- Kota -->
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div style="width: 55px; height: 55px; background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: white; flex-shrink: 0;">
                        <i class="fas fa-map-marker-alt" style="font-size: 22px;"></i>
                    </div>
                    <div style="flex: 1;">
                        <div style="font-size: 14px; color: #6b7280; margin-bottom: 4px;">Kota Tinggal</div>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span style="font-size: 18px; font-weight: 600; color: #1f2937;">{{ $anggota->kota }}</span>
                            <span style="background: #fef3c7; color: #92400e; padding: 6px 14px; border-radius: 20px; font-size: 14px; font-weight: 500; display: flex; align-items: center; gap: 6px;">
                                <i class="fas fa-city"></i>
                                Lokasi
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Timeline -->
                <div style="position: relative; padding-left: 30px; margin-top: 10px;">
                    <div style="position: absolute; left: 12px; top: 0; bottom: 0; width: 3px; background: linear-gradient(to bottom, #3b82f6, #10b981); border-radius: 3px;"></div>
                    
                    <div style="margin-bottom: 25px; position: relative;">
                        <div style="position: absolute; left: -40px; top: 0; width: 16px; height: 16px; background: #10b981; border-radius: 50%; border: 4px solid white; box-shadow: 0 0 0 3px #10b981;"></div>
                        <div style="font-size: 14px; color: #6b7280; margin-bottom: 6px;">Dibuat Pada</div>
                        <div style="font-size: 16px; color: #374151; display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                            <i class="fas fa-calendar-plus" style="color: #10b981;"></i>
                            <span>{{ $anggota->created_at->format('d F Y') }}</span>
                            <span style="background: #f3f4f6; color: #6b7280; padding: 4px 10px; border-radius: 6px; font-size: 13px; font-family: monospace;">
                                {{ $anggota->created_at->format('H:i:s') }}
                            </span>
                            <span style="color: #10b981; font-size: 13px; font-weight: 500;">
                                ({{ $anggota->created_at->diffForHumans() }})
                            </span>
                        </div>
                    </div>

                    <div style="position: relative;">
                        <div style="position: absolute; left: -40px; top: 0; width: 16px; height: 16px; background: #3b82f6; border-radius: 50%; border: 4px solid white; box-shadow: 0 0 0 3px #3b82f6;"></div>
                        <div style="font-size: 14px; color: #6b7280; margin-bottom: 6px;">Diperbarui Pada</div>
                        <div style="font-size: 16px; color: #374151; display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                            <i class="fas fa-history" style="color: #3b82f6;"></i>
                            <span>{{ $anggota->updated_at->format('d F Y') }}</span>
                            <span style="background: #f3f4f6; color: #6b7280; padding: 4px 10px; border-radius: 6px; font-size: 13px; font-family: monospace;">
                                {{ $anggota->updated_at->format('H:i:s') }}
                            </span>
                            <span style="color: #3b82f6; font-size: 13px; font-weight: 500;">
                                ({{ $anggota->updated_at->diffForHumans() }})
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
                    <a href="{{ route('anggota.edit', $anggota->id) }}" 
                       style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); 
                              color: white; 
                              padding: 15px 20px; 
                              border-radius: 10px; 
                              text-decoration: none; 
                              text-align: center;
                              font-weight: 500;
                              display: flex;
                              align-items: center;
                              justify-content: center;
                              gap: 10px;
                              transition: all 0.3s ease;">
                        <i class="fas fa-edit"></i>
                        Edit Anggota
                    </a>
                    
                    <a href="{{ route('anggota.index') }}" 
                       style="background: #f3f4f6; 
                              color: #374151; 
                              padding: 15px 20px; 
                              border-radius: 10px; 
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
                    <i class="fas fa-chart-bar" style="color: #8b5cf6;"></i>
                    Status Anggota
                </h4>
                <div style="display: grid; gap: 12px;">
                    <div style="background: white; padding: 14px; border-radius: 8px; display: flex; align-items: center; gap: 12px; border: 1px solid #e5e7eb; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);">
                        <div style="width: 12px; height: 12px; background: #10b981; border-radius: 50%;"></div>
                        <div>
                            <div style="font-size: 13px; color: #6b7280;">Status</div>
                            <div style="font-size: 14px; font-weight: 500; color: #374151;">Anggota Aktif</div>
                        </div>
                    </div>
                    <div style="background: white; padding: 14px; border-radius: 8px; display: flex; align-items: center; gap: 12px; border: 1px solid #e5e7eb; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);">
                        <div style="width: 12px; height: 12px; background: #3b82f6; border-radius: 50%;"></div>
                        <div>
                            <div style="font-size: 13px; color: #6b7280;">Keanggotaan</div>
                            <div style="font-size: 14px; font-weight: 500; color: #374151;">Terdaftar Resmi</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Info -->
    <div style="background: linear-gradient(135deg, #dbeafe 0%, #93c5fd 100%); 
                padding: 25px; 
                border-radius: 12px; 
                border: 1px solid #93c5fd;">
        <div style="display: flex; gap: 15px; align-items: flex-start;">
            <div style="width: 55px; height: 55px; background: #3b82f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; flex-shrink: 0;">
                <i class="fas fa-info-circle" style="font-size: 24px;"></i>
            </div>
            <div style="flex: 1;">
                <h3 style="margin: 0 0 12px 0; color: #1e40af; font-size: 18px;">Informasi Sistem</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px;">
                    <div>
                        <div style="font-size: 13px; color: #4b5563; margin-bottom: 6px;">ID Database</div>
                        <div style="font-family: monospace; background: #1e293b; color: #e2e8f0; padding: 10px 14px; border-radius: 8px; font-size: 15px; font-weight: 500;">
                            {{ $anggota->id }}
                        </div>
                    </div>
                    <div>
                        <div style="font-size: 13px; color: #4b5563; margin-bottom: 6px;">Tanggal Registrasi</div>
                        <div style="display: flex; align-items: center; gap: 10px; color: #374151; font-size: 15px; font-weight: 500;">
                            <i class="fas fa-calendar-check" style="color: #10b981;"></i>
                            {{ $anggota->created_at->format('d M Y') }}
                        </div>
                    </div>
                    <div>
                        <div style="font-size: 13px; color: #4b5563; margin-bottom: 6px;">Durasi Keanggotaan</div>
                        <div style="display: flex; align-items: center; gap: 10px; color: #374151; font-size: 15px; font-weight: 500;">
                            <i class="fas fa-clock" style="color: #8b5cf6;"></i>
                            {{ $anggota->created_at->diffForHumans() }}
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
    
    .info-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection