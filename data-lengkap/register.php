<?php
include 'config/db.php';
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['register'])) {
  $username = mysqli_real_escape_string($conn,$_POST['username']);
  $email = mysqli_real_escape_string($conn,$_POST['email']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  // simple check
  $exists = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
  if(mysqli_num_rows($exists)>0){
    $err = 'Email sudah terdaftar';
  } else {
    mysqli_query($conn, "INSERT INTO users (username,email,password,role) VALUES('$username','$email','$password','user')");
    header('Location: login.php');
    exit;
  }
}
?>
<!doctype html>
<html lang="id">
<head><meta charset="utf-8"><title>Register</title><link rel="stylesheet" href="../css/style.css"></head>
<body>
<?php include 'includes/navbar.php'; ?>
<div class="login-container">
  <h2>Register</h2>
  <?php if(!empty($err)) echo '<p style="color:red;text-align:center">'.htmlspecialchars($err).'</p>'; ?>
  <form method="post">
    <input type="text" name="username" placeholder="Nama Lengkap" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button name="register" type="submit">Daftar</button>
  </form>
  <p style="text-align:center;margin-top:12px">Sudah punya akun? <a href="login.php">Login</a></p>
</div>
</body>
</html>
