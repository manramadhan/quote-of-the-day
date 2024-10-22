<?php
require 'functions.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$id = $_GET['id'];
$quote = getQuoteById($id);

if (isset($_POST['update'])) {
    $newQuote = $_POST['quote'];
    $image = $_FILES['image']['name'] ? uploadImage($_FILES['image']) : $quote['image'];
    updateQuote($id, $newQuote, $image);
    header('Location: dashboard.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/css/style.css">
    <title>Edit Quote</title>
</head>
<body>
    <h2>Edit Quote</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        <textarea name="quote" required><?= htmlspecialchars($quote['quote']) ?></textarea>
        <input type="file" name="image">
        <button type="submit" name="update">Update Quote</button>
    </form>
    <a href="dashboard.php" class="back-link">Back to Dashboard</a> <!-- Tambahkan class untuk styling -->  
</body>
</html>
