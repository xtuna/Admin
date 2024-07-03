<?php
// db.php
$host = '127.0.0.1:3307';
// $port = '3307';
$db = 'pup_lagoon';
$user = 'root';
$pass = '';

$connection = new mysqli($host, $user, $pass, $db);

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>