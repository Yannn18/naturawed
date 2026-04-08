<?php
// File: controllers/AuthController.php

// Panggil Model di bagian atas
require_once __DIR__ . '/../models/UserModel.php';

class AuthController {
    private $conn;
    private $userModel;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
        // Inisialisasi Model saat Controller dipanggil
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

        // Minta Model untuk mencari User
        $userData = $this->userModel->getUserByEmail($email);

        if ($userData) {
            // Cek Password (Ubah ke password_verify jika nanti pakai Hash)
            if ($pass === $userData['password']) {
                $_SESSION['login'] = true;
                $_SESSION['user_id'] = $userData['id'];
                $_SESSION['role'] = $userData['role'];
                $_SESSION['user_email'] = $userData['email'];
                
        
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
        session_unset();
        session_destroy();
        header("Location: index.php?action=show_login");
        exit;
    }
}
?>