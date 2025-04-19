<?php
session_start();
include("api/conn.php");

if (isset($_POST['submit'])) {
    $otp = trim($_POST['otp']);

    // Check if OTP matches
    if (isset($_SESSION['otp']) && $otp == $_SESSION['otp']) {

        // Ensure all required session data exists
        if (
            isset($_SESSION['contact'], $_SESSION['name'], $_SESSION['email'],
            $_SESSION['hashed_password'], $_SESSION['user_type'])
        ) {
            $name           = $_SESSION['name'];
            $email          = $_SESSION['email'];
            $hashed_password= $_SESSION['hashed_password'];
            $contact        = $_SESSION['contact'];
            $user_type      = $_SESSION['user_type'];
            $profile_image  = $_SESSION['profile_image'] ?? null;

            // Prepare SQL insert
            $query = "INSERT INTO users (name, email, password, contact, user_type, profile_image, create_on)
                      VALUES (?, ?, ?, ?, ?, ?, NOW())";
            $stmt = $conn->prepare($query);
            if (!$stmt) {
                $_SESSION['error_message'] = "Database error: " . $conn->error;
                header("Location: register_otp_confirm.php");
                exit;
            }

            $stmt->bind_param("ssssss", $name, $email, $hashed_password, $contact, $user_type, $profile_image);

            if ($stmt->execute()) {
                // ✅ Clean up session variables
                unset(
                    $_SESSION['otp'],
                    $_SESSION['name'],
                    $_SESSION['email'],
                    $_SESSION['contact'],
                    $_SESSION['user_type'],
                    $_SESSION['hashed_password'],
                    $_SESSION['profile_image']
                );

                $_SESSION['success_message'] = "🎉 Registration successful! You can now log in.";
                header("Location: login_page.php");
                exit;
            } else {
                $_SESSION['error_message'] = "❌ Registration failed. Please try again.";
                header("Location: register_otp_confirm.php");
                exit;
            }

        } else {
            $_SESSION['error_message'] = "Session expired or missing data. Please register again.";
            header("Location: register.php");
            exit;
        }

    } else {
        $_SESSION['error_message'] = "⚠️ Invalid OTP. Please check your email and try again.";
        header("Location: register_otp_confirm.php");
        exit;
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OTP Confirmation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap + MDB -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/mdb.min.css">
    <link rel="stylesheet" href="css/style.min.css">

    <style>
        body {
            background: #f8f9fa;
        }
        .otp-container {
            margin-top: 100px;
        }
        .otp-input {
            text-align: center;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>

<div class="container otp-container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="text-center mb-4">Verify Your OTP</h5>
                    <?php if (isset($_SESSION['error_message'])): ?>
                        <div class="alert alert-danger mt-3"><?php echo htmlspecialchars($_SESSION['error_message']); unset($_SESSION['error_message']); ?></div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['success_message'])): ?>
                        <div class="alert alert-success mt-3"><?php echo htmlspecialchars($_SESSION['success_message']); unset($_SESSION['success_message']); ?></div>
                    <?php endif; ?>
                    <form method="POST" id="otpForm">
                        <div class="form-group d-flex justify-content-between">
                            <input type="text" id="otp1" maxlength="1" class="form-control mx-1 otp-input" required>
                            <input type="text" id="otp2" maxlength="1" class="form-control mx-1 otp-input" required>
                            <input type="text" id="otp3" maxlength="1" class="form-control mx-1 otp-input" required>
                            <input type="text" id="otp4" maxlength="1" class="form-control mx-1 otp-input" required>
                        </div>
                        <input type="hidden" name="otp" id="combinedOtp">
                        <button type="submit" name="submit" class="btn btn-info btn-block mt-3">Verify OTP</button>
                    </form>
                </div>
            </div>
           
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/mdb.min.js"></script>
<script>
    function moveFocus(current, nextId) {
        if (current.value.length === 1 && document.getElementById(nextId)) {
            document.getElementById(nextId).focus();
        }
    }

    document.querySelectorAll('.otp-input').forEach((input, index, inputs) => {
        input.addEventListener('input', () => {
            if (input.value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        });
    });

    document.getElementById('otpForm').addEventListener('submit', function (e) {
        let otp = '';
        for (let i = 1; i <= 4; i++) {
            otp += document.getElementById('otp' + i).value;
        }
        document.getElementById('combinedOtp').value = otp;
    });
</script>

</body>
</html>
