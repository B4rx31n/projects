<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan | Sistem Absensi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background-color: #f8f9fc; min-height: 100vh; }
        .main-content { margin-left: 250px; padding: 20px;}
        .topbar { display: flex; justify-content: space-between; align-items: center; padding: 15px 20px; background: white; border-radius: 10px; margin-bottom: 20px; box-shadow: 0 3px 10px rgba(0,0,0,0.05);}
        .page-title h1 { font-size: 24px; color: #5a5c69; margin-bottom: 5px;}
        .breadcrumb { font-size: 14px; color: #858796;}
        .breadcrumb a { color: #4e73df; text-decoration: none;}
        .table-container { background: white; border-radius: 10px; padding: 20px; box-shadow: 0 3px 10px rgba(0,0,0,0.05);}
        table { width: 100%; border-collapse: collapse;}
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #e3e6f0;}
        th { background: #f8f9fc; color: #5a5c69; font-weight: 600;}
        tr:last-child td { border-bottom: none;}
        tr:hover { background: #f8f9fc;}
        .btn-export { background: #4e73df; color: #fff; border: none; padding: 10px 24px; border-radius: 6px; font-size: 16px; cursor: pointer; transition: background 0.2s; margin-bottom: 18px;}
        .btn-export:hover { background: #2e59d9; }
        .footer { text-align: center; padding: 20px; margin-top: 30px; color: #858796; font-size: 14px; border-top: 1px solid #eaecf4;}
        @media (max-width: 992px) { .main-content { margin-left: 0; } }
        /* Sidebar style */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100%;
            background: linear-gradient(180deg, #4e73df 0%, #6f42c1 100%);
            color: white;
            z-index: 100;
        }
        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar-header h3 { font-size: 22px; margin: 10px 0 5px;}
        .sidebar-header p { font-size: 13px; opacity: 0.8;}
        .sidebar-menu { padding: 15px 0;}
        .sidebar-menu ul { list-style: none; margin: 0; padding: 0;}
        .sidebar-menu li { margin-bottom: 5px;}
        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            transition: all 0.3s;
        }
        .sidebar-menu a:hover, .sidebar-menu a.active {
            background: rgba(255,255,255,0.1);
            color: white;
            border-left: 4px solid white;
        }
        .sidebar-menu i { margin-right: 10px; font-size: 18px; width: 20px; text-align: center;}
    </style>
    <!-- jsPDF & AutoTable CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script>
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
            <li><a href="absensi.php"><i class="fas fa-calendar-check"></i> <span>Absensi</span></a></li>
            <li><a href="laporan.php" class="active"><i class="fas fa-chart-bar"></i> <span>Laporan</span></a></li>
            <li><a href="pengaturan.php"><i class="fas fa-cog"></i> <span>Pengaturan</span></a></li>
            <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
        </ul>
    </div>
</div>

<div class="main-content">
    <div class="topbar">
        <div class="page-title">
            <h1>Laporan</h1>
            <div class="breadcrumb">
                <a href="dashboard.php">Home</a> / <span>Laporan</span>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="table-container">
            <button class="btn-export" onclick="exportPDF()"><i class="fas fa-file-pdf"></i> Export PDF</button>
            <h2 style="margin-bottom:20px;"><i class="fas fa-users"></i> Data Karyawan</h2>
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
                    $karyawan = json_decode(file_get_contents("karyawan.json"), true);
                    $no = 1;
                    foreach ($karyawan as $k) {
                        $jabatan = isset($k['jabatan']) ? $k['jabatan'] : '-';
                        $kelurahan = isset($k['kelurahan']) ? $k['kelurahan'] : '-';
                        echo "<tr>
                            <td>{$no}</td>
                            <td>{$k['nama']}</td>
                            <td>{$jabatan}</td>
                            <td>{$kelurahan}</td>
                            <td>{$k['no_wa']}</td>
                        </tr>";
                        $no++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="footer">
        <p>&copy; <?php echo date('Y'); ?> Sistem Absensi Karyawan | Divisi IT</p>
    </div>
</div>

<script>
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
</html>