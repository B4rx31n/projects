<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Laporan Sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --primary-gradient-hover: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            --sidebar-bg: #1a1c23;
            --sidebar-hover: #2a2d3a;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --card-shadow-hover: 0 15px 35px rgba(0, 0, 0, 0.12);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        body {
            background-color: #f8fafc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        /* Layout dengan sidebar */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Modern */
        .sidebar {
            width: 260px;
            background: var(--sidebar-bg);
            color: #fff;
            padding: 0;
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.1);
            z-index: 10;
            transition: var(--transition);
        }

        .sidebar-header {
            padding: 25px 20px;
            background: rgba(0, 0, 0, 0.2);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h3 {
            font-weight: 700;
            font-size: 1.4rem;
            margin-bottom: 5px;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .sidebar-header p {
            color: #a0a0c0;
            font-size: 0.85rem;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 14px 20px;
            color: #b0b0d0;
            text-decoration: none;
            transition: var(--transition);
            border-left: 4px solid transparent;
        }

        .sidebar-menu a:hover, .sidebar-menu a.active {
            background: var(--sidebar-hover);
            color: #fff;
            border-left-color: #667eea;
        }

        .sidebar-menu a i {
            margin-right: 12px;
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 20px 30px;
            overflow-y: auto;
        }

        /* Navbar atas */
        .top-navbar {
            background: #fff;
            padding: 15px 25px;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-navbar h1 {
            font-weight: 700;
            font-size: 1.8rem;
            margin: 0;
            color: #2d3748;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
        }

        /* Statistik Cards Modern */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 25px;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            border: none;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--card-shadow-hover);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--primary-gradient);
        }

        .stat-icon {
            width: 70px;
            height: 70px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: 2rem;
        }

        .stat-icon.total {
            background: rgba(102, 126, 234, 0.1);
            color: #667eea;
        }

        .stat-icon.pending {
            background: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }

        .stat-icon.responded {
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }

        .stat-card h3 {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 5px;
            color: #2d3748;
        }

        .stat-card p {
            color: #718096;
            font-size: 0.95rem;
            margin-bottom: 0;
        }

        .stat-change {
            font-size: 0.85rem;
            margin-top: 10px;
            display: flex;
            align-items: center;
        }

        .stat-change.up {
            color: #28a745;
        }

        .stat-change.down {
            color: #e53e3e;
        }

        /* Report Cards Modern */
        .report-card {
            background: #fff;
            border-radius: 16px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            border: none;
        }

        .report-card:hover {
            box-shadow: var(--card-shadow-hover);
        }

        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eef2f7;
        }

        .report-id {
            font-weight: 700;
            color: #667eea;
            font-size: 1.1rem;
        }

        .report-date {
            color: #a0a0c0;
            font-size: 0.9rem;
        }

        .report-content {
            margin-bottom: 25px;
            line-height: 1.6;
            color: #4a5568;
        }

        .status-badge {
            padding: 8px 18px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .status-pending {
            background: rgba(255, 193, 7, 0.15);
            color: #d97706;
            border: 1px solid rgba(255, 193, 7, 0.3);
        }

        .status-responded {
            background: rgba(40, 167, 69, 0.15);
            color: #28a745;
            border: 1px solid rgba(40, 167, 69, 0.3);
        }

        .admin-response {
            background: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
            border-left: 4px solid #28a745;
        }

        .response-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
            color: #28a745;
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }

        .btn-modern {
            padding: 10px 22px;
            border-radius: 10px;
            font-weight: 600;
            border: none;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-respond {
            background: var(--primary-gradient);
            color: white;
        }

        .btn-respond:hover {
            background: var(--primary-gradient-hover);
            color: white;
            transform: translateY(-2px);
        }

        .btn-view {
            background: #eef2f7;
            color: #4a5568;
        }

        .btn-view:hover {
            background: #e2e8f0;
            color: #2d3748;
            transform: translateY(-2px);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 30px;
            background: #fff;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
        }

        .empty-icon {
            font-size: 5rem;
            color: #cbd5e0;
            margin-bottom: 20px;
        }

        .empty-state h4 {
            color: #4a5568;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #a0a0c0;
            max-width: 500px;
            margin: 0 auto 25px;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .dashboard-container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                height: auto;
            }
            
            .stats-container {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 20px 15px;
            }
            
            .top-navbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .user-info {
                align-self: flex-end;
            }
            
            .stats-container {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn-modern {
                width: 100%;
                justify-content: center;
            }
        }

        /* Animasi */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h3><i class="fas fa-school me-2"></i> Admin Sekolah</h3>
                <p>Manajemen Laporan Sekolah</p>
            </div>
            
            <div class="sidebar-menu">
                <a href="#" class="active">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a href="#">
                    <i class="fas fa-file-alt"></i> Laporan
                </a>
                <a href="#">
                    <i class="fas fa-chart-bar"></i> Statistik
                </a>
                <a href="#">
                    <i class="fas fa-users"></i> Pengguna
                </a>
                <a href="#">
                    <i class="fas fa-cog"></i> Pengaturan
                </a>
            </div>
            
            <div class="sidebar-footer" style="padding: 20px; margin-top: 50px; border-top: 1px solid rgba(255,255,255,0.1);">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-modern btn-view w-100">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Navbar -->
            <div class="top-navbar fade-in">
                <h1><i class="fas fa-tachometer-alt me-2"></i> Dashboard Laporan</h1>
                <div class="user-info">
                    <div class="user-avatar">AD</div>
                    <div>
                        <div class="fw-bold">Admin Sekolah</div>
                        <small class="text-muted">Administrator</small>
                    </div>
                </div>
            </div>
            
            <!-- Alert -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center fade-in" role="alert" style="border-radius: 12px; border: none; box-shadow: var(--card-shadow);">
                    <i class="fas fa-check-circle me-3" style="font-size: 1.5rem;"></i>
                    <div class="flex-grow-1">{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            
            <!-- Statistics -->
            <div class="stats-container fade-in">
                <div class="stat-card">
                    <div class="stat-icon total">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h3>{{ $reports->count() }}</h3>
                    <p>Total Laporan</p>
                    <div class="stat-change up">
                        <i class="fas fa-arrow-up me-1"></i> 12% dari bulan lalu
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon pending">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3>{{ $reports->where('status', 'pending')->count() }}</h3>
                    <p>Menunggu Tanggapan</p>
                    <div class="stat-change down">
                        <i class="fas fa-arrow-down me-1"></i> 5% dari minggu lalu
                    </div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-icon responded">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3>{{ $reports->where('status', 'responded')->count() }}</h3>
                    <p>Sudah Ditanggapi</p>
                    <div class="stat-change up">
                        <i class="fas fa-arrow-up me-1"></i> 18% dari minggu lalu
                    </div>
                </div>
            </div>
            
            <!-- Reports Section -->
            <div class="d-flex justify-content-between align-items-center mb-4 fade-in">
                <h2 class="fw-bold mb-0">
                    <i class="fas fa-list-ul me-2"></i> Daftar Laporan
                </h2>
                <div class="text-muted">
                    Menampilkan <span class="fw-bold text-primary">{{ $reports->count() }}</span> laporan
                </div>
            </div>
            
            @if($reports->isEmpty())
                <div class="empty-state fade-in">
                    <div class="empty-icon">
                        <i class="fas fa-inbox"></i>
                    </div>
                    <h4>Belum Ada Laporan</h4>
                    <p>Saat ini belum ada laporan yang masuk ke sistem. Laporan dari pengguna akan muncul di sini.</p>
                    <button class="btn btn-modern btn-respond">
                        <i class="fas fa-plus me-2"></i> Buat Laporan Contoh
                    </button>
                </div>
            @else
                @foreach($reports as $report)
                    <div class="report-card fade-in">
                        <div class="report-header">
                            <div>
                                <span class="status-badge status-{{ $report->status }}">
                                    @if($report->status === 'pending')
                                        <i class="fas fa-clock me-1"></i> Menunggu Tanggapan
                                    @else
                                        <i class="fas fa-check-circle me-1"></i> Sudah Ditanggapi
                                    @endif
                                </span>
                                <div class="report-date mt-2">
                                    <i class="far fa-calendar me-1"></i> {{ $report->created_at->format('d M Y, H:i') }}
                                </div>
                            </div>
                            <div class="report-id">#{{ str_pad($report->id, 5, '0', STR_PAD_LEFT) }}</div>
                        </div>
                        
                        <div class="report-content">
                            <h5 class="mb-3 text-dark">
                                <i class="fas fa-comment-alt me-2 text-primary"></i> Isi Laporan
                            </h5>
                            <p class="mb-0">{{ $report->content }}</p>
                        </div>
                        
                        @if($report->status === 'responded')
                            <div class="admin-response">
                                <div class="response-header">
                                    <i class="fas fa-user-check"></i>
                                    <span>Tanggapan Admin</span>
                                </div>
                                <p class="mb-2">{{ $report->admin_response }}</p>
                                <small class="text-muted">
                                    <i class="far fa-clock me-1"></i> Ditanggapi pada {{ $report->updated_at->format('d M Y, H:i') }}
                                </small>
                            </div>
                        @endif
                        
                        <div class="action-buttons">
                            <a href="{{ route('admin.respond.form', $report->id) }}" class="btn btn-modern btn-respond">
                                <i class="fas fa-reply me-1"></i> Tanggapi Laporan
                            </a>
                            <a href="#" class="btn btn-modern btn-view">
                                <i class="far fa-eye me-1"></i> Detail Laporan
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
            
            <!-- Footer -->
            <div class="mt-5 pt-4 text-center text-muted border-top fade-in">
                <p>Admin Dashboard &copy; {{ date('Y') }} - Sistem Laporan Sekolah</p>
                <small>v2.1.0 | Terakhir diakses: {{ date('d M Y, H:i') }}</small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animasi untuk statistik cards saat di-scroll
        document.addEventListener('DOMContentLoaded', function() {
            // Efek hover pada statistik cards
            const statCards = document.querySelectorAll('.stat-card');
            statCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
            
            // Tambahkan animasi fade-in pada elemen saat scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);
            
            // Terapkan pada report cards
            document.querySelectorAll('.report-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                observer.observe(card);
            });
            
            // Tambahkan efek loading untuk tombol
            document.querySelectorAll('.btn-respond').forEach(button => {
                button.addEventListener('click', function(e) {
                    const originalText = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Memproses...';
                    this.disabled = true;
                    
                    // Simulasi loading
                    setTimeout(() => {
                        this.innerHTML = originalText;
                        this.disabled = false;
                    }, 1500);
                });
            });
        });
    </script>
</body>
</html>