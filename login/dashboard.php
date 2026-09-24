<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

include "koneksi.php";

// Proses Tambah/Edit/Hapus
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $tahun = mysqli_real_escape_string($conn, $_POST['Tahun_PKL']);
    $lama = mysqli_real_escape_string($conn, $_POST['lama_pkl']);
    $asal_sekolah = '';
    $universitas = '';
    
    if ($_POST['action'] === 'tambah_siswa') {
        $asal_sekolah = mysqli_real_escape_string($conn, $_POST['asal_sekolah']);
    } elseif ($_POST['action'] === 'tambah_mahasiswa') {
        $universitas = mysqli_real_escape_string($conn, $_POST['universitas']);
    } elseif ($_POST['action'] === 'edit') {
        $id = (int)$_POST['id'];
        $asal_sekolah = mysqli_real_escape_string($conn, $_POST['asal_sekolah']);
        $universitas = mysqli_real_escape_string($conn, $_POST['universitas']);
        $sql_update = "UPDATE data_siswa SET 
                        nama='$nama',
                        asal_sekolah='$asal_sekolah',
                        universitas='$universitas',
                        Tahun_PKL='$tahun',
                        lama_pkl='$lama' 
                       WHERE id=$id";
        mysqli_query($conn, $sql_update);
        header("Location: dashboard.php");
        exit;
    }

    if ($_POST['action'] === 'tambah_siswa' || $_POST['action'] === 'tambah_mahasiswa') {
        $sql_insert = "INSERT INTO data_siswa (nama, asal_sekolah, universitas, Tahun_PKL, lama_pkl)
                       VALUES ('$nama','$asal_sekolah','$universitas','$tahun','$lama')";
        mysqli_query($conn, $sql_insert);
        header("Location: dashboard.php");
        exit;
    }
}

if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM data_siswa WHERE id=$id");
    header("Location: dashboard.php");
    exit;
}

$result_siswa = mysqli_query($conn, "SELECT * FROM data_siswa WHERE asal_sekolah <> '' ORDER BY nama ASC");
$result_mahasiswa = mysqli_query($conn, "SELECT * FROM data_siswa WHERE universitas <> '' ORDER BY nama ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard PKL</title>
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
    font-size: 2rem;
    font-weight: 600;
    color: var(--dark);
}

.user-profile {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: var(--primary-light);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
}

.user-name {
    font-weight: 500;
}

/* Cards */
.card-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2.5rem;
}

.card {
    background-color: white;
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.card-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--dark);
}

.card-icon {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.card-icon.student {
    background-color: var(--success);
}

.card-icon.university {
    background-color: var(--info);
}

.form-group {
    margin-bottom: 1rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: var(--dark);
}

.form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid var(--gray-light);
    border-radius: 8px;
    font-family: inherit;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
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
}

.btn-primary {
    background-color: var(--primary);
    color: white;
}

.btn-primary:hover {
    background-color: var(--secondary);
    transform: translateY(-2px);
}

.btn-block {
    display: block;
    width: 100%;
}

/* Tables */
.table-container {
    background-color: white;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    margin-bottom: 2rem;
}

.table-title {
    padding: 1.25rem 1.5rem;
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--dark);
    border-bottom: 1px solid var(--gray-light);
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.table-title i {
    color: var(--primary);
}

