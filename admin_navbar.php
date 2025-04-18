<!-- Navbar -->
<nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-collapse-init data-mdb-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Brand -->
        <a class="navbar-brand" href="#" style="font-weight: 600; font-size: 1.25rem; color: #333;">
            Flappy
        </a>

        <!-- Right links -->
        <ul class="navbar-nav ms-auto d-flex flex-row">
            <!-- Notification dropdown -->
            <li class="nav-item dropdown">
                <a
                    data-mdb-dropdown-init class="nav-link me-3 me-lg-0 dropdown-toggle "
                    href="#"
                    id="navbarDropdownMenuLink"
                    role="button"
                    data-mdb-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-bell"></i>
                    <span class="badge rounded-pill badge-notification bg-danger">1</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="#">Some news</a></li>
                    <li><a class="dropdown-item" href="#">Another news</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </li>

            <!-- Avatar Dropdown -->
            <li class="nav-item dropdown">
                <a
                    data-mdb-dropdown-init class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center"
                    href="#"
                    id="navbarDropdownMenuLink"
                    role="button"
                    data-mdb-toggle="dropdown"
                    aria-expanded="false">
                    <img
                        src="<?= $image_src ?>"
                        class="rounded-circle"
                        height="32"
                        alt="Avatar"
                        loading="lazy" />
                </a>

                <ul
                    class="dropdown-menu dropdown-menu-end"
                    aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="admin_profile.php">My profile</a></li>
                    <li><a class="dropdown-item" href="#"  href="#" id="logoutBtn1">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- Container wrapper -->
</nav>
<!-- Navbar -->


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  document.getElementById('logoutBtn1').addEventListener('click', function (e) {
    e.preventDefault();
    Swal.fire({
      title: 'Are you sure?',
      text: "You will be logged out!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Yes, logout',
      background: '#ffffff',
      color: '#000000'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = 'logout.php'; // Your actual logout script
      }
    });
  });
</script>
