<?php
// Letakkan file ini di folder: controllers/AuthController.php

class AuthController {
    
    private $conn;

    public function __construct() {
        // Asumsi struktur folder Anda: controllers sejajar dengan config
        require_once __DIR__ . '/../config/koneksi.php';
        global $conn; // Mengambil variabel $conn dari file koneksi.php
        $this->conn = $conn;
    }

    // 1. FUNGSI SIGN IN (Menggantikan signin.php)
    public function login() {
        header('Content-Type: application/json; charset=utf-8');
        if (session_status() === PHP_SESSION_NONE) session_start();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(["status" => "error", "message" => "Request method not allowed."]);
            return;
        }

        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $pass = isset($_POST['password']) ? trim($_POST['password']) : '';
        $remember = isset($_POST['remember']) ? $_POST['remember'] : 'false';

        if ($email === '' || $pass === '') {
            echo json_encode(["status" => "error", "message" => "Email dan password harus diisi."]);
            return;
        }

        $emailEscaped = mysqli_real_escape_string($this->conn, $email);
        $passEscaped = mysqli_real_escape_string($this->conn, $pass);
        
        $query = "SELECT * FROM users WHERE email='$emailEscaped' AND password='$passEscaped'";
        $result = mysqli_query($this->conn, $query);

        if ($result === false) {
            echo json_encode(["status" => "error", "message" => "Database error: " . mysqli_error($this->conn)]);
            return;
        }

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['login'] = true;
            $_SESSION['user'] = $row['usn'];

            if ($remember === 'true') {
                setcookie('user_email', $row['usn'], time() + 86400, "/");
            }
            echo json_encode(["status" => "success", "username" => $row['usn']]);
        } else {
            echo json_encode(["status" => "error", "message" => "Email atau Password salah!"]);
        }
    }

    // 2. FUNGSI SIGN UP (Menggantikan signup.php)
    public function register() {
        header('Content-Type: application/json; charset=utf-8');
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (!isset($_POST['email'])) {
            echo json_encode(["status" => "error", "message" => "Data tidak diterima oleh server."]);
            return;
        }

        $email = mysqli_real_escape_string($this->conn, $_POST['email']);
        $usn = mysqli_real_escape_string($this->conn, $_POST['username']);
        $pass = mysqli_real_escape_string($this->conn, $_POST['password']);

        $query = "INSERT INTO users (email, usn, password) VALUES ('$email', '$usn', '$pass')";

        if (mysqli_query($this->conn, $query)) {
            $_SESSION['login'] = true;
            $_SESSION['user'] = $usn;
            setcookie('user_email', $usn, time() + 86400, "/");
            
            echo json_encode(["status" => "success", "username" => $usn]);
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal simpan ke database: " . mysqli_error($this->conn)]);
        }
    }

    // 3. FUNGSI LOGOUT (Menggantikan logout.php)
    public function logout() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        $_SESSION = [];
        session_unset();
        session_destroy();

        if (isset($_COOKIE['user_email'])) {
            setcookie('user_email', '', time() - 3600, '/');
        }

        // Redirect ke tampilan signin (karena ini bukan JSON respon)
        header("Location: /views/auth/signin.html"); 
        exit;
    }
}