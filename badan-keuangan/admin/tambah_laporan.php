<?php include '../config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Laporan</title>
</head>
<body>
<h2>Tambah Laporan</h2>
<form method="POST" enctype="multipart/form-data">
    Judul: <input type="text" name="judul" required><br><br>
    Tanggal: <input type="date" name="tanggal" required><br><br>
    File PDF: <input type="file" name="file_pdf" accept=".pdf" required><br><br>
    <button type="submit" name="submit">Simpan</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $tanggal = $_POST['tanggal'];

    $file_name = $_FILES['file_pdf']['name'];
    $tmp_name = $_FILES['file_pdf']['tmp_name'];
    move_uploaded_file($tmp_name, "../files/".$file_name);

    $query = "INSERT INTO laporan (judul, file_pdf, tanggal) VALUES ('$judul', '$file_name', '$tanggal')";
    if (mysqli_query($conn, $query)) {
        header("Location: laporan.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
</body>
</html>
