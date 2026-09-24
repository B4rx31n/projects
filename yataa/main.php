<?php
// ============================================
// SITUS WEB PHP SEDERHANA DENGAN DATABASE
// ============================================

// ============================================
// KONEKSI DATABASE
// ============================================
session_start();

// Konfigurasi database
$db_config = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '', // Kosongkan jika tidak ada password
    'database' => 'simple_website_db',
    'charset' => 'utf8mb4'
];

// Fungsi koneksi database
function connectDatabase() {
    global $db_config;
    
    $conn = mysqli_connect(
        $db_config['host'],
        $db_config['username'],
        $db_config['password'],
        $db_config['database']
    );
    
    // Jika koneksi gagal, coba buat database
    if (!$conn) {
        // Coba koneksi tanpa database terlebih dahulu
        $conn = mysqli_connect(
            $db_config['host'],
            $db_config['username'],
            $db_config['password']
        );
        
        if ($conn) {
            // Buat database jika belum ada
            $sql = "CREATE DATABASE IF NOT EXISTS " . $db_config['database'] . 
                   " CHARACTER SET " . $db_config['charset'];
            
            if (mysqli_query($conn, $sql)) {
                mysqli_select_db($conn, $db_config['database']);
                initializeDatabase($conn);
            }
        }
    } else {
        // Database sudah ada, cek dan buat tabel jika perlu
        initializeDatabase($conn);
    }
    
    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }
    
    mysqli_set_charset($conn, $db_config['charset']);
    return $conn;
}

// Fungsi inisialisasi database (buat tabel jika belum ada)
function initializeDatabase($conn) {
    global $db_config;
    
    // Pilih database
    mysqli_select_db($conn, $db_config['database']);
    
    // Buat tabel pengguna (users)
    $sql_users = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        full_name VARCHAR(100),
        role ENUM('admin', 'user') DEFAULT 'user',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    // Buat tabel pesan kontak (messages)
    $sql_messages = "CREATE TABLE IF NOT EXISTS messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        message TEXT NOT NULL,
        status ENUM('unread', 'read', 'replied') DEFAULT 'unread',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    // Buat tabel artikel (articles)
    $sql_articles = "CREATE TABLE IF NOT EXISTS articles (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(200) NOT NULL,
        content TEXT NOT NULL,
        author_id INT,
        views INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE SET NULL
    )";
    
    // Eksekusi query pembuatan tabel
    mysqli_query($conn, $sql_users);
    mysqli_query($conn, $sql_messages);
    mysqli_query($conn, $sql_articles);
    
    // Tambahkan admin default jika belum ada
    $check_admin = mysqli_query($conn, "SELECT * FROM users WHERE username = 'admin'");
    if (mysqli_num_rows($check_admin) == 0) {
        $hashed_password = password_hash('admin123', PASSWORD_DEFAULT);
        $sql_admin = "INSERT INTO users (username, email, password, full_name, role) 
                      VALUES ('admin', 'admin@example.com', '$hashed_password', 'Administrator', 'admin')";
        mysqli_query($conn, $sql_admin);
    }
    
    // Tambahkan contoh artikel jika belum ada
    $check_articles = mysqli_query($conn, "SELECT * FROM articles");
    if (mysqli_num_rows($check_articles) == 0) {
        $admin_id = mysqli_insert_id($conn);
        $sample_articles = [
            "INSERT INTO articles (title, content, author_id, views) 
             VALUES ('Selamat Datang di Website Kami', 'Ini adalah artikel pertama di website sederhana kami.', 1, 15)",
            "INSERT INTO articles (title, content, author_id, views) 
             VALUES ('Cara Membuat Website dengan PHP', 'PHP adalah bahasa pemrograman yang populer untuk pengembangan web.', 1, 42)",
            "INSERT INTO articles (title, content, author_id, views) 
             VALUES ('Pengenalan Database MySQL', 'MySQL adalah sistem manajemen database yang banyak digunakan.', 1, 28)"
        ];
        
        foreach ($sample_articles as $sql) {
            mysqli_query($conn, $sql);
        }
    }
}

