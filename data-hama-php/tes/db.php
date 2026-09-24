<?php
$host = "localhost"; // ganti sesuai setting server kamu
$user = "root";      // username MySQL
$pass = "";          // password MySQL
$dbname = "crud_products"; // nama database

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Database connection failed"]));
}
?>
