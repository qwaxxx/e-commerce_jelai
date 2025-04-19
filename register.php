<?php
session_start();
include("api/conn.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST['submit'])) {
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $name = trim(mysqli_real_escape_string($conn, $_POST['name']));
    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $contact = trim(mysqli_real_escape_string($conn, $_POST['contact']));
    $user_type = trim(mysqli_real_escape_string($conn, $_POST['user_type']));
    $password = $_POST['password'];
    $imageFileName = null;

    // ✅ Handle image upload
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $target_dir = "img/";
        $file_tmp = $_FILES["profile_image"]["tmp_name"];
        $original_name = basename($_FILES["profile_image"]["name"]);
        $imageFileType = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        // Validate image
        $check = getimagesize($file_tmp);
        if ($check !== false && in_array($imageFileType, $allowed_types)) {
            // Generate a unique filename to prevent conflicts
            $unique_name = uniqid('IMG_', true) . '.' . $imageFileType;
            $target_file = $target_dir . $unique_name;

            if (move_uploaded_file($file_tmp, $target_file)) {
                $imageFileName = $unique_name;
            } else {
                $_SESSION['error_message'] = "Sorry, there was an error uploading your image.";
                header("Location: register.php");
                exit;
            }
        } else {
            $_SESSION['error_message'] = "File is not a valid image or file type not allowed.";
            header("Location: register.php");
            exit;
        }
    }

    // ✅ Check for duplicate user
    $query = "SELECT * FROM users WHERE email = ? OR name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error_message'] = "User already exists!";
        header("Location: register.php");
        exit;
    }

    // ✅ Store user data in session
    $_SESSION['contact'] = $contact;
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['user_type'] = $user_type;
    $_SESSION['profile_image'] = $imageFileName;
    $_SESSION['hashed_password'] = password_hash($password, PASSWORD_DEFAULT);

    // ✅ Generate OTP
    $otp = rand(1000, 9999);
    $_SESSION['otp'] = $otp;

    // ✅ Send email using PHPMailer
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'remoterouter71@gmail.com'; 
        $mail->Password = 'dspkvdhaakctmgdu'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom('remoterouter71@gmail.com', 'E-commerce');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Verification Code';
        $mail->Body = "<p>Hello <strong>$name</strong>,<br>Your verification code is <strong>" . implode(' ', str_split($otp)) . "</strong></p>";

        $mail->send();
        header("Location: register_otp_confirm.php");
        exit;
    } catch (Exception $e) {
        $_SESSION['error_message'] = "Mailer Error: {$mail->ErrorInfo}";
        header("Location: register.php");
        exit;
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Register</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.min.css" rel="stylesheet">
    <style type="text/css">
        html,
        body,
        header,
        .carousel {
            height: 60vh;
        }

        #intro {
            width: 100%;
            display: flex;
            justify-content: center;
            position: absolute;
            top: 80px;
            /* Adjust as needed */
            left: 50%;
            transform: translateX(-50%);
            z-index: 1050;
        }

        #login-form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 350px;
            /* Adjust form width */
        }



        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            white-space: nowrap;
            padding: 10px 20px;
            /* Adjust button size */
            text-transform: uppercase;
        }


        @media (max-width: 740px) {

            html,
            body,
            header,
            .carousel {
                height: 100vh;
            }
        }

        @media (min-width: 800px) and (max-width: 850px) {

            html,
            body,
            header,
            .carousel {
                height: 100vh;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
        <div class="container">

            <!-- Brand -->
            <a class="navbar-brand waves-effect" href="index.php">
                <strong class="blue-text">E-commerce</strong>
            </a>

            <!-- Collapse -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Links -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- Left -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right -->
                <ul class="navbar-nav nav-flex-icons">
                    <li class="nav-item">
                        <a class="nav-link waves-effect">
                            <span class="badge red z-depth-1 mr-1"> 0 </span>
                            <i class="fas fa-shopping-cart"></i>
                            <span class="clearfix d-none d-sm-inline-block"> Cart </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="login_page.php" class="nav-link border border-light rounded waves-effect">
                            <i class="fas fa-user-circle mr-2"></i>Login
                        </a>
                    </li>
                </ul>

            </div>

        </div>
    </nav>
    <!-- Navbar -->
    <!--Main Navigation-->

    <!-- Background image -->
    <div id="intro" class="bg-image shadow-2-strong">
        <div class="mask d-flex align-items-center h-100 p-4" style="background-color: rgba(0, 0, 0, 0.2);">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-12 col-md-10">
                    <form class="bg-white rounded shadow-5-strong p-5" method="post">
                        <h4 class="text-center mb-4">Create Your Account</h4>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" id="name" class="form-control" name="name" required />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="email">Email address</label>
                            <input type="email" id="email" class="form-control" name="email" required />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="contact">Contact</label>
                            <input type="text" id="contact" class="form-control" name="contact" required />
                        </div>

                        <div hidden class="form-outline mb-4">
                            <label class="form-label" for="profile_image">Picture</label>
                            <input type="file" name="profile_image" class="form-control">
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="user_type">User Type</label>
                            <select class="form-control" id="user_type" name="user_type" required>
                                <option disabled selected value="">Choose...</option>
                                <option value="customer">Customer</option>
                                <option value="seller">Seller</option>
                            </select>
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" class="form-control" name="password" required />
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
                        <a href="login_page.php" class="btn btn-outline-secondary btn-block mt-2">Login</a>
                    </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Background image -->
    </header>
    <!--Main Navigation-->
    <!--Carousel Wrapper-->
    <div id="carousel-example-1z" class="carousel slide carousel-fade pt-4" data-ride="carousel">

        <!--Indicators-->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-1z" data-slide-to="1"></li>
            <li data-target="#carousel-example-1z" data-slide-to="2"></li>
        </ol>
        <!--/.Indicators-->

        <!--Slides-->
        <div class="carousel-inner" role="listbox">

            <!--First slide-->
            <div class="carousel-item active">
                <div class="view" style="background-image: url('img/product/Yoga\ 7\ 2-in-1\ 14\'Gen\ 9.png'); background-repeat: no-repeat; background-size: cover;">

                    <!-- Mask & flexbox options-->
                    <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

                        <!-- Content -->
                        <div class="text-center white-text mx-5 wow fadeIn">


                        </div>
                        <!-- Content -->

                    </div>
                    <!-- Mask & flexbox options-->

                </div>
            </div>
            <!--/First slide-->

            <!--Second slide-->
            <div class="carousel-item">
                <div class="view" style="background-image: url('img/product/Lenovo\ LOQ\ 15AHP9.png'); background-repeat: no-repeat; background-size: cover;">

                    <!-- Mask & flexbox options-->
                    <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

                        <!-- Content -->
                        <div class="text-center white-text mx-5 wow fadeIn">

                        </div>
                        <!-- Content -->

                    </div>
                    <!-- Mask & flexbox options-->

                </div>
            </div>
            <!--/Second slide-->

            <!--Third slide-->
            <div class="carousel-item">
                <div class="view" style="background-image: url('img/product/IdeaPadSlim1i15Gen\ 7.png'); background-repeat: no-repeat; background-size: cover;">

                    <!-- Mask & flexbox options-->
                    <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

                        <!-- Content -->
                        <div class="text-center white-text mx-5 wow fadeIn">

                        </div>
                        <!-- Content -->

                    </div>
                    <!-- Mask & flexbox options-->

                </div>
            </div>
            <!--/Third slide-->

        </div>
        <!--/.Slides-->

    </div>


    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Initializations -->
    <script type="text/javascript">
        // Animations initialization
        new WOW().init();
    </script>
</body>

</html>