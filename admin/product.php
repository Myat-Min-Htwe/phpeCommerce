<?php

error_reporting(1);

session_start();
include("connection.php");

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: index.php");
    exit;
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($_POST['name']) || empty($_POST['price'])) {
            $er = "Please fill product name and price!";
        } else {
            $name = $_POST['name'];
            $price = $_POST['price'];

            // Sanitize the product name for creating the directory
            //$sanitized_name = preg_replace('/[^a-zA-Z0-9]/', '_', $name);
            $dir_path = "assets/image";

            // Create the image directory if not exists
            if (!is_dir($dir_path)) {
                mkdir($dir_path);
            }
            
            // Upload and move the image
            $img = $_FILES['img']['name'];
            $tmp_name = $_FILES['img']['tmp_name'];

            move_uploaded_file($tmp_name, $dir_path . DIRECTORY_SEPARATOR . $img);

            $query = $connection -> prepare ("INSERT INTO item (img, item_name, price) VALUES (?, ?, ?)");
            $query -> bind_param ("sss", $img, $name, $price);

            if ($query -> execute()) {
                if ($query -> affected_rows > 0) {
                    $success = "Exported successfully";

                    header("Refresh: 1"); // Refresh the page after 2 seconds
                    
                }else {
                    $er = "Exported failed! No rows affected.";
                }
            }else {
                $er = "Exported failed! Query execution error: ";
            }
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


    <section style="height: 549px;" class="container-fluid py-5 bg-dark">
        <div class="row text-center pt-1">
                <h1 class="text-success fw-bold">Export Products</h1>
        </div>

        <p class="h4 text-danger fw-bold text-center"><?php echo $er; ?></p>
        <p class="h4 text-success fw-bold text-center"><?php echo $success; ?></p>

            <div class="col-lg-6 m-auto">
                <form action="product.php" method="POST" enctype="multipart/form-data" class="col-md-6 m-auto shadow-lg mt-3 p-4">
                    
                    <div class="mb-2 col-lg-12">
                        <label for="p_img" class="form-label fw-bold text-success">Image</label>
                        <input type="file" class="form-control shadow bg-light" name="img">
                
                    </div>
                    <div class="mb-2 col-lg-12">
                        <label for="p_name" class="form-label fw-bold text-success">Product Name</label>
                        <input type="text" class="form-control shadow bg-light" name="name">
                
                    </div>
                    <div class="mb-2 col-lg-12">
                        <label for="p_price" class="form-label fw-bold text-success">Product Price</label>
                        <input type="text" class="form-control shadow bg-light" name="price">
                
                    </div>
        
                    <div class="col text-center mt-4">
                        <button type="submit" name="sub" id="sub"
                        class="btn btn-outline-success shadow px-5">Export</button>
                    </div>
        
                </form>
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