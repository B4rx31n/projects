<?php include '../config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Berita</title>
</head>
<body>
<h2>Tambah Berita</h2>
<form method="POST">
    Judul: <input type="text" name="judul" required><br><br>
    Isi: <textarea name="isi" rows="5" cols="40" required></textarea><br><br>
    Tanggal: <input type="date" name="tanggal" required><br><br>
    <button type="submit" name="submit">Simpan</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tanggal = $_POST['tanggal'];

    $query = "INSERT INTO berita (judul, isi, tanggal) VALUES ('$judul', '$isi', '$tanggal')";
    if (mysqli_query($conn, $query)) {
        header("Location: berita.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
</body>
</html>
