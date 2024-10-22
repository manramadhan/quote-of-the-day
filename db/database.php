<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'quote_db');  // Nama database
define('DB_USER', 'root');      // Nama pengguna MySQL
define('DB_PASS', '');          // Kata sandi MySQL

function connectDB() {
    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}
