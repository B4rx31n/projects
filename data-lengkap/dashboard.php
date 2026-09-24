<?php
session_start();
include 'config/db.php';
if(!isset($_SESSION['login']) || $_SESSION['login']!==true){
  header('Location: login.php');
  exit;
}
?>
<!doctype html>
<html lang="id">
<head><meta charset="utf-8"><title>Dashboard</title><link rel="stylesheet" href="css/style.css"></head>
<body>
<?php include 'includes/navbar.php'; ?>
<div class="container">
  <h2 class="section-title">Dashboard</h2>
  <p>Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?>. Gunakan menu untuk mengelola data.</p>

  <div style="display:flex;gap:12px;margin-top:18px">
    <a class="btn" href="pages/data_umur.php">Kelola Data Umur</a>
    <a class="btn" href="pages/data_nama.php">Kelola Data Nama</a>
    <a class="btn" href="pages/data_pekerjaan.php">Kelola Data Pekerjaan</a>
  </div>
</div>
</body>
</html>
