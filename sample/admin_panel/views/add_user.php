<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

include('../db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $type = $_POST['type'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("INSERT INTO users (fullname, email, type, status) VALUES (?, ?, ?, ?)");
    $stmt->execute([$fullname, $email, $type, $status]);

    header('Location: manage_users.php');
    exit();
}

include('header.php');
?>

<h2>Add User</h2>
<form method="post">
    <div class="mb-3">
        <label for="fullname" class="form-label">Full Name</label>
        <input type="text" name="fullname" id="fullname" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="type" class="form-label">Type [Customer, Seller]</label>
        <input type="text" name="type" id="type" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status [Active, Disabled]</label>
        <input type="text" name="status" id="status" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Add User</button>
</form>

<?php include('footer.php'); ?>
