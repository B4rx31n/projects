<?php
session_start();
include "koneksi.php";

// Cek login
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

$username = $_SESSION['username'];
$action   = $_GET['action'] ?? '';

// ==== Ubah Tema ====
if ($action === 'ubah_tema') {
    // Ambil input dari form
    $tema = isset($_POST['tema']) ? 'gelap' : 'terang';

    // Update database
    $query = "UPDATE users SET tema='$tema' WHERE username='$username'";
    mysqli_query($conn, $query);

    // Update session
    $_SESSION['tema'] = $tema;

    $_SESSION['msg'] = "Tema berhasil diperbarui.";
    header("Location: pengaturan.php");
    exit;
}

// ==== Ubah Username ====
if ($action === 'ubah_nama') {
    $username_baru = trim($_POST['username']);

    if ($username_baru !== '') {
        mysqli_query($conn, "UPDATE users SET username='$username_baru' WHERE username='$username'");
        $_SESSION['username'] = $username_baru;
        $_SESSION['msg'] = "Username berhasil diperbarui.";
    }
    header("Location: pengaturan.php");
    exit;
}

// ==== Ubah Password ====
if ($action === 'ubah_password') {
    $lama = md5($_POST['password_lama']);
    $baru = md5($_POST['password_baru']);
    $konfirmasi = md5($_POST['password_konfirmasi']);

    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$lama'");
    if (mysqli_num_rows($cek) > 0) {
        if ($baru === $konfirmasi) {
            mysqli_query($conn, "UPDATE users SET password='$baru' WHERE username='$username'");
            $_SESSION['msg'] = "Password berhasil diperbarui.";
        } else {
            $_SESSION['msg'] = "Password baru dan konfirmasi tidak cocok.";
        }
    } else {
        $_SESSION['msg'] = "Password lama salah.";
    }
    header("Location: pengaturan.php");
    exit;
}
?>