// Koneksi ke database
$conn = connectDatabase();

// ============================================
// KONFIGURASI SITUS
// ============================================

// Pengaturan situs
$site_config = [
    'title' => 'Situs Web dengan Database',
    'description' => 'Contoh situs web PHP dengan integrasi database MySQL',
    'author' => 'Pengembang Web',
    'year' => date('Y')
];

// Data menu navigasi
$menu_items = [
    'Beranda' => 'index.php',
    'Artikel' => 'index.php?page=articles',
    'Tentang' => 'index.php?page=about',
    'Kontak' => 'index.php?page=contact',
    'Admin' => 'index.php?page=admin'
];

// ============================================
// FUNGSI UTILITAS
// ============================================

// Fungsi untuk mendapatkan halaman saat ini
function getCurrentPage() {
    return isset($_GET['page']) ? $_GET['page'] : 'home';
}

// Fungsi untuk membersihkan input
function cleanInput($conn, $data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = mysqli_real_escape_string($conn, $data);
    return $data;
}

// Fungsi untuk validasi email
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Fungsi untuk mendapatkan IP pengguna
function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

// ============================================
// PROSES FORM DAN AUTHENTIKASI
// ============================================

$form_message = '';
$form_error = '';

// Proses Login/Logout
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'logout') {
        session_destroy();
        header('Location: index.php');
        exit();
    }
}

// Proses Login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_submit'])) {
    $username = cleanInput($conn, $_POST['username']);
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['full_name'] = $user['full_name'];
            
            $form_message = "Login berhasil! Selamat datang, " . $user['full_name'];
        } else {
            $form_error = "Password salah!";
        }
    } else {
        $form_error = "Username tidak ditemukan!";
    }
}

// Proses Pendaftaran
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register_submit'])) {
    $username = cleanInput($conn, $_POST['username']);
    $email = cleanInput($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $full_name = cleanInput($conn, $_POST['full_name']);
    
    // Validasi
    $valid = true;
    
    if (empty($username) || strlen($username) < 3) {
        $form_error = "Username minimal 3 karakter";
        $valid = false;
    } elseif (!isValidEmail($email)) {
        $form_error = "Email tidak valid";
        $valid = false;
    } elseif (strlen($password) < 6) {
        $form_error = "Password minimal 6 karakter";
        $valid = false;
    } elseif ($password !== $confirm_password) {
        $form_error = "Password tidak cocok";
        $valid = false;
    } else {
        // Cek username sudah ada
        $check_user = mysqli_query($conn, "SELECT id FROM users WHERE username = '$username'");
        if (mysqli_num_rows($check_user) > 0) {
            $form_error = "Username sudah digunakan";
            $valid = false;
        }
        
        // Cek email sudah ada
        $check_email = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email'");
        if (mysqli_num_rows($check_email) > 0) {
            $form_error = "Email sudah terdaftar";
            $valid = false;
        }
    }
    
    if ($valid) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, password, full_name, role) 
                VALUES ('$username', '$email', '$hashed_password', '$full_name', 'user')";
        
        if (mysqli_query($conn, $sql)) {
            $form_message = "Pendaftaran berhasil! Silakan login.";
        } else {
            $form_error = "Gagal mendaftar: " . mysqli_error($conn);
        }
    }
}

// Proses Form Kontak
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_submit'])) {
    $name = cleanInput($conn, $_POST['name']);
    $email = cleanInput($conn, $_POST['email']);
    $message = cleanInput($conn, $_POST['message']);
    
    $valid = true;
    
    if (empty($name)) {
        $form_error = 'Nama harus diisi';
        $valid = false;
    } elseif (!isValidEmail($email)) {
        $form_error = 'Email tidak valid';
        $valid = false;
    } elseif (empty($message)) {
        $form_error = 'Pesan harus diisi';
        $valid = false;
    }
    
    if ($valid) {
        $sql = "INSERT INTO messages (name, email, message, status) 
                VALUES ('$name', '$email', '$message', 'unread')";
        
        if (mysqli_query($conn, $sql)) {
            $form_message = 'Terima kasih, ' . $name . '! Pesan Anda telah berhasil dikirim.';
        } else {
            $form_error = 'Gagal mengirim pesan: ' . mysqli_error($conn);
        }
    }
}

