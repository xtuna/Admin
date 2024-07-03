<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Customer Account</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <link rel="stylesheet" href="includes/style/style.css">
   <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
   <script src="js/script.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

</head>

<body>

   <?php
   session_start();
   $connection = mysqli_connect("localhost", "root", "", "demo");
   if (!$connection) {
      die("Connection failed: " . mysqli_connect_error());
   }

   include('includes/sidebar-customer.php');

   ?>


   <div class="container">

      <section class="products">

         <h1 class="heading">PUP Lagoon Stores</h1>

         <div class="row row-cols-1 row-cols-md-2 row-cols-lg-5 g-5">

            <?php
            // Select products from database
            $select_products = mysqli_query($connection, "SELECT * FROM sellers");
            if (mysqli_num_rows($select_products) > 0) {
               while ($fetch_product = mysqli_fetch_assoc($select_products)) {
            ?>

                  <div class="col">
                     <form action="add_to_cart.php" method="post">
                        <div class="card h-100">
                           <img src="uploads/<?php echo $fetch_product['storeimage']; ?>" class="card-img-top" alt="<?php echo $fetch_product['storename']; ?>">
                           <div class="card-body">
                              <h5 class="card-title"><?php echo $fetch_product['storename']; ?></h5>
                              <p class="card-text">Stall Number: <?php echo $fetch_product['stallNumber']; ?></p>
                              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productsModal" data-store-id="<?php echo $fetch_product['id']; ?>">View</button>
                              <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ratings">Rate Store</button>
                           </div>
                        </div>
                     </form>
                  </div>
            <?php
               }
            } else {
               echo "<p class='col'>No stores found.</p>";
            }
            ?>
         </div>

      </section>

   </div>
   </div>

   <div class="modal fade" id="productsModal" tabindex="-1" aria-labelledby="productsModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
         <div class="modal-content">
            <div class="modal-header">
               <h1 class="modal-title fs-5" id="productsModalLabel">Products</h1>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalProductsContent">
               <!-- Products will be loaded here dynamically -->
            </div>
         </div>
      </div>
   </div>

   <div class="modal fade" id="ratings" tabindex="-1" aria-labelledby="insertRatings" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="insertRatings">Rate the Store</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form action="addRate" method="POST">

                  <div class="rateyo" id="rateYo">
                     <br>
                  </div>

                  <div class="form-group mb-3">
                     <label>Enter your email address and we'll send you a temporary password.</label>
                     <input type="text" class="form-control" name="username" placeholder="Enter Email" required>
                  </div>

            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="submit" name="save_data" class="btn btn-success">Submit</button>
               </form>
            </div>
         </div>
      </div>
   </div>

   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

   <script>
      document.addEventListener('DOMContentLoaded', function() {
         var productsModal = document.getElementById('productsModal');
         productsModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var storeId = button.getAttribute('data-store-id');
            var modalTitle = productsModal.querySelector('.modal-title');
            var modalBody = productsModal.querySelector('.modal-body');

            // Make an AJAX request to get the products
            fetch('get_store_products.php?store_id=' + storeId)
               .then(response => response.text())
               .then(data => {
                  modalBody.innerHTML = data;
               })
               .catch(error => {
                  console.error('Error:', error);
                  modalBody.innerHTML = '<p>Error loading products.</p>';
               });

            // Update the modal title
            modalTitle.textContent = 'Products for Store #' + storeId;
         });

         $("#ratings").on('shown.bs.modal', function() {
            $("#rateYo").rateYo({
               rating: 1.5,
               spacing: "10px",
               numStars: 5,
               minValue: 0,
               maxValue: 5,
               normalFill: 'black',
               ratedFill: 'orange'
            });
         });
      });
   </script>

   <?php include('includes/footer.php'); ?>

</body>

</html>