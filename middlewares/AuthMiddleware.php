<?php
// File: middlewares/AuthMiddleware.php

class AuthMiddleware {
    
    public static function autoLogin($conn) {
        if (session_status() === PHP_SESSION_NONE) session_start();

            // Jika belum login tapi punya cookie ID dan Key
        if (!isset($_SESSION['login']) && isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
        $id = $_COOKIE['id'];
        $key = $_COOKIE['key'];

        // 1. Ambil data user berdasarkan ID
        // Gunakan prepared statement gaya MySQLi
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id); // "i" artinya integer
        $stmt->execute();
        
        // 2. Ambil hasilnya
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        // 3. Verifikasi Hash
        if ($user && $key === hash('sha256', $user['email'])) {
            $_SESSION['login'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['business_name'] = $user['business_name'] ?? $user['full_name'] ?? 'Vendor Studio';
            $_SESSION['address'] = $user['address'] ?? '';
        }
        $stmt->close();
        }
    }
}
?>