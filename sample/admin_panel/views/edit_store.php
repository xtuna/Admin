<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

include('../db.php');

if (isset($_GET['id'])) {
    $store_id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM stores WHERE id = ?");
    $stmt->execute([$store_id]);
    $store = $stmt->fetch();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $stall_number = $_POST['stall_number'];
        $image = $_POST['image'];

        $stmt = $pdo->prepare("UPDATE stores SET name = ?, stall_number = ?, image = ? WHERE id = ?");
        $stmt->execute([$name, $stall_number, $image, $store_id]);

        header('Location: manage_stores.php');
        exit();
    }
} else {
    header('Location: manage_stores.php');
    exit();
}

include('header.php');
?>

<h2>Edit Store</h2>
<form method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Store Name</label>
        <input type="text" name="name" id="name" class="form-control" value="<?= $store['name'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="stall_number" class="form-label">Stall Number</label>
        <input type="text" name="stall_number" id="stall_number" class="form-control" value="<?= $store['stall_number'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image URL</label>
        <input type="text" name="image" id="image" class="form-control" value="<?= $store['image'] ?>" required>
    </div>
    <button type="submit" class="btn btn-primary">Update Store</button>
</form>

<?php include('footer.php'); ?>