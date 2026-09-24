@extends('layouts.app')

@section('title', 'Produk - UKK App')

@section('page-title')
    Daftar Produk
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active">Produk</li>
@endsection

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 20px; font-family: 'Segoe UI', Arial, sans-serif;">

    <!-- Header Section -->
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 25px; border-radius: 12px; margin-bottom: 30px; color: white;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1 style="margin: 0 0 8px 0; font-size: 28px; font-weight: 600;">
                    <i class="fas fa-boxes" style="margin-right: 12px;"></i>Data Produk
                </h1>
                <p style="margin: 0; opacity: 0.9; font-size: 15px;">Kelola stok dan data produk koperasi</p>
            </div>
            <a href="{{ route('produk.create') }}" 
               style="background: rgba(255, 255, 255, 0.2); 
                      backdrop-filter: blur(10px); 
                      color: white; 
                      padding: 12px 24px; 
                      border-radius: 8px; 
                      text-decoration: none; 
                      display: flex; 
                      align-items: center; 
                      border: 1px solid rgba(255, 255, 255, 0.3);
                      transition: all 0.3s ease;">
                <i class="fas fa-plus-circle" style="margin-right: 8px;"></i>
                Tambah Produk
            </a>
        </div>
    </div>

    <!-- Alert Messages -->
    @if (session('success'))
    <div style="background: linear-gradient(135deg, #d1fae5, #a7f3d0); 
                color: #065f46; 
                padding: 16px 20px; 
                border-radius: 10px; 
                margin-bottom: 25px; 
                border-left: 4px solid #10b981;
                display: flex;
                align-items: center;
                box-shadow: 0 4px 12px rgba(16, 185, 129, 0.1);">
        <i class="fas fa-check-circle" style="margin-right: 12px; font-size: 20px;"></i>
        <div>
            <strong style="display: block; margin-bottom: 4px;">Berhasil!</strong>
            {{ session('success') }}
        </div>
    </div>
    @endif

    <!-- Search Section -->
    <div style="background: white; 
                padding: 25px; 
                border-radius: 12px; 
                margin-bottom: 30px; 
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
                border: 1px solid #e5e7eb;">
        <div style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
            <div style="flex: 1; min-width: 300px;">
                <form action="{{ route('produk.index') }}" method="GET" style="display: flex; gap: 10px;">
                    <div style="flex: 1; position: relative;">
                        <input type="text" 
                               name="search" 
                               placeholder="Cari nama barang..." 
                               value="{{ $search ?? '' }}" 
                               style="width: 100%; 
                                      padding: 14px 16px 14px 48px; 
                                      border: 2px solid #e5e7eb; 
                                      border-radius: 8px; 
                                      font-size: 15px;
                                      transition: all 0.3s ease;
                                      background: #f9fafb;"
                               onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 0 0 3px rgba(102, 126, 234, 0.1)';"
                               onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
                        <i class="fas fa-search" style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: #9ca3af;"></i>
                    </div>
                    <button type="submit" 
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
                                   color: white; 
                                   padding: 14px 28px; 
                                   border: none; 
                                   border-radius: 8px; 
                                   cursor: pointer;
                                   font-weight: 500;
                                   transition: opacity 0.3s ease;">
                        Cari
                    </button>
                </form>
            </div>
            
            @if(isset($search) && $search != '')
            <div style="display: flex; align-items: center; gap: 10px; padding: 12px 16px; background: #eff6ff; border-radius: 8px;">
                <i class="fas fa-filter" style="color: #3b82f6;"></i>
                <div>
                    <div style="font-size: 13px; color: #6b7280;">Hasil pencarian:</div>
                    <div style="font-weight: 500; color: #1e40af;">"{{ $search }}"</div>
                </div>
                <a href="{{ route('produk.index') }}" 
                   style="margin-left: 10px; 
                          color: #ef4444; 
                          text-decoration: none;
                          display: flex;
                          align-items: center;
                          gap: 4px;">
                    <i class="fas fa-times"></i>
                    Clear
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- Table Section -->
    <div style="background: white; 
                border-radius: 12px; 
                overflow: hidden;
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
                border: 1px solid #e5e7eb;">
        
        <!-- Table -->
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);">
                        <th style="padding: 18px 20px; text-align: left; color: #374151; font-weight: 600; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e5e7eb;">No</th>
                        <th style="padding: 18px 20px; text-align: left; color: #374151; font-weight: 600; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e5e7eb;">Nama Barang</th>
                        <th style="padding: 18px 20px; text-align: left; color: #374151; font-weight: 600; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e5e7eb;">Stok</th>
                        <th style="padding: 18px 20px; text-align: left; color: #374151; font-weight: 600; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e5e7eb;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produks as $p)
                    <tr style="border-bottom: 1px solid #f3f4f6; transition: background 0.3s ease;" 
                        onmouseover="this.style.backgroundColor='#f9fafb'" 
                        onmouseout="this.style.backgroundColor='white'">
                        <td style="padding: 16px 20px; color: #6b7280; font-weight: 500;">{{ $loop->iteration }}</td>
                        <td style="padding: 16px 20px;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white;">
                                    <i class="fas fa-box"></i>
                                </div>
                                <div>
                                    <div style="font-weight: 500; color: #1f2937;">{{ $p->nama_barang }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="padding: 16px 20px;">
                            <span style="display: inline-block; 
                                         background: linear-gradient(135deg, #10b981 0%, #059669 100%); 
                                         color: white; 
                                         padding: 6px 14px; 
                                         border-radius: 20px; 
                                         font-weight: 500; 
                                         font-size: 14px;
                                         box-shadow: 0 2px 8px rgba(16, 185, 129, 0.2);">
                                <i class="fas fa-layer-group" style="margin-right: 6px; font-size: 12px;"></i>
                                {{ $p->jumlah }} Unit
                            </span>
                        </td>
                        <td style="padding: 16px 20px;">
                            <div style="display: flex; gap: 8px;">
                                <a href="{{ route('produk.show', $p->id) }}" 
                                   style="background: #dbeafe; 
                                          color: #1d4ed8; 
                                          padding: 8px 16px; 
                                          border-radius: 6px; 
                                          text-decoration: none; 
                                          display: flex; 
                                          align-items: center; 
                                          gap: 6px;
                                          font-size: 14px;
                                          font-weight: 500;
                                          transition: all 0.3s ease;">
                                    <i class="fas fa-eye" style="font-size: 12px;"></i>
                                    Detail
                                </a>
                                <a href="{{ route('produk.edit', $p->id) }}" 
                                   style="background: #fef3c7; 
                                          color: #92400e; 
                                          padding: 8px 16px; 
                                          border-radius: 6px; 
                                          text-decoration: none; 
                                          display: flex; 
                                          align-items: center; 
                                          gap: 6px;
                                          font-size: 14px;
                                          font-weight: 500;
                                          transition: all 0.3s ease;">
                                    <i class="fas fa-edit" style="font-size: 12px;"></i>
                                    Edit
                                </a>
                                <form action="{{ route('produk.destroy', $p->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Yakin ingin menghapus produk {{ $p->nama_barang }}?')"
                                            style="background: #fee2e2; 
                                                   color: #991b1b; 
                                                   padding: 8px 16px; 
                                                   border-radius: 6px; 
                                                   border: none; 
                                                   cursor: pointer;
                                                   display: flex; 
                                                   align-items: center; 
                                                   gap: 6px;
                                                   font-size: 14px;
                                                   font-weight: 500;
                                                   transition: all 0.3s ease;">
                                        <i class="fas fa-trash" style="font-size: 12px;"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="padding: 60px 20px; text-align: center;">
                            <div style="max-width: 400px; margin: 0 auto;">
                                <div style="width: 80px; height: 80px; background: #f3f4f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                    <i class="fas fa-box-open" style="font-size: 36px; color: #9ca3af;"></i>
                                </div>
                                <h3 style="color: #6b7280; margin: 0 0 8px 0;">
                                    @if(isset($search) && $search != '')
                                        Data tidak ditemukan
                                    @else
                                        Belum ada data produk
                                    @endif
                                </h3>
                                <p style="color: #9ca3af; margin: 0;">
                                    @if(isset($search) && $search != '')
                                        Tidak ditemukan produk dengan nama "{{ $search }}"
                                    @else
                                        Tambah produk pertama Anda untuk memulai
                                    @endif
                                </p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Footer Stats -->
        @if($produks->count() > 0)
        <div style="padding: 20px; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-top: 1px solid #e5e7eb;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; gap: 30px;">
                    <div>
                        <div style="font-size: 13px; color: #6b7280; margin-bottom: 4px;">Total Produk</div>
                        <div style="font-size: 20px; font-weight: 600; color: #1f2937;">{{ $produks->count() }}</div>
                    </div>
                    <div>
                        <div style="font-size: 13px; color: #6b7280; margin-bottom: 4px;">Total Stok</div>
                        <div style="font-size: 20px; font-weight: 600; color: #10b981;">{{ $produks->sum('jumlah') }} Unit</div>
                    </div>
                </div>
                <div style="color: #6b7280; font-size: 13px; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-info-circle"></i>
                    Last updated: {{ now()->format('d M Y, H:i') }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
a:hover, button:hover {
    opacity: 0.9;
    transform: translateY(-1px);
}

.actions a:hover, .actions button:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

/* Responsive */
@media (max-width: 768px) {
    .container {
        padding: 15px;
    }
    
    .header-content {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .table-container {
        margin: 0 -15px;
    }
    
    table {
        font-size: 14px;
    }
    
    th, td {
        padding: 12px 15px !important;
    }
}
</style>
@endsection