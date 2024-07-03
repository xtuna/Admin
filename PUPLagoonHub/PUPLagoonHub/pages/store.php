<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../includes/style/style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

</head>

<body>

    <?php
    session_start();
    if (!isset($_SESSION['admin_id'])) {
        header('Location: landing.php');
        exit();
    }

    include('../db.php');

    // Handle delete operation
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_store'])) {
        $store_id = $_POST['store_id'];
        $stmt = $pdo->prepare("DELETE FROM stores WHERE id = ?");
        $stmt->execute([$store_id]);
    }

    // Fetch all stores from database
    $stmt = $pdo->prepare("SELECT * FROM stores");
    $stmt->execute();
    $stores = $stmt->fetchAll();

    $page = 'stores';
    include('../includes/sidebar-admin.php');
    ?>

    <!-- Add Store Modal -->
    <div class="modal fade" id="addStoreModal" tabindex="-1" aria-labelledby="addStoreModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addStoreModalLabel">ADD STORE</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../pages/add_store.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label> Store Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Store Name">
                        </div>
                        <div class="form-group mb-3">
                            <label> Store Image</label>
                            <input type="file" class="form-control" name="image" accept=".jpg, .png, .jpeg">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="save_store" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Store Modal -->
    <div class="modal fade" id="editStoreModal" tabindex="-1" aria-labelledby="editStoreModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editStoreModalLabel">EDIT STORE</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editStoreForm" action="../pages/edit_store.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" id="editStoreId" name="store_id">
                        <div class="form-group mb-3">
                            <label> Store Name</label>
                            <input type="text" class="form-control" id="editStoreName" name="name" placeholder="Enter Store Name">
                        </div>
                        <div class="form-group mb-3">
                            <label> Store Image</label>
                            <input type="file" class="form-control" name="image" accept=".jpg, .png, .jpeg">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="save_store" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Container for displaying stores -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">MANAGE STORES</h4>
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addStoreModal">
                            Add Store
                        </button>
                    </div>
                    <div class="row">
                        <?php foreach ($stores as $row) { ?>
                        <div class="col-md-4">
                            <div class="card">
                                <div style="width: 100px; height: 100px; overflow: hidden; background: #cccccc; margin: 0 auto">
                                    <img src="../uploads/<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top" alt="Store Image">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                                    <button type="button" class="btn btn-primary" onclick="editStore(<?php echo $row['id']; ?>, '<?php echo htmlspecialchars($row['name']); ?>')">Edit</button>
                                    <form action="store.php" method="post" class="d-inline">
                                        <input type="hidden" name="store_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="delete_store" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('../includes/footer.php'); ?>

    <!-- JavaScript to populate edit modal -->
    <script>
        function editStore(id, name) {
            document.getElementById('editStoreId').value = id;
            document.getElementById('editStoreName').value = name;
            var modal = new bootstrap.Modal(document.getElementById('editStoreModal'));
            modal.show();
        }
    </script>

</body>

</html>
