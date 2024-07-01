<?php
session_start();
require 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
    $stmt->execute([$username, $password]);
    header('Location: users.php');
    exit();
}

$users = $pdo->query('SELECT * FROM users')->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container">
        <h1>Manage Users</h1>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Add User</button>
        </form>
        <ul>
            <?php foreach ($users as $user): ?>
                <li><?= htmlspecialchars($user['username']) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
