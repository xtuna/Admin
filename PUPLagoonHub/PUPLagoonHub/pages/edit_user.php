<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: landing.php');
    exit();
}

include('../db.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['user_id'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $type = $_POST['type'];
    $status = $_POST['status'];

    $stmt = $pdo->prepare("UPDATE users SET fullname = ?, email = ?, type = ?, status = ? WHERE id = ?");
    $stmt->execute([$fullname, $email, $type, $status, $id]);

    header('Location: ../pages/user.php');
    exit();
}
?>
