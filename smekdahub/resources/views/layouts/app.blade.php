<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmekdaHub - @yield('title', 'Sistem Pelaporan Sekolah')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --sidebar-width: 260px;
            --sidebar-collapsed: 80px;
            --primary-blue: #1e40af;
            --secondary-blue: #3b82f6;
            --light-blue: #60a5fa;
            --accent-blue: #0ea5e9;
            --dark-blue: #1e3a8a;
            --sidebar-blue: #1e3a8a;
            --light-bg: #f0f9ff;
            --border-color: #dbeafe;
            --transition-speed: 0.3s;
            --card-bg: #ffffff;
            --hover-blue: #2563eb;
        }
        
        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', 'Inter', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
            color: #1f2937;
        }
        
        /* Layout Container */
        #wrapper {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Styles - Blue Theme */
        #sidebar {
            width: var(--sidebar-width);
            background: linear-gradient(180deg, var(--sidebar-blue) 0%, var(--dark-blue) 100%);
            color: white;
            transition: all var(--transition-speed) ease;
            position: fixed;
            height: 100vh;
            z-index: 1000;
            box-shadow: 2px 0 15px rgba(30, 58, 138, 0.15);
            overflow-y: auto;
        }
        
        #sidebar.collapsed {
            width: var(--sidebar-collapsed);
        }
        
        #sidebar.collapsed .sidebar-header h3,
        #sidebar.collapsed .nav-link span,
        #sidebar.collapsed .user-info {
            display: none;
        }
        
        #sidebar.collapsed .sidebar-header {
            justify-content: center;
            padding: 1rem 0;
        }
        
        .sidebar-header {
            padding: 1.5rem 1.5rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(255, 255, 255, 0.05);
        }
        
        .sidebar-header h3 {
            margin: 0;
            font-weight: 800;
            font-size: 1.5rem;
            letter-spacing: 0.5px;
        }
        
        .sidebar-header h3 i {
            color: var(--light-blue);
            margin-right: 10px;
            background: rgba(255, 255, 255, 0.1);
            padding: 8px;
            border-radius: 10px;
        }
        
        .toggle-btn {
            background: rgba(255, 255, 255, 0.15);
            border: none;
            color: white;
            border-radius: 8px;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .toggle-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: rotate(15deg);
        }
        
        .sidebar-content {
            padding: 1.5rem 0;
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.85);
            padding: 0.9rem 1.5rem;
            margin: 0.2rem 0.8rem;
            border-radius: 10px;
            display: flex;
            align-items: center;
            transition: all 0.25s ease;
            text-decoration: none;
            white-space: nowrap;
            font-weight: 500;
        }
        
        .nav-link:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            transform: translateX(8px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        
        .nav-link.active {
            background: linear-gradient(135deg, var(--secondary-blue) 0%, var(--accent-blue) 100%);
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        
        .nav-link i {
            font-size: 1.3rem;
            width: 28px;
            margin-right: 12px;
            text-align: center;
        }
        
        .nav-link.admin-link {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            font-weight: 600;
            margin-top: 1rem;
        }
        
        .nav-link.admin-link:hover {
            background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%);
            transform: translateX(8px);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
        }
        
        /* User Profile in Sidebar */
        .user-profile {
            padding: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            margin-top: auto;
            position: absolute;
            bottom: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
        }
        
        .user-info {
            display: flex;
            align-items: center;
        }
        
        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent-blue) 0%, var(--light-blue) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            margin-right: 12px;
            flex-shrink: 0;
            font-size: 1.1rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        .user-details h6 {
            margin: 0;
            font-weight: 700;
            font-size: 0.95rem;
        }
        
        .user-details small {
            color: rgba(255, 255, 255, 0.75);
            font-size: 0.8rem;
        }
        
        /* Main Content Area */
        #content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: margin-left var(--transition-speed) ease;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: var(--light-bg);
        }
        
        #content.expanded {
            margin-left: var(--sidebar-collapsed);
        }
        
        .top-navbar {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            padding: 1.2rem 2rem;
            border-bottom: 1px solid var(--border-color);
            box-shadow: 0 4px 15px rgba(30, 58, 138, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
            font-size: 0.9rem;
        }
        
        .breadcrumb-item a {
            color: var(--secondary-blue);
            text-decoration: none;
            font-weight: 500;
        }
        
        .breadcrumb-item.active {
            color: var(--dark-blue);
            font-weight: 600;
        }
        
        .page-title {
            color: var(--dark-blue);
            font-weight: 800;
            margin: 0;
            font-size: 1.6rem;
            background: linear-gradient(135deg, var(--dark-blue) 0%, var(--secondary-blue) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .main-content {
            flex: 1;
            padding: 2rem;
            background-color: var(--light-bg);
        }
        
        /* Cards */
        .card {
            border-radius: 14px;
            border: none;
            box-shadow: 0 6px 20px rgba(30, 58, 138, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 1.5rem;
            background: var(--card-bg);
            border: 1px solid rgba(219, 234, 254, 0.5);
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(30, 58, 138, 0.12);
        }
        
        .card-header {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-bottom: 1px solid var(--border-color);
            padding: 1.5rem 1.8rem;
            border-radius: 14px 14px 0 0 !important;
            font-weight: 700;
            color: var(--dark-blue);
            font-size: 1.1rem;
        }
        
        .card-body {
            padding: 1.8rem;
        }
        
        /* Footer */
        .footer {
            background: white;
            padding: 1.2rem 2rem;
            border-top: 1px solid var(--border-color);
            color: #64748b;
            font-size: 0.9rem;
            box-shadow: 0 -2px 10px rgba(30, 58, 138, 0.03);
        }
        
        /* Alerts */
        .alert {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 1.5rem;
            border-left: 5px solid;
        }
        
        .alert-success {
            background-color: #f0fdf4;
            color: #166534;
            border-left-color: #22c55e;
        }
        
        .alert-danger {
            background-color: #fef2f2;
            color: #991b1b;
            border-left-color: #ef4444;
        }
        
        .alert-info {
            background-color: #f0f9ff;
            color: var(--dark-blue);
            border-left-color: var(--secondary-blue);
        }
        
        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, var(--secondary-blue) 0%, var(--hover-blue) 100%);
            border: none;
            border-radius: 10px;
            padding: 0.7rem 1.8rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
            background: linear-gradient(135deg, var(--hover-blue) 0%, var(--secondary-blue) 100%);
        }
        
        .btn-outline-primary {
            border: 2px solid var(--secondary-blue);
            color: var(--secondary-blue);
            border-radius: 10px;
            font-weight: 600;
            padding: 0.7rem 1.8rem;
            transition: all 0.3s ease;
        }
        
        .btn-outline-primary:hover {
            background: var(--secondary-blue);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
        }
        
        /* Stats Cards */
        .stat-card {
            border-radius: 14px;
            padding: 1.5rem;
            color: white;
            height: 100%;
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-card.blue-1 {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        }
        
        .stat-card.blue-2 {
            background: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%);
        }
        
        .stat-card.blue-3 {
            background: linear-gradient(135deg, #60a5fa 0%, #2563eb 100%);
        }
        
        .stat-card.blue-4 {
            background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%);
        }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            #sidebar {
                margin-left: -100%;
                width: 280px;
                box-shadow: 5px 0 25px rgba(30, 58, 138, 0.2);
            }
            
            #sidebar.mobile-show {
                margin-left: 0;
            }
            
            #content {
                margin-left: 0 !important;
            }
            
            .mobile-toggle {
                display: block !important;
                background: var(--secondary-blue);
                color: white;
                border: none;
                width: 45px;
                height: 45px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .mobile-toggle:hover {
                background: var(--hover-blue);
            }
            
            .desktop-toggle {
                display: none;
            }
            
            .top-navbar {
                padding: 1rem 1.5rem;
            }
            
            .main-content {
                padding: 1.5rem;
            }
        }
        
        @media (min-width: 769px) {
            .mobile-toggle {
                display: none !important;
            }
        }
        
        /* Scrollbar Styling */
        #sidebar::-webkit-scrollbar {
            width: 6px;
        }
        
        #sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }
        
        #sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }
        
        #sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }
        
        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease forwards;
        }
        
        /* Badges */
        .badge-blue {
            background: linear-gradient(135deg, var(--secondary-blue) 0%, var(--accent-blue) 100%);
            color: white;
            font-weight: 600;
            padding: 0.4em 0.8em;
            border-radius: 20px;
        }
        
        /* Table Styling */
        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(30, 58, 138, 0.05);
        }
        
        .table thead th {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            color: var(--dark-blue);
            font-weight: 700;
            border-bottom: 2px solid var(--border-color);
            padding: 1rem;
        }
        
        .table tbody tr:hover {
            background-color: rgba(219, 234, 254, 0.3);
        }
    </style>
