<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem CRUD Laravel')</title>
    
    <!-- Hapus dulu animate.css untuk testing -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: #333;
            min-height: 100vh;
        }

        /* Container utama */
        .app-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: #2c3e50;
            color: white;
            display: flex;
            flex-direction: column;
        }

        .sidebar-header {
            padding: 25px 20px;
            border-bottom: 1px solid #34495e;
            text-align: center;
        }

        .sidebar-header i {
            font-size: 32px;
            color: #3498db;
            margin-bottom: 10px;
        }

        .sidebar-header h2 {
            font-size: 18px;
            font-weight: 600;
        }

        .sidebar-menu {
            padding: 20px 0;
            flex: 1;
        }

        .menu-item {
            display: block;
            padding: 12px 20px;
            color: #bdc3c7;
            text-decoration: none;
            transition: all 0.3s;
            border-left: 4px solid transparent;
        }

        .menu-item:hover {
            background: #34495e;
            color: white;
            border-left-color: #3498db;
        }

        .menu-item.active {
            background: #34495e;
            color: white;
            border-left-color: #3498db;
        }

        .menu-item i {
            width: 25px;
            margin-right: 10px;
        }

        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid #34495e;
            background: #243342;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: #3498db;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }

        .user-details {
            line-height: 1.4;
        }

        .user-name {
            font-size: 14px;
            font-weight: 600;
        }

        .user-role {
            font-size: 12px;
            color: #95a5a6;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* Top Header */
        .top-header {
            background: white;
            padding: 15px 30px;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .header-left h1 {
            font-size: 24px;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .breadcrumb {
            font-size: 14px;
            color: #7f8c8d;
        }

        .breadcrumb a {
            color: #3498db;
            text-decoration: none;
        }

        .breadcrumb span {
            margin: 0 8px;
        }

        .header-actions {
            display: flex;
            gap: 10px;
        }

        .action-btn {
            width: 36px;
            height: 36px;
            border: 1px solid #ddd;
            background: white;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #555;
            transition: all 0.3s;
        }

        .action-btn:hover {
            background: #f8f9fa;
            border-color: #3498db;
            color: #3498db;
        }

        /* Content Area */
        .content-area {
            padding: 25px;
            flex: 1;
            background: #f8f9fa;
        }

        /* Alerts */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        /* Main Content Card */
        .main-card {
            background: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
            min-height: 400px;
        }

        /* Footer */
        .main-footer {
            background: #2c3e50;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 14px;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .app-container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                position: fixed;
                z-index: 1000;
                height: 60px;
                overflow: hidden;
                transition: height 0.3s;
            }
            
            .sidebar.active {
                height: 100vh;
            }
            
            .mobile-toggle {
                position: absolute;
                right: 20px;
                top: 15px;
                background: none;
                border: none;
                color: white;
                font-size: 20px;
                cursor: pointer;
            }
            
            .main-content {
                margin-top: 60px;
            }
            
            .top-header {
                padding: 15px;
            }
            
            .content-area {
                padding: 15px;
            }
        }

        /* Utility Classes */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th {
            background: #f8f9fa;
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
        }

        .table td {
            padding: 12px;
            border-bottom: 1px solid #e0e0e0;
        }

        .table tr:hover {
            background: #f8f9fa;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-primary {
            background: #3498db;
            color: white;
        }

        .btn-primary:hover {
            background: #2980b9;
        }

        .mb-3 { margin-bottom: 1rem; }
        .mt-3 { margin-top: 1rem; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <i class="fas fa-database"></i>
                <h2>Sistem CRUD</h2>
                <button class="mobile-toggle" id="mobileToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            <div class="sidebar-menu">
                <a href="{{ url('/') }}" class="menu-item">
                    <i class="fas fa-home"></i> Dashboard
                </a>
                <a href="{{ url('/produk') }}" class="menu-item">
                    <i class="fas fa-box"></i> Produk
                </a>
                <a href="{{ url('/supplier') }}" class="menu-item">
                    <i class="fas fa-truck"></i> Supplier
                </a>
                <a href="{{ url('/anggota') }}" class="menu-item">
                    <i class="fas fa-user-friends"></i> Anggota
                </a>
                <a href="{{ url('/user') }}" class="menu-item">
                    <i class="fas fa-users"></i> Pengguna
                </a>
            </div>

            <div class="sidebar-footer">
                <div class="user-info">
                    <div class="user-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="user-details">
                        <div class="user-name">Admin</div>
                        <div class="user-role">Administrator</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <div class="top-header">
                <div class="header-left">
                    <h1>@yield('page-title', 'Dashboard')</h1>
                    <div class="breadcrumb">
                        <a href="{{ url('/') }}">Home</a>
                        <span>></span>
                        <span>@yield('page-title', 'Dashboard')</span>
                    </div>
                </div>
                <div class="header-actions">
                    <button class="action-btn" title="Refresh" onclick="window.location.reload()">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                    <button class="action-btn" title="Notifikasi">
                        <i class="fas fa-bell"></i>
                    </button>
                </div>
            </div>

            <!-- Content Area -->
            <div class="content-area">
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ session('error') }}
                    </div>
                @endif

                <div class="main-card">
                    @yield('content')
                </div>
            </div>

            <!-- Footer -->
            <div class="main-footer">
                <p>&copy; {{ date('Y') }} Sistem CRUD Laravel</p>
            </div>
        </div>
    </div>

    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileToggle = document.getElementById('mobileToggle');
            const sidebar = document.getElementById('sidebar');
            
            if (mobileToggle) {
                mobileToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                });
            }
            
            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    alert.style.opacity = '0';
                    setTimeout(() => {
                        alert.style.display = 'none';
                    }, 300);
                });
            }, 5000);
        });
    </script>
</body>
</html>