<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

<div class="page-title">Web Dinamis</div>

<nav>
    <a href="../index.php?page=beranda">Beranda</a> |
    <a href="../index.php?page=tentang">Tentang Kami</a> |
    <a href="../index.php?page=kontak">Kontak</a> |
    <a href="index.php">Data Barang</a>
</nav>
<hr>

<div class="container">
    <h1 class="page-title">Tambah Barang</h1>
    
    <form action="" method="post" style="max-width: 500px; margin: auto;">
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Harga:</label>
            <input type="number" name="harga" class="form-control" required>
        </div>
        <button type="submit" name="simpan" class="btn btn-block">Simpan</button>
    </form>
</div>

<?php
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    mysqli_query($conn, "INSERT INTO barang (nama, harga) VALUES ('$nama', '$harga')");
    header("Location: index.php");
}
?>

</body>
</html>
