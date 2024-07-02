<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="path_to_your_css/styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .sidebar {
            height: 100vh;
            width: 250px;
            background-color: #343a40;
            color: #fff;
            position: fixed;
        }

        .sidebar .logo {
            padding: 20px;
            text-align: center;
            font-size: 1.5em;
            font-weight: bold;
            color: #ffc107;
        }

        .sidebar .nav-item {
            padding: 15px 20px;
            font-size: 1.2em;
        }

        .sidebar .nav-item a {
            color: #fff;
            text-decoration: none;
        }

        .sidebar .nav-item a:hover {
            background-color: #495057;
            border-radius: 5px;
        }

        .sidebar .nav-item.active a {
            text-decoration: underline;
        }

        .sidebar .nav-item i {
            margin-right: 10px;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>
<div class="sidebar">
        <div class="logo">
            <img src="path_to_logo.png" alt="Logo">
        </div>
        <h4><center>Admin</center></h4>
        <ul class="nav flex-column">
            <li class="nav-item <?php if($page == 'stores') { echo 'active'; } ?>">
                <a href="manage_stores.php"><i class="fas fa-store"></i> Stores</a>
            </li>
            <li class="nav-item <?php if($page == 'users') { echo 'active'; } ?>">
                <a href="manage_users.php"><i class="fas fa-users"></i> Users</a>
            </li>
            <li class="nav-item">
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </li>
        </ul>
    </div>
    <div class="content">
