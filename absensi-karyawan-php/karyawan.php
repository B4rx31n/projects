<?php
// Ambil data dari JSON
$karyawan = json_decode(file_get_contents("karyawan.json"), true);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karyawan | Sistem Absensi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        
        /* Table Container */
        .table-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-bottom: 20px;
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
            display: flex;
            align-items: center;
            gap: 10px;
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
            text-decoration: none;
        }
        
        .btn-primary {
            background: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background: #3a59c7;
        }
        
        .btn-success {
            background: var(--success);
            color: white;
        }
        
        .btn-success:hover {
            background: #17a673;
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
            position: sticky;
            top: 0;
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
        
        .status-warning {
            background: rgba(246, 194, 62, 0.1);
            color: var(--warning);
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
        
        /* Search and Filter */
        .search-filter {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        
        .search-box {
            position: relative;
            flex: 1;
            min-width: 250px;
        }
        
        .search-box input {
            width: 100%;
            padding: 10px 15px 10px 40px;
            border: 1px solid #d1d3e2;
            border-radius: 6px;
            font-size: 14px;
        }
        
        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #b7b9cc;
        }
        
        .filter-select {
            padding: 10px 15px;
            border: 1px solid #d1d3e2;
            border-radius: 6px;
            font-size: 14px;
            background: white;
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
            
            .search-filter {
                flex-direction: column;
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
        
        .action-buttons {
            display: flex;
            gap: 5px;
        }
        
        .action-btn {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            cursor: pointer;
            border: none;
            display: flex;
            align-items: center;
            gap: 3px;
        }
        
        .btn-edit {
            background: rgba(54, 185, 204, 0.1);
            color: var(--info);
            border: 1px solid rgba(54, 185, 204, 0.2);
        }
        
        .btn-delete {
            background: rgba(231, 74, 59, 0.1);
            color: var(--danger);
            border: 1px solid rgba(231, 74, 59, 0.2);
        }
        
        .btn-view {
            background: rgba(78, 115, 223, 0.1);
            color: var(--primary);
            border: 1px solid rgba(78, 115, 223, 0.2);
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            gap: 5px;
        }
        
        .pagination button {
            padding: 8px 12px;
            border: 1px solid #d1d3e2;
            background: white;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .pagination button.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }
    </style>
    <!-- jsPDF & AutoTable -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
</head>
<body>
    <!-- Sidebar -->
     <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <i class="fas fa-fingerprint fa-2x"></i>
            <h3>Sistem Absensi</h3>
            <p>Panel Admin</p>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
                <li><a href="karyawan.php" class="active"><i class="fas fa-users"></i> <span>Data Karyawan</span></a></li>
                <li><a href="absensi.php"><i class="fas fa-calendar-check"></i> <span>Absensi</span></a></li>
                <li><a href="laporan.php"><i class="fas fa-chart-bar"></i> <span>Laporan</span></a></li>
                <li><a href="pengaturan.php"><i class="fas fa-cog"></i> <span>Pengaturan</span></a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <div class="page-title">
                <h1>Data Karyawan</h1>
                <div class="breadcrumb">
                    <a href="dashboard.php">Home</a> / <span>Data Karyawan</span>
                </div>
            </div>
            <div class="user-info">
                <img src="https://ui-avatars.com/api/?name=Admin&background=4e73df&color=fff" alt="Admin">
                <div class="user-details">
                    <div class="name">Administrator</div>
                    <div class="role">Super Admin</div>
                </div>
            </div>
        </div>

        <!-- Table Container -->
        <div class="table-container">
            <div class="table-header">
                <h2><i class="fas fa-users"></i> Daftar Karyawan</h2>
                <div class="actions">
                    <button class="btn btn-outline" onclick="exportPDF()"><i class="fas fa-file-pdf"></i> Export PDF</button>
                    <button class="btn btn-primary" id="refresh-btn"><i class="fas fa-sync"></i> Refresh</button>
                </div>
            </div>

            <!-- Search -->
            <div class="search-filter">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="search-input" placeholder="Cari karyawan...">
                </div>
            </div>
            
            <table id="karyawan-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Kel/Kec</th>
            <th>No. WA</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $no = 1;
    if (!empty($karyawan)) {
        foreach ($karyawan as $k) {
            $nama = $k['nama'];
            $jabatan = $k['jabatan'];
            $kelurahan = isset($k['kelurahan']) ? $k['kelurahan'] : "-";
            $no_wa = $k['no_wa'];
            echo "<tr>
                <td>{$no}</td>
                <td>{$nama}</td>
                <td>{$jabatan}</td>
                <td>{$kelurahan}</td>
                <td>{$no_wa}</td>
            </tr>";
            $no++;
        }
    } else {
        echo "<tr><td colspan='5' style='text-align:center;'>Tidak ada data karyawan</td></tr>";
    }
    ?>
    </tbody>
</table>

        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; <?php echo date('Y'); ?> Sistem Absensi Karyawan | Divisi IT</p>
        </div>
    </div>

<script>
    // Refresh
    document.getElementById('refresh-btn').addEventListener('click', function() {
        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memuat...';
        setTimeout(() => { window.location.reload(); }, 1000);
    });

    // Search
    document.getElementById('search-input').addEventListener('input', function() {
        const searchValue = this.value.toLowerCase();
        const rows = document.querySelectorAll('#karyawan-table tbody tr');
        rows.forEach(row => {
            const nama = row.cells[1].textContent.toLowerCase();
            const jabatan = row.cells[2].textContent.toLowerCase();
            const kelurahan = row.cells[3].textContent.toLowerCase();
            if (nama.includes(searchValue) || jabatan.includes(searchValue) || kelurahan.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Export PDF
    function exportPDF() {
        const { jsPDF } = window.jspdf;
        var doc = new jsPDF();
        doc.text("Data Karyawan", 14, 15);
        doc.autoTable({
            html: '#karyawan-table',
            startY: 20,
            headStyles: { fillColor: [78, 115, 223] }
        });
        doc.save('data_karyawan.pdf');
    }
</script>
</body>
</html><?phpexit;