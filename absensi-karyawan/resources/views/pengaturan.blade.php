<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pengaturan | Sistem Absensi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body { background-color: #f8f9fc; min-height: 100vh; }
        .main-content { margin-left: 250px; padding: 20px; }
        .topbar { display: flex; justify-content: space-between; align-items: center; padding: 15px 20px; background: white; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 3px 10px rgba(0,0,0,0.05); }
        .page-title h1 { font-size: 24px; color: #5a5c69; margin-bottom: 5px; }
        .breadcrumb { font-size: 14px; color: #858796; }
        .breadcrumb a { color: #4e73df; text-decoration: none; }
        .settings-container { background: white; border-radius: 10px; padding: 30px 24px; box-shadow: 0 3px 10px rgba(0,0,0,0.05); max-width: 500px; margin-bottom: 30px; }
        .settings-title { font-size: 20px; color: #4e73df; margin-bottom: 20px; display: flex; align-items: center; }
        .settings-title i { margin-right: 10px; }
        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; margin-bottom: 6px; color: #5a5c69; font-weight: 500; }
        .form-group input[type="text"], .form-group input[type="time"], .form-group input[type="password"] {
            width: 100%; padding: 10px 12px; border: 1px solid #d1d3e2; border-radius: 6px; font-size: 16px; background: #f8f9fc;
        }
        .form-group input:focus { border-color: #4e73df; outline: none; }
        .btn-save {
            background: #4e73df; color: #fff; border: none; padding: 10px 28px; border-radius: 6px; font-size: 16px; cursor: pointer; transition: background 0.2s;
        }
        .btn-save:hover { background: #2e59d9; }
        .footer { text-align: center; padding: 20px; margin-top: 30px; color: #858796; font-size: 14px; border-top: 1px solid #eaecf4; }
        @media (max-width: 992px) { .main-content { margin-left: 0; } .settings-container { max-width: 100%; } }
        /* Sidebar style */
        .sidebar {
            position: fixed; top: 0; left: 0; width: 250px; height: 100%;
            background: linear-gradient(180deg, #4e73df 0%, #6f42c1 100%);
            color: white; z-index: 100;
        }
        .sidebar-header {
            padding: 20px; text-align: center; border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar-header h3 { font-size: 22px; margin: 10px 0 5px; }
        .sidebar-header p { font-size: 13px; opacity: 0.8; }
        .sidebar-menu { padding: 15px 0; }
        .sidebar-menu ul { list-style: none; margin: 0; padding: 0; }
        .sidebar-menu li { margin-bottom: 5px; }
        .sidebar-menu a {
            display: flex; align-items: center; padding: 12px 20px;
            color: rgba(255,255,255,0.9); text-decoration: none; transition: all 0.3s;
        }
        .sidebar-menu a:hover, .sidebar-menu a.active {
            background: rgba(255,255,255,0.1); color: white; border-left: 4px solid white;
        }
        .sidebar-menu i { margin-right: 10px; font-size: 18px; width: 20px; text-align: center; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <i class="fas fa-fingerprint fa-2x"></i>
            <h3>Sistem Absensi</h3>
            <p>Panel Admin</p>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li><a href="{{ url('/dashboard') }}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
                <li><a href="{{ url('/karyawan') }}"><i class="fas fa-users"></i> <span>Data Karyawan</span></a></li>
                <li><a href="{{ url('/absensi') }}"><i class="fas fa-calendar-check"></i> <span>Absensi</span></a></li>
                <li><a href="{{ url('/laporan') }}"><i class="fas fa-chart-bar"></i> <span>Laporan</span></a></li>
                <li><a href="{{ url('/pengaturan') }}" class="active"><i class="fas fa-cog"></i> <span>Pengaturan</span></a></li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <div class="topbar">
            <div class="page-title">
                <h1>Pengaturan</h1>
                <div class="breadcrumb">
                    <a href="{{ url('/dashboard') }}">Home</a> / <span>Pengaturan</span>
                </div>
            </div>
        </div>
        <div class="settings-container">
            @if(session('success'))
                <div class="alert alert-success" style="color: green; margin-bottom: 15px;">{{ session('success') }}</div>
            @endif
            <form method="POST" action="{{ route('pengaturan.save') }}">
                @csrf
                <div class="form-group">
                    <label for="app_name">Nama Aplikasi</label>
                    <input type="text" id="app_name" name="app_name" value="{{ old('app_name', $settings['app_name'] ?? 'Sistem Absensi Karyawan') }}" required>
                </div>
                <div class="form-group">
                    <label for="jam_masuk">Jam Masuk</label>
                    <input type="time" id="jam_masuk" name="jam_masuk" value="{{ old('jam_masuk', $settings['jam_masuk'] ?? '08:00') }}" required>
                </div>
                <div class="form-group">
                    <label for="admin_pass">Password Admin</label>
                    <input type="password" id="admin_pass" name="admin_pass" placeholder="********" />
                </div>
                <button type="submit" class="btn-save"><i class="fas fa-save"></i> Simpan Perubahan</button>
            </form>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Sistem Absensi Karyawan | Divisi IT</p>
        </div>
    </div>
</body>
</html>
