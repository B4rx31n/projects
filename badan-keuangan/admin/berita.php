<?php include '../config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Berita</title>
</head>
<body>
<h2>Berita</h2>
<a href="tambah_berita.php">Tambah Berita</a>
<link rel="stylesheet" href="../style.css">
<table border="1">
    <tr>
        <th>Judul</th>
        <th>Tanggal</th>
        <th>Aksi</th>
    </tr>
    <?php
    $result = mysqli_query($conn, "SELECT * FROM berita ORDER BY tanggal DESC");
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>
            <td>{$row['judul']}</td>
            <td>{$row['tanggal']}</td>
            <td>
                <a href='edit_berita.php?id={$row['id']}'>Edit</a> | 
                <a href='hapus_berita.php?id={$row['id']}'>Hapus</a>
            </td>
        </tr>";
    }
    ?>
</table>
</body>
</html>
