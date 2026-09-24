<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login User - Sistem Absensi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        :root {
            --primary: #4e73df;
            --primary-dark: #3a59c7;
            --secondary: #6f42c1;
            --success: #1cc88a;
            --success-dark: #17a673;
            --dark: #5a5c69;
            --light: #f8f9fc;
        }
        
        body {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }
        
        .bg-shapes {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: -1; overflow: hidden;
        }
        
        .shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
        }
        
        .shape-1 { width: 500px; height: 500px; background: var(--primary); top: -250px; right: -100px; }
        .shape-2 { width: 300px; height: 300px; background: var(--success); bottom: -100px; left: -50px; }
        .shape-3 { width: 200px; height: 200px; background: var(--secondary); top: 50%; left: 20%; }
        
        .login-container {
            width: 100%; max-width: 450px;
            background: rgba(255,255,255,0.95);
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            backdrop-filter: blur(10px);
            z-index: 10;
            animation: fadeIn 0.7s ease-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.25);
        }
        
        .login-header {
            background: linear-gradient(90deg, var(--success) 0%, var(--success-dark) 100%);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }
        
        .login-header::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), var(--success), var(--secondary));
        }
        
        .logo {
            width: 80px; height: 80px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
            transition: transform 0.3s ease;
            animation: pulse 4s infinite ease-in-out;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .logo i {
            font-size: 40px;
            background: linear-gradient(90deg, var(--success) 0%, var(--success-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .login-header h1 {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 5px;
            letter-spacing: 0.5px;
        }
        
        .login-header p {
            font-size: 15px;
            opacity: 0.9;
            font-weight: 300;
        }
        
        .login-body {
            padding: 30px;
        }
        
        .welcome-text {
            text-align: center;
            margin-bottom: 25px;
        }
        
        .welcome-text h2 {
            color: var(--dark);
            font-size: 22px;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .welcome-text p {
            color: #858796;
            font-size: 15px;
            line-height: 1.5;
        }
        
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }
        
        .input-with-icon {
            position: relative;
        }
        
        .input-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #b7b9cc;
            transition: color 0.3s;
        }
        
        .input-with-icon input {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 1px solid #d1d3e2;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s;
        }
        
        .input-with-icon input:focus {
            border-color: var(--success);
            box-shadow: 0 0 0 0.2rem rgba(28, 200, 138, 0.25);
            outline: none;
        }
        
        .input-with-icon input:focus + i {
            color: var(--success);
        }
        
        .btn-login {
            display: block;
            width: 100%;
            padding: 15px;
            background: linear-gradient(90deg, var(--success) 0%, var(--success-dark) 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(28, 200, 138, 0.3);
            position: relative;
            overflow: hidden;
        }
        
        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(28, 200, 138, 0.4);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }
        
        .btn-login:hover::before {
            left: 100%;
        }
        
        .btn-login i {
            margin-right: 8px;
        }
        
        .info-box {
            background: var(--light);
            border-radius: 10px;
            padding: 20px;
            margin-top: 25px;
            text-align: center;
            border-left: 4px solid var(--success);
        }
        
        .info-box h4 {
            color: var(--dark);
            font-size: 16px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .info-box p {
            color: #858796;
            font-size: 14px;
            line-height: 1.5;
        }
        
        .login-footer {
            text-align: center;
            padding: 20px;
            color: #858796;
            font-size: 14px;
            border-top: 1px solid #eaecf4;
            background: #f8f9fc;
        }
        
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        
        .back-link a {
            color: var(--primary);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: color 0.3s;
        }
        
        .back-link a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="bg-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>
    <div class="login-container">
        <div class="login-header">
            <div class="logo"><i class="fas fa-user-clock"></i></div>
            <h1>Absensi Karyawan</h1>
            <p>Masukkan Nama untuk melakukan absensi</p>
        </div>
        <div class="login-body">
            <div class="welcome-text">
                <h2>Login User</h2>
                <p>Silakan masukkan Nama Anda untuk melakukan absensi</p>
            </div>
            <form action="{{ route('absen.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama Karyawan</label>
                    <div class="input-with-icon">
                        <input type="text" id="nama" name="nama" required placeholder="Masukkan Nama Anda" />
                        <i class="fas fa-user"></i>
                    </div>
                </div>
                <button type="submit" class="btn-login">
                    <i class="fas fa-fingerprint"></i> Absen Sekarang
                </button>
            </form>
            <div class="info-box">
                <h4><i class="fas fa-info-circle"></i> Informasi Penting</h4>
                <p>Pastikan Nama yang Anda masukkan sudah terdaftar dalam sistem. Absensi akan tercatat secara real-time.</p>
            </div>
            <div class="back-link">
                <a href="{{ url('/') }}"><i class="fas fa-arrow-left"></i> Kembali ke Halaman Utama</a>
            </div>
        </div>
        <div class="login-footer">
            <p>&copy; 2023 Sistem Absensi Karyawan | Divisi IT</p>
        </div>
    </div>
</body>
</html>
