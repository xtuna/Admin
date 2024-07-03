<?php
session_start();

// Database connection details
$host = '127.0.0.1:3307';
$db = 'pup_lagoon';
$user = 'root';
$pass = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Replace with actual authentication logic
    if ($email == 'admin' && $password == 'password') {
        $_SESSION['loggedin'] = true;
        header("Location: ../admin.php");
        exit;
    } else {
        $error = "Invalid credentials";
    }
}
?>