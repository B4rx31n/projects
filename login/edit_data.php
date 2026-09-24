<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit;
}


include "koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: data_siswa.php");
    exit;
}

$id = intval($_GET['id']);

// Ambil data lama untuk ditampilkan di form
$sql = "SELECT * FROM data_siswa WHERE id = $id LIMIT 1";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 0) {
    header("Location: data_user.php");
    exit;
}

$data = mysqli_fetch_assoc($result);

$error = '';

// Proses update data
if (isset($_POST['submit'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $asal = mysqli_real_escape_string($conn, $_POST['asal_sekolah_dan_universitas']);
    $tahun = mysqli_real_escape_string($conn, $_POST['Tahun_PKL']);
    $lama = mysqli_real_escape_string($conn, $_POST['lama_pkl']);

    if ($nama && $asal && $tahun && $lama) {
        $sql_update = "UPDATE data_siswa SET 
            nama='$nama',
            asal_sekolah_dan_universitas='$asal',
            Tahun_PKL='$tahun',
            lama_pkl='$lama'
            WHERE id=$id";

        if (mysqli_query($conn, $sql_update)) {
            header("Location: data_user.php");
            exit;
        } else {
            $error = "Gagal mengupdate data: " . mysqli_error($conn);
        }
    } else {
        $error = "Semua field harus diisi!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Data Siswa & Mahasiswa</title>
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
            max-width: 600px;
            margin: auto;
        }
        h2 {
            text-align: center; color: #333;
        }
        form label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        form input {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        form button {
            margin-top: 20px;
            background: #2575fc;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }
        form button:hover {
            background: #1a4ed1;
        }
        .error-msg {
            color: red;
            margin-top: 15px;
            font-weight: bold;
        }
        .btn-back {
            display: inline-block;
            margin-top: 15px;
            background: #ff4d4d;
            color: white;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }
        .btn-back:hover {
            background: #cc0000;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Data Siswa & Mahasiswa</h2>

        <?php if ($error): ?>
            <div class="error-msg"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required />

            <label for="asal_sekolah_dan_universitas">Asal Sekolah & Universitas</label>
            <input type="text" id="asal_sekolah_dan_universitas" name="asal_sekolah_dan_universitas" value="<?= htmlspecialchars($data['asal_sekolah_dan_universitas']) ?>" required />

            <label for="Tahun_PKL">Tanggal Mulai PKL</label>
            <input type="date" id="Tahun_PKL" name="Tahun_PKL" value="<?= htmlspecialchars($data['Tahun_PKL']) ?>" required />

            <label for="lama_pkl">Tanggal Selesai PKL</label>
            <input type="date" id="lama_pkl" name="lama_pkl" value="<?= htmlspecialchars($data['lama_pkl']) ?>" required />

            <button type="submit" name="submit">Update Data</button>
        </form>

        <a href="data_user.php" class="btn-back">⬅ Kembali</a>
    </div>
</body>
</html>
