<?php
// Public homepage
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <title>Data Gabungan - Beranda</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include 'includes/navbar.php'; ?>

<!-- Hero -->
<header class="hero" id="hero">
  <div class="overlay"></div>
  <div class="hero-content">
    <h1>DATA GABUNGAN</h1>
    <p>Meningkatkan transparansi dan akuntabilitas pemerintah daerah melalui akses informasi yang mudah dan terbuka untuk seluruh masyarakat.</p>
    <a href="#services" class="btn">Jelajahi Layanan →</a>
  </div>
  <a class="scroll-down" href="#services" title="Scroll ke bawah">↓</a>
</header>

<section id="services" class="container">
  <h2 class="section-title">DATA KARYAWAN</h2>
  <div class="stats">
    <div><span class="big">5000</span><div class="muted">Data Tersedia</div></div>
    <div><span class="big">24</span><div class="muted">Jam Update</div></div>
    <div><span class="big">99</span><div class="muted">% Akurasi</div></div>
  </div>

  <div class="cards">
    <div class="card">
      <div class="icon">👥</div>
      <h3>DATA UMUR</h3>
      <p>Pengelolaan data demografi seperti distribusi umur, jenis kelamin, dan struktur keluarga.</p>
      <a href="pages/data_umur.php" class="btn-outline">Lihat Data</a>
    </div>

    <div class="card">
      <div class="icon">🆔</div>
      <h3>DATA NAMA</h3>
      <p>Sistem manajemen data identitas seperti nama lengkap, NIK, alamat, dan dokumen kependudukan lainnya.</p>
      <a href="pages/data_nama.php" class="btn-outline">Lihat Data</a>
    </div>

    <div class="card">
      <div class="icon">💼</div>
      <h3>DATA PEKERJAAN</h3>
      <p>Informasi tentang status pekerjaan, jenis pekerjaan, dan kondisi ekonomi masyarakat.</p>
      <a href="pages/data_pekerjaan.php" class="btn-outline">Lihat Data</a>
    </div>
  </div>
</section>

<section id="about" class="container light">
  <h2 class="section-title">Tentang Kami</h2>
  <div class="about-grid">
    <div class="about-card">Menjadi portal transparansi data karyawan terdepan di Indonesia yang memberikan akses mudah dan cepat bagi seluruh masyarakat.</div>
    <div class="about-card blue">Misi</div>
    <div class="about-card blue">Nilai</div>
  </div>
  <p class="center">Kami berkomitmen untuk menyediakan data karyawan yang akurat, real-time, dan mudah diakses untuk seluruh masyarakat.</p>
</section>

<section id="contact" class="container">
  <h2 class="section-title">Hubungi Kami</h2>
  <div class="contact-grid">
    <form action="#" method="post" class="contact-form">
      <input placeholder="Nama Anda" required>
      <input placeholder="Email Anda" required>
      <textarea placeholder="Pesan Anda" required></textarea>
      <button class="btn">Kirim Pesan</button>
    </form>
    <div class="map">
      <!-- placeholder map -->
      <img src="assets/map-placeholder.png" alt="map" style="width:100%;border-radius:8px;box-shadow:0 4px 14px rgba(0,0,0,0.08)">
    </div>
  </div>
</section>

<footer class="footer">
  <div>&copy; <?php echo date('Y'); ?> Data Gabungan</div>
</footer>

<script>
  // smooth scroll for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(a=>{
    a.addEventListener('click', function(e){
      e.preventDefault();
      document.querySelector(this.getAttribute('href')).scrollIntoView({behavior:'smooth'});
    });
  });
</script>
</body>
</html>
