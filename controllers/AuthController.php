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

    // ... (fungsi register tetap sama)

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