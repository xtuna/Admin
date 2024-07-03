<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "demo";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed:" . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prodID = $_POST["Prod_ID"];
    $productName = $_POST["ProductName"];
    $stock = $_POST["Stock"];
    $price = $_POST["Price"];

    $sql = "UPDATE product SET ProductName='$productName', Stock='$stock', Price='$price' WHERE Prod_ID='$prodID'";

    if ($connection->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $connection->error;
    }

    $connection->close();
    header("Location: index.php");
    exit();
}
?>
