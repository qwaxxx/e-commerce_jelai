<?php
include 'api/conn.php';


session_start();
$user_id = $_SESSION['user_id'];

// Check if form is submitted
if (isset($_POST['submit'])) {
    $name = $_POST['prod_name'];
    $price = $_POST['prod_price'];
    $stock = $_POST['prod_stock'];
    $description = $_POST['prod_description'];

    // Handle image upload
    $image_name = $_FILES['prod_picture']['name'];
    $image_tmp = $_FILES['prod_picture']['tmp_name'];
    $target_dir = "uploads/"; // make sure this folder exists
    $target_file = $target_dir . basename($image_name);

    if (move_uploaded_file($image_tmp, $target_file)) {
        // Save to database
        $sql = "INSERT INTO products (prod_name, prod_stock, prod_description, prod_price, prod_picture, user_id) 
                VALUES ('$name', '$stock', '$description', '$price', '$target_file', '$user_id ')";

        if ($conn->query($sql) === TRUE) {
            header("Location: seller_dashboard.php");
            exit;
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Image upload failed.";
    }
}

$conn->close();
