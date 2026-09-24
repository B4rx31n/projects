<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Absensi | Sistem Absensi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4e73df;
            --primary-dark: #6f42c1;
            --secondary: #858796;
            --success: #1cc88a;
            --warning: #f6c23e;
            --danger: #e74a3b;
            --light: #f8f9fc;
            --dark: #5a5c69;
            --card-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            --transition: all 0.3s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background-color: #f8f9fc;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            color: var(--dark);
        }
        
        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: var(--transition);
        }
        
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: white;
            border-radius: 12px;
            margin-bottom: 24px;
            box-shadow: var(--card-shadow);
        }
        
        .page-title h1 {
            font-size: 24px;
            color: var(--dark);
            margin-bottom: 5px;
            font-weight: 600;
        }
        
        .breadcrumb {
            font-size: 14px;
            color: var(--secondary);
        }
        
        .breadcrumb a {
            color: var(--primary);
            text-decoration: none;
            transition: var(--transition);
        }
        
        .breadcrumb a:hover {
            text-decoration: underline;
        }
        
        .card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            box-shadow: var(--card-shadow);
            margin-bottom: 24px;
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e3e6f0;
        }
        
        .card-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--dark);
            display: flex;
            align-items: center;
        }
        
        .card-title i {
            margin-right: 10px;
            color: var(--primary);
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 16px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            border: none;
        }
        
        .btn-primary {
            background: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
        }
        
        .btn-outline {
            background: transparent;
            color: var(--primary);
            border: 1px solid var(--primary);
        }
        
        .btn-outline:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }
        
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 8px;
            overflow: hidden;
        }
        
        th, td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid #e3e6f0;
        }
        
        th {
            background: #f8f9fc;
            color: var(--dark);
            font-weight: 600;
            position: relative;
        }
        
        th:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 1px;
            background: #e3e6f0;
        }
        
        tr:last-child td {
            border-bottom: none;
        }
        
        tr:hover {
            background: #f8f9fc;
        }
        
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .status-hadir {
            background: rgba(28, 200, 138, 0.2);
            color: var(--success);
        }
        
        .status-terlambat {
            background: rgba(246, 194, 62, 0.2);
            color: var(--warning);
        }
        
        .status-tidak-hadir {
            background: rgba(231, 74, 59, 0.2);
            color: var(--danger);
        }
        
        .footer {
            text-align: center;
            padding: 24px;
            margin-top: 30px;
            color: var(--secondary);
            font-size: 14px;
            border-top: 1px solid #eaecf4;
        }
        
        /* Sidebar styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100%;
            background: linear-gradient(180deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            z-index: 100;
            transition: var(--transition);
        }
        
        .sidebar-header {
            padding: 24px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-header h3 {
            font-size: 22px;
            margin: 10px 0 5px;
            font-weight: 600;
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
            margin: 0;
            padding: 0;
        }
        
        .sidebar-menu li {
            margin-bottom: 5px;
        }
        
        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            transition: var(--transition);
        }
        
        .sidebar-menu a:hover, .sidebar-menu a.active {
            background: rgba(255,255,255,0.1);
            color: white;
            border-left: 4px solid white;
        }
        
        .sidebar-menu i {
            margin-right: 10px;
            font-size: 18px;
            width: 20px;
            text-align: center;
        }
        
        .export-container {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }
        
        @media (max-width: 992px) {
            .main-content {
                margin-left: 0;
            }
            
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
        }
        
        @media (max-width: 768px) {
            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .export-container {
                margin-top: 15px;
                width: 100%;
                justify-content: flex-start;
            }
        }
        
        @media (max-width: 576px) {
            .table-container {
                overflow-x: auto;
            }
            
            table {
                min-width: 600px;
            }
            
            .main-content {
                padding: 15px;
            }
            
            .topbar {
                padding: 15px;
            }
        }
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
            <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
            <li><a href="karyawan.php"><i class="fas fa-users"></i> <span>Data Karyawan</span></a></li>
            <li><a href="absensi.php" class="active"><i class="fas fa-calendar-check"></i> <span>Absensi</span></a></li>
            <li><a href="laporan.php"><i class="fas fa-chart-bar"></i> <span>Laporan</span></a></li>
            <li><a href="pengaturan.php"><i class="fas fa-cog"></i> <span>Pengaturan</span></a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
        </ul>
    </div>
</div>

<div class="main-content">
    <div class="topbar">
        <div class="page-title">
            <h1>Absensi</h1>
            <div class="breadcrumb">
                <a href="dashboard.php">Home</a> / <span>Absensi</span>
            </div>
        </div>
    </div>

    <div class="content">
        <div<div class="card-header">
    <h2 class="card-title"><i class="fas fa-calendar-check"></i> Riwayat Absensi Hari Ini</h2>
    <div class="export-container">
        <button class="btn btn-outline" id="export-btn">
            <i class="fas fa-file-pdf"></i> Export PDF
        </button>
    </div>
</div>

<div class="table-container">
    <table id="absensi-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jabatan</th>
                <th>Kel/Kec</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $tanggal = date('Y-m-d');
            $karyawan = json_decode(file_get_contents("karyawan.json"), true);
            $karyawanMap = [];
            foreach ($karyawan as $k) {
                $karyawanMap[$k['nama']] = $k;
            }

            $result = $conn->query("SELECT * FROM absensi WHERE tanggal='$tanggal' ORDER BY jam ASC");
            $absensiHariIni = [];
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $absensiHariIni[$row['nama']] = $row['jam'];
                }
            }

            $no = 1;
            foreach ($karyawan as $k) {
                $namaKey = $k['nama'];
                $nama = $k['nama'];
                $jabatan = isset($k['jabatan']) ? $k['jabatan'] : '-';
                $kelurahan = isset($k['kelurahan']) ? $k['kelurahan'] : '-';

                if (isset($absensiHariIni[$namaKey])) {
                    $jam = $absensiHariIni[$namaKey];
                    $statusClass = ($jam > '09:00:00') ? 'status-terlambat' : 'status-hadir';
                    $statusText = ($jam > '09:00:00') ? 'Terlambat' : 'Hadir';
                } else {
                    $jam = '-';
                    $statusClass = 'status-tidak-hadir';
                    $statusText = 'Tidak Hadir';
                }

                echo "<tr>
                    <td>{$no}</td>
                    <td>{$nama}</td>
                    <td>{$jabatan}</td>
                    <td>{$kelurahan}</td>
                    <td>{$tanggal}</td>
                    <td>{$jam}</td>
                    <td><span class='status-badge {$statusClass}'>{$statusText}</span></td>
                </tr>";
                $no++;
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Script export (dynamic load supaya tidak mempengaruhi sidebar) -->
<script>
/**
 * Load script secara dinamis dan tunggu sampai selesai
 */