.table-responsive {
    overflow-x: auto;
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

.badge {
    display: inline-block;
    padding: 0.35rem 0.75rem;
    border-radius: 50px;
    font-size: 0.75rem;
    font-weight: 500;
}

.badge-student {
    background-color: rgba(76, 201, 240, 0.1);
    color: var(--success);
}

.badge-university {
    background-color: rgba(86, 11, 173, 0.1);
    color: var(--info);
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
}

.btn-sm {
    padding: 0.5rem 0.75rem;
    font-size: 0.875rem;
}

.btn-edit {
    background-color: rgba(67, 97, 238, 0.1);
    color: var(--primary);
}

.btn-edit:hover {
    background-color: rgba(67, 97, 238, 0.2);
}

.btn-delete {
    background-color: rgba(247, 37, 133, 0.1);
    color: var(--danger);
}

.btn-delete:hover {
    background-color: rgba(247, 37, 133, 0.2);
}

/* Modal */
.modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(26, 26, 46, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.modal.active {
    opacity: 1;
    visibility: visible;
}

.modal-content {
    background-color: white;
    border-radius: 12px;
    width: 100%;
    max-width: 500px;
    transform: translateY(20px);
    transition: all 0.3s ease;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.modal.active .modal-content {
    transform: translateY(0);
}

.modal-header {
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid var(--gray-light);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--dark);
}

.modal-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    color: var(--gray);
    transition: color 0.2s ease;
}

.modal-close:hover {
    color: var(--danger);
}

.modal-body {
    padding: 1.5rem;
}

.modal-footer {
    padding: 1rem 1.5rem;
    border-top: 1px solid var(--gray-light);
    display: flex;
    justify-content: flex-end;
    gap: 0.75rem;
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideIn {
    from { transform: translateY(20px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
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
    
    .card-container {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .user-profile {
        margin-top: 0.5rem;
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
            <a href="dashboard.php" class="nav-item active">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="laporan.php" class="nav-item">
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
            <h1>Selamat Datang, <?php echo htmlspecialchars($_SESSION["username"]); ?></h1>
            <div class="user-profile">
                <div class="user-avatar"><?php echo strtoupper(substr($_SESSION["username"], 0, 1)); ?></div>
                <span class="user-name"><?php echo htmlspecialchars($_SESSION["username"]); ?></span>
            </div>
        </div>

        <!-- Cards -->
        <div class="card-container">
            <!-- Add Student Card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Siswa</h3>
                    <div class="card-icon student">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                </div>
                <form method="POST" action="">
                    <input type="hidden" name="action" value="tambah_siswa">
                    <div class="form-group">
                        <label for="student-name">Nama Lengkap</label>
                        <input type="text" id="student-name" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="student-school">Asal Sekolah</label>
                        <input type="text" id="student-school" name="asal_sekolah" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="student-start">Tanggal Mulai</label>
                        <input type="date" id="student-start" name="Tahun_PKL" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="student-end">Tanggal Selesai</label>
                        <input type="date" id="student-end" name="lama_pkl" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-plus"></i> Tambah Siswa
                    </button>
                </form>
            </div>

            <!-- Add University Student Card -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Mahasiswa</h3>
                    <div class="card-icon university">
                        <i class="fas fa-user-tie"></i>
                    </div>
                </div>
                <form method="POST" action="">
                    <input type="hidden" name="action" value="tambah_mahasiswa">
                    <div class="form-group">
                        <label for="university-name">Nama Lengkap</label>
                        <input type="text" id="university-name" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="university-name">Universitas</label>
                        <input type="text" id="university-name" name="universitas" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="university-start">Tanggal Mulai</label>
                        <input type="date" id="university-start" name="Tahun_PKL" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="university-end">Tanggal Selesai</label>
                        <input type="date" id="university-end" name="lama_pkl" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-plus"></i> Tambah Mahasiswa
                    </button>
                </form>
            </div>
        </div>

        <!-- Students Table -->
        <div class="table-container">
            <div class="table-title">
                <i class="fas fa-user-graduate"></i>
                <span>Daftar Siswa PKL</span>
            </div>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Asal Sekolah</th>
                            <th>Mulai PKL</th>
                            <th>Selesai PKL</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; while($row=mysqli_fetch_assoc($result_siswa)): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['asal_sekolah']) ?></td>
                            <td><?= htmlspecialchars($row['Tahun_PKL']) ?></td>
                            <td><?= htmlspecialchars($row['lama_pkl']) ?></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-edit" 
                                            data-id="<?= $row['id'] ?>"
                                            data-nama="<?= htmlspecialchars($row['nama'], ENT_QUOTES) ?>"
                                            data-sekolah="<?= htmlspecialchars($row['asal_sekolah'], ENT_QUOTES) ?>"
                                            data-universitas=""
                                            data-tahun="<?= $row['Tahun_PKL'] ?>"
                                            data-lama="<?= $row['lama_pkl'] ?>">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <a href="?hapus=<?= $row['id'] ?>" class="btn btn-sm btn-delete" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- University Students Table -->
        <div class="table-container">
            <div class="table-title">
                <i class="fas fa-user-tie"></i>
                <span>Daftar Mahasiswa PKL</span>
            </div>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Universitas</th>
                            <th>Mulai PKL</th>
                            <th>Selesai PKL</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; while($row=mysqli_fetch_assoc($result_mahasiswa)): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['universitas']) ?></td>
                            <td><?= htmlspecialchars($row['Tahun_PKL']) ?></td>
                            <td><?= htmlspecialchars($row['lama_pkl']) ?></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-edit" 
                                            data-id="<?= $row['id'] ?>"
                                            data-nama="<?= htmlspecialchars($row['nama'], ENT_QUOTES) ?>"
                                            data-sekolah=""
                                            data-universitas="<?= htmlspecialchars($row['universitas'], ENT_QUOTES) ?>"
                                            data-tahun="<?= $row['Tahun_PKL'] ?>"
                                            data-lama="<?= $row['lama_pkl'] ?>">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <a href="?hapus=<?= $row['id'] ?>" class="btn btn-sm btn-delete" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<!-- Edit Modal -->
<div class="modal" id="editModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Edit Data PKL</h3>
            <button class="modal-close">&times;</button>
        </div>
        <div class="modal-body">
            <form method="POST" action="">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" name="id" id="editId">
                <div class="form-group">
                    <label for="editNama">Nama Lengkap</label>
                    <input type="text" id="editNama" name="nama" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="editSekolah">Asal Sekolah</label>
                    <input type="text" id="editSekolah" name="asal_sekolah" class="form-control">
                </div>
                <div class="form-group">
                    <label for="editUniversitas">Universitas</label>
                    <input type="text" id="editUniversitas" name="universitas" class="form-control">
                </div>
                <div class="form-group">
                    <label for="editTahun">Tanggal Mulai PKL</label>
                    <input type="date" id="editTahun" name="Tahun_PKL" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="editLama">Tanggal Selesai PKL</label>
                    <input type="date" id="editLama" name="lama_pkl" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary modal-close">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Edit Modal Functionality
document.addEventListener('DOMContentLoaded', function() {
    const editButtons = document.querySelectorAll('.btn-edit');
    const modal = document.getElementById('editModal');
    const modalClose = document.querySelectorAll('.modal-close');
    
    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            document.getElementById('editId').value = button.dataset.id;
            document.getElementById('editNama').value = button.dataset.nama;
            document.getElementById('editSekolah').value = button.dataset.sekolah;
            document.getElementById('editUniversitas').value = button.dataset.universitas;
            document.getElementById('editTahun').value = button.dataset.tahun;
            document.getElementById('editLama').value = button.dataset.lama;
            
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    });
    
    modalClose.forEach(button => {
        button.addEventListener('click', () => {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        });
    });
    
    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    });
});

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