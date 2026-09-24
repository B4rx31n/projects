<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanggapi Laporan - Laporan Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: #f5f7fa;
        }
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        }
        .report-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .form-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">
                <i class="bi bi-speedometer2"></i> Admin Dashboard
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="mb-4">
            <i class="bi bi-reply"></i> Tanggapi Laporan
        </h2>

        <div class="card report-card mb-4 p-4">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <span class="badge bg-warning">
                        <i class="bi bi-clock"></i> Menunggu Tanggapan
                    </span>
                    <small class="text-muted ms-2">
                        <i class="bi bi-calendar"></i> {{ $report->created_at->format('d M Y, H:i') }}
                    </small>
                </div>
                <strong class="text-muted">#{{ $report->id }}</strong>
            </div>
            
            <div>
                <h5 class="mb-2">
                    <i class="bi bi-chat-left-text text-primary"></i> Isi Laporan
                </h5>
                <p class="mb-0">{{ $report->content }}</p>
            </div>
        </div>

        <div class="card form-card p-4">
            <h4 class="mb-4">
                <i class="bi bi-pencil-square"></i> Tulis Tanggapan
            </h4>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.respond', $report->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="admin_response" class="form-label fw-bold">
                        <i class="bi bi-chat-dots"></i> Tanggapan Admin
                    </label>
                    <textarea 
                        class="form-control" 
                        id="admin_response" 
                        name="admin_response" 
                        rows="8" 
                        placeholder="Tulis tanggapan Anda terhadap laporan ini..."
                        required
                    ></textarea>
                    <small class="form-text text-muted">
                        <i class="bi bi-info-circle"></i> Tanggapan ini akan ditampilkan kepada publik setelah dikirim.
                    </small>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-send"></i> Kirim Tanggapan
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

