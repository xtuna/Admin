<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.html');
    exit;
}

require 'db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Fetch all products
    $stmt = $pdo->query('SELECT * FROM products');
    $products = $stmt->fetchAll();
    echo json_encode($products);
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Add new product
    $data = json_decode(file_get_contents('php://input'), true);
    $stmt = $pdo->prepare('INSERT INTO products (name, description, price, stock) VALUES (?, ?, ?, ?)');
    $stmt->execute([$data['name'], $data['description'], $data['price'], $data['stock']]);
    echo json_encode(['id' => $pdo->lastInsertId(), 'name' => $data['name'], 'description' => $data['description'], 'price' => $data['price'], 'stock' => $data['stock']]);
} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Delete product
    $data = json_decode(file_get_contents('php://input'), true);
    $stmt = $pdo->prepare('DELETE FROM products WHERE id = ?');
    $stmt->execute([$data['id']]);
    echo json_encode(['status' => 'success']);
} elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    // Update product
    $data = json_decode(file_get_contents('php://input'), true);
    $stmt = $pdo->prepare('UPDATE products SET name = ?, description = ?, price = ?, stock = ? WHERE id = ?');
    $stmt->execute([$data['name'], $data['description'], $data['price'], $data['stock'], $data['id']]);
    echo json_encode(['status' => 'success']);
}
?>
