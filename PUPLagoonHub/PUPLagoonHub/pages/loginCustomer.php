<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "demo");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['login_customer'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Sanitize inputs to prevent SQL injection
    $email = mysqli_real_escape_string($connection, $email);

    $query = "SELECT * FROM customers WHERE email='$email'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run && mysqli_num_rows($query_run) > 0) {
        $row = mysqli_fetch_assoc($query_run);
        if (password_verify($password, $row['password'])) {
            // Password matches, set session variables
            $_SESSION['auth'] = true;
            $_SESSION['customer_id'] = $row['customerID'];
            $_SESSION['customer_name'] = $row['fullname'];

            // Redirect to customer account page or dashboard
            header("Location: ../customer.php");
            exit(); // Ensure that no further code is executed after redirection
        } else {
            // Invalid password
            $_SESSION['status'] = "Invalid Password";
            $_SESSION['status_code'] = "error";
            header("Location: ../landing.php");
            exit(); // Ensure that no further code is executed after redirection
        }
    } else {
        // Customer not found
        $_SESSION['status'] = "Customer not found";
        $_SESSION['status_code'] = "error";
        header("Location: ../landing.php");
        exit(); // Ensure that no further code is executed after redirection
    }
}
?>
