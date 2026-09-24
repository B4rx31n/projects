<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SmekdaHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-blue: #1e40af;
            --secondary-blue: #3b82f6;
            --accent-blue: #0ea5e9;
            --light-blue: #60a5fa;
            --dark-blue: #1e3a8a;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
        }
        
        body {
            background: linear-gradient(135deg, var(--dark-blue) 0%, var(--primary-blue) 50%, var(--secondary-blue) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow-x: hidden;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="%23ffffff" opacity="0.1"/></svg>');
            background-size: 50px 50px;
            opacity: 0.1;
        }
        
        .login-container {
            width: 100%;
            max-width: 420px;
            animation: fadeIn 0.6s ease-out;
        }
        
        .login-card {
            border-radius: 20px;
            overflow: hidden;
            border: none;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
            background: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--dark-blue) 0%, var(--secondary-blue) 100%);
            padding: 2.5rem 2rem;
            text-align: center;
            border-bottom: none;
            position: relative;
            overflow: hidden;
        }
        
        .card-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1%, transparent 1%);
            background-size: 20px 20px;
            opacity: 0.3;
        }
        
        .logo-container {
            position: relative;
            z-index: 1;
        }
        
        .logo-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 70px;
            height: 70px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 18px;
            margin-bottom: 1.5rem;
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(5px);
        }
        
        .logo-icon i {
            font-size: 2.2rem;
            color: white;
        }
        
        .card-header h1 {
            font-weight: 800;
            font-size: 2rem;
            color: white;
            margin-bottom: 0.5rem;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        .card-header p {
            color: rgba(255, 255, 255, 0.85);
            font-size: 0.95rem;
            margin: 0;
        }
        
        .card-body {
            padding: 2.5rem 2rem;
        }
        
        .page-title {
            text-align: center;
            color: var(--dark-blue);
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 1.8rem;
            position: relative;
            padding-bottom: 0.75rem;
        }
        
        .page-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--secondary-blue) 0%, var(--accent-blue) 100%);
            border-radius: 2px;
        }
        
        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }
        
        .input-group {
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
        }
        
        .input-group:focus-within {
            border-color: var(--secondary-blue);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            transform: translateY(-2px);
        }
        
        .input-group-text {
            background-color: #f8fafc;
            border: none;
            color: var(--secondary-blue);
            font-size: 1.1rem;
            padding: 0.875rem 1rem;
            border-right: 1px solid #e5e7eb;
        }
        
        .form-control {
            border: none;
            padding: 0.875rem 1rem;
            font-size: 0.95rem;
            background-color: white;
        }
        
        .form-control:focus {
            box-shadow: none;
            background-color: white;
        }
        
        .form-control::placeholder {
            color: #9ca3af;
        }
        
        .btn-login {
            background: linear-gradient(135deg, var(--secondary-blue) 0%, var(--accent-blue) 100%);
            border: none;
            border-radius: 12px;
            padding: 1rem;
            font-weight: 700;
            font-size: 1rem;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            width: 100%;
            margin-bottom: 1.5rem;
        }
        
        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
            background: linear-gradient(135deg, var(--accent-blue) 0%, var(--secondary-blue) 100%);
        }
        
        .btn-login:active {
            transform: translateY(-1px);
        }
        
        .btn-outline-primary {
            border: 2px solid var(--secondary-blue);
            color: var(--secondary-blue);
            border-radius: 12px;
            padding: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-outline-primary:hover {
            background-color: var(--secondary-blue);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
        }
        
        .register-text {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #6b7280;
        }
        
        .card-footer {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-top: 1px solid #e5e7eb;
            padding: 1.25rem 2rem;
            text-align: center;
        }
        
        .back-link {
            color: #6b7280;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .back-link:hover {
            color: var(--secondary-blue);
        }
        
        .demo-card {
            margin-top: 1.5rem;
            border: 2px solid var(--light-blue);
            border-radius: 16px;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }
        
        .demo-header {
            background: linear-gradient(135deg, var(--light-blue) 0%, var(--accent-blue) 100%);
            color: white;
            padding: 1rem 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .demo-content {
            padding: 1.5rem;
        }
        
        .demo-account {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }
        
        .account-type {
            background: white;
            border-radius: 12px;
            padding: 1.25rem;
            border: 1px solid #e5e7eb;
            transition: transform 0.3s ease;
        }
        
        .account-type:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }
        
        .account-type.admin {
            border-top: 4px solid var(--danger-color);
        }
        
        .account-type.siswa {
            border-top: 4px solid var(--success-color);
        }
        
        .account-type h6 {
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.75rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .account-details {
            font-size: 0.85rem;
        }
        
        .account-email {
            color: var(--dark-blue);
            font-weight: 600;
            margin-bottom: 0.25rem;
            word-break: break-all;
        }
        
        .account-password {
            color: #6b7280;
            font-size: 0.8rem;
        }
        
        /* Alerts */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }
        
        .alert-danger {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
            border-left: 4px solid var(--danger-color);
        }
        
        .alert-success {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
            border-left: 4px solid var(--success-color);
        }
        
        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }
        
        .pulse {
            animation: pulse 2s infinite;
        }
        
        /* Responsive */
        @media (max-width: 576px) {
            .login-container {
                max-width: 100%;
            }
            
            .card-header {
                padding: 2rem 1.5rem;
            }
            
            .card-body {
                padding: 2rem 1.5rem;
            }
            
            .demo-account {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }
        
        /* Floating elements */
        .floating-element {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            z-index: -1;
        }
        
        .floating-1 {
            width: 100px;
            height: 100px;
            top: 10%;
            left: 5%;
            animation: float 20s infinite linear;
        }
        
        .floating-2 {
            width: 150px;
            height: 150px;
            bottom: 15%;
            right: 10%;
            animation: float 25s infinite linear reverse;
        }
        
        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
            }
            100% {
                transform: translateY(-100px) rotate(360deg);
            }
        }
    </style>
