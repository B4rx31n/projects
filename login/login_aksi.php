<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    // Simpan data ke session
    $_SESSION['username'] = $row['username'];
    $_SESSION['tema'] = $row['tema']; // ambil tema dari DB

    header("Location: dashboard.php");
} else {
    $_SESSION['msg'] = "Username atau password salah.";
    header("Location: index.php");
}
?>
