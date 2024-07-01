<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/sidebar.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <div class="container">
        <h1>Welcome to the Admin Dashboard</h1>
        <ul>
            <li><a href="stores.php">Manage Stores</a></li>
            <li><a href="users.php">Manage Users</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
