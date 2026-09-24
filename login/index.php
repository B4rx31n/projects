<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Sistem Absensi</title>
<style>
    * {margin:0; padding:0; box-sizing:border-box; font-family: Arial, sans-serif;}
    body {
        background: linear-gradient(135deg, #4facfe, #00f2fe);
        display: flex;
        flex-direction: column;
        align-items: center;
        min-height: 100vh;
        color: #333;
        overflow-x: hidden;
    }
    .header {
        width: 100%;
        padding: 15px;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(8px);
        color:white;
        text-align:center;
        font-size:22px;
        font-weight:bold;
        box-shadow:0 2px 10px rgba(0,0,0,0.2);
    }
    .login-container {
        flex:1;
        display:flex;
        align-items:center;
        justify-content:center;
        width:100%;
        padding:20px;
        opacity:0;
        transform: translateY(30px);
        animation: fadeSlideIn 0.8s ease forwards;
    }
    .login-card {
        background:white;
        padding:30px;
        border-radius:12px;
        box-shadow:0 5px 20px rgba(0,0,0,0.2);
        width:100%;
        max-width:400px;
        text-align:center;
        transform: scale(0.8);
        opacity:0;
        animation: popIn 0.6s 0.2s ease forwards;
        transition: opacity 0.5s, transform 0.5s;
    }
    .login-card.fade-out {
        opacity:0;
        transform: scale(0.8);
    }
    h2 { margin-bottom:10px; color:#2c3e50; }
    p { margin-bottom:20px; color:#666; }
    .form-group { margin-bottom:15px; text-align:left; }
    .form-group input { width:100%; padding:12px; border-radius:8px; border:1px solid #ccc; font-size:14px; transition:0.3s; }
    .form-group input:focus { border-color:#4facfe; outline:none; box-shadow:0 0 8px rgba(79,172,254,0.3); }
    .btn-login { width:100%; padding:12px; background: linear-gradient(90deg,#4facfe,#00f2fe); border:none; border-radius:8px; color:white; font-size:16px; cursor:pointer; transition:0.3s; }
    .btn-login:hover { background: linear-gradient(90deg,#00f2fe,#4facfe); transform:scale(1.03); }
    .register-link { margin-top:15px; font-size:14px; }
    .register-link a { color:#4facfe; text-decoration:none; font-weight:bold; cursor:pointer; }
    .register-link a:hover { text-decoration:underline; }
    @keyframes fadeSlideIn { 0%{opacity:0; transform:translateY(30px);} 100%{opacity:1; transform:translateY(0);} }
    @keyframes popIn { 0%{transform:scale(0.8); opacity:0;} 100%{transform:scale(1); opacity:1;} }
</style>
</head>
<body>

<div class="header">📊 Aplikasi Absensi Siswa & Mahasiswa PKL</div>

<div class="login-container">
    <div class="login-card" id="loginCard">
        <h2>🔑 Selamat Datang</h2>
        <p>Silakan masuk untuk melanjutkan</p>
        
        <form method="POST" action="proses_login.php">
            <div class="form-group">
                <input type="text" name="username" placeholder="Masukkan Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Masukkan Password" required>
            </div>
            <button type="submit" class="btn-login">Login</button>
        </form>

        <div class="register-link">
            Belum punya akun? <a id="goRegister">Daftar sekarang</a>
        </div>
    </div>
</div>

<script>
document.getElementById('goRegister').addEventListener('click', function(e){
    e.preventDefault();
    const card = document.getElementById('loginCard');
    card.classList.add('fade-out'); // Tambahkan animasi fade out
    setTimeout(() => {
        window.location.href = 'register.php'; // Pindah ke halaman register setelah 500ms
    }, 500);
});
</script>

</body>
</html>
