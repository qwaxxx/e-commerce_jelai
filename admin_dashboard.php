<?php
session_start();
include("api/conn.php");

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login_page.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user info
$query = "SELECT name, email, profile_image FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$stmt->bind_result($name, $email, $profile_image);
$stmt->fetch();
$stmt->close();

// Display the image if it exists or use a placeholder
$image_src = $profile_image ? 'img/' . $profile_image : 'https://via.placeholder.com/150';

// Fetch total users, orders, and products
$query_users = "SELECT COUNT(*) FROM users";
$query_orders = "SELECT COUNT(*) FROM billing_orders";
$query_products = "SELECT COUNT(*) FROM products";

$total_users = $conn->query($query_users)->fetch_row()[0];
$total_orders = $conn->query($query_orders)->fetch_row()[0];
$total_products = $conn->query($query_products)->fetch_row()[0];


// Fetch user info
$query = "SELECT name, email, profile_image FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$stmt->bind_result($name, $email, $profile_image);
$stmt->fetch();
$stmt->close();

// Display the image if it exists or use a placeholder
$image_src = $profile_image ? 'img/' . $profile_image : 'https://via.placeholder.com/150';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/mdb.min.css" rel="stylesheet">
    <link href="css/style.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style type="text/css">
        @media (max-width: 991.98px) {
            #sidebarMenu {
                display: none;
            }

            #sidebarMenu.show {
                display: block;
            }
        }

        body {
            background-color: #fbfbfb;
        }

        @media (min-width: 991.98px) {
            main {
                padding-left: 240px;
            }
        }

        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding: 58px 0 0;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
            width: 240px;
            z-index: 600;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                width: 100%;
            }
        }

        .sidebar .active {
            border-radius: 5px;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
        }

        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: 0.5rem;
            overflow-x: hidden;
            overflow-y: auto;
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />
</head>

<body>
    <header>

        <?php include 'admin_slidebar.php' ?>

        <?php include 'admin_navbar.php' ?>

    </header>

    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container pt-4">
            <div class="row mb-4">
                <!-- Total Users Card -->
                <div class="col-md-4">
                    <div class="card bg-primary text-white">
                        <div class="card-header">
                            <i class="fas fa-users"></i> Total Users
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $total_users ?></h5>
                        </div>
                    </div>
                </div>

                <!-- Total Orders Card -->
                <div class="col-md-4">
                    <div class="card bg-success text-white">
                        <div class="card-header">
                            <i class="fas fa-box"></i> Total Orders
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $total_orders ?></h5>
                        </div>
                    </div>
                </div>

                <!-- Total Products Card -->
                <div class="col-md-4">
                    <div class="card bg-warning text-white">
                        <div class="card-header">
                            <i class="fas fa-cogs"></i> Total Products
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><?= $total_products ?></h5>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <!--Main layout-->

    <?php include 'footer.php'; ?>

    <script>
        document.querySelector('.navbar-toggler').addEventListener('click', () => {
            const sidebar = document.getElementById('sidebarMenu');
            sidebar.classList.toggle('show');
            console.log('Sidebar toggled:', sidebar.classList.contains('show'));
        });
    </script>
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>
    <script type="text/javascript">
        new WOW().init();
    </script>

</body>

</html>