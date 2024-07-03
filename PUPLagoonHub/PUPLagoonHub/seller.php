<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Seller Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="includes/style/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

</head>

<body>

    <?php
    session_start();
    $connection = mysqli_connect("127.0.0.1:3307", "root", "", "pup_lagoon");

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    include('includes/sidebar.php');

    // Check if status message exists and display using SweetAlert2
    if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
    ?>
        <script>
            Swal.fire({
                title: '<?php echo $_SESSION['status_code'] ?>',
                text: '<?php echo $_SESSION['status'] ?>',
                icon: '<?php echo $_SESSION['status_code'] ?>'
            });
        </script>
    <?php
        unset($_SESSION['status']);
    }

    // Modal for adding new product
    ?>
    <div class="modal fade" id="inserdata" tabindex="-1" aria-labelledby="inserdataLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="inserdataLabel">ADD PRODUCTS</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="pages/addProduct.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label> Product Name</label>
                            <input type="text" class="form-control" name="productName" placeholder="Enter Product Name">
                        </div>
                        <div class="form-group mb-3">
                            <label> Stock</label>
                            <input type="number" class="form-control" name="productStock" placeholder="Enter Stock">
                        </div>
                        <div class="form-group mb-3">
                            <label> Price</label>
                            <input type="number" step="0.01" class="form-control" name="productPrice" placeholder="Enter Price">
                        </div>
                        <div class="form-group mb-3">
                            <label> Product Image</label>
                            <input type="file" class="form-control" name="productImage" accept=".jpg, .png, .jpeg">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="save_data" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Container for displaying products -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">LIST OF PRODUCTS</h4>
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#inserdata">
                            Add Product
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Product ID</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Product Image</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Fetch products for the logged-in seller
                                if (isset($_SESSION['seller_id'])) {
                                    $seller_id = $_SESSION['seller_id'];
                                    $fetch_query = "SELECT * FROM products WHERE seller_id = '$seller_id'";
                                    $fetch_query_run = mysqli_query($connection, $fetch_query);

                                    if (mysqli_num_rows($fetch_query_run) > 0) {
                                        while ($row = mysqli_fetch_array($fetch_query_run)) {
                                ?>
                                            <tr>
                                                <td><?php echo $row['id'] ?></td>
                                                <td><?php echo $row['product_name'] ?></td>
                                                <td><?php echo $row['product_stock'] ?></td>
                                                <td><?php echo $row['price'] ?></td>
                                                <td><img src="uploads/<?php echo $row['product_image']; ?>" alt="Product Image" style="max-width: 100px;"></td>
                                                <td>
                                                    <a href="#" class="btn btn-success btn-sm">Edit</a>
                                                    <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="6">No Record Found</td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="6">No seller ID found.</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('includes/footer.php'); ?>
</body>

</html>