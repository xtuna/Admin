<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

include('../db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete_user'])) {
        $user_id = $_POST['user_id'];
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
    } elseif (isset($_POST['edit_user'])) {
        // Handle user edit logic here
    }
}

$stmt = $pdo->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->fetchAll();

$page = 'users';
include('header.php');
?>

<h2>Manage Users</h2>
<a href="add_user.php" class="btn btn-primary mb-3">Add User</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>Type</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['fullname'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['type'] ?></td>
                <td><?= $user['status'] ?></td>
                <td>
                    <form method="post" class="d-inline-block">
                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                        <button type="submit" name="edit_user" class="btn btn-success">Edit</button>
                    </form>
                    <form method="post" class="d-inline-block">
                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                        <button type="submit" name="delete_user" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include('footer.php'); ?>
