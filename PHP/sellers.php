<!DOCTYPE html>
<html>
<head>
    <title>Sellers</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.html');
    exit;
}
?>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <button onclick="toggleSidebar()">☰</button>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="orders.php">Orders</a></li>
            <li><a href="reviews.php">Reviews</a></li>
            <li><a href="sellers.php">Sellers</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <h1>Sellers</h1>
        <!-- Sellers content goes here -->
    </div>
    <script src="dashboard.js"></script>
</body>
</html>
