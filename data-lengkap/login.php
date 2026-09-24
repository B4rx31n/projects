<?php
session_start();
include 'config/db.php';

if(isset($_SESSION['login']) && $_SESSION['login']===true){
  header('Location: dashboard.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['login'])) {
  $email = mysqli_real_escape_string($conn,$_POST['email']);
  $password = $_POST['password'];

  $res = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
  if($res && mysqli_num_rows($res)>0){
    $user = mysqli_fetch_assoc($res);
    if (password_verify($password, $user['password'])) {
      $_SESSION['login'] = true;
      $_SESSION['username'] = $user['username'];
      $_SESSION['role'] = $user['role'];
      header('Location: dashboard.php');
      exit;
    }
  }
  $error = 'Email atau password salah';
}
?>
<!doctype html>
<html lang="id">
<head><meta charset="utf-8"><title>Login</title><link rel="stylesheet" href="css/style.css"></head>
<body>
<?php include 'includes/navbar.php'; ?>
<div class="login-container">
  <h2>Login</h2>
  <?php if(!empty($error)) echo '<p style="color:red;text-align:center">'.htmlspecialchars($error).'</p>'; ?>
  <form method="post">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button name="login" type="submit">Masuk</button>
  </form>
  <p style="text-align:center;margin-top:12px">Belum punya akun? <a href="register.php">Daftar</a></p>
</div>
</body>
</html>
