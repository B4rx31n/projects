<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Gabungan</title>
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
            margin-bottom: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border: none;
        }
        .card-header {
            background-color: #0d6efd;
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 15px 20px;
        }
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
            padding-bottom: 10px;
            border-bottom: 2px solid #0d6efd;
        }
        .btn-submit {
            width: 100%;
            padding: 12px;
            font-weight: 600;
            margin-top: 20px;
        }
        .form-label {
            font-weight: 500;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2><i class="fas fa-plus-circle me-2"></i>Tambah Data Gabungan</h2>
            
            <form action="simpan.php" method="post">
                <!-- Data Umur Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-user-clock me-2"></i>Data Umur</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="umur" class="form-label">Umur</label>
                            <input type="number" class="form-control" id="umur" name="umur" required>
                        </div>
                        <div class="mb-3">
                            <label for="ket_umur" class="form-label">Keterangan Umur</label>
                            <input type="text" class="form-control" id="ket_umur" name="ket_umur">
                        </div>
                    </div>
                </div>

                <!-- Data Hama Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-bug me-2"></i>Data Hama</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="hama" class="form-label">Nama Hama</label>
                            <input type="text" class="form-control" id="hama" name="hama" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat">
                        </div>
                    </div>
                </div>

                <!-- Data Pekerjaan Card -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-briefcase me-2"></i>Data Pekerjaan</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="pekerjaan" class="form-label">Pekerjaan</label>
                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" required>
                        </div>
                        <div class="mb-3">
                            <label for="ket_pekerjaan" class="form-label">Keterangan Pekerjaan</label>
                            <input type="text" class="form-control" id="ket_pekerjaan" name="ket_pekerjaan">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-submit">
                    <i class="fas fa-save me-2"></i>Simpan Semua Data
                </button>
            </form>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>