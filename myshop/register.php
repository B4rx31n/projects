<?php
session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: crud.php");
    exit;
}

$host = 'localhost';
$dbname = 'keuangan_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_username = trim($_POST['username']);
    $input_password = $_POST['password'];
    $input_password2 = $_POST['password2'];

    // Validasi
    if (strlen($input_username) < 3) {
        $error = "Username minimal 3 karakter.";
    } elseif (strlen($input_password) < 4) {
        $error = "Password minimal 4 karakter.";
    } elseif ($input_password !== $input_password2) {
        $error = "Konfirmasi password tidak cocok.";
    } else {
        // Cek username sudah ada
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$input_username]);
        if ($stmt->fetch()) {
            $error = "Username sudah digunakan.";
        } else {
            // Simpan user baru
            $hashed = password_hash($input_password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute([$input_username, $hashed]);
            $success = "Registrasi berhasil! Silakan login.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Sistem Keuangan</title>
  <style>
    :root {
      --primary: #4361ee;
      --primary-light: #e0e7ff;
      --danger: #ef4444;
      --success: #10b981;
      --light: #f9fafb;
      --dark: #1f2937;
      --gray: #6b7280;
      --radius: 12px;
      --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    body {
      font-family: 'Inter', sans-serif;
      background: #f3f4f6;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
    }
    .login-container {
      width: 100%;
      max-width: 400px;
      background: white;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      overflow: hidden;
    }
    .login-header {
      padding: 24px;
      background: var(--primary);
      color: white;
      text-align: center;
    }
    h1 {
      font-size: 1.5rem;
      font-weight: 600;
    }
    .login-body {
      padding: 24px;
    }
    .form-group {
      margin-bottom: 16px;
    }
    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
      color: var(--gray);
      font-size: 14px;
    }
    input {
      width: 100%;
      padding: 12px;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      font-size: 14px;
      transition: all 0.3s;
    }
    input:focus {
      outline: none;
      border-color: var(--primary);
      box-shadow: 0 0 0 3px var(--primary-light);
    }
    .btn-login {
      width: 100%;
      padding: 12px;
      background: var(--primary);
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s;
    }
    .btn-login:hover {
      background: #3a56d4;
    }
    .error-message {
      color: var(--danger);
      font-size: 14px;
      margin-top: 8px;
      text-align: center;
    }
    .success-message {
      color: var(--success);
      font-size: 14px;
      margin-top: 8px;
      text-align: center;
    }
    .footer-text {
      text-align: center;
      margin-top: 16px;
      font-size: 14px;
      color: var(--gray);
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="login-header">
      <h1>Registrasi Akun</h1>
    </div>
    <div class="login-body">
      <?php if ($error): ?>
        <div class="error-message"><?php echo $error; ?></div>
      <?php elseif ($success): ?>
        <div class="success-message"><?php echo $success; ?></div>
      <?php endif; ?>
      <form method="POST" action="register.php">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" required minlength="3">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required minlength="4">
        </div>
        <div class="form-group">
          <label for="password2">Konfirmasi Password</label>
          <input type="password" id="password2" name="password2" required minlength="4">
        </div>
        <button type="submit" class="btn-login">Daftar</button>
      </form>
      <div style="text-align:center; margin-top:12px;">
        Sudah punya akun? <a href="login.php" style="color:var(--primary);text-decoration:underline;">Login di sini</a>
      </div>
      <div class="footer-text">
        Sistem Manajemen Keuangan v1.0
      </div>
    </div>
  </div>
</body>
</html>