<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: landing.php');
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

    header('Location: ../pages/user.php');
    exit();
}

include('../views/header.php');
?>

    <?php include('../includes/footer.php'); ?>
</body>

</html>