<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Admin | Sistem Absensi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        :root {
            --primary: #4e73df;
            --secondary: #6f42c1;
            --success: #1cc88a;
            --info: #36b9cc;
            --warning: #f6c23e;
            --danger: #e74a3b;
            --light: #f8f9fc;
            --dark: #5a5c69;
        }
        
        body {
            background-color: #f8f9fc;
            min-height: 100vh;
        }
        
        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100%;
            background: linear-gradient(180deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            transition: all 0.3s;
            z-index: 1000;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
        
        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-header h3 {
            font-size: 22px;
            margin: 10px 0 5px;
        }
        
        .sidebar-header p {
            font-size: 13px;
            opacity: 0.8;
        }
        
        .sidebar-menu {
            padding: 15px 0;
        }
        
        .sidebar-menu ul {
            list-style: none;
        }
        
        .sidebar-menu li {
            margin-bottom: 5px;
        }
        
        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .sidebar-menu a:hover, .sidebar-menu a.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-left: 4px solid white;
        }
        
        .sidebar-menu i {
            margin-right: 10px;
            font-size: 18px;
            width: 20px;
            text-align: center;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: all 0.3s;
        }
        
        /* Topbar */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background: white;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }
        
        .page-title h1 {
            font-size: 24px;
            color: var(--dark);
            margin-bottom: 5px;
        }
        
        .breadcrumb {
            font-size: 14px;
            color: #858796;
        }
        
        .breadcrumb a {
            color: var(--primary);
            text-decoration: none;
        }
        
        .user-info {
            display: flex;
            align-items: center;
        }
        
        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }
        
        .user-details {
            text-align: right;
        }
        
        .user-details .name {
            font-weight: 600;
            color: var(--dark);
        }
        
        .user-details .role {
            font-size: 13px;
            color: #858796;
        }
        
        /* Cards */
        .cards-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .card-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            font-size: 24px;
        }
        
        .bg-primary { background: rgba(78, 115, 223, 0.1); color: var(--primary); }
        .bg-success { background: rgba(28, 200, 138, 0.1); color: var(--success); }
        .bg-warning { background: rgba(246, 194, 62, 0.1); color: var(--warning); }
        .bg-danger { background: rgba(231, 74, 59, 0.1); color: var(--danger); }
        
        .card h2 {
            font-size: 28px;
            margin-bottom: 5px;
            color: var(--dark);
        }
        
        .card p {
            color: #858796;
            font-size: 14px;
        }
        
        /* Table */
        .table-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }
        
        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .table-header h2 {
            color: var(--dark);
            font-size: 18px;
        }
        
        .actions {
            display: flex;
            gap: 10px;
        }
        
        .btn {
            padding: 8px 15px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .btn-primary {
            background: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background: #3a59c7;
        }
        
        .btn-outline {
            background: transparent;
            border: 1px solid #d1d3e2;
            color: var(--dark);
        }
        
        .btn-outline:hover {
            background: #f8f9fc;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e3e6f0;
        }
        
        th {
            background: #f8f9fc;
            color: var(--dark);
            font-weight: 600;
        }
        
        tr:last-child td {
            border-bottom: none;
        }
        
        tr:hover {
            background: #f8f9fc;
        }
        
        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
            display: inline-block;
        }
        
        .status-success {
            background: rgba(28, 200, 138, 0.1);
            color: var(--success);
        }
        
        /* Footer */
        .footer {
            text-align: center;
            padding: 20px;
            margin-top: 30px;
            color: #858796;
            font-size: 14px;
            border-top: 1px solid #eaecf4;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                width: 80px;
                text-align: center;
            }
            
            .sidebar-header h3, .sidebar-header p, .sidebar-menu span {
                display: none;
            }
            
            .sidebar-menu i {
                margin-right: 0;
                font-size: 20px;
            }
            
            .sidebar-menu a {
                justify-content: center;
                padding: 15px;
            }
            
            .main-content {
                margin-left: 80px;
            }
        }
        
        @media (max-width: 768px) {
            .cards-row {
                grid-template-columns: 1fr;
            }
            
            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .user-info {
                margin-top: 15px;
            }
            
            .table-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .actions {
                margin-top: 15px;
                flex-wrap: wrap;
            }
        }
        
        @media (max-width: 576px) {
            .sidebar {
                width: 0;
                overflow: hidden;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .table-container {
                overflow-x: auto;
            }
            
            table {
                min-width: 600px;
            }
        }
    </style>
</head>
<body>
    @if(session('success'))
    <div style="background-color: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 15px; margin: 20px; border-radius: 5px; text-align: center;">
        {{ session('success') }}
    </div>
    @endif

    <!-- Sidebar -->
    <div class="sidebar">
    <div class="sidebar-header">
        <i class="fas fa-fingerprint fa-2x"></i>
        <h3>Sistem Absensi</h3>
        <p>Panel Admin</p>
    </div>
    <div class="sidebar-menu">
        <ul>
            <li><a href="{{ url('/dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
            <li><a href="{{ url('/karyawan') }}" class="{{ request()->is('karyawan') ? 'active' : '' }}"><i class="fas fa-users"></i> <span>Data Karyawan</span></a></li>
            <li><a href="{{ url('/absensi') }}" class="{{ request()->is('absensi') ? 'active' : '' }}"><i class="fas fa-calendar-check"></i> <span>Absensi</span></a></li>
            <li><a href="{{ url('/laporan') }}" class="{{ request()->is('laporan') ? 'active' : '' }}"><i class="fas fa-chart-bar"></i> <span>Laporan</span></a></li>
            <li><a href="{{ url('/pengaturan') }}" class="{{ request()->is('pengaturan') ? 'active' : '' }}"><i class="fas fa-cog"></i> <span>Pengaturan</span></a></li>
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

<!-- Main Content -->
<div class="main-content">
    <!-- Topbar -->
    <div class="topbar">
        <div class="page-title">
            <h1>Dashboard Admin</h1>
            <div class="breadcrumb">
                <a href="#">Home</a> / <span>Dashboard</span>
            </div>
        </div>
        <div class="user-info">
            <img src="https://ui-avatars.com/api/?name=Admin&background=4e73df&color=fff" alt="Admin" />
            <div class="user-details">
                <div class="name">Administrator</div>
                <div class="role">Super Admin</div>
            </div>
        </div>
    </div>

    <!-- Cards Row -->
    <div class="cards-row">
        <div class="card">
            <div class="card-icon bg-primary">
                <i class="fas fa-users"></i>
            </div>
            <h2>{{ $totalKaryawan }}</h2>
            <p>Total Karyawan</p>
        </div>
        <div class="card">
            <div class="card-icon bg-success">
                <i class="fas fa-calendar-check"></i>
            </div>
            <h2>{{ $hadirHariIni }}</h2>
            <p>Hadir Hari Ini</p>
        </div>
        <div class="card">
            <div class="card-icon bg-warning">
                <i class="fas fa-user-clock"></i>
            </div>
            <h2>{{ $terlambat }}</h2>
            <p>Terlambat</p>
        </div>
        <div class="card">
            <div class="card-icon bg-danger">
                <i class="fas fa-user-slash"></i>
            </div>
            <h2>{{ $tidakHadir }}</h2>
            <p>Tidak Hadir</p>
        </div>
    </div>

    <!-- Table -->
    <div class="table-container">
        <div class="table-header">
            <h2><i class="fas fa-history"></i> Riwayat Absensi Terbaru</h2>
            <div class="actions">
                <button class="btn btn-outline"><i class="fas fa-download"></i> Export</button>
                <button class="btn btn-primary" onclick="location.reload()"><i class="fas fa-sync"></i> Refresh</button>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Kel/Kec</th>
                    <th>Jam</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($absensiTerbaru as $absensi)
                    @php
                        $namaKey = $absensi->nama;
                        $nama = $karyawanMap[$namaKey]['nama'] ?? $namaKey;
                        $jabatan = $karyawanMap[$namaKey]['jabatan'] ?? '-';
                        $kelurahan = $karyawanMap[$namaKey]['kelurahan'] ?? '-';
                    @endphp
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $nama }}</td>
                        <td>{{ $jabatan }}</td>
                        <td>{{ $kelurahan }}</td>
                        <td>{{ \Carbon\Carbon::parse($absensi->jam)->format('H:i') }}</td>
                        <td>
                            <form action="{{ route('dashboard.hapus', ['id' => $absensi->id]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline" style="color:#e74a3b;">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2023 Sistem Absensi Karyawan | Divisi IT</p>
    </div>
</div>

</body>
</html>
