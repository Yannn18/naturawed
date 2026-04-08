<?php

session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

require_once __DIR__ . '/../config/koneksi.php';
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/PackageController.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'home';

// Logic Auth sederhana (Pengganti isAuthenticated)
$isAuthenticated = isset($_SESSION['user_id']);

// Logic Modal (Pengganti showAuthModal)
$showAuthModal = isset($_GET['auth']) && $_GET['auth'] === 'show';

$authController = new AuthController();

switch ($action) {
    case 'show_login':
        
        require_once __DIR__ . '/../views/auth/signin.html';
        break;

    case 'show_register':
        require_once __DIR__ . '/../views/auth/signup.html';
        break;

    case 'show_registervendor':
        require_once __DIR__ . '/../views/auth/signupvendor.html';
        break;

    case 'dashboard_vendor':
        require_once __DIR__ . '/../views/vendor/dashboard-vendor.php';
        break;

    case 'home':
        require_once __DIR__ . '/../views/public/home.php';
        break;
        
    case 'vendors':
        require_once __DIR__ . '/../views/public/vendors.php';
        break;

    case 'inspiration':
        require_once __DIR__ . '/../views/public/inspiration.php';
        break;
        
    case 'package_detail':
        require_once __DIR__ . '/../views/public/package_detail.php';
        break;

        case 'vendor_packages':
        if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'vendor') {
            header("Location: /index.php?action=home"); exit;
        }
        require_once __DIR__ . '/../views/vendor/packages.php';
        break;
   case 'vendor_add_package':
        if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'vendor') {
            header("Location: /index.php?action=home"); exit;
        }
        require_once __DIR__ . '/../views/vendor/package_add.php';
        break;

    case 'portfolio':
        require_once __DIR__ . '/../views/vendor/portfolio.php';
        break;

    case 'profile_edit':
        require_once __DIR__ . '/../views/vendor/profile_edit.php';
        break;

    case 'checkout':
        require_once __DIR__ . '/../views/customer/checkout.php';
        break;

    case 'payment':
        require_once __DIR__ . '/../views/customer/payment.php';
        break;
        
    case 'history':
        require_once __DIR__ . '/../views/customer/history.php';
        break;
        
    case 'dashboard-vendor':
        require_once __DIR__ . '/../views/vendor/dashboard-vendor.php';
        break;
    case 'login':
        $authController->login();
        break;
    case 'register':
        $authController->registerCustomer();
        break;

    case 'logout':
        $authController->logout();
        break;

    case 'register_vendor':
        $authController->registerVendor();
        break;
        case 'store_package':
        $packageCtrl = new PackageController();
        $packageCtrl->store();
        break;

    default:
        header('Content-Type: application/json; charset=utf-8');
        http_response_code(404);
        echo json_encode(["status" => "error", "message" => "Endpoint tidak valid."]);
        break;
}

