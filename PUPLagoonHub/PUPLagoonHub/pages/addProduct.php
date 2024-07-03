<?php
session_start();
$connection = mysqli_connect("127.0.0.1:3307", "root", "", "pup_lagoon");

if(isset($_POST['save_data'])) {
    $ProductName = $_POST['productName'];
    $Stock = $_POST['productStock'];
    $Price = $_POST['productPrice'];
    $user_id = $_SESSION['seller_id']; // Get the seller's ID from the session

    // File upload handling
    $targetDir = "../uploads/"; // Adjust this path as per your setup
    $targetFile = $targetDir . basename($_FILES["productImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["productImage"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["productImage"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFile)) {
            echo "The file ". htmlspecialchars(basename($_FILES["productImage"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Insert data into database if file upload was successful
    if($uploadOk == 1) {
        $insert_query = "INSERT INTO products (product_name, product_stock, price, product_image, seller_id) VALUES ('$ProductName', '$Stock', '$Price', '$targetFile', '$user_id')";
        $insert_query_run = mysqli_query($connection, $insert_query);

        if($insert_query_run) {
            $_SESSION['status'] = "Data Inserted Successfully!";
            $_SESSION['status_code'] = "success";
            header('location: ../seller.php');
        } else {
            $_SESSION['status'] = "Insertion of data failed";
            $_SESSION['status_code'] = "error";
            header('location: ../seller.php');
        }
    }
}
?>
