<?php
session_start();

// Jika belum login, arahkan ke login.php
if (!isset($_SESSION['user'])) {
    header("Location: login/login.php"); // sesuaikan folder login kamu
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Website Dinamis</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

    <!-- Judul Website -->
    <div class="page-title">Web Dinamis</div>

    <!-- Navigasi -->
    <nav>
        <a href="index.php?page=beranda">Beranda</a>
        <a href="index.php?page=tentang">Tentang Kami</a>
        <a href="index.php?page=kontak">Kontak</a>
        <a href="crud/index.php">Data Barang</a>
        <a href="login/logout.php">Logout</a>

    </nav>
    <hr>

    <!-- Load Halaman -->
    <div class="container">
    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : 'beranda';
    $allowed_pages = ['beranda', 'tentang', 'kontak'];

    if (in_array($page, $allowed_pages)) {
        include $page . '.php';
    } else {
        echo "<h1 class='center-content'>404 - Halaman tidak ditemukan</h1>";
    }
    ?>
    </div>

    <footer>
        &copy; <?= date('Y') ?> Website Dinamis. All rights reserved.
    </footer>

</body>
</html>
