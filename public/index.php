<?php
// Posisi file ini sekarang di: public/index.php
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

require_once __DIR__ . '/../config/koneksi.php';
require_once __DIR__ . '/../controllers/AuthController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'home';

// Logic Auth sederhana (Pengganti isAuthenticated)
$isAuthenticated = isset($_SESSION['user_id']);

// Logic Modal (Pengganti showAuthModal)
$showAuthModal = isset($_GET['auth']) && $_GET['auth'] === 'show';

$authController = new AuthController();

switch ($action) {
    case 'show_login':
        // Karena index.php ada di public/, kita naik satu level (../) ke folder views
        require_once __DIR__ . '/../views/auth/signin.html';
        break;
    case 'show_register':
        require_once __DIR__ . '/../views/auth/signup.html';
        break;
        
    case 'home':
        require_once __DIR__ . '/../views/home.php';
        break;
        
    case 'vendors':
        require_once __DIR__ . '/../views/vendors.php';
        break;

    case 'inspiration':
        require_once __DIR__ . '/../views/inspiration.php';
        break;
        
    case 'package_detail':
        require_once __DIR__ . '/../views/package_detail.php';
        break;

    case 'checkout':
        require_once __DIR__ . '/../views/checkout.php';
        break;

    case 'payment':
        require_once __DIR__ . '/../views/payment.php';
        break;
    case 'dashboard':
        require_once __DIR__ . '/../views/vendor/dashboard-vendor.php';
        break;
    case 'login':
        $authController->login();
        break;
    case 'register':
        $authController->register();
        break;
    case 'logout':
        $authController->logout();
        break;
    default:
        header('Content-Type: application/json; charset=utf-8');
        http_response_code(404);
        echo json_encode(["status" => "error", "message" => "Endpoint tidak valid."]);
        break;
}

