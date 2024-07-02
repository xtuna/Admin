<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

include('../db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_store'])) {
        $store_id = $_POST['store_id'];
        $stmt = $pdo->prepare("DELETE FROM stores WHERE id = ?");
        $stmt->execute([$store_id]);
    } elseif (isset($_POST['edit_store'])) {
        // Handle store edit logic here
    }
}

$stmt = $pdo->prepare("SELECT * FROM stores");
$stmt->execute();
$stores = $stmt->fetchAll();

include('header.php');
?>

<h2>Manage Stores</h2>
<a href="add_store.php" class="btn btn-primary mb-3">Add Store</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Store Name</th>
            <th>Stall Number</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($stores as $store): ?>
            <tr>
                <td><?= $store['id'] ?></td>
                <td><?= $store['name'] ?></td>
                <td><?= $store['stall_number'] ?></td>
                <td><img src="<?= $store['image'] ?>" alt="<?= $store['name'] ?>"></td>
                <td>
                    <form method="post" class="d-inline-block">
                        <input type="hidden" name="store_id" value="<?= $store['id'] ?>">
                        <button type="submit" name="edit_store" class="btn btn-success">Edit</button>
                    </form>
                    <form method="post" class="d-inline-block">
                        <input type="hidden" name="store_id" value="<?= $store['id'] ?>">
                        <button type="submit" name="delete_store" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include('footer.php'); ?>
