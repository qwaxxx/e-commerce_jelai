<?php
session_start();
include 'api/conn.php'; // Make sure this connects to your DB

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "Please fill in all fields.";
        exit;
    }

    // Prevent SQL injection
    $stmt = $conn->prepare("SELECT id, email, password, user_type FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify password (assuming password is hashed)
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['user_type'];

            // Redirect based on role
            switch ($user['user_type']) {
                case 'customer':
                    header("Location: customer_dashboard.php");
                    break;
                case 'seller':
                    header("Location: seller_dashboard.php");
                    break;
                case 'admin':
                    header("Location: admin_dashboard.php");
                    break;
                default:
                    echo "Unknown role.";
            }
        } else {
            echo "Invalid password.{$user['email']}";
        }
    } else {
        echo "No user found with that email.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
