<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}

include "koneksi.php";

// Proses Tambah Data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $asal = mysqli_real_escape_string($conn, $_POST['asal_sekolah_dan_universitas']);
    $tahun = mysqli_real_escape_string($conn, $_POST['Tahun_PKL']);
    $lama = mysqli_real_escape_string($conn, $_POST['lama_pkl']);

    $sql_insert = "INSERT INTO data_siswa (nama, asal_sekolah_dan_universitas, Tahun_PKL, lama_pkl) VALUES ('$nama', '$asal', '$tahun', '$lama')";
    mysqli_query($conn, $sql_insert);

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Tambah Data Siswa & Mahasiswa</title>
<style>
  /* styling form sama seperti yang kamu punya sebelumnya */
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #cce7ff;
    color: #0a3d62;
    margin: 0;
    padding: 40px 20px;
  }
  .container {
    max-width: 480px;
    margin: 0 auto;
    background: #b0d4ff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
  }
  h1 {
    margin-bottom: 25px;
  }
  label {
    display: block;
    margin: 10px 0 6px;
    font-weight: 600;
  }
  input {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #74b9ff;
    font-size: 14px;
    background: white;
    transition: border-color 0.3s ease;
  }
  input:focus {
    border-color: #0652dd;
    outline: none;
  }
  button {
    margin-top: 20px;
    background: #0984e3;
    color: white;
    padding: 12px 18px;
    border: none;
    border-radius: 10px;
    font-weight: 700;
    cursor: pointer;
    transition: background 0.3s ease;
  }
  button:hover {
    background: #0652dd;
  }
  a.btn-back {
    display: inline-block;
    margin-top: 20px;
    color: #0984e3;
    text-decoration: none;
    font-weight: 600;
  }
  a.btn-back:hover {
    text-decoration: underline;
  }
</style>
</head>
<body>

<div class="container" role="main">
  <h1>➕ Tambah Data Baru</h1>
  <form method="POST" action="tambah.php">
    <label for="nama">Nama</label>
    <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required />

    <label for="asal_sekolah_dan_universitas">Asal Sekolah / Universitas</label>
    <input type="text" id="asal_sekolah_dan_universitas" name="asal_sekolah_dan_universitas" placeholder="Masukkan asal sekolah atau universitas" required />

    <label for="Tahun_PKL">Tanggal Mulai PKL</label>
    <input type="date" id="Tahun_PKL" name="Tahun_PKL" required />

    <label for="lama_pkl">Tanggal Selesai PKL</label>
    <input type="date" id="lama_pkl" name="lama_pkl" required />

    <button type="submit">Tambah Data</button>
  </form>
  <a href="dashboard.php" class="btn-back" aria-label="Kembali ke dashboard">← Kembali ke Dasbor</a>
</div>

</body>
</html>
