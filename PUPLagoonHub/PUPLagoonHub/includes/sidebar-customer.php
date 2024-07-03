<?php 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$current_page = basename($_SERVER['PHP_SELF']); // Get the current page file name

// Check if current page is home.php
$is_home_page = ($current_page == 'customer.php');

$is_cart_page = ($current_page == 'cart.php');

// Check if current page is products.php
$is_products_page = ($current_page == 'customer.php');

if (isset($_SESSION['customer_id'])) {
    // Fetch seller information from database
    $customer_id = $_SESSION['customer_id'];
    $fetch_customer_query = "SELECT * FROM customers WHERE customerID = '$customer_id'";
    $fetch_customer_result = mysqli_query($connection, $fetch_customer_query);

    if ($fetch_customer_result && mysqli_num_rows($fetch_customer_result) > 0) {
        $customer_data = mysqli_fetch_assoc($fetch_customer_result);
        $customer_name = $customer_data['fullname'];
    } else {
        $customer_name = "Customer"; // Default name if not found
    }
} else {
    // Handle if seller is not logged in
    $customer_name = "Guest";
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
            <p class="bold">Customer Account</p>
        </div>
    </div>
    <ul>
        <p>Welcome, <?php echo $customer_name; ?>!</p>
        <li class="<?php echo ($current_page === 'customer.php') ? 'active' : ''; ?>">
            <a href="#">
                <i class="bx bx-store"></i>
                <span class="nav-item">Stores</span>
            </a>
        </li>
        <li class="<?php echo ($current_page === 'cart.php') ? 'active' : ''; ?>">
            <a href="pages/cart.php">
                <i class="bx bx-cart-alt"></i>
                <span class="nav-item">Cart</span>
            </a>
        </li>
        <li class="">
            <a href="pages/reviews.php">
                <i class="bx bx-bell"></i>
                <span class="nav-item">Track My Order</span>
            </a>
        </li>
        <li class="">
            <a href="#">
                <i class="bx bx-money"></i>
                <span class="nav-item">Transactions</span>
            </a>
        </li>
        <li class="">
            <a href="#">
                <i class="bx bx-key"></i>
                <span class="nav-item">Password</span>
            </a>
        </li>
        <li class="">
            <a href="#" onclick="confirmLogout()">
                <i class="bx bx-log-out"></i>
                <span class="nav-item">Logout</span>
            </a>
        </li>
    </ul>
</div>

<script>
function confirmLogout() {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, logout!"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "pages/logout.php";
        }
    });
}
</script>
