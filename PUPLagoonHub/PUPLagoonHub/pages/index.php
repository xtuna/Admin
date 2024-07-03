<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PUP Lagoon Hub</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">


</head>
<body>

<script>
    Swal.fire({
  title: "Do you want to save the changes?",
  showDenyButton: true,
  showCancelButton: true,
  confirmButtonText: "Save",
  denyButtonText: `Don't save`
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    Swal.fire("Saved!", "", "success");
  } else if (result.isDenied) {
    Swal.fire("Changes are not saved", "", "info");
  }
});
</script>

    <div class="sidebar">
        <div class="top">
            <div class="logo">
            <img src="Logo.png" alt="Logo" class="logo-img">
            <hr class="white-line">
            </div>
        </div>
    
        <div class="user">  
        <div>
            <p class="bold">Seller Account</p>
        </div>
        </div>
        <ul>
            <li>
                <a href="#">
                    <i class="bx bx-shopping-bag"></i>
                    <span class="nav-item">Products</span>
                </a>
            </li>
            <li>
                <a href="order.php">
                    <i class="bx bx-list-check"></i>
                    <span class="nav-item">Orders</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bx bx-star"></i>
                    <span class="nav-item">Reviews</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="bx bx-log-out"></i>
                    <span class="nav-item">Logout</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="container">
    <div class="table">
       <h1>Products</h1>
       <br>
       <table>
            <thead>
                <tr>
                    <th>ProductID</th>
                    <th>ProductName</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database ="demo";

            $connection = new mysqli($servername, $username, $password, $database);

            if ($connection->connect_error) {
                die("Connection failed:". $connection->connect_error);
            }

            $sql = "SELECT * FROM product";
            $result = $connection->query($sql);

            if (!$result) {
                die("Invalid query: ". $connection->error);
            }

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>" . $row["Prod_ID"] . "</td>
                <td>" . $row["ProductName"] . "</td>
                <td>" . $row["Stock"] . "</td>
                <td>" . $row["Price"] . "</td>
                <td>
                    <a class='btn btn-primary btn-sm' href='update'>Update</a>
                    <a class='btn btn-danger btn-sm'href='delete'>Delete</a>
                </td>
            </tr>";
            }
                ?>
            </tbody>     

       </table>
    </div>
    </div>


</body>

</html>