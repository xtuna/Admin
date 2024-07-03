<?php
// session_start() should be called only once in your application, ensure it is not duplicated
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include('../db.php'); // Ensure the path to db.php is correct

$current_page = basename($_SERVER['PHP_SELF']); // Get the current page file name

$is_store_page = ($current_page == 'store.php');

$is_user_page = ($current_page == 'user.php');

// Fetch admin information from database
if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    $fetch_admin_query = "SELECT * FROM admins WHERE id = '$admin_id'";
    $fetch_admin_result = mysqli_query($connection, $fetch_admin_query);

    if ($fetch_admin_result && mysqli_num_rows($fetch_admin_result) > 0) {
        $admin_data = mysqli_fetch_assoc($fetch_admin_result);
        $admin_email = $admin_data['email'];
    } else {
        $admin_email = "Admin"; // Default name if not found
    }
} else {
    // Handle if admin is not logged in
    $admin_email = "Guest";
}
?>

<div class="sidebar">
    <div class="top">
        <div class="logo">
            <img src="../imgs/Logo.png" alt="Logo" class="logo-img">
            <hr class="white-line">
        </div>
    </div>

    <div class="user">
        <div>
            <p class="bold">Admin Account</p>
        </div>
    </div>
    <ul>
        <p>Welcome, <?php echo $admin_email; ?>!</p>
        <li class="<?php echo ($current_page === 'store.php') ? 'active' : ''; ?>">
            <a href="../pages/store.php">
                <i class="bx bx-list-check"></i>
                <span class="nav-item">Stores</span>
            </a>
        </li>
        <li class="<?php echo ($current_page === 'user.php') ? 'active' : ''; ?>">
            <a href="../pages/user.php">
                <i class="bx bx-list-check"></i>
                <span class="nav-item">Users</span>
            </a>
        </li>
        <li>
            <a href="../pages/logout.php" data-bs-toggle="modal" data-bs-target="#logout">
                <i class="bx bx-log-out"></i>
                <span class="nav-item">Logout</span>
            </a>
        </li>
    </ul>
</div>

<form id="logoutForm" action="..pages/logout.php" method="POST">
    <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="logoutLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="logoutLabel">Confirm</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <label>Are you sure you want to logout?</label>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-lg" name="logout_btn">Yes</button>
                    <button type="button" class="btn btn-danger btn-lg" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const logoutForm = document.getElementById('logoutForm');
        logoutForm.addEventListener('submit', function(event) {
            event.preventDefault();
            this.submit();
        });
    });
</script>
