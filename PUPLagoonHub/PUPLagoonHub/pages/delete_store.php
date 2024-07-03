<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: landing.php');
    exit();
}

include('../db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $stmt = $pdo->prepare("DELETE FROM stores WHERE id = ?");
    $stmt->execute([$id]);

    header('Location: ../pages/store.php');
    exit();
} else {
    header('Location: ../pages/store.php');
    exit();
}
?>
