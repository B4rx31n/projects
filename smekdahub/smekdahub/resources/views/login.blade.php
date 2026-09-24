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
            --gradient-bg: linear-gradient(135deg, #1e3a8a 0%, #1e40af 30%, #3b82f6 70%, #60a5fa 100%);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--gradient-bg);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            z-index: -1;
        }
        
        .login-wrapper {
            width: 100%;
            max-width: 440px;
            animation: fadeInUp 0.8s ease-out;
        }
        
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.35);
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
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 1%, transparent 1%);
            background-size: 30px 30px;
            opacity: 0.3;
            animation: float 20s linear infinite;
        }
        
        .logo-container {
            position: relative;
            z-index: 2;
        }
        
        .logo-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            margin-bottom: 1.5rem;
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(5px);
            transition: transform 0.3s ease;
        }
        
        .logo-icon:hover {
            transform: rotate(10deg) scale(1.05);
        }
        
        .logo-icon i {
            font-size: 2.5rem;
            color: white;
        }
        
        .card-header h1 {
            font-weight: 800;
            font-size: 2.5rem;
            color: white;
            margin-bottom: 0.5rem;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        
        .card-header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
            margin: 0;
            font-weight: 300;
        }
        
        .card-body {
            padding: 2.5rem 2rem;
        }
        
        .page-title {
            text-align: center;
            color: var(--dark-blue);
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 1rem;
        }
        
        .page-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--secondary-blue) 0%, var(--accent-blue) 100%);
            border-radius: 2px;
        }
        
        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
        }
        
        .form-label i {
            margin-right: 10px;
            color: var(--secondary-blue);
            font-size: 1.1rem;
        }
        
        .input-group {
            border-radius: 14px;
            overflow: hidden;
            border: 2px solid #e5e7eb;
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
        }
        
        .input-group:focus-within {
            border-color: var(--secondary-blue);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
            transform: translateY(-2px);
        }
        
        .input-group-text {
            background: #f8fafc;
            border: none;
            color: var(--secondary-blue);
            font-size: 1.2rem;
            padding: 0 1.25rem;
            min-width: 55px;
            justify-content: center;
        }
        
        .form-control {
            border: none;
            padding: 1rem 1.25rem;
            font-size: 1rem;
            background: white;
            height: auto;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            box-shadow: none;
            background: white;
        }
        
        .form-control::placeholder {
            color: #9ca3af;
            font-weight: 400;
        }
        
        .form-check {
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
        }
        
        .form-check-input {
            width: 20px;
            height: 20px;
            border-radius: 6px;
            border: 2px solid #d1d5db;
            margin-right: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .form-check-input:checked {
            background-color: var(--secondary-blue);
            border-color: var(--secondary-blue);
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/%3e%3c/svg%3e");
        }
        
        .form-check-input:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
        }
        
        .form-check-label {
            color: #4b5563;
            font-weight: 500;
            font-size: 0.95rem;
            cursor: pointer;
        }
        
        .btn-login {
            background: linear-gradient(135deg, var(--secondary-blue) 0%, var(--accent-blue) 100%);
            border: none;
            border-radius: 14px;
            padding: 1.1rem;
            font-weight: 700;
            font-size: 1.1rem;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
            width: 100%;
            position: relative;
            overflow: hidden;
        }
        
        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }
        
        .btn-login:hover::before {
            left: 100%;
        }
        
        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(59, 130, 246, 0.5);
            background: linear-gradient(135deg, var(--accent-blue) 0%, var(--secondary-blue) 100%);
        }
        
        .btn-login:active {
            transform: translateY(-1px);
        }
        
        .demo-info {
            margin-top: 2rem;
            padding: 1.5rem;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            border-radius: 16px;
            border: 2px solid var(--light-blue);
            text-align: center;
        }
        
        .demo-info h6 {
            color: var(--dark-blue);
            font-weight: 700;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .demo-accounts {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        
        .demo-account {
            background: white;
            border-radius: 12px;
            padding: 1rem;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .demo-account:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            border-color: var(--secondary-blue);
        }
        
        .demo-account.admin {
            border-top: 4px solid var(--danger-color);
        }
        
        .demo-account.siswa {
            border-top: 4px solid var(--success-color);
        }
        
        .account-type {
            font-weight: 700;
            font-size: 0.9rem;
            color: #1f2937;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .account-email {
            color: var(--dark-blue);
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 0.25rem;
            word-break: break-all;
        }
        
        .account-password {
            color: #6b7280;
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .card-footer {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-top: 1px solid #e5e7eb;
            padding: 1.5rem 2rem;
            text-align: center;
        }
        
        .footer-text {
            color: #6b7280;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }
        
        .back-link {
            color: var(--secondary-blue);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
        }
        
        .back-link:hover {
            color: var(--dark-blue);
            text-decoration: underline;
        }
        
        /* Alerts */
        .alert {
            border-radius: 14px;
            border: none;
            padding: 1.25rem 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            animation: slideIn 0.5s ease-out;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #991b1b;
            border-left: 5px solid var(--danger-color);
        }
        
        .alert-success {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            color: #065f46;
            border-left: 5px solid var(--success-color);
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes float {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
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
        
        /* Floating elements */
        .floating-shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            z-index: -1;
            filter: blur(40px);
        }
        
        .shape-1 {
            width: 300px;
            height: 300px;
            top: -150px;
            right: -150px;
        }
        
        .shape-2 {
            width: 200px;
            height: 200px;
            bottom: -100px;
            left: -100px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .login-wrapper {
                max-width: 100%;
            }
            
            .card-header {
                padding: 2rem 1.5rem;
            }
            
            .card-body {
                padding: 2rem 1.5rem;
            }
            
            .logo-icon {
                width: 70px;
                height: 70px;
            }
            
            .card-header h1 {
                font-size: 2rem;
            }
            
            .demo-accounts {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--secondary-blue);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--dark-blue);
        }
    </style>
</head>
<body>
    <!-- Floating Background Shapes -->
    <div class="floating-shape shape-1"></div>
    <div class="floating-shape shape-2"></div>
    
    <div class="login-wrapper">
        <div class="login-card">
            <!-- Header -->
            <div class="card-header">
                <div class="logo-container">
                    <div class="logo-icon pulse">
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
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <i class="bi bi-check-circle-fill me-3 fs-5"></i>
                        <div class="flex-grow-1">{{ session('success') }}</div>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" id="loginForm">
                    @csrf
                    
                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="bi bi-envelope-fill"></i>Alamat Email
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person-circle"></i>
                            </span>
                            <input type="email" name="email" id="email" class="form-control" 
                                   placeholder="contoh: admin@smekda.com" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autofocus>
                        </div>
                    </div>
                    
                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="bi bi-lock-fill"></i>Password
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-key-fill"></i>
                            </span>
                            <input type="password" name="password" id="password" class="form-control" 
                                   placeholder="Masukkan password Anda" 
                                   required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Remember Me -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Ingat Saya pada perangkat ini
                        </label>
                    </div>
                    
                    <!-- Login Button -->
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn-login">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk Sekarang
                        </button>
                    </div>
                </form>
                
                <!-- Demo Accounts -->
                <div class="demo-info">
                    <h6>
                        <i class="bi bi-info-circle-fill"></i>
                        Akun Demo untuk Testing
                    </h6>
                    <div class="demo-accounts">
                        <div class="demo-account admin" onclick="fillCredentials('admin@smekda.com', 'password123')">
                            <div class="account-type">
                                <i class="bi bi-shield-check text-danger"></i>
                                Akun Admin
                            </div>
                            <div class="account-email">admin@smekda.com</div>
                            <div class="account-password">
                                <i class="bi bi-key"></i>
                                password123
                            </div>
                        </div>
                        
                        <div class="demo-account siswa" onclick="fillCredentials('siswa@gmail.com', 'password123')">
                            <div class="account-type">
                                <i class="bi bi-person-check text-success"></i>
                                Akun Siswa
                            </div>
                            <div class="account-email">siswa@gmail.com</div>
                            <div class="account-password">
                                <i class="bi bi-key"></i>
                                password123
                            </div>
                        </div>
                    </div>
                    <small class="text-muted d-block">
                        <i class="bi bi-lightbulb me-1"></i>Klik akun demo untuk mengisi formulir
                    </small>
                </div>
            </div>
            
            <!-- Footer -->
            <div class="card-footer">
                <p class="footer-text mb-2">Belum punya akun? Hubungi Admin Sekolah.</p>
                <a href="/" class="back-link">
                    <i class="bi bi-arrow-left"></i>
                    Kembali ke Halaman Utama
                </a>
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
            
            // Auto-fill demo credentials
            window.fillCredentials = function(email, password) {
                document.getElementById('email').value = email;
                document.getElementById('password').value = password;
                
                // Show visual feedback
                const loginBtn = document.querySelector('.btn-login');
                loginBtn.classList.add('pulse');
                setTimeout(() => loginBtn.classList.remove('pulse'), 1000);
            };
            
            // Form submission handling
            const loginForm = document.getElementById('loginForm');
            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    const submitBtn = this.querySelector('.btn-login');
                    if (submitBtn) {
                        submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Memproses...';
                        submitBtn.disabled = true;
                        submitBtn.classList.remove('pulse');
                    }
                });
            }
            
            // Auto-focus animation
            const emailInput = document.getElementById('email');
            if (emailInput) {
                setTimeout(() => {
                    emailInput.focus();
                }, 500);
            }
            
            // Add ripple effect to login button
            const loginBtn = document.querySelector('.btn-login');
            if (loginBtn) {
                loginBtn.addEventListener('click', function(e) {
                    const rect = this.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    const ripple = document.createElement('span');
                    ripple.style.position = 'absolute';
                    ripple.style.borderRadius = '50%';
                    ripple.style.background = 'rgba(255, 255, 255, 0.6)';
                    ripple.style.transform = 'scale(0)';
                    ripple.style.animation = 'ripple 0.6s linear';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => ripple.remove(), 600);
                });
            }
            
            // Add CSS for ripple effect
            const style = document.createElement('style');
            style.textContent = `
                @keyframes ripple {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>
</html>