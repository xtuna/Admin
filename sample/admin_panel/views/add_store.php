<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

include('../db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $store_name = $_POST['name'];
    $image_path = '';

    if (!empty($_FILES['image']['name'])) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES['image']['name']);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image_path = 'uploads/' . basename($_FILES['image']['name']);
        }
    }

    if (!empty($store_name) && !empty($image_path)) {
        $stmt = $pdo->prepare("INSERT INTO stores (name, image) VALUES (?, ?)");
        $stmt->execute([$store_name, $image_path]);
        header('Location: manage_stores.php');
        exit();
    }
}

$page = 'add_store';
include('header.php');
?>

<div class="container">
    <h1>Add Store</h1>
    <form action="add_store.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Store Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="image">Store Image:</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Store</button>
    </form>
</div>

<?php
include('footer.php');
?>
