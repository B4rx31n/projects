<?php
include 'db.php';

$tabel = $_GET['tabel'];
$id    = $_GET['id'];

// Validasi nama tabel (biar ga bisa di-hack)
$allowedTables = ['umurs', 'hamas', 'pekerjaans'];
if (!in_array($tabel, $allowedTables)) {
    die("Tabel tidak valid!");
}

$sql = "DELETE FROM $tabel WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Gagal menghapus data: " . $conn->error;
}
?>