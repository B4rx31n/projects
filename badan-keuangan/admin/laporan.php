<?php include '../config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Laporan Keuangan</title>
</head>
<body>
<h2>Laporan Keuangan</h2>
<a href="tambah_laporan.php">Tambah Laporan</a>
<table border="1">
    <tr>
        <th>Judul</th>
        <th>Tanggal</th>
        <th>File</th>
        <th>Aksi</th>
    </tr>
    <?php
    $result = mysqli_query($conn, "SELECT * FROM laporan ORDER BY tanggal DESC");
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>
            <td>{$row['judul']}</td>
            <td>{$row['tanggal']}</td>
            <td><a href='../files/{$row['file_pdf']}'>Download</a></td>
            <td>
                <a href='edit_laporan.php?id={$row['id']}'>Edit</a> | 
                <a href='hapus_laporan.php?id={$row['id']}'>Hapus</a>
            </td>
        </tr>";
    }
    ?>
</table>
</body>
</html>
