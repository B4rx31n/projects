<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Absensi Karyawan</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        :root {
            --primary: #4e73df;
            --primary-dark: #3a59c7;
            --secondary: #6f42c1;
            --success: #1cc88a;
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
        
        /* Background animation elements */
        .bg-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }
        
        .shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
        }
        
        .shape-1 {
            width: 500px;
            height: 500px;
            background: var(--primary);
            top: -250px;
            right: -100px;
        }
        
        .shape-2 {
            width: 300px;
            height: 300px;
            background: var(--success);
            bottom: -100px;
            left: -50px;
        }
        
        .shape-3 {
            width: 200px;
            height: 200px;
            background: var(--secondary);
            top: 50%;
            left: 20%;
        }
        
        .login-container {
            width: 100%;
            max-width: 420px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            backdrop-filter: blur(10px);
            z-index: 10;
        }
        
        .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
        }
        
        .login-header {
            background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 35px 30px;
            text-align: center;
            position: relative;
        }
        
        .login-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--success), var(--primary), var(--secondary));
        }
        
        .logo {
            width: 90px;
            height: 90px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
        }
        
        .logo:hover {
            transform: scale(1.05);
        }
        
        .logo i {
            font-size: 45px;
            background: linear-gradient(90deg, var(--primary) 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .login-header h1 {
            font-size: 28px;
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
            padding: 35px 30px;
        }
        
        .welcome-text {
            text-align: center;
            margin-bottom: 30px;
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
        
        .btn-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .btn i {
            margin-right: 10px;
            font-size: 18px;
        }
        
        .btn-user {
            background: linear-gradient(90deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
        }
        
        .btn-admin {
            background: white;
            color: var(--dark);
            border: 2px solid #e3e6f0;
        }
        
        .btn-user:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(78, 115, 223, 0.3);
        }
        
        .btn-admin:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border-color: var(--primary);
            color: var(--primary);
        }
        
        .btn-user::before, .btn-admin::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: 0.5s;
        }
        
        .btn-user:hover::before, .btn-admin:hover::before {
            left: 100%;
        }
        
        .info-box {
            background: var(--light);
            border-radius: 10px;
            padding: 20px;
            margin-top: 25px;
            text-align: center;
            border-left: 4px solid var(--primary);
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
        
        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .login-container {
            animation: fadeIn 0.7s ease-out;
        }
        
        /* Responsive */
        @media (max-width: 576px) {
            .login-container {
                border-radius: 12px;
            }
            
            .login-header {
                padding: 25px 20px;
            }
            
            .login-body {
                padding: 25px 20px;
            }
            
            .logo {
                width: 80px;
                height: 80px;
            }
            
            .logo i {
                font-size: 40px;
            }
            
            .login-header h1 {
                font-size: 24px;
            }
        }
        
        /* Pulse animation for logo */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .logo {
            animation: pulse 4s infinite ease-in-out;
        }
    </style>
</head>
<body>
    <!-- Background shapes -->
    <div class="bg-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>
    
    <!-- Login Container -->
    <div class="login-container">
        <div class="login-header">
            <div class="logo">
                <i class="fas fa-fingerprint"></i>
            </div>
            <h1>Sistem Absensi</h1>
            <p>PT. Perusahaan Contoh - Divisi IT</p>
        </div>
        
        <div class="login-body">
            <div class="welcome-text">
                <h2>Selamat Datang</h2>
                <p>Silakan pilih jenis login untuk mengakses sistem absensi karyawan</p>
            </div>
            
            <div class="btn-container">
                <a href="user.php" class="btn btn-user">
                    <i class="fas fa-user"></i> Login Karyawan
                </a>
                <a href="admin_login.php" class="btn btn-admin">
                    <i class="fas fa-lock"></i> Login Administrator
                </a>
            </div>
            
            <div class="info-box">
                <h4><i class="fas fa-info-circle"></i> Informasi</h4>
                <p>Sistem absensi ini digunakan untuk mencatat kehadiran karyawan secara digital dan real-time.</p>
            </div>
        </div>
        
        <div class="login-footer">
            <p>&copy; 2023 Sistem Absensi Karyawan | Divisi IT</p>
        </div>
    </div>

    <script>
        // Simple animation for background shapes
        document.addEventListener('DOMContentLoaded', function() {
            const shapes = document.querySelectorAll('.shape');
            
            shapes.forEach((shape, index) => {
                // Animate each shape with different delays
                shape.style.animation = `float ${8 + index * 2}s infinite ease-in-out`;
                shape.style.animationDelay = `${index * 1}s`;
            });
            
            // Add style for floating animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes float {
                    0% { transform: translateY(0) rotate(0deg); }
                    50% { transform: translateY(-20px) rotate(5deg); }
                    100% { transform: translateY(0) rotate(0deg); }
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>
</html>