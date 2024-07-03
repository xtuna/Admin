<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "demo");

if(isset($_POST['save_data'])) {
    $fullname = $_POST['fullname'];
    $contact = $_POST['contact'];
    $storename = $_POST['storename'];
    $stallNumber = $_POST['stallNumber'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Handle store image upload
    $storeimage = '';
    if(isset($_FILES['storeimage']) && $_FILES['storeimage']['error'] == 0) {
        $storeimage = '../uploads/' . basename($_FILES['storeimage']['name']);
        move_uploaded_file($_FILES['storeimage']['tmp_name'], $storeimage);
    }

    $query = "INSERT INTO sellers (fullname, contact, storename, stallNumber, storeimage, email, password) 
              VALUES ('$fullname', '$contact', '$storename', '$stallNumber', '$storeimage', '$email', '$password')";

    if(mysqli_query($connection, $query)) {
        $_SESSION['status'] = "Seller Registered Successfully!";
        $_SESSION['status_code'] = "success";
        header("Location: ../landing.php");
    } else {
        $_SESSION['status'] = "Seller Registration Failed!";
        $_SESSION['status_code'] = "error";
        header("Location: ../landing.php");
    }
}
?>
