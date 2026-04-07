<?php
// controllers/AuthController.php

class AuthController {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function login() {
        header('Content-Type: application/json; charset=utf-8');
        if (session_status() === PHP_SESSION_NONE) session_start();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(["status" => "error", "message" => "Method not allowed."]);
            return;
        }

        $email = mysqli_real_escape_string($this->conn, trim($_POST['email'] ?? ''));
        $pass = trim($_POST['password'] ?? '');

        $query = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($this->conn, $query);

        if ($result && mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            
            // Gunakan password_verify jika Anda menggunakan password_hash saat register
            // Jika masih plain text, gunakan: if ($pass === $row['password'])
            if ($pass === $row['password']) {
                $_SESSION['login'] = true;
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['user_email'] = $row['email'];

                echo json_encode(["status" => "success", "username" => $row['email'], "role" => $row['role']]);
            } else {
                echo json_encode(["status" => "error", "message" => "Password salah!"]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Email tidak terdaftar!"]);
        }
    }

    public function registerVendor() {
        header('Content-Type: application/json; charset=utf-8');
        
        // Pastikan session aktif untuk keamanan
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        $email    = mysqli_real_escape_string($this->conn, $_POST['email'] ?? '');
        $username = mysqli_real_escape_string($this->conn, $_POST['username'] ?? '');
        $password = mysqli_real_escape_string($this->conn, $_POST['password'] ?? '');
        $address  = mysqli_real_escape_string($this->conn, $_POST['address'] ?? '');
        $role     = 'vendor';

        if(empty($email) || empty($password)) {
            echo json_encode(["status" => "error", "message" => "Email dan Password wajib diisi."]);
            return;
        }

        mysqli_begin_transaction($this->conn);
        try {
            // 1. Insert ke tabel users
            $queryUser = "INSERT INTO users (email, password, role) VALUES ('$email', '$password', '$role')";
            if (!mysqli_query($this->conn, $queryUser)) {
                throw new Exception("Gagal simpan akun (Users): " . mysqli_error($this->conn));
            }

            $userId = mysqli_insert_id($this->conn);

            // 2. Insert ke tabel vendor_profiles
            // PASTIKAN nama tabel dan kolom 'address' sesuai dengan di phpMyAdmin
            $queryProfile = "INSERT INTO vendor_profiles (user_id, business_name, address) 
                             VALUES ('$userId', '$username', '$address')";
            
            if (!mysqli_query($this->conn, $queryProfile)) {
                throw new Exception("Gagal simpan profil vendor: " . mysqli_error($this->conn));
            }

            mysqli_commit($this->conn);
            echo json_encode(["status" => "success", "username" => $username]);
            exit;
        } catch (Exception $e) {
            mysqli_rollback($this->conn);
            // Memberikan pesan error spesifik dari database
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public function registerCustomer() {
        header('Content-Type: application/json; charset=utf-8');
        
        $email    = mysqli_real_escape_string($this->conn, $_POST['email'] ?? '');
        $username = mysqli_real_escape_string($this->conn, $_POST['username'] ?? '');
        $password = mysqli_real_escape_string($this->conn, $_POST['password'] ?? '');
        $role     = 'customer';

        mysqli_begin_transaction($this->conn);
        try {
            // Insert ke tabel users
            $queryUser = "INSERT INTO users (email, password, role) VALUES ('$email', '$password', '$role')";
            if (!mysqli_query($this->conn, $queryUser)) throw new Exception(mysqli_error($this->conn));

            $userId = mysqli_insert_id($this->conn);

            // Insert ke tabel customer_profiles (TIDAK ada kolom address)
            $queryProfile = "INSERT INTO customer_profiles (user_id, full_name) 
                             VALUES ('$userId', '$username')";
            
            if (!mysqli_query($this->conn, $queryProfile)) throw new Exception(mysqli_error($this->conn));

            mysqli_commit($this->conn);
            echo json_encode(["status" => "success", "username" => $username]);
        } catch (Exception $e) {
            mysqli_rollback($this->conn);
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        session_unset();
        session_destroy();
        header("Location: index.php?action=show_login");
        exit;
    }
}