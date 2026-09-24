<?php
date_default_timezone_set("Asia/Jakarta"); // biar pakai WIB

$host = "localhost";
$user = "root";
$pass = "";
$db   = "absensi_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
