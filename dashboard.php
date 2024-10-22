<?php
require 'functions.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$quotes = getQuotes();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<div class="container">
    <h2>Welcome, <?= $_SESSION['username'] ?>!</h2>
    <a href="add_quote.php">Add Quote</a>
    <a href="logout.php" onclick="return confirm('Anda yakin ingin logout?');">Logout</a>

    <h3>Your Quotes:</h3>
    <ul>
        <?php foreach ($quotes as $quote) : ?>
            <li>
                <?php if ($quote['image']): ?>
                    <img src="uploads/<?= $quote['image'] ?>" alt="Image" class="round-image">
                <?php endif; ?>
                <div class="quote-content">
                    <?= htmlspecialchars($quote['quote']) ?> - <strong><?= htmlspecialchars($quote['username']) ?></strong>
                </div>
                <div class="actions">
                    <a href="edit_quote.php?id=<?= $quote['id'] ?>" class="btn">Edit</a>
                    <a href="delete_quote.php?id=<?= $quote['id'] ?>" class="btn" onclick="return confirm('Anda yakin ingin menghapus quote ini?');">Hapus</a>
                    </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

</body>
</html>

