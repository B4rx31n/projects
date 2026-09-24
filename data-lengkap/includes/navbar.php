<?php
session_start();
$logged_in = isset($_SESSION['login']) && $_SESSION['login']===true;
$username = $logged_in ? $_SESSION['username'] : '';
?>
<nav class="navbar">
  <div class="brand"><img src="assets/logo.png" alt="logo" style="height:36px;vertical-align:middle"> DATA</div>
  <ul class="menu">
    <li><a href="index.php">Beranda</a></li>
    <li><a href="#services">Layanan</a></li>
    <li><a href="#about">Tentang</a></li>
    <li><a href="#contact">Kontak</a></li>
    <?php if($logged_in): ?>
      <li><a href="dashboard.php">Dashboard (<?php echo htmlspecialchars($username); ?>)</a></li>
      <li><a href="logout.php">Logout</a></li>
    <?php else: ?>
      <li><a href="login.php">Login</a></li>
    <?php endif; ?>
  </ul>
</nav>
