<?php

error_reporting(1);
session_start();

include("connection.php");

if (isset($_POST['sub'])) {
    if ($_POST['name'] == "" || $_POST['password'] == ""){
        $er = "Please fill admin name and password !";
    }else {
        $name = $_POST['name'];
        $password = $_POST['password'];

        //******hashing the existing Password in database which put manually***use one time and reclose this step***
        
        // $query = "SELECT * FROM user";
        // $pass_res = mysqli_query($connection, $query);

        // while ($pass_row = mysqli_fetch_assoc($pass_res)) {
            
        //     //******check hash password need or not
        //     if (!password_needs_rehash($pass_row['password'], PASSWORD_DEFAULT)){
        //         continue; //skip if password doesn't need rehashing
        //     }

        //     $hash_pass = password_hash($pass_row['password'], PASSWORD_DEFAULT);

        //     $admin_name = $pass_row['name'];

        //     $updateQuery = "UPDATE user SET password = '$hash_pass' WHERE name = '$admin_name'";
        //     mysqli_query($connection, $updateQuery);
        // }


        $stmt = $connection -> prepare ("SELECT * FROM user WHERE name = ?");
        $stmt -> bind_param ("s", $name);
        $stmt -> execute();

        $result = $stmt -> get_result();

        if ($result -> num_rows > 0) {
            $row = mysqli_fetch_assoc($result);

            $hashPassword = $row['password'];

            if (password_verify($password, $hashPassword)) {
                $_SESSION['authenticated'] = true; //store session for indicate authentication

                header("Location: home.php");
                exit;
                
            }else {
                $er = "Your password is incorrect !";
            }
        }else {
            $er = "User not found !";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>I Anime House</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
<!--
    
TemplateMo 559 Zay Shop

https://templatemo.com/tm-559-zay-shop

-->
</head>

<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg bg-dark shadow-lg">
        <div class="container d-flex justify-content-center align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="index.php">
                <img src="../img/logo.png" style="width: 40px;height: 40px;"> I Anime House
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php"><i class="fas fa-shopping-basket"></i> Shop</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php"><i class="fas fa-unlock-alt"></i> Register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php"><i class="fas fa-comment-alt"></i> Contact</a>
                        </li>
                    </ul>
                </div>
            </div> -->

        </div>
    </nav>
    <!-- Close Header -->


    <div class="container-fluid py-5 bg-dark">
        <div class="col-md-6 m-auto text-center">
            <h1 class="fw-bold text-success">Admin Login</h1>
        </div>
    <div class="row col-lg-6 m-auto py-5">

    <div class="h4 mb-2 fw-bold text-center text-danger"><?php echo $er; ?></div>
    
            <form method="POST" enctype="multipart/form-data" action="index.php" class="col-md-6 m-auto shadow-lg p-4">
    
                <div class="mb-2 col-lg-12">
                    <label for="name" class="form-label fw-bold text-success">Admin Name</label>
                    <input type="text" class="form-control shadow bg-light" name="name">
    
                </div>
                <div class="mb-2 col-lg-12">
                    <label for="password" class="form-label fw-bold text-success">Admin Password</label>
                    <input type="password" class="form-control shadow bg-light" name="password">
                </div>
                
    
                <div class="row">
                    <div class="col text-center mt-4 mb-4">
                        <button type="submit" name="sub" id="sub"
                            class="btn btn-outline-success shadow px-5">Login</button>
                    </div>
                </div>
    
            </form>
        </div>
    </div>

    <!-- Start Footer -->
    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row justify-content-between">

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3 border-light logo">
                        <img src="../img/logo.png" style="width: 40px;height: 40px;"> I Anime House
                    </h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>
                            <i class="fas fa-map-marker-alt fa-fw"></i>
                            1001-123st-Yangon
                        </li>
                        <li>
                            <i class="fa fa-phone fa-fw"></i>
                            <a class="text-decoration-none" href="tel:010-020-0340">010-020-0340</a>
                        </li>
                        <li>
                            <i class="fa fa-envelope fa-fw"></i>
                            <a class="text-decoration-none" href="mailto:info@company.com">info@company.com</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="w-100 bg-black py-3">
            <div class="container text-center">
                <div class="row pt-2">
                    <div class="col-12">
                        <p class="text-left text-light">
                            Copyright &copy; 2023 | <span class="text-success">Myat Min Htwe</span>  <span class="fw-bold">#4071</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </footer>
    <!-- End Footer -->

    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- End Script -->
</body>

</html>