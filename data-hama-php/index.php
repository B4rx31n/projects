<?php
include 'db.php';

// Ambil semua data
$umurs = $conn->query("SELECT * FROM umurs");
$hamas = $conn->query("SELECT * FROM hamas");
$pekerjaans = $conn->query("SELECT * FROM pekerjaans");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Gabungan</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .card {
            margin-bottom: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #0d6efd;
            color: white;
            border-radius: 10px 10px 0 0 !important;
        }
        .btn-add {
            margin-bottom: 20px;
        }
        .table-responsive {
            border-radius: 0 0 10px 10px;
        }
        .table th {
            background-color: #f1f8ff;
        }
        h2 {
            color: #333;
            margin-bottom: 30px;
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-database me-2"></i>Data Gabungan</h2>
            <a href="tambah.php" class="btn btn-primary btn-add">
                <i class="fas fa-plus me-1"></i> Tambah Data Baru
            </a>
        </div>

        <!-- Data Umur Card -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="fas fa-user-clock me-2"></i>Data Umur</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead>
                        <tr>
                            <th class="align-middle" style="width:60px;">ID</th>
                            <th class="align-middle" style="width:150px;">Umur</th>
                            <th class="align-middle" style="width:220px;">Keterangan</th>
                            <th class="text-center align-middle" style="width:120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $umurs->fetch_assoc()): ?>
                        <tr>
                            <td class="align-middle"><?= htmlspecialchars($row['id']) ?></td>
                            <td class="align-middle"><?= htmlspecialchars($row['umur']) ?></td>
                            <td class="align-middle"><?= htmlspecialchars($row['ket']) ?></td>
                            <td class="text-center align-middle">
                                <a href="edit.php?tabel=umurs&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm me-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="hapus.php?tabel=umurs&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Data Hama Card -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="fas fa-bug me-2"></i>Data Hama</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead>
                        <tr>
                            <th class="align-middle" style="width:60px;">ID</th>
                            <th class="align-middle" style="width:150px;">Hama</th>
                            <th class="align-middle" style="width:220px;">Alamat</th>
                            <th class="text-center align-middle" style="width:120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $hamas->fetch_assoc()): ?>
                        <tr>
                            <td class="align-middle"><?= htmlspecialchars($row['id']) ?></td>
                            <td class="align-middle"><?= htmlspecialchars($row['hama']) ?></td>
                            <td class="align-middle"><?= htmlspecialchars($row['alamat']) ?></td>
                            <td class="text-center align-middle">
                                <a href="edit.php?tabel=hamas&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm me-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="hapus.php?tabel=hamas&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Data Pekerjaan Card -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="fas fa-briefcase me-2"></i>Data Pekerjaan</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead>
                        <tr>
                            <th class="align-middle" style="width:60px;">ID</th>
                            <th class="align-middle" style="width:150px;">Pekerjaan</th>
                            <th class="align-middle" style="width:220px;">Keterangan</th>
                            <th class="text-center align-middle" style="width:120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $pekerjaans->fetch_assoc()): ?>
                        <tr>
                            <td class="align-middle"><?= htmlspecialchars($row['id']) ?></td>
                            <td class="align-middle"><?= htmlspecialchars($row['pekerjaan']) ?></td>
                            <td class="align-middle"><?= htmlspecialchars($row['ket']) ?></td>
                            <td class="text-center align-middle">
                                <a href="edit.php?tabel=pekerjaans&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm me-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <a href="hapus.php?tabel=pekerjaans&id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>