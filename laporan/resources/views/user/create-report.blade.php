<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Laporan - Laporan Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
        .report-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            background: white;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }
        .anonymous-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">
                <i class="bi bi-megaphone"></i> Laporan Sekolah
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="/">Beranda</a>
                <a class="nav-link" href="{{ route('reports.public') }}">Lihat Laporan</a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card report-card p-4">
                    <div class="text-center mb-4">
                        <i class="bi bi-shield-check text-primary" style="font-size: 3rem;"></i>
                        <h2 class="mt-3">Buat Laporan Baru</h2>
                        <span class="anonymous-badge">
                            <i class="bi bi-eye-slash"></i> 100% Anonim
                        </span>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('reports.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="content" class="form-label fw-bold">
                                <i class="bi bi-pencil-square"></i> Isi Laporan Anda
                            </label>
                            <textarea 
                                class="form-control" 
                                id="content" 
                                name="content" 
                                rows="8" 
                                placeholder="Tulis laporan Anda di sini. Contoh: 'Sekolah ini banyak fasilitas yang kurang seperti laboratorium komputer dan perpustakaan yang lebih lengkap. Harap pihak sekolah dapat memperhatikan hal ini.'"
                                required
                            ></textarea>
                            <small class="form-text text-muted">
                                <i class="bi bi-info-circle"></i> Laporan Anda akan tetap anonim. Anda dapat melaporkan apa saja terkait sekolah.
                            </small>
                        </div>

                        <div class="alert alert-info">
                            <i class="bi bi-lightbulb"></i> <strong>Tips:</strong> 
                            <ul class="mb-0 mt-2">
                                <li>Laporan dapat berupa saran, keluhan, atau masukan</li>
                                <li>Gunakan bahasa yang sopan dan jelas</li>
                                <li>Admin akan menanggapi laporan Anda</li>
                            </ul>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-send"></i> Kirim Laporan
                            </button>
                            <a href="{{ route('reports.public') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-list-ul"></i> Lihat Laporan Lainnya
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
