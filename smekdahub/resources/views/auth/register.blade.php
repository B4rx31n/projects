<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - SmekdaHub</title>
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
        
        .register-container {
            width: 100%;
            max-width: 520px;
            animation: slideIn 0.6s ease-out;
        }
        
        .register-card {
            border-radius: 20px;
            overflow: hidden;
            border: none;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
            background: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .register-card:hover {
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
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .form-label.required::after {
            content: '*';
            color: var(--danger-color);
            margin-left: 2px;
        }
        
        .input-group {
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
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
            width: 50px;
            justify-content: center;
        }
        
        .form-control, .form-select {
            border: none;
            padding: 0.875rem 1rem;
            font-size: 0.95rem;
            background-color: white;
            height: auto;
        }
        
        .form-control:focus, .form-select:focus {
            box-shadow: none;
            background-color: white;
        }
        
        .form-control::placeholder {
            color: #9ca3af;
        }
        
        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
        }
        
        /* Role Cards */
        .role-selection {
            margin-bottom: 1.5rem;
        }
        
        .role-options {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-top: 0.5rem;
        }
        
        .role-option {
            padding: 12px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
        }
        
        .role-option:hover {
            border-color: var(--light-blue);
            background-color: rgba(96, 165, 250, 0.05);
            transform: translateY(-2px);
        }
        
        .role-option.selected {
            border-color: var(--secondary-blue);
            background-color: rgba(59, 130, 246, 0.1);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }
        
        .role-icon {
            font-size: 1.5rem;
            color: var(--secondary-blue);
            margin-bottom: 8px;
        }
        
        .role-option.selected .role-icon {
            color: var(--dark-blue);
        }
        
        .role-name {
            font-weight: 600;
            font-size: 0.85rem;
            color: #374151;
        }
        
        .role-option.selected .role-name {
            color: var(--dark-blue);
        }
        
        /* Password Strength Indicator */
        .password-strength {
            margin-top: 0.5rem;
            padding: 10px;
            background: #f8fafc;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }
        
        .strength-meter {
            height: 4px;
            background: #e5e7eb;
            border-radius: 2px;
            margin-bottom: 8px;
            overflow: hidden;
        }
        
        .strength-fill {
            height: 100%;
            width: 0%;
            background: var(--danger-color);
            border-radius: 2px;
            transition: all 0.3s ease;
        }
        
        .strength-label {
            font-size: 0.8rem;
            color: #6b7280;
        }
        
        .strength-requirements {
            font-size: 0.75rem;
            color: #6b7280;
            margin-top: 8px;
        }
        
        .requirement {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-bottom: 3px;
        }
        
        .requirement.met {
            color: var(--success-color);
        }
        
        .requirement.met::before {
            content: '✓';
            color: var(--success-color);
        }
        
        .btn-register {
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
        }
        
        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
            background: linear-gradient(135deg, var(--accent-blue) 0%, var(--secondary-blue) 100%);
        }
        
        .btn-register:active {
            transform: translateY(-1px);
        }
        
        .btn-register:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        
        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e5e7eb;
        }
        
        .login-link a {
            color: var(--secondary-blue);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s ease;
        }
        
        .login-link a:hover {
            color: var(--dark-blue);
            text-decoration: underline;
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
        
        /* Terms Checkbox */
        .terms-checkbox {
            margin: 1.5rem 0;
            padding: 15px;
            background: #f8fafc;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
        }
        
        .form-check-input {
            width: 18px;
            height: 18px;
            border-radius: 4px;
            border: 2px solid #d1d5db;
            cursor: pointer;
        }
        
        .form-check-input:checked {
            background-color: var(--secondary-blue);
            border-color: var(--secondary-blue);
        }
        
        .form-check-input:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .form-check-label {
            font-size: 0.9rem;
            color: #4b5563;
            margin-left: 0.5rem;
        }
        
        .form-check-label a {
            color: var(--secondary-blue);
            text-decoration: none;
            font-weight: 600;
        }
        
        .form-check-label a:hover {
            text-decoration: underline;
        }
        
        /* Error Styling */
        .error-message {
            color: var(--danger-color);
            font-size: 0.8rem;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .error-input {
            border-color: var(--danger-color) !important;
        }
        
        .error-input:focus-within {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1) !important;
        }
        
        /* Animation */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        
        .shake {
            animation: shake 0.5s ease-in-out;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .register-container {
                max-width: 100%;
            }
            
            .card-header {
                padding: 2rem 1.5rem;
            }
            
            .card-body {
                padding: 2rem 1.5rem;
            }
            
            .role-options {
                grid-template-columns: 1fr;
                gap: 8px;
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
            width: 80px;
            height: 80px;
            top: 15%;
            left: 10%;
            animation: float 15s infinite linear;
        }
        
        .floating-2 {
            width: 120px;
            height: 120px;
            bottom: 10%;
            right: 5%;
            animation: float 20s infinite linear reverse;
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
    
    <div class="register-container">
        <div class="register-card">
            <!-- Header -->
            <div class="card-header">
                <div class="logo-container">
                    <div class="logo-icon">
                        <i class="bi bi-megaphone-fill"></i>
                    </div>
                    <h1>SmekdaHub</h1>
                    <p>Bergabung dengan komunitas sekolah kami</p>
                </div>
            </div>
            
            <!-- Body -->
            <div class="card-body">
                <h2 class="page-title">Buat Akun Baru</h2>
                
                @if($errors->any())
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-3 fs-5"></i>
                        <div class="flex-grow-1">
                            <strong>Periksa kembali data Anda:</strong>
                            <ul class="mb-0 mt-2 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST" id="registerForm" novalidate>
                    @csrf
                    
                    <!-- Full Name Field -->
                    <div class="form-group">
                        <label for="name" class="form-label required">
                            <i class="bi bi-person"></i>Nama Lengkap
                        </label>
                        <div class="input-group {{ $errors->has('name') ? 'error-input' : '' }}">
                            <span class="input-group-text">
                                <i class="bi bi-person-fill"></i>
                            </span>
                            <input type="text" name="name" id="name" class="form-control" 
                                   placeholder="Contoh: Ahmad Santoso" 
                                   value="{{ old('name') }}" 
                                   required>
                        </div>
                        @if($errors->has('name'))
                            <div class="error-message">
                                <i class="bi bi-exclamation-circle"></i>
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                    
                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email" class="form-label required">
                            <i class="bi bi-envelope"></i>Alamat Email
                        </label>
                        <div class="input-group {{ $errors->has('email') ? 'error-input' : '' }}">
                            <span class="input-group-text">
                                <i class="bi bi-envelope-fill"></i>
                            </span>
                            <input type="email" name="email" id="email" class="form-control"
                                   placeholder="contoh: nama@email.com" 
                                   value="{{ old('email') }}" 
                                   required>
                        </div>
                        @if($errors->has('email'))
                            <div class="error-message">
                                <i class="bi bi-exclamation-circle"></i>
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                        <small class="text-muted d-block mt-1">Gunakan email aktif yang valid</small>
                    </div>

                    <!-- Role Selection -->
                    <div class="form-group role-selection">
                        <label class="form-label required">
                            <i class="bi bi-person-badge"></i>Saya Adalah
                        </label>
                        <div class="input-group {{ $errors->has('role') ? 'error-input' : '' }}" style="display: none;">
                            <input type="text" name="role" id="roleInput" value="{{ old('role') }}" required>
                        </div>
                        
                        <div class="role-options">
                            <div class="role-option {{ old('role') == 'siswa' ? 'selected' : '' }}" data-value="siswa">
                                <div class="role-icon">
                                    <i class="bi bi-mortarboard-fill"></i>
                                </div>
                                <div class="role-name">Siswa</div>
                            </div>
                            
                            <div class="role-option {{ old('role') == 'ortu' ? 'selected' : '' }}" data-value="ortu">
                                <div class="role-icon">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                                <div class="role-name">Orang Tua</div>
                            </div>
                            
                            <div class="role-option {{ old('role') == 'masyarakat' ? 'selected' : '' }}" data-value="masyarakat">
                                <div class="role-icon">
                                    <i class="bi bi-house-door-fill"></i>
                                </div>
                                <div class="role-name">Masyarakat</div>
                            </div>
                        </div>
                        @if($errors->has('role'))
                            <div class="error-message">
                                <i class="bi bi-exclamation-circle"></i>
                                {{ $errors->first('role') }}
                            </div>
                        @endif
                    </div>

                    <!-- Password Fields -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password" class="form-label required">
                                    <i class="bi bi-lock"></i>Password
                                </label>
                                <div class="input-group {{ $errors->has('password') ? 'error-input' : '' }}">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock-fill"></i>
                                    </span>
                                    <input type="password" name="password" id="password" class="form-control" 
                                           placeholder="Minimal 8 karakter" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                
                                <div class="password-strength">
                                    <div class="strength-meter">
                                        <div class="strength-fill" id="strengthFill"></div>
                                    </div>
                                    <div class="strength-label" id="strengthLabel">Kekuatan password</div>
                                    <div class="strength-requirements" id="requirements">
                                        <div class="requirement" id="reqLength">Minimal 8 karakter</div>
                                        <div class="requirement" id="reqUpper">Huruf besar</div>
                                        <div class="requirement" id="reqLower">Huruf kecil</div>
                                        <div class="requirement" id="reqNumber">Angka</div>
                                        <div class="requirement" id="reqSpecial">Karakter khusus</div>
                                    </div>
                                </div>
                                
                                @if($errors->has('password'))
                                    <div class="error-message">
                                        <i class="bi bi-exclamation-circle"></i>
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password_confirmation" class="form-label required">
                                    <i class="bi bi-lock-fill"></i>Konfirmasi Password
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock-fill"></i>
                                    </span>
                                    <input type="password" name="password_confirmation" id="password_confirmation" 
                                           class="form-control" placeholder="Ulangi password" required>
                                    <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                <div class="match-status" id="matchStatus"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Terms Agreement -->
                    <div class="terms-checkbox">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="terms" required>
                            <label class="form-check-label" for="terms">
                                Saya menyetujui <a href="#" class="terms-link">syarat dan ketentuan</a> serta <a href="#" class="privacy-link">kebijakan privasi</a>
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn-register" id="submitBtn">
                            <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                        </button>
                    </div>
                </form>

                <!-- Login Link -->
                <div class="login-link">
                    <span class="text-muted">Sudah punya akun?</span>
                    <a href="{{ route('login') }}" class="ms-1">
                        <i class="bi bi-box-arrow-in-right me-1"></i>Login di sini
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Role selection
            const roleOptions = document.querySelectorAll('.role-option');
            const roleInput = document.getElementById('roleInput');
            
            roleOptions.forEach(option => {
                option.addEventListener('click', function() {
                    roleOptions.forEach(opt => opt.classList.remove('selected'));
                    this.classList.add('selected');
                    roleInput.value = this.dataset.value;
                });
            });
            
            // Toggle password visibility
            function setupPasswordToggle(toggleId, inputId) {
                const toggleBtn = document.getElementById(toggleId);
                const passwordInput = document.getElementById(inputId);
                
                if (toggleBtn && passwordInput) {
                    toggleBtn.addEventListener('click', function() {
                        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                        passwordInput.setAttribute('type', type);
                        
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
            }
            
            setupPasswordToggle('togglePassword', 'password');
            setupPasswordToggle('toggleConfirmPassword', 'password_confirmation');
            
            // Password strength checker
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            const strengthFill = document.getElementById('strengthFill');
            const strengthLabel = document.getElementById('strengthLabel');
            const requirements = {
                length: document.getElementById('reqLength'),
                upper: document.getElementById('reqUpper'),
                lower: document.getElementById('reqLower'),
                number: document.getElementById('reqNumber'),
                special: document.getElementById('reqSpecial')
            };
            
            function checkPasswordStrength(password) {
                let strength = 0;
                
                // Check length
                if (password.length >= 8) {
                    strength += 20;
                    requirements.length.classList.add('met');
                } else {
                    requirements.length.classList.remove('met');
                }
                
                // Check uppercase
                if (/[A-Z]/.test(password)) {
                    strength += 20;
                    requirements.upper.classList.add('met');
                } else {
                    requirements.upper.classList.remove('met');
                }
                
                // Check lowercase
                if (/[a-z]/.test(password)) {
                    strength += 20;
                    requirements.lower.classList.add('met');
                } else {
                    requirements.lower.classList.remove('met');
                }
                
                // Check numbers
                if (/[0-9]/.test(password)) {
                    strength += 20;
                    requirements.number.classList.add('met');
                } else {
                    requirements.number.classList.remove('met');
                }
                
                // Check special characters
                if (/[^A-Za-z0-9]/.test(password)) {
                    strength += 20;
                    requirements.special.classList.add('met');
                } else {
                    requirements.special.classList.remove('met');
                }
                
                // Update strength meter
                strengthFill.style.width = strength + '%';
                
                // Update strength label and color
                if (strength <= 40) {
                    strengthFill.style.backgroundColor = '#ef4444';
                    strengthLabel.textContent = 'Password lemah';
                    strengthLabel.style.color = '#ef4444';
                } else if (strength <= 80) {
                    strengthFill.style.backgroundColor = '#f59e0b';
                    strengthLabel.textContent = 'Password cukup';
                    strengthLabel.style.color = '#f59e0b';
                } else {
                    strengthFill.style.backgroundColor = '#10b981';
                    strengthLabel.textContent = 'Password kuat';
                    strengthLabel.style.color = '#10b981';
                }
                
                return strength;
            }
            
            // Check password match
            function checkPasswordMatch() {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;
                const matchStatus = document.getElementById('matchStatus');
                
                if (!confirmPassword) {
                    matchStatus.innerHTML = '';
                    return;
                }
                
                if (password === confirmPassword) {
                    matchStatus.innerHTML = '<span style="color: #10b981;"><i class="bi bi-check-circle me-1"></i>Password cocok</span>';
                } else {
                    matchStatus.innerHTML = '<span style="color: #ef4444;"><i class="bi bi-x-circle me-1"></i>Password tidak cocok</span>';
                }
            }
            
            // Event listeners for password inputs
            passwordInput.addEventListener('input', function() {
                checkPasswordStrength(this.value);
                checkPasswordMatch();
            });
            
            confirmPasswordInput.addEventListener('input', checkPasswordMatch);
            
            // Form validation
            const registerForm = document.getElementById('registerForm');
            const submitBtn = document.getElementById('submitBtn');
            
            registerForm.addEventListener('submit', function(e) {
                let valid = true;
                
                // Check role selection
                if (!roleInput.value) {
                    valid = false;
                    const roleSelection = document.querySelector('.role-selection');
                    roleSelection.classList.add('shake');
                    setTimeout(() => roleSelection.classList.remove('shake'), 500);
                }
                
                // Check password strength
                if (checkPasswordStrength(passwordInput.value) < 80) {
                    valid = false;
                    passwordInput.focus();
                }
                
                // Check password match
                if (passwordInput.value !== confirmPasswordInput.value) {
                    valid = false;
                    confirmPasswordInput.classList.add('shake');
                    setTimeout(() => confirmPasswordInput.classList.remove('shake'), 500);
                }
                
                // Check terms agreement
                const termsCheckbox = document.getElementById('terms');
                if (!termsCheckbox.checked) {
                    valid = false;
                    termsCheckbox.classList.add('shake');
                    setTimeout(() => termsCheckbox.classList.remove('shake'), 500);
                }
                
                if (!valid) {
                    e.preventDefault();
                    return;
                }
                
                // Disable submit button and show loading state
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Mendaftarkan...';
            });
            
            // Initialize password strength on page load
            checkPasswordStrength(passwordInput.value);
            checkPasswordMatch();
        });
    </script>
</body>
</html>