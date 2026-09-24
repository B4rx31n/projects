<?php
session_start();

// Cek login
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

// Pesan notifikasi
$msg = $_SESSION['msg'] ?? '';
unset($_SESSION['msg']);

// Tema default
$tema = $_SESSION['tema'] ?? 'terang';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengaturan Akun</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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

    /* Dark Mode Variables */
    :root.dark-mode {
        --dark: #f8f9fa;
        --light: #1a1a2e;
        --gray-light: #2a2a3a;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: var(--light);
        color: var(--dark);
        line-height: 1.6;
        transition: background-color 0.3s ease, color 0.3s ease;
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
        color: var(--primary);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    /* Settings Cards */
    .settings-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 1.5rem;
    }

    .settings-card {
        background-color: var(--gray-light);
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .settings-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .settings-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    .settings-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--primary);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .settings-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        background-color: var(--primary);
    }

    .form-group {
        margin-bottom: 1.25rem;
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
        border: 1px solid rgba(67, 97, 238, 0.3);
        border-radius: 8px;
        font-family: inherit;
        background-color: var(--light);
        color: var(--dark);
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
    }

    /* Buttons */
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

    .btn-warning {
        background-color: var(--warning);
        color: white;
    }

    .btn-warning:hover {
        background-color: #e07e0e;
    }

    .btn-success {
        background-color: var(--success);
        color: white;
    }

    .btn-success:hover {
        background-color: #3aa8d4;
    }

    .btn-outline {
        background-color: transparent;
        border: 1px solid var(--primary);
        color: var(--primary);
    }

    .btn-outline:hover {
        background-color: rgba(67, 97, 238, 0.1);
    }

    .btn-block {
        display: block;
        width: 100%;
    }

    /* Toggle Switch */
    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .toggle-slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: .4s;
        border-radius: 34px;
    }

    .toggle-slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        transition: .4s;
        border-radius: 50%;
    }

    input:checked + .toggle-slider {
        background-color: var(--primary);
    }

    input:checked + .toggle-slider:before {
        transform: translateX(26px);
    }

    .toggle-label {
        margin-left: 0.5rem;
        font-weight: 500;
    }

    .toggle-container {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }

    /* Alert */
    .alert {
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .alert-info {
        background-color: rgba(76, 201, 240, 0.2);
        color: var(--success);
        border: 1px solid rgba(76, 201, 240, 0.3);
    }

    /* Back Button */
    .back-btn {
        margin-top: 2rem;
        text-align: center;
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
        
        .settings-container {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
    }
    </style>
</head>
<body class="<?= $tema === 'gelap' ? 'dark-mode' : '' ?>">
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
            <a href="laporan.php" class="nav-item">
                <i class="fas fa-file-alt"></i>
                <span>Laporan</span>
            </a>
            <a href="pengaturan.php" class="nav-item active">
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
                <i class="fas fa-cog"></i>
                <span>Pengaturan Akun</span>
            </h1>
        </div>

        <?php if ($msg): ?>
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i>
                <span><?= htmlspecialchars($msg); ?></span>
            </div>
        <?php endif; ?>

        <div class="settings-container">
            <!-- Username Settings -->
            <div class="settings-card">
                <div class="settings-header">
                    <h3 class="settings-title">
                        <i class="fas fa-user"></i>
                        <span>Ubah Username</span>
                    </h3>
                    <div class="settings-icon">
                        <i class="fas fa-id-card"></i>
                    </div>
                </div>
                
                <form action="pengaturan_aksi.php?action=ubah_nama" method="post">
                    <div class="form-group">
                        <label for="username">Username Baru</label>
                        <input type="text" id="username" name="username" class="form-control" 
                               value="<?= htmlspecialchars($_SESSION['username']); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </form>
            </div>

            <!-- Password Settings -->
            <div class="settings-card">
                <div class="settings-header">
                    <h3 class="settings-title">
                        <i class="fas fa-lock"></i>
                        <span>Ubah Password</span>
                    </h3>
                    <div class="settings-icon">
                        <i class="fas fa-key"></i>
                    </div>
                </div>
                
                <form action="pengaturan_aksi.php?action=ubah_password" method="post">
                    <div class="form-group">
                        <label for="password_lama">Password Lama</label>
                        <input type="password" id="password_lama" name="password_lama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password_baru">Password Baru</label>
                        <input type="password" id="password_baru" name="password_baru" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password_konfirmasi">Konfirmasi Password Baru</label>
                        <input type="password" id="password_konfirmasi" name="password_konfirmasi" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-warning btn-block">
                        <i class="fas fa-key"></i> Ganti Password
                    </button>
                </form>
            </div>

            <!-- Theme Settings -->
            <div class="settings-card">
                <div class="settings-header">
                    <h3 class="settings-title">
                        <i class="fas fa-palette"></i>
                        <span>Pengaturan Tema</span>
                    </h3>
                    <div class="settings-icon">
                        <i class="fas fa-moon"></i>
                    </div>
                </div>
                
                <form action="pengaturan_aksi.php?action=ubah_tema" method="post">
                    <div class="toggle-container">
                        <label class="toggle-switch">
                            <input type="checkbox" name="tema" id="tema" <?= $tema === 'gelap' ? 'checked' : '' ?>>
                            <span class="toggle-slider"></span>
                        </label>
                        <span class="toggle-label">Mode Gelap</span>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">
                        <i class="fas fa-save"></i> Simpan Tema
                    </button>
                </form>
            </div>
        </div>

        <div class="back-btn">
            <a href="dashboard.php" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
            </a>
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