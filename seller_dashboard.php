<?php
session_start();
include("api/conn.php");

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>E-commerce</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.min.css" rel="stylesheet">

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

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding: 58px 0 0;
            /* Height of navbar */
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
            /* Scrollable contents if viewport is shorter than content. */
        }
    </style>
    <!-- MDB CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />

    <!-- Your content here -->


</head>

<body>

    <!--Main Navigation-->
    <header>
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">


            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3 mt-4">

                    <!-- Collapse 2 -->
                    <a
                        class="list-group-item list-group-item-action py-2 ripple"
                        href="seller_dashboard.php">
                        <i class="fas fa-chart-area fa-fw me-3"></i><span>Sell items</span>
                    </a>
                    <a
                        class="list-group-item list-group-item-action py-2 ripple"
                        href="seller_transaction.php">
                        <i class="fas fa-chart-area fa-fw me-3"></i><span>Transactions</span>
                    </a>
                </div>
            </div>
        </nav>
        <!-- Sidebar -->

        <!-- Navbar -->
        <nav id="main-navbar" class="navbar navbar-expand-lg bg-white fixed-top">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-mdb-collapse-init data-mdb-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>


                <!-- Brand -->
                <a class="navbar-brand" href="logout.php">
                    Flappy
                </a>
                <!-- Search form -->


                <!-- Right links -->
                <ul class="navbar-nav ms-auto d-flex flex-row">
                    <!-- Notification dropdown -->
                    <li class="nav-item dropdown">
                        <a
                            data-mdb-dropdown-init class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow"
                            href="#"
                            id="navbarDropdownMenuLink"
                            role="button"
                            data-mdb-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            <span class="badge rounded-pill badge-notification bg-danger">1</span>
                        </a>
                        <ul
                            class="dropdown-menu dropdown-menu-end"
                            aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Some news</a></li>
                            <li><a class="dropdown-item" href="#">Another news</a></li>
                            <li>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </li>
                        </ul>
                    </li>


                    <!-- Avatar -->
                    <li class="nav-item dropdown">
                        <a
                            data-mdb-dropdown-init class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center"
                            href="#"
                            id="navbarDropdownMenuLink"
                            role="button"
                            data-mdb-toggle="dropdown"
                            aria-expanded="false">
                            <img
                                src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img (31).webp"
                                class="rounded-circle"
                                height="22"
                                alt="Avatar"
                                loading="lazy" />
                        </a>
                        <ul
                            class="dropdown-menu dropdown-menu-end"
                            aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="seller_profile.php">My profile</a></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>
    <!--Main Navigation-->


    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container  pt-4">

            <!--Navbar-->
            <nav class="navbar navbar-expand-lg navbar-dark mdb-color lighten-3 mt-3 mb-5">

                <!-- Navbar brand -->
                <span class="navbar-brand">Categories:</span>

                <!-- Collapse button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
                    aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Collapsible content -->
                <div class="collapse navbar-collapse" id="basicExampleNav">

                    <!-- Links -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" id="showAll" href="#">All
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">

                            <select class="form-control nav-link mdb-color lighten-3" name="price_range" id="price_range" style="color:aqua;height:42px;margin-left:2px">
                                <option value="">Select price range</option>
                                <option value="0-1000">₱0 - ₱1000</option>
                                <option value="1000-2000">₱1000 - ₱2000</option>
                                <option value="2000-3000">₱2000 - ₱3000</option>
                            </select>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#addproduct">
                                + Add product
                            </button>
                        </li>
                    </ul>
                    <!-- Links -->

                    <form class="form-inline">
                        <div class="md-form my-0">
                            <input class="form-control mr-sm-2" type="text" placeholder="Search" id="search" aria-label="Search">
                        </div>
                    </form>
                </div>
                <!-- Collapsible content -->

            </nav>
            <!--/.Navbar-->
            <div id="productContainer"></div>


        </div>
    </main>
    <!--Main layout-->

    <!--Footer-->
    <footer class="page-footer text-center font-small mt-4 wow fadeIn">

        <!--Call to action-->
        <div class="pt-4">
            <a class="btn btn-outline-white" href="https://mdbootstrap.com/docs/jquery/getting-started/download/" target="_blank"
                role="button">Download MDB
                <i class="fas fa-download ml-2"></i>
            </a>
            <a class="btn btn-outline-white" href="https://mdbootstrap.com/education/bootstrap/" target="_blank" role="button">Start
                free tutorial
                <i class="fas fa-graduation-cap ml-2"></i>
            </a>
        </div>
        <!--/.Call to action-->

        <hr class="my-4">

        <!-- Social icons -->
        <div class="pb-4">
            <a href="https://www.facebook.com/mdbootstrap" target="_blank">
                <i class="fab fa-facebook-f mr-3"></i>
            </a>

            <a href="https://twitter.com/MDBootstrap" target="_blank">
                <i class="fab fa-twitter mr-3"></i>
            </a>

            <a href="https://www.youtube.com/watch?v=7MUISDJ5ZZ4" target="_blank">
                <i class="fab fa-youtube mr-3"></i>
            </a>

            <a href="https://plus.google.com/u/0/b/107863090883699620484" target="_blank">
                <i class="fab fa-google-plus-g mr-3"></i>
            </a>

            <a href="https://dribbble.com/mdbootstrap" target="_blank">
                <i class="fab fa-dribbble mr-3"></i>
            </a>

            <a href="https://pinterest.com/mdbootstrap" target="_blank">
                <i class="fab fa-pinterest mr-3"></i>
            </a>

            <a href="https://github.com/mdbootstrap/bootstrap-material-design" target="_blank">
                <i class="fab fa-github mr-3"></i>
            </a>

            <a href="http://codepen.io/mdbootstrap/" target="_blank">
                <i class="fab fa-codepen mr-3"></i>
            </a>
        </div>
        <!-- Social icons -->

        <!--Copyright-->
        <div class="footer-copyright py-3">
            © 2019 Copyright:
            <a href="https://mdbootstrap.com/education/bootstrap/" target="_blank"> MDBootstrap.com </a>
        </div>
        <!--/.Copyright-->
        <!-- Button trigger modal -->

    </footer>
    <!--/.Footer-->
    <!-- Button trigger modal -->

    <!-- Modal -->
    <?php
    // Query to fetch products
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <?php $modalId = "productModal" . $row['prod_id']; ?>
            <div class="modal fade" id="<?= $modalId; ?>" tabindex="1" role="dialog" aria-labelledby="updateProductLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form method="POST" action="update_product.php">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateProductLabel">Update Product</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="prod_id" value="<?= $row['prod_id']; ?>">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" name="prod_name" class="form-control" value="<?= $row['prod_name']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="prod_description" class="form-control" required><?= $row['prod_description']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Stock</label>
                                    <input type="number" name="prod_stock" class="form-control" value="<?= $row['prod_stock']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" name="prod_price" class="form-control" value="<?= $row['prod_price']; ?>" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Update Product</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="text-center">No products available.</p>
    <?php endif;
    $conn->close();

    ?>
    <div class="modal fade" id="addproduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Items to Sell</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="seller_uploadprod.php" method="POST" enctype="multipart/form-data" class="p-4 border rounded shadow-sm">
                        <div class="form-group">
                            <label for="prod_name">Product Name</label>
                            <input type="text" name="prod_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="prod_price">Price</label>
                            <input type="number" name="prod_price" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="prod_stock">Stock</label>
                            <input type="number" name="prod_stock" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="prod_description">Description</label>
                            <textarea name="prod_description" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="prod_picture">Product Image</label>
                            <input type="file" name="prod_picture" class="form-control-file" accept="image/*" required>
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary">Add Product</button>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>




    <!-- SCRIPTS -->
    <script>
        document.querySelector('.navbar-toggler').addEventListener('click', () => {
            const sidebar = document.getElementById('sidebarMenu');
            sidebar.classList.toggle('show');
            console.log('Sidebar toggled:', sidebar.classList.contains('show'));
        });
    </script>
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script>
        $(document).ready(function() {
            loadProducts();

            $('#search').on('keyup', function() {
                loadProducts($('#search').val(), $('#price_range').val(), 1);
            });

            $('#price_range').on('change', function() {
                loadProducts($('#search').val(), $('#price_range').val(), 1);
            });

            $('#showAll').on('click', function(e) {
                e.preventDefault();
                $('#search').val('');
                $('#price_range').val('');
                loadProducts();
            });

            // Handle pagination click (delegate since it’s loaded via AJAX)
            $(document).on('click', '.pagination-link', function(e) {
                e.preventDefault();
                const page = $(this).data('page');
                loadProducts($('#search').val(), $('#price_range').val(), page);
            });

            function loadProducts(search = '', price = '', page = 1) {
                $.ajax({
                    url: 'seller_fetch_products.php',
                    method: 'POST',
                    data: {
                        search: search,
                        price: price,
                        page: page
                    },
                    success: function(data) {
                        $('#productContainer').html(data);
                    }
                });
            }
        });
    </script>

    <!-- Bootstrap -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/mdb.min.js"></script>


    <!-- MDB core JavaScript (should come after Bootstrap) -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>

    <script type="text/javascript">
        // Animations initialization

        new WOW().init();
    </script>



</body>

</html>