<?php
include 'db.php';

$tabel = $_GET['tabel'] ?? '';
$id    = $_GET['id'] ?? '';

$allowedTables = ['umurs', 'hamas', 'pekerjaans'];
if (!in_array($tabel, $allowedTables) || !$id) {
    die("Data tidak valid!");
}

// Ambil data lama
$sql = "SELECT * FROM $tabel WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    die("Data tidak ditemukan!");
}

// Proses update jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($tabel == 'umurs') {
        $umur = $_POST['umur'];
        $ket = $_POST['ket'];
        $sql = "UPDATE umurs SET umur=?, ket=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $umur, $ket, $id);
    } elseif ($tabel == 'hamas') {
        $hama = $_POST['hama'];
        $alamat = $_POST['alamat'];
        $sql = "UPDATE hamas SET hama=?, alamat=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $hama, $alamat, $id);
    } elseif ($tabel == 'pekerjaans') {
        $pekerjaan = $_POST['pekerjaan'];
        $ket = $_POST['ket'];
        $sql = "UPDATE pekerjaans SET pekerjaan=?, ket=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $pekerjaan, $ket, $id);
    }
    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        $error = "Gagal mengupdate data!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data <?= ucfirst($tabel) ?></title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 40px;
        }
        .edit-container {
            max-width: 600px;
            margin: 0 auto;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: none;
        }
        .card-header {
            background-color: #0d6efd;
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 15px 25px;
        }
        .card-title {
            font-weight: 600;
            margin-bottom: 0;
        }
        .form-label {
            font-weight: 500;
            margin-top: 10px;
        }
        .btn-submit {
            padding: 10px 20px;
            font-weight: 500;
            min-width: 120px;
        }
        .btn-cancel {
            padding: 10px 20px;
            font-weight: 500;
            min-width: 120px;
        }
        .form-control {
            padding: 10px 15px;
            border-radius: 8px;
        }
        .icon-title {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container edit-container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">
                    <?php if($tabel == 'umurs'): ?>
                        <i class="fas fa-user-clock icon-title"></i>
                    <?php elseif($tabel == 'hamas'): ?>
                        <i class="fas fa-bug icon-title"></i>
                    <?php elseif($tabel == 'pekerjaans'): ?>
                        <i class="fas fa-briefcase icon-title"></i>
                    <?php endif; ?>
                    Edit Data <?= ucfirst($tabel) ?>
                </h5>
                <a href="index.php" class="btn btn-sm btn-light">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
            <div class="card-body">
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $error ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                
                <form method="post">
                    <?php if ($tabel == 'umurs'): ?>
                        <div class="mb-4">
                            <label for="umur" class="form-label">Umur</label>
                            <input type="text" class="form-control" id="umur" name="umur" 
                                   value="<?= htmlspecialchars($data['umur']) ?>" required>
                        </div>
                        <div class="mb-4">
                            <label for="ket" class="form-label">Keterangan</label>
                            <input type="text" class="form-control" id="ket" name="ket" 
                                   value="<?= htmlspecialchars($data['ket']) ?>">
                        </div>
                    <?php elseif ($tabel == 'hamas'): ?>
                        <div class="mb-4">
                            <label for="hama" class="form-label">Nama Hama</label>
                            <input type="text" class="form-control" id="hama" name="hama" 
                                   value="<?= htmlspecialchars($data['hama']) ?>" required>
                        </div>
                        <div class="mb-4">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" 
                                   value="<?= htmlspecialchars($data['alamat']) ?>">
                        </div>
                    <?php elseif ($tabel == 'pekerjaans'): ?>
                        <div class="mb-4">
                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" 
                                   value="<?= htmlspecialchars($data['pekerjaan']) ?>" required>
                        </div>
                        <div class="mb-4">
                            <label for="ket" class="form-label">Keterangan</label>
                            <input type="text" class="form-control" id="ket" name="ket" 
                                   value="<?= htmlspecialchars($data['ket']) ?>">
                        </div>
                    <?php endif; ?>
                    
                    <div class="d-flex justify-content-end gap-3 mt-4">
                        <a href="index.php" class="btn btn-secondary btn-cancel">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-primary btn-submit">
                            <i class="fas fa-save me-2"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>