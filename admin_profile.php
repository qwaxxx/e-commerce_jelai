<?php
session_start();
include("api/conn.php");

// Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: login_page.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Handle form submission
if (isset($_POST['update'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $imageFileName = null;

    // Handle image upload
    if (!empty($_FILES['profile_image']['tmp_name'])) {
        $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is a valid image
        $check = getimagesize($_FILES["profile_image"]["tmp_name"]);
        if ($check !== false) {
            // Move uploaded file to the img directory
            if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
                $imageFileName = basename($_FILES["profile_image"]["name"]);
            } else {
                $_SESSION['error_message'] = "Sorry, there was an error uploading your file.";
            }
        } else {
            $_SESSION['error_message'] = "File is not an image.";
        }
    }

    // Update the user info in the database
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        if ($imageFileName) {
            $query = "UPDATE users SET name = ?, email = ?, password = ?, profile_image = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssssi", $name, $email, $hashed_password, $imageFileName, $user_id);
        } else {
            $query = "UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssi", $name, $email, $hashed_password, $user_id);
        }
    } else {
        if ($imageFileName) {
            $query = "UPDATE users SET name = ?, email = ?, profile_image = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssi", $name, $email, $imageFileName, $user_id);
        } else {
            $query = "UPDATE users SET name = ?, email = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssi", $name, $email, $user_id);
        }
    }

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Profile updated successfully!";
    } else {
        $_SESSION['error_message'] = "Error updating profile.";
    }

    $stmt->close();
    header("Location: customer_profile.php");
    exit;
}

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
    <title>Profile</title>
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

        <?php include 'admin_slidebar.php'?>

        <?php include 'admin_navbar.php'?>

    </header>

    <!--Main layout-->
    <main style="margin-top: 58px;">
    <div class="container pt-4">
    <h3 class="mb-4">Profile</h3>

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <img src="<?= $image_src ?>" alt="Profile" class="rounded-circle mb-3" width="120" height="120">
            <input type="file" name="profile_image" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required value="<?= htmlspecialchars($name) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" required value="<?= htmlspecialchars($email) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">New Password <small class="text-muted">(Leave blank to keep current)</small></label>
            <input type="password" name="password" class="form-control">
        </div>

        <button type="submit" name="update" class="btn btn-primary">Update Profile</button>
    </form>
</div>

<!-- SweetAlert feedback -->
<?php if (isset($_SESSION['success_message'])): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Success',
    text: '<?= $_SESSION['success_message'] ?>',
    timer: 2000,
    showConfirmButton: false
});
</script>
<?php unset($_SESSION['success_message']); endif; ?>

<?php if (isset($_SESSION['error_message'])): ?>
<script>
Swal.fire({
    icon: 'error',
    title: 'Error',
    text: '<?= $_SESSION['error_message'] ?>',
    timer: 2000,
    showConfirmButton: false
});
</script>
<?php unset($_SESSION['error_message']); endif; ?>
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