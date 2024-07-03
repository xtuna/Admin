<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>admin Panel</title>
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
    // session_start();
    $connection = mysqli_connect("127.0.0.1:3307", "root", "", "pup_lagoon");

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    include('../includes/sidebar-admin.php');

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

    ?>

<!-- <h2>Dashboard</h2>
<p>Welcome to the admin panel.</p> -->

    <?php include('../includes/footer.php'); ?>
</body>

</html>



