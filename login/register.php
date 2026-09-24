<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register - Sistem Absensi</title>
<style>
    * {margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;}
    body {
        background: linear-gradient(135deg, #4facfe, #00f2fe);
        min-height: 100vh;
        display:flex;
        justify-content:center;
        align-items:center;
        padding:20px;
        overflow-x:hidden;
    }

    .container {
        background:#f0f8ff;
        padding:40px 30px;
        border-radius:15px;
        box-shadow:0 15px 30px rgba(0,0,0,0.2);
        width:100%;
        max-width:400px;
        text-align:center;
        opacity:0;
        transform: translateY(30px);
        animation: fadeSlideIn 0.7s ease forwards;
    }

    h2 {
        margin-bottom:25px;
        font-weight:700;
        color:#004080;
        user-select:none;
        animation: popIn 0.6s ease forwards;
    }

    form {display:flex; flex-direction:column; gap:18px;}

    input[type="text"], input[type="password"] {
        padding:14px 18px;
        border-radius:10px;
        border:1.5px solid #a0c4ff;
        font-size:16px;
        transition:0.3s;
        outline-offset:2px;
    }

    input:focus {
        border-color:#3399ff;
        box-shadow:0 0 10px rgba(51,153,255,0.3);
        outline:none;
    }

    button {
        background: linear-gradient(90deg, #3399ff, #0066cc);
        color:white;
        padding:14px;
        font-size:18px;
        font-weight:700;
        border:none;
        border-radius:12px;
        cursor:pointer;
        transition:0.3s;
        box-shadow:0 6px 12px rgba(0,102,204,0.4);
    }

    button:hover {
        background: linear-gradient(90deg, #0066cc, #3399ff);
        box-shadow:0 8px 18px rgba(0,102,204,0.6);
        transform: scale(1.03);
    }

    .link {
        margin-top:22px;
        font-size:15px;
        color:#004080;
    }

    .link a {
        color:#3399ff;
        font-weight:600;
        text-decoration:none;
        transition:0.3s;
        cursor:pointer;
    }

    .link a:hover {
        color:#0066cc;
        text-decoration:underline;
    }

    /* Animasi */
    @keyframes fadeSlideIn {
        0% {opacity:0; transform:translateY(30px);}
        100% {opacity:1; transform:translateY(0);}
    }

    @keyframes popIn {
        0% {transform:scale(0.8); opacity:0;}
        100% {transform:scale(1); opacity:1;}
    }
</style>
</head>
<body>

<div class="container" id="registerCard" role="main" aria-label="Form registrasi pengguna">
    <h2>📝 Daftar Akun Baru</h2>
    <form id="registerForm" method="POST" action="proses_register.php" novalidate>
        <input type="text" name="username" placeholder="Masukkan Username" required aria-label="Username" />
        <input type="password" name="password" placeholder="Masukkan Password" required aria-label="Password" />
        <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required aria-label="Konfirmasi Password" />
        <button type="submit" aria-label="Daftar">Daftar</button>
    </form>
    <div class="link">
        Sudah punya akun? <a id="goLogin">Login di sini</a>
    </div>
</div>

<script>
const form = document.getElementById('registerForm');
const registerCard = document.getElementById('registerCard');

// Validasi form sebelum submit
form.addEventListener('submit', function(e){
    const username = form.username.value.trim();
    const password = form.password.value.trim();
    const confirm = form.confirm_password.value.trim();

    if(!username || !password || !confirm){
        alert('Semua field wajib diisi!');
        e.preventDefault();
        return false;
    }

    if(password !== confirm){
        alert('Password dan konfirmasi password tidak sama!');
        e.preventDefault();
        return false;
    }
});

// Animasi pindah ke login
document.getElementById('goLogin').addEventListener('click', function(e){
    e.preventDefault();
    registerCard.style.opacity = 0;
    registerCard.style.transform = 'translateY(30px)';
    setTimeout(()=>{ window.location.href = 'index.php'; }, 500);
});
</script>

</body>
</html>
