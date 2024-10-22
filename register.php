<?php
require 'functions.php';
session_start();

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    
    if (!empty($username)) {
        // Cek apakah username sudah ada
        $pdo = connectDB();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        if ($stmt->rowCount() > 0) {
            $error = "Username sudah digunakan.";
        } else {
            // Tambahkan user
            registerUser($username);
            $_SESSION['user_id'] = $pdo->lastInsertId();
            $_SESSION['username'] = $username;
            header('Location: login.php');
            exit();
        }
    } else {
        $error = "Username tidak boleh kosong.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/css/style.css">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <?php if (isset($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <input type="text" name="username" placeholder="Username" autocomplete="off" autofocus required>
            <button type="submit" name="register" autocomplete="off" autofocus>Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
