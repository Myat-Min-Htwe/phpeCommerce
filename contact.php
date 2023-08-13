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

    <!-- Load map styles -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
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

    <!-- Start Content Page -->
    <div class="container-fluid bg-dark py-5">
        <div class="col-md-6 m-auto text-center">
            <h1 class="fw-bold text-success text-decoration-underline">Feedback</h1>
            <p style="color: white">
                Send us a Feedback !
            </p>
        </div>
    </div>

    <?php
    error_reporting(1);

    session_start();

    include("connection.php");


    if (isset($_POST['sub'])) {
        $name = $_POST['contact_name'];
        $email = $_POST['contact_email'];
        $subject = $_POST['contact_subject'];
        $msg = $_POST['contact_msg'];


        // Use prepared statements to prevent SQL injection
        $stmt = $connection->prepare("INSERT INTO contact(name, email, subject, msg) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $subject, $msg);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Message sent successfully";
            
        } else {
            $_SESSION['error_message'] = "Failed sending message!";
        }
    }

    if (isset($_SESSION['success_message'])){
        $er = "<font color='green' size='+1'>" . $_SESSION['success_message'] . "</font>";
        header("Refresh: 2; URL=contact.php");
        unset($_SESSION['success_message']);
    }

    // Check if there's an error message in the session and display it
    if (isset($_SESSION['error_message'])) {
        $er = "<font color='red' size='+1'>" . $_SESSION['error_message'] . "</font>";
        unset($_SESSION['error_message']); // Clear the session variable to prevent showing the message again on subsequent refreshes
    }
    ?>
    
    <!-- Start Contact -->
    <div class="container-fluid py-5 bg-dark">

        <div class="h4 fw-bold text-center"><?php echo $er; ?></div>

        <div class="row py-5">
        
            <form class="col-md-9 m-auto shadow-lg" method="POST" enctype="multipart/form-data" role="form">
                <div class="row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputname" class=" fw-bold text-success">Name</label>
                        <input type="text" class="form-control mt-1  shadow bg-light" id="contact_name" name="contact_name" placeholder="Name" required>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputemail" class=" fw-bold text-success">Email</label>
                        <input type="email" class="form-control mt-1  shadow bg-light" id="contact_email" name="contact_email" placeholder="Email" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="inputsubject" class=" fw-bold text-success">Subject</label>
                    <input type="text" class="form-control mt-1  shadow bg-light" id="contact_subject" name="contact_subject" placeholder="Subject" required>
                </div>
                <div class="mb-3">
                    <label for="inputmessage" class=" fw-bold text-success">Message</label>
                    <textarea class="form-control mt-1  shadow bg-light" id="contact_msg" name="contact_msg" placeholder="Message" required rows="5"></textarea>
                </div>
                <div class="row">
                    <div class="col text-center mt-3 mb-5">
                        <button type="submit" name="sub" id="sub" class="btn btn-outline-success px-5 shadow">Send</button>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
    <!-- End Contact -->


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