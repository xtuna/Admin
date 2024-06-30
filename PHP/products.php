<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
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
        <form id="add-product-form" style="display: none;">
            <h2>Add New Product</h2>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br>
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" required><br>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required><br>
            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" required><br>
            <button type="submit">Add Product</button>
        </form>
    </div>
    <script src="products.js"></script>
    <script src="dashboard.js"></script>
</body>
</html>
