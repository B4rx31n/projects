@extends('layouts.app')

@section('title', 'Supplier - UKK App')

@section('page-title')
    Daftar Supplier
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active">Supplier</li>
@endsection

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 20px; font-family: 'Segoe UI', Arial, sans-serif;">

    <!-- Header Section -->
    <div style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); padding: 25px; border-radius: 12px; margin-bottom: 30px; color: white;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1 style="margin: 0 0 8px 0; font-size: 28px; font-weight: 600;">
                    <i class="fas fa-truck" style="margin-right: 12px;"></i>Data Supplier Koperasi
                </h1>
                <p style="margin: 0; opacity: 0.9; font-size: 15px;">Kelola data pemasok barang untuk koperasi UKK</p>
            </div>
            <a href="{{ route('supplier.create') }}" 
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
                Tambah Supplier
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
                <form action="{{ route('supplier.index') }}" method="GET" style="display: flex; gap: 10px;">
                    <div style="flex: 1; position: relative;">
                        <input type="text" 
                               name="search" 
                               placeholder="Cari nama supplier, kota, atau barang..." 
                               value="{{ $search ?? '' }}" 
                               style="width: 100%; 
                                      padding: 14px 16px 14px 48px; 
                                      border: 2px solid #e5e7eb; 
                                      border-radius: 8px; 
                                      font-size: 15px;
                                      transition: all 0.3s ease;
                                      background: #f9fafb;"
                               onfocus="this.style.borderColor='#f59e0b'; this.style.boxShadow='0 0 0 3px rgba(245, 158, 11, 0.1)';"
                               onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none';">
                        <i class="fas fa-search" style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: #9ca3af;"></i>
                    </div>
                    <button type="submit" 
                            style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); 
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
            <div style="display: flex; align-items: center; gap: 10px; padding: 12px 16px; background: #fffbeb; border-radius: 8px;">
                <i class="fas fa-filter" style="color: #f59e0b;"></i>
                <div>
                    <div style="font-size: 13px; color: #92400e;">Hasil pencarian:</div>
                    <div style="font-weight: 500; color: #92400e;">"{{ $search }}"</div>
                </div>
                <a href="{{ route('supplier.index') }}" 
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
                        <th style="padding: 18px 15px; text-align: left; color: #374151; font-weight: 600; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e5e7eb;">No</th>
                        <th style="padding: 18px 15px; text-align: left; color: #374151; font-weight: 600; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e5e7eb;">Supplier</th>
                        <th style="padding: 18px 15px; text-align: left; color: #374151; font-weight: 600; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e5e7eb;">Kota</th>
                        <th style="padding: 18px 15px; text-align: left; color: #374151; font-weight: 600; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e5e7eb;">Contact</th>
                        <th style="padding: 18px 15px; text-align: left; color: #374151; font-weight: 600; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e5e7eb;">Barang</th>
                        <th style="padding: 18px 15px; text-align: left; color: #374151; font-weight: 600; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e5e7eb;">Jumlah</th>
                        <th style="padding: 18px 15px; text-align: left; color: #374151; font-weight: 600; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e5e7eb;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($suppliers as $supplier)
                    <tr style="border-bottom: 1px solid #f3f4f6; transition: background 0.3s ease;" 
                        onmouseover="this.style.backgroundColor='#f9fafb'" 
                        onmouseout="this.style.backgroundColor='white'">
                        <td style="padding: 16px 15px; color: #6b7280; font-weight: 500; text-align: center;">{{ $loop->iteration }}</td>
                        <td style="padding: 16px 15px;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 32px; height: 32px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white;">
                                    <i class="fas fa-building" style="font-size: 14px;"></i>
                                </div>
                                <div>
                                    <div style="font-weight: 500; color: #1f2937; font-size: 14px;">{{ $supplier->nama_supplier }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="padding: 16px 15px;">
                            <div style="display: flex; align-items: center; gap: 6px;">
                                <i class="fas fa-map-marker-alt" style="color: #ef4444; font-size: 12px;"></i>
                                <span style="font-size: 14px; color: #374151;">{{ $supplier->alamat_kota }}</span>
                            </div>
                        </td>
                        <td style="padding: 16px 15px;">
                            <div style="display: flex; align-items: center; gap: 6px;">
                                <i class="fas fa-user-tie" style="color: #3b82f6; font-size: 12px;"></i>
                                <span style="font-size: 14px; color: #374151;">{{ $supplier->contact_person }}</span>
                            </div>
                        </td>
                        <td style="padding: 16px 15px;">
                            <div style="display: flex; align-items: center; gap: 6px;">
                                <i class="fas fa-box" style="color: #10b981; font-size: 12px;"></i>
                                <span style="font-size: 14px; color: #374151;">{{ $supplier->nama_barang }}</span>
                            </div>
                        </td>
                        <td style="padding: 16px 15px;">
                            <span style="display: inline-block; 
                                         background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); 
                                         color: white; 
                                         padding: 4px 10px; 
                                         border-radius: 6px; 
                                         font-weight: 500; 
                                         font-size: 13px;
                                         min-width: 50px;
                                         text-align: center;">
                                {{ $supplier->jumlah_pasokan }}
                            </span>
                        </td>
                        <td style="padding: 16px 15px;">
                            <div style="display: flex; gap: 6px; flex-wrap: wrap;">
                                <a href="{{ route('supplier.show', $supplier->id) }}" 
                                   style="background: #dbeafe; 
                                          color: #1d4ed8; 
                                          padding: 6px 12px; 
                                          border-radius: 6px; 
                                          text-decoration: none; 
                                          display: flex; 
                                          align-items: center; 
                                          gap: 4px;
                                          font-size: 13px;
                                          font-weight: 500;
                                          transition: all 0.3s ease;">
                                    <i class="fas fa-eye" style="font-size: 11px;"></i>
                                    Detail
                                </a>
                                <a href="{{ route('supplier.edit', $supplier->id) }}" 
                                   style="background: #fef3c7; 
                                          color: #92400e; 
                                          padding: 6px 12px; 
                                          border-radius: 6px; 
                                          text-decoration: none; 
                                          display: flex; 
                                          align-items: center; 
                                          gap: 4px;
                                          font-size: 13px;
                                          font-weight: 500;
                                          transition: all 0.3s ease;">
                                    <i class="fas fa-edit" style="font-size: 11px;"></i>
                                    Edit
                                </a>
                                <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Yakin ingin menghapus supplier {{ $supplier->nama_supplier }}?')"
                                            style="background: #fee2e2; 
                                                   color: #991b1b; 
                                                   padding: 6px 12px; 
                                                   border-radius: 6px; 
                                                   border: none; 
                                                   cursor: pointer;
                                                   display: flex; 
                                                   align-items: center; 
                                                   gap: 4px;
                                                   font-size: 13px;
                                                   font-weight: 500;
                                                   transition: all 0.3s ease;">
                                        <i class="fas fa-trash" style="font-size: 11px;"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="padding: 60px 20px; text-align: center;">
                            <div style="max-width: 400px; margin: 0 auto;">
                                <div style="width: 80px; height: 80px; background: #f3f4f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                    <i class="fas fa-truck-loading" style="font-size: 36px; color: #9ca3af;"></i>
                                </div>
                                <h3 style="color: #6b7280; margin: 0 0 8px 0;">
                                    @if(isset($search) && $search != '')
                                        Data tidak ditemukan
                                    @else
                                        Belum ada data supplier
                                    @endif
                                </h3>
                                <p style="color: #9ca3af; margin: 0;">
                                    @if(isset($search) && $search != '')
                                        Tidak ditemukan supplier dengan pencarian "{{ $search }}"
                                    @else
                                        Tambah supplier pertama Anda untuk memulai
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
        @if($suppliers->count() > 0)
        <div style="padding: 20px; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-top: 1px solid #e5e7eb;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; gap: 30px;">
                    <div>
                        <div style="font-size: 13px; color: #6b7280; margin-bottom: 4px;">Total Supplier</div>
                        <div style="font-size: 20px; font-weight: 600; color: #1f2937;">{{ $suppliers->count() }}</div>
                    </div>
                    <div>
                        <div style="font-size: 13px; color: #6b7280; margin-bottom: 4px;">Total Pasokan</div>
                        <div style="font-size: 20px; font-weight: 600; color: #8b5cf6;">{{ $suppliers->sum('jumlah_pasokan') }}</div>
                    </div>
                    <div>
                        <div style="font-size: 13px; color: #6b7280; margin-bottom: 4px;">Kota Berbeda</div>
                        <div style="font-size: 20px; font-weight: 600; color: #f59e0b;">{{ $suppliers->unique('alamat_kota')->count() }}</div>
                    </div>
                </div>
                <div style="color: #6b7280; font-size: 13px; display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-industry" style="color: #f59e0b;"></i>
                    Sistem Supplier Koperasi UKK
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
        font-size: 12px;
    }
    
    th, td {
        padding: 12px 10px !important;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 6px;
    }
    
    .action-buttons a, .action-buttons button {
        width: 100%;
        justify-content: center;
        font-size: 12px !important;
        padding: 8px !important;
    }
}
</style>
@endsection