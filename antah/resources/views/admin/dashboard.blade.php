@extends('layouts.app')

@section('page-title', 'Admin Dashboard')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 20px;">
    <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 30px; border-radius: 10px; margin-bottom: 30px; color: white;">
        <h1 style="margin: 0 0 10px 0; font-size: 28px;">
            <i class="fas fa-tachometer-alt" style="margin-right: 10px;"></i>Admin Dashboard
        </h1>
        <p style="margin: 0; opacity: 0.9;">Selamat datang, {{ Auth::guard('admin')->user()->name }}! Role: {{ Auth::guard('admin')->user()->role }} - Kelola sistem UKK Management</p>
    </div>

    @if(session('success'))
    <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 40px;">
        <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; border-top: 4px solid #3b82f6;">
            <div style="background: #eff6ff; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                <i class="fas fa-box" style="font-size: 24px; color: #3b82f6;"></i>
            </div>
            <h3 style="margin: 0 0 10px 0; color: #333;">Produk</h3>
            <p style="color: #666; margin-bottom: 20px;">Kelola data produk dan stok barang</p>
            <a href="{{ route('produk.index') }}" style="display: inline-block; background: #3b82f6; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; transition: background 0.3s;">
                <i class="fas fa-cog" style="margin-right: 5px;"></i>Manage Produk
            </a>
        </div>

        <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; border-top: 4px solid #10b981;">
            <div style="background: #ecfdf5; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                <i class="fas fa-users" style="font-size: 24px; color: #10b981;"></i>
            </div>
            <h3 style="margin: 0 0 10px 0; color: #333;">Anggota</h3>
            <p style="color: #666; margin-bottom: 20px;">Kelola data anggota koperasi</p>
            <a href="{{ route('anggota.index') }}" style="display: inline-block; background: #10b981; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; transition: background 0.3s;">
                <i class="fas fa-cog" style="margin-right: 5px;"></i>Manage Anggota
            </a>
        </div>

        <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; border-top: 4px solid #f59e0b;">
            <div style="background: #fffbeb; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                <i class="fas fa-truck" style="font-size: 24px; color: #f59e0b;"></i>
            </div>
            <h3 style="margin: 0 0 10px 0; color: #333;">Supplier</h3>
            <p style="color: #666; margin-bottom: 20px;">Kelola data supplier barang</p>
            <a href="{{ route('supplier.index') }}" style="display: inline-block; background: #f59e0b; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; transition: background 0.3s;">
                <i class="fas fa-cog" style="margin-right: 5px;"></i>Manage Supplier
            </a>
        </div>

        <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); text-align: center; border-top: 4px solid #8b5cf6;">
            <div style="background: #f5f3ff; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px;">
                <i class="fas fa-shipping-fast" style="font-size: 24px; color: #8b5cf6;"></i>
            </div>
            <h3 style="margin: 0 0 10px 0; color: #333;">Pengiriman</h3>
            <p style="color: #666; margin-bottom: 20px;">Kelola pesanan dan pengiriman</p>
            <a href="{{ route('pengiriman.index') }}" style="display: inline-block; background: #8b5cf6; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; transition: background 0.3s;">
                <i class="fas fa-cog" style="margin-right: 5px;"></i>Manage Pengiriman
            </a>
        </div>
    </div>

    <div style="background: white; padding: 25px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 30px;">
        <h3 style="margin: 0 0 20px 0; color: #333; display: flex; align-items: center;">
            <i class="fas fa-chart-line" style="margin-right: 10px; color: #3b82f6;"></i>Quick Statistics
        </h3>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
            <div style="text-align: center; padding: 15px; background: #f8fafc; border-radius: 8px;">
                <div style="font-size: 32px; font-weight: bold; color: #3b82f6; margin-bottom: 5px;">
                    {{ $produkCount ?? '0' }}
                </div>
                <div style="color: #666;">Total Produk</div>
            </div>
            
            <div style="text-align: center; padding: 15px; background: #f8fafc; border-radius: 8px;">
                <div style="font-size: 32px; font-weight: bold; color: #10b981; margin-bottom: 5px;">
                    {{ $anggotaCount ?? '0' }}
                </div>
                <div style="color: #666;">Total Anggota</div>
            </div>
            
            <div style="text-align: center; padding: 15px; background: #f8fafc; border-radius: 8px;">
                <div style="font-size: 32px; font-weight: bold; color: #f59e0b; margin-bottom: 5px;">
                    {{ $supplierCount ?? '0' }}
                </div>
                <div style="color: #666;">Total Supplier</div>
            </div>
            
            <div style="text-align: center; padding: 15px; background: #f8fafc; border-radius: 8px;">
                <div style="font-size: 32px; font-weight: bold; color: #8b5cf6; margin-bottom: 5px;">
                    {{ $pengirimanCount ?? '0' }}
                </div>
                <div style="color: #666;">Total Pengiriman</div>
            </div>
        </div>
    </div>

    <div style="text-align: center; padding: 20px;">
        <form method="POST" action="{{ route('admin.logout') }}" style="display: inline-block;">
            @csrf
            <button type="submit" style="background: #ef4444; color: white; padding: 12px 30px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; transition: background 0.3s;">
                <i class="fas fa-sign-out-alt" style="margin-right: 8px;"></i>Logout
            </button>
        </form>
    </div>

    <div style="text-align: center; margin-top: 30px; color: #666; font-size: 14px;">
        <p>UKK Management System &copy; {{ date('Y') }}</p>
    </div>
</div>

<style>
a:hover {
    opacity: 0.9;
}

button:hover {
    opacity: 0.9;
}
</style>
@endsection 