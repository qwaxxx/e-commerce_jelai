<?php
session_start();
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

        table td,
        table th {
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        thead th {
            color: #fff;

        }

        .card {
            border-radius: .5rem;
        }

        .table-scroll {
            border-radius: .5rem;
        }

        .table-scroll table thead th {
            font-size: 1 rem;
        }

        thead {
            top: 0;
            position: sticky;

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
                <button data-mdb-button-init
                    class="navbar-toggler"
                    type="button"
                    data-mdb-collapse-init
                    data-mdb-target="#sidebarMenu"
                    aria-controls="sidebarMenu"
                    aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Brand -->
                <a class="navbar-brand" href="logout.php">
                    Flappy <?php echo $user_id ?>
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
                            <span id="notificationBadge" class="badge rounded-pill badge-notification bg-danger">0</span>

                        </a>
                        <ul id="notificationDropdown" class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Loading...</a></li>
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


        <section class="intro">

            <div class="container">
                <div class="card mt-2">
                    <div class="card-header">Welcome !</div>
                    <div class="card-body">
                        <h5 class="card-title">Valued Seller,</h5>
                        <p class="card-text">You are in seller page, update your profile.</p>
                        <a href="seller_profile.php" class="btn btn-primary" data-mdb-ripple-init>Go to Profile</a>
                    </div>
                </div>
                <div class="row justify-content-center mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="row mb-3">
                                    <div class="col-md-6 offset-md-3">
                                        <input type="text" id="searchInput" class="form-control" placeholder="Search orders..." onkeyup="searchTable()" />
                                    </div>
                                </div>
                                <div class="table-responsive table-scroll" data-mdb-perfect-scrollbar="true" style="position: relative; height: 700px">

                                    <table id="ordersTable" class="table table-striped mb-0">
                                        <thead style="background-color: #002d72; color:#fbfbfb">
                                            <tr style="cursor: pointer;">
                                                <th onclick="sortTable(0)">Date/Time <span class="sort-indicator"></span></th>
                                                <th onclick="sortTable(1)">Tracking ID<span class="sort-indicator"></span></th>
                                                <th onclick="sortTable(2)">Customer Name<span class="sort-indicator"></span></th>
                                                <th onclick="sortTable(3)">Block/Lot/Street/Village <span class="sort-indicator"></span></th>
                                                <th onclick="sortTable(4)">Baranggay <span class="sort-indicator"></span></th>
                                                <th onclick="sortTable(5)">City <span class="sort-indicator"></span></th>
                                                <th onclick="sortTable(6)">Province <span class="sort-indicator"></span></th>
                                                <th onclick="sortTable(7)">Country <span class="sort-indicator"></span></th>
                                                <th onclick="sortTable(8)">Parcel Quantity <span class="sort-indicator"></span></th>
                                                <th onclick="sortTable(9)">Total Amount <span class="sort-indicator"></span></th>
                                                <th onclick="sortTable(10)">Status <span class="sort-indicator"></span></th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody id="ordersBody">
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                <nav>

                                    <ul class="pagination" id="pagination"></ul>
                                </nav>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </section>
        <!--Main layout-->

    </main>
    <!--Main layout-->


    <script>
        document.querySelector('.navbar-toggler').addEventListener('click', () => {
            document.getElementById('sidebarMenu').classList.toggle('show');
        });
    </script>

    <!-- SCRIPTS -->
    <!-- MDB JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>

    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script>
        let currentSortedColumn = -1;
        let currentSortDirection = "asc";

        function sortTable(n) {
            const table = document.getElementById("ordersTable");
            let rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;

            switching = true;
            dir = (n === currentSortedColumn && currentSortDirection === "asc") ? "desc" : "asc";

            currentSortedColumn = n;
            currentSortDirection = dir;

            while (switching) {
                switching = false;
                rows = table.rows;

                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];

                    let xContent = x.textContent || x.innerText;
                    let yContent = y.textContent || y.innerText;

                    let comparison = 0;

                    // Check if it's the Date/Time column (usually index 0)
                    if (n === 0) {
                        let xDate = new Date(xContent);
                        let yDate = new Date(yContent);
                        comparison = xDate - yDate;
                    } else {
                        const xNum = parseFloat(xContent);
                        const yNum = parseFloat(yContent);
                        const isNumeric = !isNaN(xNum) && !isNaN(yNum);

                        if (isNumeric) {
                            comparison = xNum - yNum;
                        } else {
                            comparison = xContent.toLowerCase().localeCompare(yContent.toLowerCase());
                        }
                    }

                    if ((dir === "asc" && comparison > 0) || (dir === "desc" && comparison < 0)) {
                        shouldSwitch = true;
                        break;
                    }
                }

                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchcount++;
                } else {
                    if (switchcount == 0 && dir === "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }

            // Update sort indicators
            const ths = table.querySelectorAll("th");
            ths.forEach((th, index) => {
                let span = th.querySelector(".sort-indicator");
                if (!span) {
                    span = document.createElement("span");
                    span.className = "sort-indicator";
                    th.appendChild(span);
                }
                if (index === n) {
                    span.textContent = dir === "asc" ? " ▲" : " ▼";
                } else {
                    span.textContent = "";
                }
            });
        }
    </script>


    <script>
        let ordersData = [];
        const rowsPerPage = 12;
        let currentPage = 1;

        // Fetch data from server
        fetch('seller_fetch_orders.php')
            .then(res => res.json())
            .then(data => {
                ordersData = data;
                displayTable(currentPage);
                setupPagination();
            });

        // Display paginated table
        function displayTable(page) {
            const tbody = document.getElementById('ordersBody');
            tbody.innerHTML = '';

            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const paginatedItems = ordersData.slice(start, end);

            if (paginatedItems.length === 0) {
                tbody.innerHTML = `<tr>
      <td colspan="12" class="text-center text-muted py-4">
        No transactions found.
      </td>
    </tr>`;
                return;
            }

            paginatedItems.forEach(row => {
                // only show actions when status is exactly "pending"
                const actionCell = row.addcart_status.toLowerCase() === 'pending' ?
                    `
        <button class="btn btn-success btn-sm"
                onclick="updateStatus(${row.order_id}, 'accepted')">
          Accept
        </button>
        <button class="btn btn-danger btn-sm"
                onclick="updateStatus(${row.order_id}, 'rejected')">
          Reject
        </button>` :
                    'No actions needed'; // empty if not pending

                tbody.innerHTML += `
      <tr>
        <td>${row.order_date}</td>
        <td>${row.addcart_id}</td>
        <td>${row.billing_lname}, ${row.billing_fname}</td>
        <td>${row.billing_street_village_purok}</td>
        <td>${row.billing_baranggay}</td>
        <td>${row.billing_city}</td>
        <td>${row.billing_province}</td>
        <td>${row.billing_country}</td>
        <td>${row.total_quantity}</td>
        <td>${parseFloat(row.total_amount)
                     .toLocaleString(undefined, {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                     })}</td>
        <td>${row.addcart_status}</td>
        <td>${actionCell}</td>
      </tr>`;
            });
        }


        function searchTable() {
            const input = document.getElementById("searchInput");
            const filter = input.value.toLowerCase();
            const tbody = document.getElementById("ordersBody");
            const rows = tbody.getElementsByTagName("tr");

            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName("td");
                let rowContainsKeyword = false;

                for (let j = 0; j < cells.length - 1; j++) { // Exclude the last "Action" column
                    if (cells[j].textContent.toLowerCase().includes(filter)) {
                        rowContainsKeyword = true;
                        break;
                    }
                }

                rows[i].style.display = rowContainsKeyword ? "" : "none";
            }
        }


        function updateStatus(orderId, status) {
            fetch('seller_update_status.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        order_id: orderId,
                        status: status
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Status updated successfully!');
                        // Refresh the table or update the status in the table directly
                        fetch('seller_fetch_orders.php')
                            .then(res => res.json())
                            .then(data => {
                                ordersData = data;
                                displayTable(currentPage);
                                setupPagination();
                            });
                    } else {
                        alert('Failed to update status.');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
        // Setup pagination buttons
        function setupPagination() {
            const pagination = document.getElementById('pagination');
            pagination.innerHTML = '';

            const pageCount = Math.ceil(ordersData.length / rowsPerPage);

            for (let i = 1; i <= pageCount; i++) {
                const li = document.createElement('li');
                li.classList.add('page-item');
                if (i === currentPage) li.classList.add('active');

                const a = document.createElement('a');
                a.classList.add('page-link');
                a.href = "#";
                a.innerText = i;

                a.addEventListener('click', function(e) {
                    e.preventDefault();
                    currentPage = i;
                    displayTable(currentPage);
                    setupPagination();
                });

                li.appendChild(a);
                pagination.appendChild(li);
            }
        }
    </script>
    <script>
        function loadNotifications(all = false) {
            const url = all ?
                'fetch_notification.php?all=1' :
                'fetch_notification.php';

            fetch(url)
                .then(res => res.json())
                .then(data => {
                    const badge = document.getElementById("notificationBadge");
                    const dd = document.getElementById("notificationDropdown");

                    // 1) Update badge with unread_count
                    badge.textContent = data.unread_count;
                    badge.style.display = data.unread_count ?
                        'inline-block' :
                        'none';

                    // 2) Build dropdown list of all notifications
                    dd.innerHTML = '';
                    if (data.notifications.length === 0) {
                        dd.innerHTML = '<li><a class="dropdown-item text-muted" href="#">No notifications</a></li>';
                        return;
                    }

                    data.notifications.forEach(n => {
                        const readClass = n.status === 'unread' ? 'fw-bold' : '';
                        const li = document.createElement('li');
                        li.innerHTML = `
          <a class="dropdown-item ${readClass}"
             href="#"
             onclick="handleNotificationClick(${n.id}, ${n.addcart_id})">
            ${n.message}
          </a>`;
                        dd.appendChild(li);
                    });

                    // 3) “See more” if we hit the 10‑item limit
                    if (data.notifications.length > 10 && !all) {
                        const more = document.createElement('li');
                        more.innerHTML = `
          <a class="dropdown-item text-primary fw-bold"
             href="#"
             onclick="loadNotifications(true)">
            See more
          </a>`;
                        dd.appendChild(more);
                    }
                });
        }

        // Example of your existing click‑handler
        function handleNotificationClick(notifId, orderId) {
            fetch('mark_notification_read.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        id: notifId
                    })
                })
                .then(r => r.json())
                .then(resp => {
                    if (resp.success) {
                        document.getElementById("searchInput").value = orderId;
                        searchTable();
                        loadNotifications(); // refresh both badge & list
                    } else {
                        alert("Failed to mark as read");
                    }
                });
        }

        document.addEventListener("DOMContentLoaded", () => loadNotifications());
    </script>


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