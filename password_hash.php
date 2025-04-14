<?php
$originalPassword = '';
$hashedPassword = '';

if (isset($_GET['pass']) && !empty($_GET['pass'])) {
    $originalPassword = htmlspecialchars($_GET['pass']);
    $hashedPassword = password_hash($_GET['pass'], PASSWORD_DEFAULT);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Hasher</title>
</head>

<body>
    <h2>Password Hasher</h2>

    <form action="" method="get">
        <label for="pass">Enter password:</label>
        <input type="text" name="pass" id="pass" required>
        <input type="submit" value="Hash">
    </form>

    <?php if ($originalPassword && $hashedPassword): ?>
        <p><strong>Original:</strong> <?= $originalPassword ?></p>
        <p><strong>Hashed:</strong> <?= $hashedPassword ?></p>
    <?php elseif (isset($_GET['pass'])): ?>
        <p style="color:red;">Please enter a password to hash.</p>
    <?php endif; ?>
</body>

</html>