<?php
$host = '127.0.0.1';
$port = '3307'; // MySQL port
$db = 'admin_app';
$user = 'root'; // Adjust as per your MySQL setup
$pass = ''; // Adjust as per your MySQL setup
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "Database connection successful.";
} catch (\PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
?>
