<?php
session_start();
include("api/conn.php");

// Redirect if not logged in or not an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login_page.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$update_success = false;

// Handle update
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $profile_image = '';

    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['profile_image']['type'], $allowed_types)) {
            $target_dir = "img/";
            $profile_image = basename($_FILES["profile_image"]["name"]);
            $target_file = $target_dir . $profile_image;
            move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file);

            $stmt = $conn->prepare("UPDATE users SET name=?, email=?, profile_image=? WHERE id=?");
            $stmt->bind_param("sssi", $name, $email, $profile_image, $id);
        } else {
            // Invalid file type - do not upload
            $stmt = $conn->prepare("UPDATE users SET name=?, email=? WHERE id=?");
            $stmt->bind_param("ssi", $name, $email, $id);
        }
    } else {
        $stmt = $conn->prepare("UPDATE users SET name=?, email=? WHERE id=?");
        $stmt->bind_param("ssi", $name, $email, $id);
    }

    $stmt->execute();
    $stmt->close();
    $update_success = true;
}

// Dashboard Stats
$total_users = $conn->query("SELECT COUNT(*) FROM users")->fetch_row()[0];
$total_orders = $conn->query("SELECT COUNT(*) FROM billing_orders")->fetch_row()[0];
$total_products = $conn->query("SELECT COUNT(*) FROM products")->fetch_row()[0];

// Fetch current user info
$query = "SELECT name, email, profile_image FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$stmt->bind_result($name, $email, $profile_image);
$stmt->fetch();
$stmt->close();

$image_src = $profile_image ? 'img/' . $profile_image : 'https://via.placeholder.com/150';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users</title>

    <!-- Bootstrap and SweetAlert -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
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
            width: 240px;
            z-index: 600;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
<header>
    <?php include 'admin_slidebar.php' ?>
    <?php include 'admin_navbar.php' ?>
</header>

<main style="margin-top: 58px;">
<div class="container py-4">

    <!-- User Table -->
    <div class="card">
        <div class="card-header">Users</div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Profile Image</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $users = $conn->query("SELECT id, name, email, profile_image FROM users");
                while ($row = $users->fetch_assoc()):
                    $img = $row['profile_image'] ? "img/" . $row['profile_image'] : "https://via.placeholder.com/50";
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><img src="<?= $img ?>" height="40" class="rounded-circle"></td>
                        <td>
                            <button class="btn btn-warning btn-sm editBtn"
                                    data-id="<?= $row['id'] ?>"
                                    data-name="<?= htmlspecialchars($row['name']) ?>"
                                    data-email="<?= htmlspecialchars($row['email']) ?>"
                                    data-profile="<?= $img ?>">Edit</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</main>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <form class="modal-content" method="POST" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title">Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" id="modal_id">
        <div class="mb-3">
          <label>Name</label>
          <input type="text" class="form-control" name="name" id="modal_name" required>
        </div>
        <div class="mb-3">
          <label>Email</label>
          <input type="email" class="form-control" name="email" id="modal_email" required>
        </div>
        <div class="mb-3">
          <label>Current Image</label><br>
          <img src="" id="modal_profile_img" height="70" class="rounded-circle mb-2"><br>
          <label>Change Image</label>
          <input type="file" class="form-control" name="profile_image">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </form>
  </div>
</div>

<?php include 'footer.php'; ?>

<script>
    $(document).ready(function () {
        $('.editBtn').click(function () {
            $('#modal_id').val($(this).data('id'));
            $('#modal_name').val($(this).data('name'));
            $('#modal_email').val($(this).data('email'));
            $('#modal_profile_img').attr('src', $(this).data('profile'));
            $('#editModal').modal('show');
        });

        <?php if ($update_success): ?>
        Swal.fire({
            icon: 'success',
            title: 'User Updated',
            text: 'The user information has been updated successfully!',
            confirmButtonColor: '#3085d6'
        });
        <?php endif; ?>
    });
</script>

</body>
</html>
