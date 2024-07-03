<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: landing.php');
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

$page = 'stores';
include('../includes/header.php');
?>

<div class="container">
    <h1>Manage Stores</h1>
    <a href="add_store.php" class="btn btn-primary mb-3">Add Store</a>
    <div class="row">   
        <?php foreach ($stores as $row) { ?>
        <div class="col-md-4">
            <div class="card">
                <div style="width: 100px; height: 100px; overflow: hidden; background: #cccccc; margin: 0 auto">
                    <!-- <img src="..." class="figure-img img-fluid rounded" id="imgPlaceholder" alt=""> -->
                    <img src="../uploads/<?php echo htmlspecialchars($store['image_path']); ?>" class="card-img-top" alt="Store Image">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['name']; ?></h5>
                    <a href="edit_store.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
                    <form action="manage_stores.php" method="post" class="d-inline">
                        <input type="hidden" name="store_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="delete_store" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<?php
include('footer.php');
?>
