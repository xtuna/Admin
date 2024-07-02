<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

include('../db.php');

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $status = $_POST['status'];

        $stmt = $pdo->prepare("UPDATE users SET username = ?, fullname = ?, email = ?, status = ? WHERE id = ?");
        $stmt->execute([$username, $fullname, $email, $status, $user_id]);

        header('Location: manage_users.php');
        exit();
    }
} else {
    header('Location: manage_users.php');
    exit();
}

include('header.php');
?>

<h2>Edit User</h2>
<form method="post">
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" id="username" class="form-control" value="<?= $user['username'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="fullname" class="form-label">Full Name</label>
        <input type="text" name="fullname" id="fullname" class="form-control" value="<?= $user['fullname'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="<?= $user['email'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-control">
            <option value="ACTIVE" <?= $user['status'] == 'ACTIVE' ? 'selected' : '' ?>>ACTIVE</option>
            <option value="DISABLED" <?= $user['status'] == 'DISABLED' ? 'selected' : '' ?>>DISABLED</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Update User</button>
</form>

<?php include('footer.php'); ?>
