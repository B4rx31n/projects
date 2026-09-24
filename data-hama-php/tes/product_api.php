<?php
header('Content-Type: application/json');
require 'db.php';

// Ambil action
$action = $_GET['action'] ?? 'read';

if ($action === 'read') {
    $result = $conn->query("SELECT * FROM products ORDER BY id DESC");
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo json_encode($products);
}

if ($action === 'create') {
    $name = $_POST['name'];
    $description = $_POST['description'] ?? '';
    $price = $_POST['price'];
    $category = $_POST['category'] ?? '';
    $imagePath = '';

    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
        $imagePath = $targetDir . time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    }

    $stmt = $conn->prepare("INSERT INTO products (name, description, price, category, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdss", $name, $description, $price, $category, $imagePath);
    $stmt->execute();

    echo json_encode(["status" => "success"]);
}

if ($action === 'update') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'] ?? '';
    $price = $_POST['price'];
    $category = $_POST['category'] ?? '';
    $imagePath = $_POST['currentImage'] ?? '';

    if (!empty($_FILES['image']['name'])) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
        $imagePath = $targetDir . time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    }

    $stmt = $conn->prepare("UPDATE products SET name=?, description=?, price=?, category=?, image=? WHERE id=?");
    $stmt->bind_param("ssdssi", $name, $description, $price, $category, $imagePath, $id);
    $stmt->execute();

    echo json_encode(["status" => "success"]);
}

if ($action === 'delete') {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM products WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo json_encode(["status" => "success"]);
}
