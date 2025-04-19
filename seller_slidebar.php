<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">


<!-- Sidebar -->
<nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">

<div class="position-sticky">
    <div class="list-group list-group-flush mx-3 mt-4">

        <!-- Dashboard -->
      <a href="seller_dashboard.php" class="list-group-item list-group-item-action text-dark py-3 ripple d-flex align-items-center sidebar-link">
        <i class="fas fa-tachometer-alt fa-fw me-3 fs-5"></i><span class="sidebar-text">Dashboard</span>
      </a>

      <!-- Transactions -->
      <a href="seller_transaction.php" class="list-group-item list-group-item-action text-dark  py-3 ripple d-flex align-items-center sidebar-link">
        <i class="fas fa-user-circle fa-fw me-3 fs-5"></i><span class="sidebar-text">Transaction</span>
      </a>

      <!-- Profile -->
      <a href="seller_profile.php" class="list-group-item list-group-item-action  text-dark py-3 ripple d-flex align-items-center sidebar-link">
        <i class="fas fa-user-circle fa-fw me-3 fs-5"></i><span class="sidebar-text">Profile</span>
      </a>

     <!-- Logout -->
    <a href="#" id="logoutBtn" class="list-group-item list-group-item-action text-dark py-3 ripple d-flex align-items-center sidebar-link">
        <i class="fas fa-right-from-bracket fa-fw me-3 fs-5"></i><span class="sidebar-text">Logout</span>
    </a>

    </div>
</div>
</nav>
<!-- Sidebar -->


<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  document.getElementById('logoutBtn').addEventListener('click', function (e) {
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

