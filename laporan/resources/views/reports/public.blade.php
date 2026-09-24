<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Laporan - Laporan Sekolah</title>
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
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
            margin-bottom: 20px;
        }
        .report-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .status-badge {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
        }
        .status-responded {
            background: #28a745;
            color: white;
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
                <a class="nav-link" href="{{ route('reports.create') }}">Buat Laporan</a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center mb-5">
                    <h1 class="display-5 fw-bold">Laporan yang Sudah Ditanggapi</h1>
                    <p class="text-muted">Lihat laporan-laporan yang telah ditanggapi oleh admin</p>
                </div>

                @if($reports->isEmpty())
                    <div class="card report-card p-5 text-center">
                        <i class="bi bi-inbox text-muted" style="font-size: 4rem;"></i>
                        <h4 class="mt-3 text-muted">Belum Ada Laporan</h4>
                        <p class="text-muted">Belum ada laporan yang ditanggapi oleh admin.</p>
                        <a href="{{ route('reports.create') }}" class="btn btn-primary mt-3">
                            <i class="bi bi-plus-circle"></i> Buat Laporan Pertama
                        </a>
                    </div>
                @else
                    @foreach($reports as $report)
                        <div class="card report-card p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <span class="badge status-badge status-responded">
                                        <i class="bi bi-check-circle"></i> Sudah Ditanggapi
                                    </span>
                                    <small class="text-muted ms-2">
                                        <i class="bi bi-clock"></i> {{ $report->updated_at->format('d M Y, H:i') }}
                                    </small>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <h5 class="mb-2">
                                    <i class="bi bi-chat-left-text text-primary"></i> Laporan
                                </h5>
                                <p class="mb-0">{{ $report->content }}</p>
                            </div>

                            <hr>

                            <div>
                                <h5 class="mb-2">
                                    <i class="bi bi-person-check text-success"></i> Tanggapan Admin
                                </h5>
                                <p class="mb-0 text-success">{{ $report->admin_response }}</p>
                            </div>
                        </div>
                    @endforeach

                    <div class="d-flex justify-content-center mt-4">
                        {{ $reports->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">&copy; 2024 Laporan Sekolah. Platform untuk menyampaikan aspirasi.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>





