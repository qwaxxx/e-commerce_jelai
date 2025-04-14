<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>

  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>

  <!-- Font Awesome (for icons) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <style>
    body {
      overflow-x: hidden;
    }

    .sidebar {
      height: 100vh;
      width: 250px;
      position: fixed;
      top: 0;
      left: 0;
      background-color: #343a40;
      padding-top: 60px;
      transition: all 0.3s;
    }

    .sidebar a {
      padding: 15px 20px;
      display: block;
      color: #fff;
      text-decoration: none;
    }

    .sidebar a:hover {
      background-color: #495057;
    }

    .sidebar.collapsed {
      width: 0;
      padding: 0;
      overflow: hidden;
    }

    .content {
      margin-left: 250px;
      padding: 20px;
      transition: all 0.3s;
    }

    .content.full-width {
      margin-left: 0;
    }

    .navbar-brand {
      font-weight: bold;
    }

    @media (max-width: 768px) {
      .sidebar {
        width: 0;
        padding: 0;
        overflow: hidden;
      }

      .content {
        margin-left: 0;
      }
    }
  </style>
</head>
<body>

  <!-- Top Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
      

      <a class="navbar-brand" href="#">E-commerce</a>
      <button class="btn btn-outline-light me-3" id="toggleSidebar">
        <i class="fas fa-bars"></i>
      </button>

      <div class="dropdown ms-auto">
        <a class="btn btn-dark dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-user-circle me-2"></i> User
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
          <li><a class="dropdown-item" href="#">Profile</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Sidebar -->
  <div class="sidebar bg-dark text-white" id="sidebar">
    <a href="#"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
    <a href="logout.php" class="text-danger"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
  </div>

  <!-- Main Content -->
  <div class="content" id="mainContent">
    <div class="pt-5 mt-4">
      <h2>Welcome to Your Dashboard</h2>
      <p>This is your customer area. Add your widgets, charts, and data here.</p>
    </div>
  </div>

  <!-- Sidebar Toggle Script -->
  <script>
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');

    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('collapsed');
      mainContent.classList.toggle('full-width');
    });
  </script>
</body>
</html>
