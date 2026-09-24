<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login/login.php");
    exit;
}
?>

<div class="container">
    <h1 class="page-title">Selamat Datang</h1>

    <p class="center-content">
        Selamat datang di <strong>Website Dinamis</strong> kami. Website ini dirancang untuk memberikan pengalaman pengguna yang sederhana namun profesional. 
        Anda dapat menjelajahi berbagai halaman seperti <strong>Tentang Kami</strong>, <strong>Kontak</strong>, serta melakukan <strong>pengelolaan data barang</strong> 
        melalui menu <em>Data Barang</em>.
    </p>

    <p class="center-content">
        Website ini menggunakan <strong>PHP</strong> dan <strong>MySQL</strong> untuk membangun sistem <em>CRUD</em> 
        (Create, Read, Update, Delete) yang efisien. Tampilan website juga dibuat modern dan responsif berkat penggunaan CSS terstruktur.
    </p>

    <p class="center-content">
        Gunakan menu navigasi di atas untuk mulai menggunakan fitur-fitur kami. 
        Terima kasih telah mengunjungi website ini. Semoga bermanfaat!
    </p>
</div>
