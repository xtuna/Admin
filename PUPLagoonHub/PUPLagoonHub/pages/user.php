<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Seller Panel</title>
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

    // Handle insert operation
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_data'])) {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $type = $_POST['type'];
        $status = $_POST['status'];

        $stmt = $pdo->prepare("INSERT INTO users (fullname, email, type, status) VALUES (?, ?, ?, ?)");
        $stmt->execute([$fullname, $email, $type, $status]);

        header('Location: ../pages/user.php');
        exit();
    }

    // Handle delete operation
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_user'])) {
        $user_id = $_POST['user_id'];
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
    }

    // Fetch all users from database
    $stmt = $pdo->prepare("SELECT id, fullname, email, type, status FROM users");
    $stmt->execute();
    $users = $stmt->fetchAll();

    include('../includes/sidebar-admin.php');
    ?>
    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addUserModalLabel">ADD USER</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../pages/add_user.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label> Full Name</label>
                            <input type="text" class="form-control" name="fullname" placeholder="Enter Full Name">
                        </div>
                        <div class="form-group mb-3">
                            <label> Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter Email">
                        </div>
                        <div class="form-group mb-3">
                            <label> Type [Customer, Seller]</label>
                            <input type="text" class="form-control" name="type" placeholder="Enter Type">
                        </div>
                        <div class="form-group mb-3">
                            <label> Status [Active, Disabled]</label>
                            <input type="text" class="form-control" name="status" placeholder="Enter Status">
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

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editUserModalLabel">EDIT USER</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editUserForm" action="../pages/edit_user.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" id="editUserId" name="user_id">
                        <div class="form-group mb-3">
                            <label> Full Name</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter Full Name">
                        </div>
                        <div class="form-group mb-3">
                            <label> Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                        </div>
                        <div class="form-group mb-3">
                            <label> Type [Customer, Seller]</label>
                            <input type="text" class="form-control" id="type" name="type" placeholder="Enter Type">
                        </div>
                        <div class="form-group mb-3">
                            <label> Status [Active, Disabled]</label>
                            <input type="text" class="form-control" id="status" name="status" placeholder="Enter Status">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="save_data" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Container for displaying users -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">MANAGE USERS</h4>
                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#addUserModal">
                            Add User
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($user['fullname']) ?></td>
                                        <td><?= htmlspecialchars($user['email']) ?></td>
                                        <td><?= htmlspecialchars($user['type']) ?></td>
                                        <td><?= htmlspecialchars($user['status']) ?></td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" onclick="editUser(<?php echo $user['id']; ?>, '<?php echo htmlspecialchars($user['fullname']); ?>', '<?php echo htmlspecialchars($user['email']); ?>', '<?php echo htmlspecialchars($user['type']); ?>', '<?php echo htmlspecialchars($user['status']); ?>')">EDIT</button>
                                            <form action="../pages/user.php" method="post" class="d-inline">
                                                <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                                <button type="submit" name="delete_user" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">DELETE</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('../includes/footer.php'); ?>

    <!-- JavaScript to populate edit modal -->
    <script>
        function editUser(id, fullname, email, type, status) {
            document.getElementById('editUserId').value = id;
            document.getElementById('fullname').value = fullname;
            document.getElementById('email').value = email;
            document.getElementById('type').value = type;
            document.getElementById('status').value = status;
            var modal = new bootstrap.Modal(document.getElementById('editUserModal'));
            modal.show();
        }
    </script>

</body>

</html>
