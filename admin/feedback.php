<?php

error_reporting(1);
session_start();
include("connection.php");

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: index.php");
    exit;
} else {
    $query = $connection -> prepare ("SELECT * FROM contact");

    if ($query -> execute()) {
        $result = $query -> get_result();
    }else{
        $er = "Query execution error".$query -> error;
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
    <nav class="navbar navbar-expand-lg bg-dark shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="home.php">
                <img src="../img/logo.png" style="width: 40px;height: 40px;"> I Anime House
            </a>

            <button class="navbar-toggler border-0 text-success" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span><i class="fas fa-bars"></i></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link text-success" href="home.php"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-success" href="product.php"><i class="fas fa-shopping-cart"></i> Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-success" href="view_order.php"><i class="fas fa-heart"></i> Order</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-success" href="feedback.php"><i class="fas fa-comment-alt"></i> Feedback</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">
                    <a class="nav-icon position-relative text-decoration-none text-success" href="logout.php">
                            <i class="fas fa-user-minus"></i>
                        Logout
                    </a>
                </div>
            </div>

        </div>
    </nav>
    <!-- Close Header -->

    <div class="container-fluid py-3 bg-dark">
        <div class="col-md-6 m-auto text-center shadow-lg">
            <h1 class="fw-bold text-success">Feedback Table</h1>
        </div>
    </div>

    <section style="height: auto;" class="container-fluid py-5 bg-dark">

<div class="table-responsive py-4">
<table class="table container table-primary table-striped table-hover">
    <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Subject</th>
      <th scope="col">Message</th>
    </tr>
  </thead>
  <tbody>
    <?php
    while ($row = $result -> fetch_assoc()) {
        echo "<tr>";
        echo "<th scope='row'>{$row['contact_id']}</th>";
        echo "<td>{$row['name']}</td>";
        echo "<td>{$row['email']}</td>";
        echo "<td>{$row['subject']}</td>";
        echo "<td>{$row['msg']}</td>";
        echo "</tr>";
    }
    ?>
    
  </tbody>
</table>
</div>

    </section>


    <!-- Start Footer -->
    <footer class="bg-dark shadow-lg" id="tempaltemo_footer">
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