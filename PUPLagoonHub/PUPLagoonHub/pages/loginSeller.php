<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "demo");

if(isset($_POST['login_seller'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize inputs to prevent SQL injection
    $email = mysqli_real_escape_string($connection, $email);

    $query = "SELECT * FROM sellers WHERE email='$email'";
    $query_run = mysqli_query($connection, $query);

    if(mysqli_num_rows($query_run) > 0) {
        $row = mysqli_fetch_assoc($query_run);
        if(password_verify($password, $row['password'])) {
            $_SESSION['auth'] = true;
            $_SESSION['seller_id'] = $row['id']; // Assuming 'id' is the column name for the seller ID
            $_SESSION['seller_name'] = $row['fullname']; // Store additional seller info as needed
            header("Location: ../seller.php");
            exit(); // Ensure that no further code is executed after redirection
        } else {
            $_SESSION['status'] = "Invalid Password";
            $_SESSION['status_code'] = "error";
            header("Location: ../landing.php");
            exit(); // Ensure that no further code is executed after redirection
        }
    } else {
        $_SESSION['status'] = "Seller not found";
        $_SESSION['status_code'] = "error";
        header("Location: ../landing.php");
        exit(); // Ensure that no further code is executed after redirection
    }
}
?>