</head>
<body>
    <!-- Floating elements -->
    <div class="floating-element floating-1"></div>
    <div class="floating-element floating-2"></div>
    
    <div class="login-container">
        <div class="login-card">
            <!-- Header -->
            <div class="card-header">
                <div class="logo-container">
                    <div class="logo-icon">
                        <i class="bi bi-megaphone-fill"></i>
                    </div>
                    <h1>SmekdaHub</h1>
                    <p>Sistem Informasi Pelaporan Sekolah</p>
                </div>
            </div>
            
            <!-- Body -->
            <div class="card-body">
                <h2 class="page-title">Masuk ke Akun</h2>
                
                @if(session('error'))
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-3 fs-5"></i>
                        <div class="flex-grow-1">{{ session('error') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('success'))
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="bi bi-check-circle-fill me-3 fs-5"></i>
                        <div class="flex-grow-1">{{ session('success') }}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" id="loginForm">
                    @csrf
                    
                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email" class="form-label">Alamat Email</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-envelope-fill"></i>
                            </span>
                            <input type="email" name="email" id="email" class="form-control" 
                                   placeholder="contoh: siswa@gmail.com" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autofocus>
                        </div>
                    </div>
                    
                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-lock-fill"></i>
                            </span>
                            <input type="password" name="password" id="password" class="form-control" 
                                   placeholder="Masukkan password Anda" 
                                   required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Login Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn-login pulse">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk Sekarang
                        </button>
                    </div>
                </form>

                <!-- Register Link -->
                <div class="register-text">
                    <p class="mb-3">Belum punya akun?</p>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary">
                        <i class="bi bi-person-plus me-2"></i>Daftar Akun Baru
                    </a>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="card-footer">
                <a href="{{ route('home') }}" class="back-link">
                    <i class="bi bi-arrow-left"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
        
        <!-- Demo Accounts -->
        <div class="demo-card">
            <div class="demo-header">
                <i class="bi bi-info-circle-fill"></i>
                <span>Akun Demo untuk Testing</span>
            </div>
            <div class="demo-content">
                <div class="demo-account">
                    <div class="account-type admin">
                        <h6><i class="bi bi-shield-check text-danger"></i> Akun Admin</h6>
                        <div class="account-details">
                            <div class="account-email">admin@smekda.com</div>
                            <div class="account-password">
                                <i class="bi bi-key me-1"></i>Password: password123
                            </div>
                        </div>
                    </div>
                    
                    <div class="account-type siswa">
                        <h6><i class="bi bi-person-check text-success"></i> Akun Siswa</h6>
                        <div class="account-details">
                            <div class="account-email">siswa@gmail.com</div>
                            <div class="account-password">
                                <i class="bi bi-key me-1"></i>Password: password123
                            </div>
                        </div>
                    </div>
                </div>
                <small class="text-muted d-block text-center mt-3">
                    <i class="bi bi-lightbulb me-1"></i>Gunakan akun demo untuk mencoba fitur sistem
                </small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            
            if (togglePassword && passwordInput) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    
                    // Toggle icon
                    const icon = this.querySelector('i');
                    if (type === 'password') {
                        icon.classList.remove('bi-eye-slash');
                        icon.classList.add('bi-eye');
                    } else {
                        icon.classList.remove('bi-eye');
                        icon.classList.add('bi-eye-slash');
                    }
                });
            }
            
            // Form submission animation
            const loginForm = document.getElementById('loginForm');
            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Memproses...';
                        submitBtn.disabled = true;
                        submitBtn.classList.remove('pulse');
                    }
                });
            }
            
            // Auto-fill demo accounts on click
            document.querySelectorAll('.account-type').forEach(account => {
                account.addEventListener('click', function() {
                    const email = this.querySelector('.account-email').textContent.trim();
                    const password = this.querySelector('.account-password').textContent
                        .replace('Password:', '').trim();
                    
                    document.getElementById('email').value = email;
                    document.getElementById('password').value = password;
                    
                    // Add visual feedback
                    this.style.transform = 'translateY(-3px) scale(1.02)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 300);
                });
            });
            
            // Add floating animation to logo
            const logoIcon = document.querySelector('.logo-icon');
            if (logoIcon) {
                setTimeout(() => {
                    logoIcon.classList.add('pulse');
                }, 1000);
            }
        });
    </script>
</body>
</html>