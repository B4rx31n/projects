@extends('layouts.app')

@section('title', 'Admin - UKK App')

@section('page-title')
    Daftar Admin
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active">Admin</li>
@endsection

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 20px; font-family: 'Segoe UI', Arial, sans-serif;">

    <!-- Header Section -->
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 25px; border-radius: 12px; margin-bottom: 30px; color: white;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h1 style="margin: 0 0 8px 0; font-size: 28px; font-weight: 600;">
                    <i class="fas fa-user-shield" style="margin-right: 12px;"></i>Data Admin
                </h1>
                <p style="margin: 0; opacity: 0.9; font-size: 15px;">Kelola data administrator sistem</p>
            </div>
            <a href="{{ route('admins.create') }}" 
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
                Tambah Admin
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
                        <th style="padding: 18px 20px; text-align: left; color: #374151; font-weight: 600; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e5e7eb;">Nama</th>
                        <th style="padding: 18px 20px; text-align: left; color: #374151; font-weight: 600; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e5e7eb;">Email</th>
                        <th style="padding: 18px 20px; text-align: left; color: #374151; font-weight: 600; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e5e7eb;">Role</th>
                        <th style="padding: 18px 20px; text-align: left; color: #374151; font-weight: 600; font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; border-bottom: 2px solid #e5e7eb;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($admins as $admin)
                    <tr style="border-bottom: 1px solid #f3f4f6; transition: background 0.3s ease;" 
                        onmouseover="this.style.backgroundColor='#f9fafb'" 
                        onmouseout="this.style.backgroundColor='white'">
                        <td style="padding: 16px 20px; color: #6b7280; font-weight: 500;">{{ $loop->iteration }}</td>
                        <td style="padding: 16px 20px;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white;">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div>
                                    <div style="font-weight: 500; color: #1f2937;">{{ $admin->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="padding: 16px 20px;">
                            <div style="color: #6b7280; font-size: 14px;">{{ $admin->email }}</div>
                        </td>
                        <td style="padding: 16px 20px;">
                            <span style="display: inline-block; 
                                         background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); 
                                         color: white; 
                                         padding: 6px 14px; 
                                         border-radius: 20px; 
                                         font-weight: 500; 
                                         font-size: 14px;
                                         box-shadow: 0 2px 8px rgba(245, 158, 11, 0.2);">
                                <i class="fas fa-user-tag" style="margin-right: 6px; font-size: 12px;"></i>
                                Level {{ $admin->role }}
                            </span>
                        </td>
                        <td style="padding: 16px 20px;">
                            <div style="display: flex; gap: 8px;">
                                <a href="{{ route('admins.show', $admin->id) }}" 
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
                                <a href="{{ route('admins.edit', $admin->id) }}" 
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
                                <form action="{{ route('admins.destroy', $admin->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Yakin ingin menghapus admin {{ $admin->name }}?')"
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
                        <td colspan="5" style="padding: 60px 20px; text-align: center;">
                            <div style="max-width: 400px; margin: 0 auto;">
                                <div style="width: 80px; height: 80px; background: #f3f4f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                                    <i class="fas fa-user-shield" style="font-size: 36px; color: #9ca3af;"></i>
                                </div>
                                <h3 style="color: #6b7280; margin: 0 0 8px 0;">Belum ada data admin</h3>
                                <p style="color: #9ca3af; margin: 0;">Tambah admin pertama Anda untuk memulai</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Footer Stats -->
        @if($admins->count() > 0)
        <div style="padding: 20px; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); border-top: 1px solid #e5e7eb;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; gap: 30px;">
                    <div>
                        <div style="font-size: 13px; color: #6b7280; margin-bottom: 4px;">Total Admin</div>
                        <div style="font-size: 20px; font-weight: 600; color: #1f2937;">{{ $admins->count() }}</div>
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

