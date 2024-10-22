<?php
require_once '/db/database.php';

// Fungsi untuk register user
function registerUser($username) {
    $pdo = connectDB();
    $sql = "INSERT INTO users (username) VALUES (:username)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['username' => $username]);
}

// Fungsi login user
function loginUser($username) {
    $pdo = connectDB();
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['username' => $username]);
    return $stmt->fetch();
}

// Fungsi untuk menambah quote baru
function addQuote($quote, $user_id, $image) {
    $pdo = connectDB();
    $sql = "INSERT INTO quotes (quote, image, user_id) VALUES (:quote, :image, :user_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['quote' => $quote, 'image' => $image, 'user_id' => $user_id]);
}

// Fungsi untuk mengambil semua quote
function getQuotes() {
    $pdo = connectDB();
    $sql = "SELECT quotes.*, users.username FROM quotes 
            JOIN users ON quotes.user_id = users.id ORDER BY quotes.created_at DESC";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

// Fungsi untuk mengambil quote berdasarkan ID
function getQuoteById($id) {
    $pdo = connectDB();
    $sql = "SELECT * FROM quotes WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    return $stmt->fetch();
}

// Fungsi untuk mengupdate quote
function updateQuote($id, $quote, $image) {
    $pdo = connectDB();
    $sql = "UPDATE quotes SET quote = :quote, image = :image WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['quote' => $quote, 'image' => $image, 'id' => $id]);
}

// Fungsi untuk menghapus quote
function deleteQuote($id) {
    $pdo = connectDB(); // Menggunakan fungsi connectDB untuk mendapatkan koneksi

    // Siapkan query untuk menghapus quote berdasarkan ID
    $sql = "DELETE FROM quotes WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    
    // Ikat parameter dan eksekusi
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    // Jalankan query dan periksa hasilnya
    if ($stmt->execute()) {
        return true; // Jika berhasil
    } else {
        echo "Error: " . $stmt->errorInfo()[2]; // Menampilkan error jika terjadi masalah
        return false; // Jika gagal
    }
}


// Fungsi untuk upload gambar
function uploadImage($file) {
    $targetDir = "uploads/";
    $fileName = time() . "_" . basename($file["name"]);
    $targetFile = $targetDir . $fileName;

    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        return $fileName;
    }
    return null;
}
?>
