<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
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

<?php
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM barang WHERE id=$id");
$barang = mysqli_fetch_assoc($data);
?>

<div class="container">
    <h1 class="page-title">Edit Barang</h1>
    
    <form action="" method="post" style="max-width: 500px; margin: auto;">
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($barang['nama']) ?>" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Harga:</label>
            <input type="number" name="harga" value="<?= htmlspecialchars($barang['harga']) ?>" class="form-control" required>
        </div>
        <button type="submit" name="update" class="btn btn-block">Update</button>
    </form>
</div>

<?php
if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    mysqli_query($conn, "UPDATE barang SET nama='$nama', harga='$harga' WHERE id=$id");
    header("Location: index.php");
}
?>

</body>
</html>
