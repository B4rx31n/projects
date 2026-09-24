<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

include "koneksi.php";

// Query jumlah peserta per asal sekolah
$sql_per_sekolah = "SELECT asal_sekolah AS asal, COUNT(*) AS jumlah 
                    FROM data_siswa 
                    WHERE asal_sekolah != '' 
                    GROUP BY asal_sekolah 
                    ORDER BY jumlah DESC";
$res_per_sekolah = mysqli_query($conn, $sql_per_sekolah);

// Query jumlah peserta per universitas
$sql_per_universitas = "SELECT universitas AS asal, COUNT(*) AS jumlah 
                        FROM data_siswa 
                        WHERE universitas != '' 
                        GROUP BY universitas 
                        ORDER BY jumlah DESC";
$res_per_universitas = mysqli_query($conn, $sql_per_universitas);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Laporan PKL</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
:root {
    --primary: #4361ee;
    --primary-light: #4895ef;
    --secondary: #3f37c9;
    --dark: #1a1a2e;
    --light: #f8f9fa;
    --success: #4cc9f0;
    --danger: #f72585;
    --warning: #f8961e;
    --info: #560bad;
    --gray: #6c757d;
    --gray-light: #e9ecef;
}

/* Reset & Base Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Poppins', sans-serif;
    background-color: #f5f7ff;
    color: var(--dark);
    line-height: 1.6;
}

/* Layout */
.app-container {
    display: grid;
    grid-template-columns: 280px 1fr;
    min-height: 100vh;
}

/* Sidebar */
.sidebar {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: white;
    padding: 2rem 1.5rem;
    position: relative;
    z-index: 10;
    box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
}

.sidebar-header {
    display: flex;
    align-items: center;
    margin-bottom: 2.5rem;
}

.sidebar-header h2 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-left: 0.75rem;
}

.sidebar-logo {
    width: 40px;
    height: 40px;
    background-color: white;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary);
    font-weight: bold;
    font-size: 1.25rem;
}

.nav-menu {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.nav-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    color: rgba(255, 255, 255, 0.9);
    text-decoration: none;
    transition: all 0.3s ease;
}

.nav-item:hover, .nav-item.active {
    background-color: rgba(255, 255, 255, 0.15);
    color: white;
    transform: translateX(5px);
}

.nav-item i {
    margin-right: 0.75rem;
    font-size: 1.1rem;
}

.logout-btn {
    margin-top: auto;
    padding: 0.75rem 1rem;
    background-color: rgba(255, 255, 255, 0.1);
    border: none;
    border-radius: 8px;
    color: white;
    display: flex;
    align-items: center;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
    margin-top: 2rem;
}

.logout-btn:hover {
    background-color: rgba(255, 255, 255, 0.2);
    transform: translateX(5px);
}

.logout-btn i {
    margin-right: 0.75rem;
}

