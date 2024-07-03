<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PUP LagoonHub</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="includes/style/style-landing.css">
  <link rel="stylesheet" href="sweetalert2.min.css">
</head>
<body>
<?php
session_start();

include('db.php'); // Ensure the path to db.php is correct

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL statement
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE email = :email AND password = :password");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

    // Execute the statement
    $stmt->execute();

    // Check if the user exists
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['admin_id'] = $user['id'];
        header("Location: views/admin.php");
        exit();
    } else {
        echo "Invalid email or password";
    }
}
?>

  <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="imgs/Logo.png" alt="logo" width="70" height="70" class="d-inline-block align-top ms-5" />
      </a>
      <form class="d-flex" role="search">
        <button class="btn btn-outline-light me-5" type="button" data-bs-toggle="modal" data-bs-target="#inserdata">Sign Up</button>
      </form>
    </div>
  </nav>

  <div class="modal fade" id="inserdata" tabindex="-1" aria-labelledby="inserdataLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="inserdataLabel">WHAT IS YOUR ROLE?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="d-grid gap-2">
            <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#insertCustomer">CUSTOMER</button>
            <button class="btn btn-outline-success" type="button" data-bs-toggle="modal" data-bs-target="#insertSeller">SELLER</button>
            <button class="btn btn-outline-warning" type="button" data-bs-toggle="modal" data-bs-target="#loginAdmin">ADMIN</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="insertCustomer" tabindex="-1" aria-labelledby="insertCustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="insertCustomerLabel">Customer Registration Form</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="pages/registerCustomer.php" method="POST">
            <div class="form-group mb-3">
              <label>Username</label>
              <input type="text" class="form-control" name="username" placeholder="Enter Username" required>
            </div>

            <div class="form-group mb-3">
              <label>Fullname</label>
              <input type="text" class="form-control" name="fullname" placeholder="Enter Fullname" required>
            </div>

            <div class="form-group mb-3">
              <label>Phone Number</label>
              <input type="tel" class="form-control" name="phone" placeholder="Enter Phone Number" required>
            </div>

            <div class="form-group mb-3">
              <label>Webmail</label>
              <input type="email" class="form-control" name="email" placeholder="Enter Webmail" required>
            </div>

            <div class="form-group mb-3">
              <label>Password</label>
              <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
            </div>

            <div class="form-group mb-3 text-center">
              <p><a href="#" data-bs-toggle="modal" data-bs-target="#loginCustomer" data-bs-dismiss="modal" class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover">Do have an account? Login here.</a></p>
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

  <div class="modal fade" id="loginCustomer" tabindex="-1" aria-labelledby="insertLoginCustomer" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="insertLoginCustomer">Customer Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="pages/loginCustomer.php" method="POST">
            <div class="form-group mb-3">
              <label>Email</label>
              <input type="text" class="form-control" name="email" placeholder="Enter Username" required>
            </div>

            <div class="form-group mb-3">
              <label>Password</label>
              <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
            </div>

            <div class="form-group mb-3 text-center">
              <p><a href="#" data-bs-toggle="modal" data-bs-target="#forgotPassword" data-bs-dismiss="modal" class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover">Forgot your password?</a></p>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="login_customer" class="btn btn-success">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="insertSeller" tabindex="-1" aria-labelledby="insertSellerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="insertSellerLabel">Seller Registration Form</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="pages/registerSeller.php" method="POST" enctype="multipart/form-data">
            <div class="form-group mb-3">
              <label>Fullname</label>
              <input type="text" class="form-control" name="fullname" placeholder="Enter Username" required>
            </div>

            <div class="form-group mb-3">
              <label>Contact No.</label>
              <input type="tel" class="form-control" name="contact" placeholder="Enter Contact Number" required>
            </div>

            <div class="form-group mb-3">
              <label>Store Name</label>
              <input type="text" class="form-control" name="storename" placeholder="Enter Username" required>
            </div>

            <div class="form-group mb-3">
              <label> Stall Number</label>
              <input type="number" class="form-control" name="stallNumber" placeholder="Enter Stall Number">
            </div>

            <div class="form-group mb-3">
              <label> Store Image</label>
              <input type="file" class="form-control" name="storeimage" accept=".jpg, .png, .jpeg">
            </div>

            <div class="form-group mb-3">
              <label>Email</label>
              <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
            </div>

            <div class="form-group mb-3">
              <label>Password</label>
              <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
            </div>

            <div class="form-group mb-3 text-center">
              <p><a href="#" data-bs-toggle="modal" data-bs-target="#loginSeller" data-bs-dismiss="modal" class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover">Do have an account? Login here.</a></p>
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

  <div class="modal fade" id="loginSeller" tabindex="-1" aria-labelledby="insertLoginSeller" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="insertLoginSeller">Seller Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="pages/loginSeller.php" method="POST">
            <div class="form-group mb-3">
              <label>Email</label>
              <input type="email" class="form-control" name="email" placeholder="Enter Username" required>
            </div>

            <div class="form-group mb-3">
              <label>Password</label>
              <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
            </div>

            <div class="form-group mb-3 text-center">
              <p><a href="#" data-bs-toggle="modal" data-bs-target="#forgotPassword" data-bs-dismiss="modal" class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover">Forgot your password?</a></p>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="login_seller" class="btn btn-success">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="forgotPassword" tabindex="-1" aria-labelledby="insertForgotPassword" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="insertForgotPassword">Forgot Password?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="pages/registerSeller.php" method="POST">

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

  <div class="modal fade" id="loginAdmin" tabindex="-1" aria-labelledby="insertLoginAdmin" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="insertLoginAdmin">Admin Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
        </div>
        <div class="modal-body">
          <form method="post" action="">
            <div class="form-group mb-3">
              <label>Email</label>
              <input type="text" class="form-control" name="email" placeholder="Enter Email" required>
            </div>

            <div class="form-group mb-3">
              <label>Password</label>
              <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
            </div>

            <?php if (isset($_SESSION['status'])) { echo "<p>{$_SESSION['status']}</p>"; unset($_SESSION['status']); } ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" name="login_admin" class="btn btn-success">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <section id="home" class="banner">
    <div class="content">
      <h1>LAGOON</h1>
      <br>
      <h2>HUB</h2>
      <p>The PUP Lagoon Ordering App offers a seamless and reliable ordering <br>experience.
        Easily choose stores, place orders, and check out with <br>accurate pricing and comprehensive order history.</p>
    </div>
  </section>

  <section id="about-link">
    <section class="team">
      <div class="center">
        <h1>MEET OUR TEAM</h1>
      </div>

      <div class="team-content">
        <div class="box">
          <img src="imgs/aw.png" alt="B2BN">
          <h3>BETHOVEN ALBURO JR</h3>
          <h5>Programmer</h5>
          <div class="icons">
            <a href="https://www.facebook.com/B2bin/"><i class="ri-facebook-box-fill"></i></a>
            <a href="https://www.instagram.com/bitubin/"><i class="ri-instagram-fill"></i></a>
          </div>
        </div>

        <div class="box">
          <img src="imgs/aw.png" alt="SHAN">
          <h3>DENICE SHANLEY ALEMANIA</h3>
          <h5>System Analyst</h5>
          <div class="icons">
            <a href=""><i class="ri-facebook-box-fill"></i></a>
            <a href=""><i class="ri-instagram-fill"></i></a>
          </div>
        </div>

        <div class="box">
          <img src="imgs/aw.png" alt="GWY">
          <h3>JOSIAH GWYN BULLOS</h3>
          <h5>Technical Designer</h5>
          <div class="icons">
            <a href=""><i class="ri-facebook-box-fill"></i></a>
            <a href=""><i class="ri-instagram-fill"></i></a>
          </div>
        </div>

        <div class="box">
          <img src="imgs/aw.png" alt="TINA">
          <h3>CRISTINA VELASCO</h3>
          <h5>Projetct Manager</h5>
          <div class="icons">
            <a href=""><i class="ri-facebook-box-fill"></i></a>
            <a href=""><i class="ri-instagram-fill"></i></a>
          </div>
        </div>
    </section>
  </section>

  <section id="contact-link" class="contact">
    <div class="section-header">
      <div class="Ccontainer">
        <h2>CONTACT US</h2>
        <p>Whether you have a question or simply want to connect. <br>
          Feel free to send us a message in the contact form.</p>
      </div>
    </div>

    <div class="Ccontainer">
      <div class="row">
        <div class="contact-info">
          <div class="contactItem">
            <div class="contactIcon">
              <i class="ri-map-pin-fill"></i>
            </div>

            <div class="contactContent">
              <h4>ADDRESS</h4>
              <p>PUP A. Mabini Campus, Anonas St., <br> Sta. Mesa Manila, Philippines 1016</p>
            </div>
          </div>

          <div class="contactItem">
            <div class="contactIcon">
              <i class="ri-phone-fill"></i>
            </div>

            <div class="contactContent">
              <h4>PHONE NUMBER</h4>
              <p>+639195957077</p>
            </div>
          </div>

          <div class="contactItem">
            <div class="contactIcon">
              <i class="ri-mail-fill"></i>
            </div>

            <div class="contactContent">
              <h4>EMAIL</h4>
              <p>info@iskomapph.com</p>
            </div>
          </div>
        </div>

        <div class="contact-form">
          <form id="contact-form">
            <h2>SEND FEEDBACK</h2>
            <div class="input-box">
              <input type="text" required>
              <span>Full Name</span>
            </div>

            <div class="input-box">
              <input type="email" required>
              <span>Email</span>
            </div>

            <div class="input-box">
              <textarea required></textarea>
              <span>Type your Feedback...</span>
            </div>

            <div class="input-box">
              <input type="submit" value="Send">
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <div class="footer">
    <p><i class="ri-copyright-line"></i> 2024 BSIT 3-2N. All Right Reserved.</p>
  </div>

</body>

</html>
