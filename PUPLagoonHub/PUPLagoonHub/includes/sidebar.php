<?php

$current_page = basename($_SERVER['PHP_SELF']); // Get the current page file name

$is_home_page = ($current_page == 'seller.php');

$is_order_page = ($current_page == 'order.php');

$is_products_page = ($current_page == 'products.php');

if (isset($_SESSION['seller_id'])) {
    // Fetch seller information from database
    $seller_id = $_SESSION['seller_id'];
    $fetch_seller_query = "SELECT * FROM sellers WHERE id = '$seller_id'";
    $fetch_seller_result = mysqli_query($connection, $fetch_seller_query);

    if ($fetch_seller_result && mysqli_num_rows($fetch_seller_result) > 0) {
        $seller_data = mysqli_fetch_assoc($fetch_seller_result);
        $seller_name = $seller_data['fullname'];
    } else {
        $seller_name = "Seller"; // Default name if not found
    }
} else {
    // Handle if seller is not logged in
    $seller_name = "Guest";
}
?>

<div class="sidebar">
    <div class="top">
        <div class="logo">
            <img src="imgs/Logo.png" alt="Logo" class="logo-img">
            <hr class="white-line">
        </div>
    </div>

    <div class="user">
        <div>
            <p class="bold">Seller Account</p>
        </div>
    </div>
    <ul>
        <p>Welcome, <?php echo $seller_name; ?>!</p>
        <li class="<?php echo ($current_page === 'seller.php') ? 'active' : ''; ?>">
            <a href="#">
                <i class="bx bx-shopping-bag"></i>
                <span class="nav-item">Products</span>
            </a>
        </li>
        <li class="<?php echo ($current_page === 'order.php') ? 'active' : ''; ?>">
            <a href="pages/order.php">
                <i class="bx bx-list-check"></i>
                <span class="nav-item">Orders</span>
            </a>
        </li>
        <li class="<?php echo ($current_page === 'reviews.php') ? 'active' : ''; ?>">
            <a href="pages/reviews.php">
                <i class="bx bx-star"></i>
                <span class="nav-item">Reviews</span>
            </a>
        </li>
        <li>
            <a href="#" data-bs-toggle="modal" data-bs-target="#logout">
                <i class="bx bx-log-out"></i>
                <span class="nav-item">Logout</span>
            </a>
        </li>
    </ul>
</div>

<form id="logoutForm" action="pages/logout.php" method="POST">
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
        const logoutModal = document.getElementById('logout');

        logoutForm.addEventListener('submit', function(event) {

            event.preventDefault();

            this.submit();
        });
    });
</script>