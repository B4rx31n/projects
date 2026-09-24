<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (!file_exists("users.txt")) {
        die("<script>alert('Belum ada pengguna terdaftar. Silakan register dulu.'); window.location='register.php';</script>");
    }

    $users = file("users.txt", FILE_IGNORE_NEW_LINES);
    foreach ($users as $user) {
        list($storedUser, $storedPass) = explode("|", $user);
        if ($storedUser == $username && password_verify($password, $storedPass)) {
            $_SESSION["username"] = $username;
            header("Location: dashboard.php");
            exit;
        }
    }

    echo "<script>alert('Username atau password salah!'); window.location='index.php';</script>";
}
?>