// Proses Tambah Artikel (Admin)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_article_submit']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    $title = cleanInput($conn, $_POST['title']);
    $content = cleanInput($conn, $_POST['content']);
    $author_id = $_SESSION['user_id'];
    
    if (!empty($title) && !empty($content)) {
        $sql = "INSERT INTO articles (title, content, author_id) 
                VALUES ('$title', '$content', $author_id)";
        
        if (mysqli_query($conn, $sql)) {
            $form_message = "Artikel berhasil ditambahkan!";
        } else {
            $form_error = "Gagal menambahkan artikel: " . mysqli_error($conn);
        }
    }
}

// ============================================
// AMBIL DATA DARI DATABASE
// ============================================

$current_page = getCurrentPage();
$page_title = 'Beranda';

// Ambil artikel untuk halaman artikel
$articles = [];
if ($current_page == 'articles' || $current_page == 'home') {
    $sql = "SELECT a.*, u.username as author_name 
            FROM articles a 
            LEFT JOIN users u ON a.author_id = u.id 
            ORDER BY a.created_at DESC 
            LIMIT 10";
    $result = mysqli_query($conn, $sql);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $articles[] = $row;
    }
}

// Ambil pesan untuk admin
$messages = [];
if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin' && $current_page == 'admin') {
    $sql = "SELECT * FROM messages ORDER BY created_at DESC";
    $result = mysqli_query($conn, $sql);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $messages[] = $row;
    }
}

// Hitung statistik
$stats = [];
$stats['total_articles'] = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM articles"))['total'];
$stats['total_messages'] = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM messages"))['total'];
$stats['total_users'] = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users"))['total'];
$stats['unread_messages'] = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM messages WHERE status = 'unread'"))['total'];

