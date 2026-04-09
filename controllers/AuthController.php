<?php
// File: controllers/AuthController.php
require_once __DIR__ . '/../models/UserModel.php';

class AuthController {
    private $conn;
    private $userModel;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
        $this->userModel = new UserModel($this->conn);
    }

    public function login() {
        header('Content-Type: application/json; charset=utf-8');
        if (session_status() === PHP_SESSION_NONE) session_start();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(["status" => "error", "message" => "Method not allowed."]);
            return;
        }

        $email = $_POST['email'] ?? '';
        $pass = trim($_POST['password'] ?? '');
        $remember = isset($_POST['remember']); // Cek apakah centang 'Remember Me' aktif

        $userData = $this->userModel->getUserByEmail($email);

        if ($userData) {
            if ($pass === $userData['password']) {
                // 1. SET SESSION
                $_SESSION['login'] = true;
                $_SESSION['user_id'] = $userData['id'];
                $_SESSION['role'] = $userData['role'];
                $_SESSION['user_email'] = $userData['email'];

                // 2. LOGIKA COOKIE (REMEMBER ME)
                if ($remember) {
                    // Simpan ID yang di-hash untuk keamanan sederhana
                    // Berlaku selama 30 hari (3600 * 24 * 30)
                    setcookie('id', $userData['id'], time() + (3600 * 24 * 30), "/");
                    setcookie('key', hash('sha256', $userData['email']), time() + (3600 * 24 * 30), "/");
                }
        
                echo json_encode(["status" => "success", "email" => $userData['email'], "role" => $userData['role']]);
            } else {
                echo json_encode(["status" => "error", "message" => "Password salah!"]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Email tidak terdaftar!"]);
        }
    }

     public function registerVendor() {
        header('Content-Type: application/json; charset=utf-8');
        if (session_status() === PHP_SESSION_NONE) session_start();

        $email    = $_POST['email'] ?? '';
        $username = $_POST['username'] ?? ''; // Ini adalah Business Name
        $password = $_POST['password'] ?? '';
        $address  = $_POST['address'] ?? '';

        if(empty($email) || empty($password)) {
            echo json_encode(["status" => "error", "message" => "Email dan Password wajib diisi."]);
            return;
        }

        try {
            // Delegasikan proses penyimpanan ke Model
            $this->userModel->registerVendor($email, $password, $username, $address);

        
            echo json_encode(["status" => "success", "username" => $username]);
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }
    
    public function registerCustomer() {
        header('Content-Type: application/json; charset=utf-8');

        $email    = $_POST['email'] ?? '';
        $username = $_POST['username'] ?? ''; // Ini adalah Full Name
        $password = $_POST['password'] ?? '';

        if(empty($email) || empty($password)) {
            echo json_encode(["status" => "error", "message" => "Email dan Password wajib diisi."]);
            return;
        }

        try {
            // Delegasikan proses penyimpanan ke Model
            $this->userModel->registerCustomer($email, $password, $username);
            echo json_encode(["status" => "success", "username" => $username]);
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        // Hapus Session
        session_unset();
        session_destroy();

        // Hapus Cookie dengan mengatur waktu expired ke masa lalu
        if (isset($_COOKIE['id'])) {
            setcookie('id', '', time() - 3600, "/");
            setcookie('key', '', time() - 3600, "/");
        }

        header("Location: index.php?action=show_login");
        exit;
    }
}