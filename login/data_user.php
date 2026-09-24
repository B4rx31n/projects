<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}


include "koneksi.php";

// Proses hapus data jika ada parameter delete
if (isset($_GET['delete'])) {
    $id_delete = intval($_GET['delete']);
    $sql_del = "DELETE FROM data_siswa WHERE id = $id_delete";
    mysqli_query($conn, $sql_del);
    header("Location: data_user.php");
    exit;
}

// Ambil data dari database
$sql = "SELECT * FROM data_siswa ORDER BY nama ASC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Data Siswa & Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            margin: 0; padding: 20px; color: white;
        }
        .container {
            background: white;
            color: black;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            max-width: 900px;
            margin: auto;
        }
        h2 {
            text-align: center; color: #333;
        }
        .btn-tambah, .btn-back {
            display: inline-block;
            margin-bottom: 15px;
            background: #2575fc;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s;
        }
        .btn-tambah:hover, .btn-back:hover {
            background: #1a4ed1;
        }
        table {
            width: 100%; border-collapse: collapse; margin-top: 0;
        }
        th, td {
            padding: 10px; border-bottom: 1px solid #ddd; text-align: left;
        }
        th {
            background: #2575fc; color: white;
        }
        tr:nth-child(even) {
            background-color: #f8f8f8;
        }
        tr:hover {
            background-color: #e0e0e0;
        }
        .btn-edit, .btn-delete {
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: bold;
            text-decoration: none;
            color: white;
            margin-right: 5px;
        }
        .btn-edit {
            background: #4CAF50;
        }
        .btn-edit:hover {
            background: #388E3C;
        }
        .btn-delete {
            background: #f44336;
        }
        .btn-delete:hover {
            background: #d32f2f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>📋 Data Siswa & Mahasiswa</h2>

        <a href="tambah_data.php" class="btn-tambah">＋ Tambah Data</a>
        <a href="dashboard.php" class="btn-back" style="float:right;">⬅ Dashboard</a>

        <table>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Asal Sekolah & Universitas</th>
                <th>Tahun PKL</th>
                <th>Lama PKL</th>
                <th>Aksi</th>
            </tr>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>$no</td>
                        <td>".htmlspecialchars($row['nama'])."</td>
                        <td>".htmlspecialchars($row['asal_sekolah_dan_universitas'])."</td>
                        <td>".htmlspecialchars($row['Tahun_PKL'])."</td>
                        <td>".htmlspecialchars($row['lama_pkl'])."</td>
                        <td>
                            <a href='edit_data.php?id=".$row['id']."' class='btn-edit'>Edit</a>
                            <a href='?delete=".$row['id']."' onclick=\"return confirm('Yakin hapus data ini?');\" class='btn-delete'>Hapus</a>
                        </td>
                      </tr>";
                $no++;
            }
            ?>
        </table>
    </div>
</body>
</html>
