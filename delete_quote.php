<?php
include 'db/database.php'; 
include 'functions.php'; 

$id = $_GET['id']; 

if (deleteQuote($id)) {
    header("Location: dashboard.php"); 
} else {
    echo "Gagal menghapus quote. Silakan coba lagi."; 
}
?>
