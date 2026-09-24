<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "data_lengkap";

$conn = mysqli_connect($host, $user, $pass);

if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

// try create database if not exists (convenience)
mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS ".$db);
mysqli_select_db($conn, $db);
?>