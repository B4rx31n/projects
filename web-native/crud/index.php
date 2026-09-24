<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
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
    <h1 class="page-title">Data Barang</h1>

    <div style="text-align: right; margin-bottom: 20px;">
        <a href="tambah.php" class="btn">+ Tambah Barang</a>
    </div>

    <div class="table-container">
        <table class="styled-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $result = mysqli_query($conn, "SELECT * FROM barang");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>$no</td>
                        <td>" . htmlspecialchars($row['nama']) . "</td>
                        <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                        <td>
                            <a href='edit.php?id={$row['id']}' class='btn'>Edit</a>
                            <a href='hapus.php?id={$row['id']}' class='btn btn-delete' onclick='return confirm(\"Yakin hapus?\")'>Hapus</a>
                        </td>
                    </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
