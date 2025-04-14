<?php
session_start();
include("api/conn.php");

// Verify token and email
if (isset($_GET['token']) && isset($_GET['email'])) {
    $token = htmlspecialchars($_GET['token']);
    $email = htmlspecialchars($_GET['email']);

    $query = "SELECT * FROM password_resets WHERE email = ? AND token = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("Database error: " . $conn->error);
    }
    $stmt->bind_param('ss', $email, $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $_SESSION['toast_type'] = "error";
        $_SESSION['toast_message'] = "Invalid or expired reset link.";
        header("Location: login_page.php");
        exit;
    } else {
        $row = $result->fetch_assoc();
        if ($row['expires'] < time()) {
            $_SESSION['toast_type'] = "error";
            $_SESSION['toast_message'] = "This reset link has expired.";
            header("Location: login_page.php");
            exit;
        }
    }
} else {
    header("Location: login_page.php");
    exit;
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reset_password'])) {
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];
    $token = $_POST['token'];

    if ($new_password !== $confirm_password) {
        $_SESSION['toast_type'] = "error";
        $_SESSION['toast_message'] = "Passwords do not match.";
    } else {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update password
        $update_query = "UPDATE users SET password = ? WHERE email = ?";
        $stmt = $conn->prepare($update_query);
        if (!$stmt) {
            die("Database error: " . $conn->error);
        }
        $stmt->bind_param('ss', $hashed_password, $email);
        $stmt->execute();

        // Delete reset token
        $delete_query = "DELETE FROM password_resets WHERE email = ?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param('s', $email);
        $stmt->execute();

        $_SESSION['toast_type'] = "success";
        $_SESSION['toast_message'] = "Password reset successful! You can now log in.";
        header("Location: login_page.php");
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
    <title>Password Recovery</title>
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
                    <form  class="bg-white rounded shadow-5-strong p-5" method="POST">
                        <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']); ?>">
                        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">

                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="password" class="form-control" required minlength="4">
                        </div>

                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" name="confirm_password" class="form-control" required minlength="4">
                        </div>

                        <button type="submit" name="reset_password" class="btn btn-primary btn-block">Reset Password</button>
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