<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: landing.php');
    exit();
}

include('../db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $store_id = isset($_POST['store_id']) ? $_POST['store_id'] : null;
    $name = isset($_POST['name']) ? trim($_POST['name']) : null;
    $image = isset($_FILES['image']) ? $_FILES['image'] : null;

    if ($store_id && $name) {
        if ($image) {
            // Handle file upload if a new image is provided
            $targetDir = "../uploads/";
            $targetFile = $targetDir . basename($image["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            $check = getimagesize($image["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            // Check file size
            if ($image["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                echo "Sorry, only JPG, JPEG, PNG files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($image["tmp_name"], $targetFile)) {
                    // Update store with new image
                    try {
                        $stmt = $pdo->prepare("UPDATE stores SET name = ?, image = ? WHERE id = ?");
                        $stmt->execute([$name, basename($image["name"]), $store_id]);

                        header('Location: ../pages/store.php');
                        exit();
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        } else {
            // Update store without changing the image
            try {
                $stmt = $pdo->prepare("UPDATE stores SET name = ? WHERE id = ?");
                $stmt->execute([$name, $store_id]);

                header('Location: ../pages/store.php');
                exit();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    } else {
        echo "Please fill in all required fields.";
    }
}
?>
