<?php
// db.php
$host = '127.0.0.1:3307';
// $port = '3307';
$db = 'pup_lagoon';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO('mysql:host=127.0.0.1:3307;dbname=pup_lagoon', 'email', 'password');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>