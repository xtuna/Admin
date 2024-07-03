<?php
$connection = mysqli_connect("localhost", "root", "", "demo");

if (isset($_GET['store_id'])) {
    $store_id = mysqli_real_escape_string($connection, $_GET['store_id']);
    $select_products = mysqli_query($connection, "SELECT * FROM products WHERE seller_id = '$store_id'");

    if (mysqli_num_rows($select_products) > 0) {
        echo "<div class='row row-cols-1 row-cols-md-2 row-cols-lg-6 g-3'>";
        while ($fetch_product = mysqli_fetch_assoc($select_products)) {
            ?>
            <div class="col mb-3">
                <div class="card h-100" style="max-width: 10rem;">
                    <img src="uploads/<?php echo $fetch_product['product_image']; ?>" class="card-img-top" alt="<?php echo $fetch_product['product_name']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $fetch_product['product_name']; ?></h5>
                        <p class="card-text">₱<?php echo $fetch_product['price']; ?></p>
                        <button type="button" class="btn btn-primary btn-sm">Add to Cart</button>
                    </div>
                </div>
            </div>
            <?php
        }
        echo "</div>";
    } else {
        echo "<p>No products found for this store.</p>";
    }
} else {
    echo "<p>Invalid request.</p>";
}
?>