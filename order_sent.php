<?php

error_reporting(1);
session_start();
include("connection.php");

$name = htmlspecialchars($_GET['name']);
$phone = htmlspecialchars($_GET['phone']);
$address = htmlspecialchars($_GET['address']);
$ordno = htmlspecialchars($_GET['ordno']);


if (!isset($_GET['name']) || !isset($_GET['phone']) || !isset($_GET['address']) || !isset($_GET['ordno'])) {
    session_destroy();
    header("Location: shop.php");
    exit;
}else{
    if(isset($_POST['logout'])){
        session_destroy();
        header("Location: shop.php");
        exit;
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>I Anime House</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">

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
    <nav class="navbar navbar-expand-lg navbar-light shadow" style="background-color: #ced4da;">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="index.php">
                <img src="img/logo.png" style="width: 40px;height: 40px;"> I Anime House
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
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
                <div class="navbar align-self-center d-flex">
                    <a class="nav-icon position-relative text-decoration-none" target="blank" href="admin/index.php">
                        <i class="fa fa-fw fa-lock mr-3"></i>
                        Admin
                    </a>
                </div>
            </div>

        </div>
    </nav>
    <!-- Close Header -->

    <section class="container-fluid py-5 bg-dark">
        <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h1 class="text-success fw-bold"><i>Thank you for shopping with us</i></h1>
                <p class="fw-bold text-success"><i>Order sent successfully</i></p>

                <p class="fw-bold text-success "><i>Your Name is &nbsp;</i><span><?php echo "<font color='#6454CA'>" . $_GET['name'] . "</font>"; ?></span></p>
                <p class="fw-bold text-success "><i>Your Phone is &nbsp;</i><span><?php echo "<font color='#6454CA'>" . $_GET['phone'] . "</font>"; ?></span></p>
                <p class="fw-bold text-success "><i>Your Address is &nbsp;</i><span><?php echo "<font color='#6454CA'>" . $_GET['address'] . "</font>"; ?></span></p>
                <p class="fw-bold text-success "><i>Your Order No. is &nbsp;</i><span><?php echo "<font color='#6454CA'>" . $_GET['ordno'] . "</font>"; ?></span></p>

                <form action="order_sent.php" method="POST" enctype="multipart/form-data">
                <button type="submit" name="logout" class="btn btn-outline-success shadow px-5 mt-5">Logout</button>
                </form>
            </div>
        </div>
    </section>



    <!-- Start Footer -->
    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row justify-content-between">

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3 border-light logo">
                        <img src="img/logo.png" style="width: 40px;height: 40px;"> I Anime House
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

                

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Info</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="#">About Us</a></li>
                        <li><a class="text-decoration-none" href="#">FAQs</a></li>
                    </ul>
                </div>

            </div>

            <div class="row text-light mb-4">
                <div class="col-12 mb-3">
                    <div class="w-100 my-3 border-top border-light"></div>
                </div>
                <div class="col-auto me-auto">
                    <ul class="list-inline text-left footer-icons">
                        <li class="list-inline-item border border-success rounded-circle text-center">
                            <a class="text-success text-decoration-none" target="_blank" href="http://facebook.com/"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-success rounded-circle text-center">
                            <a class="text-success text-decoration-none" target="_blank" href="https://www.instagram.com/"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-success rounded-circle text-center">
                            <a class="text-success text-decoration-none" target="_blank" href="https://twitter.com/"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
                        </li>
                        <li class="list-inline-item border border-success rounded-circle text-center">
                            <a class="text-success text-decoration-none" target="_blank" href="https://www.linkedin.com/"><i class="fab fa-linkedin fa-lg fa-fw"></i></a>
                        </li>
                    </ul>
                </div>
                
            </div>
        </div>

        <div class="w-100 bg-black py-3 text-center">
            <div class="container">
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