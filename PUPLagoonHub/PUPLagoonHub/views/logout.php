<?php
session_start();

// Destroy all session data
session_destroy();

// Redirect to the admin login page
header('Location: login.php');
exit();
?>
