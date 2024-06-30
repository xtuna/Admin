<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
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
        <div id="dashboard">
            <h1>Dashboard</h1>
            <!-- Dashboard content goes here -->
        </div>
    </div>
    <script src="dashboard.js"></script>
        <div id="products">
            <h1>Products</h1>
            <button onclick="showAddProductForm()">Add Product</button>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="product-list">
                    <!-- Products will be populated here by JavaScript -->
                </tbody>
            </table>
        </div>
        <div id="orders">
            <h1>Orders</h1>
            <!-- Orders content goes here -->
        </div>
        <div id="reviews">
            <h1>Reviews</h1>
            <!-- Reviews content goes here -->
        </div>
        <div id="sellers">
            <h1>Sellers</h1>
            <!-- Sellers content goes here -->
        </div>
        <div id="settings">
            <h1>Settings</h1>
            <!-- Settings content goes here -->
        </div>
    </div>
    <script src="admin.js"></script>
</body>
</html>
