<?php
session_start();

// Redirect if already logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header("Location: crud.php");
    exit;
}

// Koneksi database
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

// Handle login
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Query untuk mencari user
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$input_username]);
    $user = $stmt->fetch();

    if ($user && password_verify($input_password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['logged_in'] = true;
        header("Location: crud.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Sistem Keuangan</title>
  <style>
    :root {
      --primary: #4361ee;
      --primary-light: #e0e7ff;
      --danger: #ef4444;
      --light: #f9fafb;
      --dark: #1f2937;
      --gray: #6b7280;
      --radius: 12px;
      --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
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
      opacity: 0;
      transform: translateY(40px);
      animation: fadeInUp 0.7s cubic-bezier(.4,2,.3,1) forwards;
    }

    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
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
      transition: all 0.3s, box-shadow 0.2s;
      box-shadow: 0 2px 8px 0 rgba(67,97,238,0.08);
    }
    
    .btn-login:hover {
      background: #3a56d4;
      box-shadow: 0 4px 16px 0 rgba(67,97,238,0.18);
      transform: translateY(-2px) scale(1.03);
    }
    
    .error-message {
      color: var(--danger);
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
      <h1>Login Sistem Keuangan</h1>
    </div>
    
    <div class="login-body">
      <?php if ($error): ?>
        <div class="error-message"><?php echo $error; ?></div>
      <?php endif; ?>
      
      <form method="POST" action="login.php">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="btn-login">Masuk</button>
      </form>
      <div style="text-align:center; margin-top:12px;">
        Belum punya akun? <a href="register.php" style="color:var(--primary);text-decoration:underline;">Daftar di sini</a>
      </div>
      <div class="footer-text">
        Sistem Manajemen Keuangan v1.0
      </div>
    </div>
  </div>
</body>
</html>