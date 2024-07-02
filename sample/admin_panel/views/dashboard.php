<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

include('../db.php');

include('header.php');
?>

<h2>Dashboard</h2>
<p>Welcome to the admin panel.</p>

<?php include('footer.php'); ?>