function loadScript(src) {
    return new Promise((resolve, reject) => {
        // kalau udah ter-load jangan load ulang
        if (document.querySelector('script[src="' + src + '"]')) return resolve();
        const s = document.createElement('script');
        s.src = src;
        s.onload = () => resolve();
        s.onerror = () => reject(new Error('Gagal load ' + src));
        document.head.appendChild(s);
    });
}

async function exportPDF() {
    try {
        // load jsPDF + autotable hanya saat dibutuhkan
        if (!window.jspdf) {
            await loadScript('https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js');
            await loadScript('https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js');
        }

        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        doc.setFontSize(14);
        doc.text("Riwayat Absensi Hari Ini", 14, 15);

        // fallback: kalau tabel kosong, tampilkan alert sederhana
        const table = document.getElementById('absensi-table');
        if (!table || table.tBodies.length === 0 || table.tBodies[0].rows.length === 0) {
            alert('Tabel kosong — tidak ada data untuk diekspor.');
            return;
        }

        doc.autoTable({
            html: '#absensi-table',
            startY: 20,
            headStyles: { fillColor: [78, 115, 223] },
            styles: { fontSize: 10, cellPadding: 2 }
        });

        const today = new Date().toISOString().slice(0,10);
        doc.save('absensi_' + today + '.pdf');
    } catch (err) {
        console.error('Export PDF error:', err);
        alert('Gagal membuat PDF (cek console).');
    }
}

// pasang listener ke tombol (lebih aman ketimbang inline onclick)
document.getElementById('export-btn').addEventListener('click', exportPDF);
</script>


</body>
</html>