<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "demo");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO customers (username, fullname, phone, email, password) VALUES ('$username', '$fullname', '$phone', '$email', '$password')";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $_SESSION['status'] = "Customer registered successfully!";
        $_SESSION['status_code'] = "success";
    } else {
        $_SESSION['status'] = "Customer registration failed!";
        $_SESSION['status_code'] = "error";
    }
    header('Location: ../landing.php');
}
?>
