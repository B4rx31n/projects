<?php
include 'db.php';

// Ambil data dari form
$umur = $_POST['umur'];
$ket_umur = $_POST['ket_umur'];
$hama = $_POST['hama'];
$alamat = $_POST['alamat'];
$pekerjaan = $_POST['pekerjaan'];
$ket_pekerjaan = $_POST['ket_pekerjaan'];

// Simpan ke tabel umurs
$sql1 = "INSERT INTO umurs (umur, ket) VALUES (?, ?)";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param("ss", $umur, $ket_umur);
$stmt1->execute();

// Simpan ke tabel hamas
$sql2 = "INSERT INTO hamas (hama, alamat) VALUES (?, ?)";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("ss", $hama, $alamat);
$stmt2->execute();

// Simpan ke tabel pekerjaans
$sql3 = "INSERT INTO pekerjaans (pekerjaan, ket) VALUES (?, ?)";
$stmt3 = $conn->prepare($sql3);
$stmt3->bind_param("ss", $pekerjaan, $ket_pekerjaan);
$stmt3->execute();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Berhasil Disimpan</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --success-color: #4cc9f0;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .success-container {
            max-width: 600px;
            margin: 5rem auto;
            padding: 2rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            text-align: center;
        }
        
        .success-icon {
            font-size: 5rem;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
            animation: bounce 1s;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
        }
        
        .data-summary {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1.5rem;
            margin: 2rem 0;
            text-align: left;
        }
        
        .data-item {
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }
        
        .data-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .data-label {
            font-weight: 600;
            color: #555;
            margin-bottom: 0.25rem;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
            40% {transform: translateY(-20px);}
            60% {transform: translateY(-10px);}
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h2 class="mb-3">Data Berhasil Disimpan!</h2>
        <p class="text-muted mb-4">Semua data telah berhasil dimasukkan ke dalam database.</p>
        
        <div class="data-summary">
            <h5 class="mb-3">Ringkasan Data:</h5>
            
            <div class="data-item">
                <div class="data-label">Data Umur</div>
                <div><strong>Umur:</strong> <?= htmlspecialchars($umur) ?></div>
                <div><strong>Keterangan:</strong> <?= htmlspecialchars($ket_umur) ?></div>
            </div>
            
            <div class="data-item">
                <div class="data-label">Data Hama</div>
                <div><strong>Hama:</strong> <?= htmlspecialchars($hama) ?></div>
                <div><strong>Alamat:</strong> <?= htmlspecialchars($alamat) ?></div>
            </div>
            
            <div class="data-item">
                <div class="data-label">Data Pekerjaan</div>
                <div><strong>Pekerjaan:</strong> <?= htmlspecialchars($pekerjaan) ?></div>
                <div><strong>Keterangan:</strong> <?= htmlspecialchars($ket_pekerjaan) ?></div>
            </div>
        </div>
        
        <a href="index.php" class="btn btn-primary">
            <i class="fas fa-database me-2"></i> Lihat Semua Data
        </a>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>