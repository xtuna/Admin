<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="sidebar.css">
</head>
<body>
<div class="d-flex">
    <div class="sidebar bg-dark text-white p-4">
        <h4>Admin Panel</h4>
        <ul class="list-unstyled">
            <li><a href="dashboard.php" class="text-white">Dashboard</a></li>
            <li><a href="stores.php" class="text-white">Stores</a></li>
            <li><a href="users.php" class="text-white">Users</a></li>
            <li><a href="logout.php" class="text-white">Logout</a></li>
        </ul>
    </div>
    <div class="content p-4">
        <h2>Welcome to the Admin Dashboard</h2>
        <p>Select an option from the sidebar to manage the system.</p>
    </div>
</div>
</body>
</html>
