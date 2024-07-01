<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $location = $_POST['location'];

    $stmt = $pdo->prepare('INSERT INTO stores (name, location) VALUES (?, ?)');
    $stmt->execute([$name, $location]);
    header('Location: stores.php');
    exit();
}

$stores = $pdo->query('SELECT * FROM stores')->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Stores</title>
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container">
        <h1>Manage Stores</h1>
        <form method="POST">
            <input type="text" name="name" placeholder="Store Name" required>
            <input type="text" name="location" placeholder="Location" required>
            <button type="submit">Add Store</button>
        </form>
        <ul>
            <?php foreach ($stores as $store): ?>
                <li><?= htmlspecialchars($store['name']) ?> - <?= htmlspecialchars($store['location']) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