</head>
<body>
    <div id="wrapper">
        @auth
        @can('admin-only')
        <!-- Sidebar -->
        <nav id="sidebar" class="d-flex flex-column">
            <div class="sidebar-header">
                <h3>
                    <i class="bi bi-megaphone-fill"></i>
                    <span>SmekdaHub</span>
                </h3>
                <button class="toggle-btn desktop-toggle" id="sidebarToggle">
                    <i class="bi bi-chevron-left"></i>
                </button>
            </div>

            <div class="sidebar-content flex-grow-1">
                @auth
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('forum.index') }}" class="nav-link {{ request()->is('forum') ? 'active' : '' }}">
                        <i class="bi bi-chat-dots"></i>
                        <span>Forum Diskusi</span>
                    </a>

                    <a href="#" class="nav-link">
                        <i class="bi bi-file-earmark-text"></i>
                        <span>Laporan Saya</span>
                    </a>

                    <a href="#" class="nav-link">
                        <i class="bi bi-bar-chart"></i>
                        <span>Statistik</span>
                    </a>

                    @can('admin-only')
                        <a href="{{ route('admin.kelola') }}" class="nav-link admin-link {{ request()->is('admin/*') ? 'active' : '' }}">
                            <i class="bi bi-shield-check"></i>
                            <span>Kelola Laporan</span>
                        </a>

                        <a href="#" class="nav-link">
                            <i class="bi bi-people"></i>
                            <span>Kelola Pengguna</span>
                        </a>
                    @endcan

                    <a href="#" class="nav-link">
                        <i class="bi bi-bell"></i>
                        <span>Notifikasi</span>
                        <span class="badge bg-danger ms-auto">3</span>
                    </a>

                    <a href="#" class="nav-link">
                        <i class="bi bi-gear"></i>
                        <span>Pengaturan</span>
                    </a>

                    <a href="#" class="nav-link">
                        <i class="bi bi-question-circle"></i>
                        <span>Bantuan</span>
                    </a>
                @endauth
            </div>

            @auth
            <div class="user-profile">
                <div class="user-info">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="user-details">
                        <h6>{{ Auth::user()->name }}</h6>
                        <small>{{ ucfirst(Auth::user()->role) }}</small>
                    </div>
                </div>
                <div class="mt-3">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm w-100">
                            <i class="bi bi-box-arrow-right me-1"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>
            @endauth
        </nav>
        @endcan
        @endauth

        <!-- Main Content -->
        <div id="content" class="{{ Auth::check() && Auth::user()->role !== 'admin' ? 'full-width' : '' }}">
            @auth
            @can('admin-only')
            <!-- Top Navbar -->
            <nav class="top-navbar">
                <div class="d-flex align-items-center">
                    <button class="btn mobile-toggle me-3" id="mobileSidebarToggle">
                        <i class="bi bi-list"></i>
                    </button>
                    <div>
                        <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bi bi-house-door"></i></a></li>
                                @yield('breadcrumb')
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="d-flex align-items-center">
                    <div class="me-3 d-none d-md-block">
                        <span class="text-muted">
                            <i class="bi bi-calendar3 me-1"></i>
                            <span id="current-date">{{ now()->format('d F Y') }}</span>
                        </span>
                    </div>

                    @auth
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                            <div class="user-avatar me-2" style="width: 36px; height: 36px;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><h6 class="dropdown-header">{{ Auth::user()->email }}</h6></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profil</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Pengaturan</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @endauth
                </div>
            </nav>
            @endcan
            @endauth
            
            <!-- Main Content Area -->
            <main class="main-content fade-in">
                <div class="container-fluid">
                    <!-- Flash Messages -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                            <i class="bi bi-check-circle-fill me-3 fs-5"></i>
                            <div class="flex-grow-1">{{ session('success') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-3 fs-5"></i>
                            <div class="flex-grow-1">{{ session('error') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if(session('info'))
                        <div class="alert alert-info alert-dismissible fade show d-flex align-items-center" role="alert">
                            <i class="bi bi-info-circle-fill me-3 fs-5"></i>
                            <div class="flex-grow-1">{{ session('info') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-exclamation-triangle-fill me-3 fs-5"></i>
                                <div class="flex-grow-1">
                                    <strong>Terjadi kesalahan:</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    <!-- Page Content -->
                    @yield('content')
                </div>
            </main>
            
            <!-- Footer -->
            <footer class="footer">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-2 mb-md-0">
                            <i class="bi bi-c-circle me-1"></i> 2024 SmekdaHub - Sistem Informasi Pelaporan Sekolah
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="mb-0">
                            <i class="bi bi-envelope me-1"></i>smekdahub@school.edu
                            <span class="mx-2 d-none d-md-inline">|</span>
                            <i class="bi bi-telephone me-1 d-none d-md-inline"></i>
                            <span class="d-none d-md-inline">(021) 1234-5678</span>
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');
            
            // Set current date
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('current-date').textContent = now.toLocaleDateString('id-ID', options);
            
            // Toggle sidebar on desktop
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                    content.classList.toggle('expanded');
                    
                    // Change icon
                    const icon = this.querySelector('i');
                    if (sidebar.classList.contains('collapsed')) {
                        icon.classList.remove('bi-chevron-left');
                        icon.classList.add('bi-chevron-right');
                    } else {
                        icon.classList.remove('bi-chevron-right');
                        icon.classList.add('bi-chevron-left');
                    }
                });
            }
            
            // Toggle sidebar on mobile
            if (mobileSidebarToggle) {
                mobileSidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('mobile-show');
                });
            }
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(event) {
                const isMobile = window.innerWidth <= 768;
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnMobileToggle = mobileSidebarToggle && mobileSidebarToggle.contains(event.target);
                
                if (isMobile && !isClickInsideSidebar && !isClickOnMobileToggle && sidebar.classList.contains('mobile-show')) {
                    sidebar.classList.remove('mobile-show');
                }
            });
            
            // Auto-dismiss alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    if (alert.classList.contains('show')) {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    }
                }, 5000);
            });
            
            // Set active nav link based on current URL
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');
            
            navLinks.forEach(link => {
                const linkPath = link.getAttribute('href');
                if (linkPath && currentPath.startsWith(linkPath) && linkPath !== '/') {
                    navLinks.forEach(l => l.classList.remove('active'));
                    link.classList.add('active');
                }
            });
            
            // Dashboard link active when on root or dashboard
            if (currentPath === '/' || currentPath.includes('dashboard')) {
                const dashboardLink = document.querySelector('a[href*="dashboard"]');
                if (dashboardLink) {
                    navLinks.forEach(l => l.classList.remove('active'));
                    dashboardLink.classList.add('active');
                }
            }
        });
        
        // Adjust sidebar on window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const isMobile = window.innerWidth <= 768;
            
            if (isMobile && !sidebar.classList.contains('mobile-show')) {
                sidebar.classList.remove('collapsed');
                document.getElementById('content').classList.remove('expanded');
            }
        });
    </script>
    @stack('scripts')
</body>
</html>