/* Main Content */
.main-content {
    padding: 2rem 3rem;
    overflow-y: auto;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.header h1 {
    font-size: 1.8rem;
    font-weight: 600;
    color: var(--dark);
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.action-buttons {
    display: flex;
    gap: 1rem;
}

.btn {
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 8px;
    font-family: inherit;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    text-decoration: none;
}

.btn-primary {
    background-color: var(--primary);
    color: white;
}

.btn-primary:hover {
    background-color: var(--secondary);
    transform: translateY(-2px);
}

.btn-success {
    background-color: var(--success);
    color: white;
}

.btn-success:hover {
    background-color: #3aa8d4;
    transform: translateY(-2px);
}

.btn-outline {
    background-color: transparent;
    border: 1px solid var(--primary);
    color: var(--primary);
}

.btn-outline:hover {
    background-color: rgba(67, 97, 238, 0.1);
}

/* Report Cards */
.report-card {
    background-color: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    margin-bottom: 2rem;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.report-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.report-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.report-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--dark);
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.report-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.report-icon.student {
    background-color: var(--success);
}

.report-icon.university {
    background-color: var(--info);
}

/* Tables */
.table-responsive {
    overflow-x: auto;
    margin-top: 1rem;
}

table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

thead {
    background-color: var(--primary);
    color: white;
}

th {
    padding: 1rem 1.5rem;
    text-align: left;
    font-weight: 500;
}

tbody tr {
    transition: background-color 0.2s ease;
}

tbody tr:nth-child(even) {
    background-color: rgba(248, 249, 250, 0.5);
}

tbody tr:hover {
    background-color: rgba(67, 97, 238, 0.05);
}

td {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--gray-light);
    color: var(--dark);
}

td.asal {
    font-weight: 600;
}

.no-data {
    text-align: center;
    padding: 2rem;
    color: var(--gray);
}

/* Responsive */
@media (max-width: 992px) {
    .app-container {
        grid-template-columns: 1fr;
    }
    
    .sidebar {
        position: fixed;
        top: 0;
        left: -280px;
        bottom: 0;
        transition: left 0.3s ease;
    }
    
    .sidebar.active {
        left: 0;
    }
    
    .main-content {
        padding: 1.5rem;
    }
}

@media (max-width: 768px) {
    .header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .action-buttons {
        width: 100%;
        flex-direction: column;
    }
    
    .btn {
        width: 100%;
    }
}
</style>
</head>
<body>
<div class="app-container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">PKL</div>
            <h2>PKL Dashboard</h2>
        </div>
        
        <nav class="nav-menu">
            <a href="dashboard.php" class="nav-item">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="laporan.php" class="nav-item active">
                <i class="fas fa-file-alt"></i>
                <span>Laporan</span>
            </a>
            <a href="pengaturan.php" class="nav-item">
                <i class="fas fa-cog"></i>
                <span>Pengaturan</span>
            </a>
        </nav>
        
        <button class="logout-btn" onclick="window.location.href='logout.php'">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </button>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <h1>
                <i class="fas fa-file-alt"></i>
                <span>Laporan PKL</span>
            </h1>
            <div class="action-buttons">
                <a href="laporan_pdf.php" target="_blank" class="btn btn-success">
                    <i class="fas fa-file-pdf"></i> Cetak PDF
                </a>
                <a href="dashboard.php" class="btn btn-outline">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Students Report -->
        <div class="report-card">
            <div class="report-header">
                <h2 class="report-title">
                    <i class="fas fa-user-graduate"></i>
                    <span>Peserta PKL SMK</span>
                </h2>
                <div class="report-icon student">
                    <i class="fas fa-school"></i>
                </div>
            </div>
            
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Asal Sekolah</th>
                            <th>Jumlah Peserta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($res_per_sekolah && mysqli_num_rows($res_per_sekolah) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($res_per_sekolah)): ?>
                            <tr>
                                <td class="asal"><?php echo htmlspecialchars($row['asal']); ?></td>
                                <td><?php echo (int)$row['jumlah']; ?></td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="2" class="no-data">
                                    <i class="fas fa-info-circle"></i> Data tidak tersedia
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- University Students Report -->
        <div class="report-card">
            <div class="report-header">
                <h2 class="report-title">
                    <i class="fas fa-user-tie"></i>
                    <span>Peserta PKL Mahasiswa</span>
                </h2>
                <div class="report-icon university">
                    <i class="fas fa-university"></i>
                </div>
            </div>
            
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Universitas</th>
                            <th>Jumlah Peserta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($res_per_universitas && mysqli_num_rows($res_per_universitas) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($res_per_universitas)): ?>
                            <tr>
                                <td class="asal"><?php echo htmlspecialchars($row['asal']); ?></td>
                                <td><?php echo (int)$row['jumlah']; ?></td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="2" class="no-data">
                                    <i class="fas fa-info-circle"></i> Data tidak tersedia
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<script>
// Responsive Sidebar Toggle (for mobile)
document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.createElement('button');
    sidebarToggle.innerHTML = '<i class="fas fa-bars"></i>';
    sidebarToggle.style.position = 'fixed';
    sidebarToggle.style.top = '20px';
    sidebarToggle.style.left = '20px';
    sidebarToggle.style.zIndex = '1000';
    sidebarToggle.style.background = 'var(--primary)';
    sidebarToggle.style.color = 'white';
    sidebarToggle.style.border = 'none';
    sidebarToggle.style.borderRadius = '50%';
    sidebarToggle.style.width = '40px';
    sidebarToggle.style.height = '40px';
    sidebarToggle.style.display = 'none';
    sidebarToggle.style.justifyContent = 'center';
    sidebarToggle.style.alignItems = 'center';
    sidebarToggle.style.cursor = 'pointer';
    sidebarToggle.style.boxShadow = '0 2px 10px rgba(0,0,0,0.2)';
    
    document.body.appendChild(sidebarToggle);
    
    const sidebar = document.querySelector('.sidebar');
    
    function checkScreenSize() {
        if (window.innerWidth <= 992) {
            sidebarToggle.style.display = 'flex';
            sidebar.classList.remove('active');
        } else {
            sidebarToggle.style.display = 'none';
            sidebar.classList.add('active');
        }
    }
    
    window.addEventListener('resize', checkScreenSize);
    checkScreenSize();
    
    sidebarToggle.addEventListener('click', () => {
        sidebar.classList.toggle('active');
    });
});
</script>
</body>
</html>