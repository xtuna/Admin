<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "demo");

if(isset($_POST['save_data']))
{
    $StoreName = $_POST['storeName'];
    $StallNumber = $_POST['stallNumber'];

    // File upload handling
    $targetDir = "../uploads/"; // Adjust this path as per your setup
    $targetFile = $targetDir . basename($_FILES["storeImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["storeImage"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["storeImage"]["size"] > 500000) {
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
        if (move_uploaded_file($_FILES["storeImage"]["tmp_name"], $targetFile)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["storeImage"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Insert data into database if file upload was successful
    if($uploadOk == 1) {
        $insert_query = "INSERT INTO store (StoreName, StallNumber, StoreImage) VALUES ('$StoreName', '$StallNumber', '$targetFile')";
        $insert_query_run = mysqli_query($connection, $insert_query);

        if($insert_query_run)
        {
            $_SESSION['status'] = "Data Inserted Successfully!";
            $_SESSION['status_code'] = "success";
            header('location: ../seller-regis.php');
        }
        else
        {
            $_SESSION['status'] = "Insertion of data failed";
            $_SESSION['status_code'] = "error";
            header('location: ../seller-regis.php');
        }
    }
}
?>
