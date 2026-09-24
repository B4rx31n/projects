<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Pastikan file users.txt ada
    if (!file_exists("users.txt")) {
        file_put_contents("users.txt", "");
    }

    // Cek apakah username sudah ada
    $users = file("users.txt", FILE_IGNORE_NEW_LINES);
    foreach ($users as $user) {
        list($storedUser, $storedPass) = explode("|", $user);
        if ($storedUser == $username) {
            echo "<script>alert('Username sudah digunakan!'); window.location='register.php';</script>";
            exit;
        }
    }

    // Simpan user baru
    file_put_contents("users.txt", $username . "|" . password_hash($password, PASSWORD_DEFAULT) . "\n", FILE_APPEND);
    echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='index.php';</script>";
}
?>

