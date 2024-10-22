<?php
require 'functions.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['add'])) {
    $quote = $_POST['quote'];
    $image = uploadImage($_FILES['image']);  
    addQuote($quote, $_SESSION['user_id'], $image);
    header('Location: dashboard.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/css/style.css">
    <title>Add Quote</title>
</head>
<body>
    <h2>Add New Quote</h2>
    <form method="POST" action="" enctype="multipart/form-data">
        <textarea name="quote" required autofocus></textarea>
        <input type="file" name="image" required> 
        <button type="submit" name="add">Add Quote</button>
    </form>
    <a href="dashboard.php" class="back-link">Back to Dashboard</a> 
</body>
</html>