// ============================================
// TAMPILKAN HTML
// ============================================
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $site_config['title']; ?> - <?php echo ucfirst($current_page); ?></title>
    <style>
        /* ============================================
           STYLE CSS
           ============================================ */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Header */
        header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        /* Navigation */
        nav ul {
            display: flex;
            list-style: none;
            gap: 15px;
        }
        
        nav ul li a {
            color: #555;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 20px;
            transition: all 0.3s;
            font-weight: 500;
        }
        
        nav ul li a:hover, 
        nav ul li a.active {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }
        
        /* User Info */
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .user-info span {
            color: #667eea;
            font-weight: 500;
        }
        
        .btn-logout {
            background: #ff4757;
            color: white;
            border: none;
            padding: 5px 15px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 0.9rem;
        }
        
        /* Main Content */
        .main-wrapper {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            margin: 30px auto;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            min-height: 70vh;
        }
        
        .page-title {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 15px;
            border-bottom: 2px solid #e0e0e0;
            color: #444;
        }
        
        /* Messages */
        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            text-align: center;
        }
        
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        /* Forms */
        .form-container {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
        }
        
        .form-control {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: border 0.3s;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #667eea;
        }
        
        .btn {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            transition: transform 0.3s;
            display: inline-block;
            text-align: center;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        /* Articles */
        .articles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }
        
        .article-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s;
        }
        
        .article-card:hover {
            transform: translateY(-5px);
        }
        
        .article-content {
            padding: 20px;
        }
        
        .article-title {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #333;
        }
        
        .article-meta {
            display: flex;
            justify-content: space-between;
            color: #888;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }
        
        /* Statistics */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 20px;
            border-radius: 15px;
            text-align: center;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 10px 0;
        }
        
        /* Tables */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        
        .data-table th,
        .data-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .data-table th {
            background: #667eea;
            color: white;
            font-weight: 500;
        }
        
        .data-table tr:hover {
            background: #f8f9fa;
        }
        
        /* Footer */
        footer {
            text-align: center;
            padding: 30px 0;
            color: white;
            margin-top: 50px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 15px;
            }
            
            nav ul {
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .articles-grid {
                grid-template-columns: 1fr;
            }
            
            .main-wrapper {
                padding: 20px;
                margin: 15px;
            }
        }
        
        /* Tabs */
        .tabs {
            display: flex;
            border-bottom: 2px solid #e0e0e0;
            margin-bottom: 20px;
        }
        
        .tab {
            padding: 10px 20px;
            cursor: pointer;
            border-bottom: 3px solid transparent;
        }
        
        .tab.active {
            border-bottom-color: #667eea;
            color: #667eea;
            font-weight: 500;
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">WebDatabase</div>
                
                <nav>
                    <ul>
                        <?php foreach ($menu_items as $label => $url): ?>
                            <?php if (!($label == 'Admin' && (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'))): ?>
                                <li>
                                    <a href="<?php echo $url; ?>" 
                                       <?php echo (($current_page == 'home' && $url == 'index.php') || 
                                                  strpos($url, 'page=' . $current_page) !== false) 
                                                  ? 'class="active"' : ''; ?>>
                                        <?php echo $label; ?>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </nav>
                
                <div class="user-info">
                    <?php if (isset($_SESSION['username'])): ?>
                        <span>Halo, <?php echo $_SESSION['full_name'] ?: $_SESSION['username']; ?></span>
                        <a href="?action=logout" class="btn-logout">Logout</a>
                    <?php else: ?>
                        <a href="#login" class="btn" style="padding: 8px 20px; font-size: 14px;">Login</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container">
        <div class="main-wrapper">
            <!-- Messages -->
            <?php if ($form_message): ?>
                <div class="message success"><?php echo $form_message; ?></div>
            <?php endif; ?>
            
            <?php if ($form_error): ?>
                <div class="message error"><?php echo $form_error; ?></div>
            <?php endif; ?>
            
            <!-- Page Content -->
            <?php if ($current_page == 'home'): ?>
                <!-- Beranda -->
                <h1 class="page-title">Selamat Datang di <?php echo $site_config['title']; ?></h1>
                
                <!-- Statistik -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <h3>Total Artikel</h3>
                        <div class="stat-number"><?php echo $stats['total_articles']; ?></div>
                    </div>
                    <div class="stat-card">
                        <h3>Total Pesan</h3>
                        <div class="stat-number"><?php echo $stats['total_messages']; ?></div>
                    </div>
                    <div class="stat-card">
                        <h3>Total Pengguna</h3>
                        <div class="stat-number"><?php echo $stats['total_users']; ?></div>
                    </div>
                </div>
                
                <!-- Artikel Terbaru -->
                <h2 style="margin: 40px 0 20px 0; color: #444;">Artikel Terbaru</h2>
                <div class="articles-grid">
                    <?php foreach (array_slice($articles, 0, 3) as $article): ?>
                        <div class="article-card">
                            <div class="article-content">
                                <h3 class="article-title"><?php echo htmlspecialchars($article['title']); ?></h3>
                                <div class="article-meta">
                                    <span>Oleh: <?php echo htmlspecialchars($article['author_name']); ?></span>
                                    <span><?php echo date('d M Y', strtotime($article['created_at'])); ?></span>
                                </div>
                                <p><?php echo substr(strip_tags($article['content']), 0, 100); ?>...</p>
                                <div style="margin-top: 15px; display: flex; justify-content: space-between; align-items: center;">
                                    <span>👁️ <?php echo $article['views']; ?> views</span>
                                    <a href="?page=articles" class="btn" style="padding: 8px 15px; font-size: 14px;">Baca</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- Login/Register Form (jika belum login) -->
                <?php if (!isset($_SESSION['username'])): ?>
                    <div style="margin-top: 50px; padding-top: 30px; border-top: 2px solid #e0e0e0;">
                        <div class="tabs">
                            <div class="tab active" onclick="switchTab('login')">Login</div>
                            <div class="tab" onclick="switchTab('register')">Register</div>
                        </div>
                        
                        <div id="login" class="tab-content active">
                            <div class="form-container">
                                <h3 style="text-align: center; margin-bottom: 20px;">Login ke Akun Anda</h3>
                                <form method="POST" action="">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                    <button type="submit" name="login_submit" class="btn" style="width: 100%;">Login</button>
                                </form>
                                <p style="text-align: center; margin-top: 15px; color: #666;">
                                    Demo: admin / admin123
                                </p>
                            </div>
                        </div>
                        
                        <div id="register" class="tab-content">
                            <div class="form-container">
                                <h3 style="text-align: center; margin-bottom: 20px;">Buat Akun Baru</h3>
                                <form method="POST" action="">
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" name="full_name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Konfirmasi Password</label>
                                        <input type="password" name="confirm_password" class="form-control" required>
                                    </div>
                                    <button type="submit" name="register_submit" class="btn" style="width: 100%;">Daftar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                
            <?php elseif ($current_page == 'articles'): ?>
                <!-- Halaman Artikel -->
                <h1 class="page-title">Daftar Artikel</h1>
                
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                    <!-- Form Tambah Artikel untuk Admin -->
                    <div style="background: #f8f9fa; padding: 20px; border-radius: 10px; margin-bottom: 30px;">
                        <h3 style="margin-bottom: 15px; color: #444;">Tambah Artikel Baru</h3>
                        <form method="POST" action="">
                            <div class="form-group">
                                <input type="text" name="title" class="form-control" placeholder="Judul Artikel" required>
                            </div>
                            <div class="form-group">
                                <textarea name="content" class="form-control" placeholder="Isi Artikel" rows="5" required></textarea>
                            </div>
                            <button type="submit" name="add_article_submit" class="btn">Tambah Artikel</button>
                        </form>
                    </div>
                <?php endif; ?>
                
                <!-- Daftar Artikel -->
                <div class="articles-grid">
                    <?php if (count($articles) > 0): ?>
                        <?php foreach ($articles as $article): ?>
                            <div class="article-card">
                                <div class="article-content">
                                    <h3 class="article-title"><?php echo htmlspecialchars($article['title']); ?></h3>
                                    <div class="article-meta">
                                        <span>Oleh: <?php echo htmlspecialchars($article['author_name']); ?></span>
                                        <span><?php echo date('d M Y', strtotime($article['created_at'])); ?></span>
                                    </div>
                                    <p><?php echo substr(strip_tags($article['content']), 0, 150); ?>...</p>
                                    <div style="margin-top: 15px; display: flex; justify-content: space-between; align-items: center;">
                                        <span>👁️ <?php echo $article['views']; ?> views</span>
                                        <a href="#" class="btn" style="padding: 8px 15px; font-size: 14px;">Baca Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p style="text-align: center; color: #666; grid-column: 1/-1;">
                            Belum ada artikel. Silakan login sebagai admin untuk menambahkan artikel.
                        </p>
                    <?php endif; ?>
                </div>
                
            <?php elseif ($current_page == 'about'): ?>
                <!-- Halaman Tentang -->
                <h1 class="page-title">Tentang Kami</h1>
                
                <div style="max-width: 800px; margin: 0 auto;">
                    <div style="text-align: center; margin-bottom: 30px;">
                        <h2 style="color: #667eea; margin-bottom: 15px;">Website dengan Database MySQL</h2>
                        <p>Ini adalah contoh website PHP sederhana yang terintegrasi dengan database MySQL.</p>
                    </div>
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin: 30px 0;">
                        <div style="background: #f8f9fa; padding: 20px; border-radius: 10px;">
                            <h3 style="color: #667eea; margin-bottom: 10px;">📊 Database</h3>
                            <p>Menggunakan MySQL untuk menyimpan data pengguna, artikel, dan pesan.</p>
                        </div>
                        <div style="background: #f8f9fa; padding: 20px; border-radius: 10px;">
                            <h3 style="color: #667eea; margin-bottom: 10px;">🔐 Keamanan</h3>
                            <p>Password di-hash dengan password_hash() dan input divalidasi dengan aman.</p>
                        </div>
                        <div style="background: #f8f9fa; padding: 20px; border-radius: 10px;">
                            <h3 style="color: #667eea; margin-bottom: 10px;">📱 Responsif</h3>
                            <p>Desain yang optimal untuk desktop, tablet, dan smartphone.</p>
                        </div>
                    </div>
                    
                    <h3 style="margin: 30px 0 15px 0; color: #444;">Statistik Sistem</h3>
                    <div class="stats-grid">
                        <div class="stat-card">
                            <h4>Pengguna Terdaftar</h4>
                            <div class="stat-number"><?php echo $stats['total_users']; ?></div>
                        </div>
                        <div class="stat-card">
                            <h4>Artikel</h4>
                            <div class="stat-number"><?php echo $stats['total_articles']; ?></div>
                        </div>
                        <div class="stat-card">
                            <h4>Pesan Masuk</h4>
                            <div class="stat-number"><?php echo $stats['total_messages']; ?></div>
                        </div>
                    </div>
                </div>
                
            <?php elseif ($current_page == 'contact'): ?>
                <!-- Halaman Kontak -->
                <h1 class="page-title">Hubungi Kami</h1>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
                    <div>
                        <h3 style="color: #444; margin-bottom: 20px;">Kirim Pesan</h3>
                        <div class="form-container">
                            <form method="POST" action="">
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control" required 
                                           value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                                </div>
                                
                                <div class="form-group">
                                    <label>Alamat Email</label>
                                    <input type="email" name="email" class="form-control" required
                                           value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                                </div>
                                
                                <div class="form-group">
                                    <label>Pesan Anda</label>
                                    <textarea name="message" class="form-control" rows="5" required><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                                </div>
                                
                                <button type="submit" name="contact_submit" class="btn" style="width: 100%;">Kirim Pesan</button>
                            </form>
                        </div>
                    </div>
                    
                    <div>
                        <h3 style="color: #444; margin-bottom: 20px;">Informasi Kontak</h3>
                        <div style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
                            <p style="margin-bottom: 15px;">📍 <strong>Alamat:</strong><br>Jl. Contoh No. 123, Jakarta 12345</p>
                            <p style="margin-bottom: 15px;">📞 <strong>Telepon:</strong><br>(021) 1234-5678</p>
                            <p style="margin-bottom: 15px;">✉️ <strong>Email:</strong><br>info@website-database.com</p>
                            <p><strong>Jam Operasional:</strong><br>Senin - Jumat: 08:00 - 17:00 WIB</p>
                        </div>
                    </div>
                </div>
                
            <?php elseif ($current_page == 'admin' && isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                <!-- Halaman Admin -->
                <h1 class="page-title">Panel Admin</h1>
                
                <div style="margin-bottom: 30px;">
                    <h3 style="color: #444; margin-bottom: 15px;">Selamat datang, <?php echo $_SESSION['full_name']; ?>!</h3>
                    <p>Anda login sebagai Administrator.</p>
                </div>
                
                <!-- Statistik Admin -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <h4>Total Pengguna</h4>
                        <div class="stat-number"><?php echo $stats['total_users']; ?></div>
                    </div>
                    <div class="stat-card">
                        <h4>Total Artikel</h4>
                        <div class="stat-number"><?php echo $stats['total_articles']; ?></div>
                    </div>
                    <div class="stat-card">
                        <h4>Pesan Masuk</h4>
                        <div class="stat-number"><?php echo $stats['total_messages']; ?></div>
                    </div>
                    <div class="stat-card">
                        <h4>Pesan Belum Dibaca</h4>
                        <div class="stat-number"><?php echo $stats['unread_messages']; ?></div>
                    </div>
                </div>
                
                <!-- Tabel Pesan -->
                <h3 style="margin: 40px 0 20px 0; color: #444;">Daftar Pesan</h3>
                <?php if (count($messages) > 0): ?>
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Pesan</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($messages as $message): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($message['name']); ?></td>
                                    <td><?php echo htmlspecialchars($message['email']); ?></td>
                                    <td><?php echo substr(htmlspecialchars($message['message']), 0, 50); ?>...</td>
                                    <td>
                                        <span style="padding: 3px 8px; border-radius: 5px; 
                                              background: <?php echo $message['status'] == 'unread' ? '#ff6b6b' : '#51cf66'; ?>; 
                                              color: white;">
                                            <?php echo $message['status']; ?>
                                        </span>
                                    </td>
                                    <td><?php echo date('d M Y', strtotime($message['created_at'])); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p style="text-align: center; color: #666; padding: 20px;">Belum ada pesan.</p>
                <?php endif; ?>
                
                <!-- Database Info -->
                <div style="margin-top: 40px; padding: 20px; background: #f8f9fa; border-radius: 10px;">
                    <h3 style="color: #444; margin-bottom: 15px;">Informasi Database</h3>
                    <p>Database: <strong><?php echo $db_config['database']; ?></strong></p>
                    <p>Host: <strong><?php echo $db_config['host']; ?></strong></p>
                    <p>Koneksi: <strong style="color: green;">✓ Terhubung</strong></p>
                </div>
                
            <?php elseif ($current_page == 'admin'): ?>
                <!-- Akses Ditolak -->
                <h1 class="page-title">Akses Ditolak</h1>
                <div style="text-align: center; padding: 50px 0;">
                    <h3 style="color: #ff4757; margin-bottom: 20px;">⚠️ Anda tidak memiliki akses ke halaman ini!</h3>
                    <p>Hanya administrator yang dapat mengakses halaman admin.</p>
                    <a href="index.php" class="btn" style="margin-top: 20px;">Kembali ke Beranda</a>
                </div>
                
            <?php else: ?>
                <!-- Halaman Tidak Ditemukan -->
                <h1 class="page-title">Halaman Tidak Ditemukan</h1>
                <div style="text-align: center; padding: 50px 0;">
                    <p style="font-size: 1.2rem; margin-bottom: 20px;">Maaf, halaman yang Anda cari tidak ditemukan.</p>
                    <a href="index.php" class="btn">Kembali ke Beranda</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; <?php echo $site_config['year']; ?> <?php echo $site_config['title']; ?>. Hak Cipta Dilindungi.</p>
            <p style="margin-top: 10px; font-size: 0.9rem;">
                Dibuat dengan ❤️ menggunakan PHP & MySQL
            </p>
            <p style="margin-top: 5px; font-size: 0.8rem; opacity: 0.8;">
                Status: <?php echo mysqli_get_host_info($conn); ?>
            </p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Fungsi untuk switch tab login/register
        function switchTab(tabName) {
            // Sembunyikan semua tab content
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Tampilkan tab yang dipilih
            document.getElementById(tabName).classList.add('active');
            
            // Update tab aktif
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Set tab yang dipilih sebagai aktif
            document.querySelectorAll('.tab').forEach(tab => {
                if (tab.textContent.toLowerCase() === tabName) {
                    tab.classList.add('active');
                }
            });
        }
        
        // Animasi untuk statistik
        document.addEventListener('DOMContentLoaded', function() {
            // Animate stat numbers
            const statNumbers = document.querySelectorAll('.stat-number');
            statNumbers.forEach(stat => {
                const target = parseInt(stat.textContent);
                let current = 0;
                const increment = target / 50;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        stat.textContent = target;
                        clearInterval(timer);
                    } else {
                        stat.textContent = Math.floor(current);
                    }
                }, 30);
            });
        });
    </script>
</body>
</html>

<?php
// Tutup koneksi database
mysqli_close($conn);
?>