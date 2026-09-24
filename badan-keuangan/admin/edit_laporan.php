<?php include '../config.php'; ?>
<?php
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM laporan WHERE id=$id");
$row = mysqli_fetch_assoc($data);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Laporan</title>
</head>
<body>
<h2>Edit Laporan</h2>
<form method="POST" enctype="multipart/form-data">
    Judul: <input type="text" name="judul" value="<?= $row['judul'] ?>" required><br><br>
    Tanggal: <input type="date" name="tanggal" value="<?= $row['tanggal'] ?>" required><br><br>
    File PDF (kosongkan jika tidak ganti): <input type="file" name="file_pdf" accept=".pdf"><br><br>
    <button type="submit" name="update">Update</button>
</form>

<?php
if (isset($_POST['update'])) {
    $judul = $_POST['judul'];
    $tanggal = $_POST['tanggal'];

    if (!empty($_FILES['file_pdf']['name'])) {
        $file_name = $_FILES['file_pdf']['name'];
        $tmp_name = $_FILES['file_pdf']['tmp_name'];
        move_uploaded_file($tmp_name, "../files/".$file_name);
        $query = "UPDATE laporan SET judul='$judul', file_pdf='$file_name', tanggal='$tanggal' WHERE id=$id";
    } else {
        $query = "UPDATE laporan SET judul='$judul', tanggal='$tanggal' WHERE id=$id";
    }

    if (mysqli_query($conn, $query)) {
        header("Location: laporan.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
</body>
</html>
s