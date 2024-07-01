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

        $stmt = $pdo->prepare("UPDATE users SET username = ?, fullname = ?, email = ? WHERE id = ?");
        $stmt->execute([$username, $fullname, $email, $user_id]);

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
    <button type="submit" class="btn btn-primary">Update User</button>
</form>

<?php include('footer.php'); ?>
