<?php
session_start(); // Start the session
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session
header('Location: ../landing.php'); // Redirect to the landing page or login page
exit();
?>