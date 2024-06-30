<?php
session_start();

$provided_username = 'admin'; // Replace with the provided username
$provided_password = 'password123'; // Replace with the provided password

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $provided_username && $password === $provided_password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit;
    } else {
        $_SESSION['login_error'] = 'Invalid username or password';
        header('Location: login.php');
        exit;
    }
}
?>
