<?php include '../config.php'; ?>
<?php
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM berita WHERE id=$id");
$row = mysqli_fetch_assoc($data);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Berita</title>
</head>
<body>
<h2>Edit Berita</h2>
<form method="POST">
    Judul: <input type="text" name="judul" value="<?= $row['judul'] ?>" required><br><br>
    Isi: <textarea name="isi" rows="5" cols="40" required><?= $row['isi'] ?></textarea><br><br>
    Tanggal: <input type="date" name="tanggal" value="<?= $row['tanggal'] ?>" required><br><br>
    <button type="submit" name="update">Update</button>
</form>

<?php
if (isset($_POST['update'])) {
    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $tanggal = $_POST['tanggal'];

    $query = "UPDATE berita SET judul='$judul', isi='$isi', tanggal='$tanggal' WHERE id=$id";

    if (mysqli_query($conn, $query)) {
        header("Location: berita.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
</body>
</html>
