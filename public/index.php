<?php
// Di public/index.php
if (session_status() === PHP_SESSION_NONE) session_start();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

require_once __DIR__ . '/../config/koneksi.php';
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/PackageController.php';
require_once __DIR__ . '/../controllers/PaymentController.php';
require_once __DIR__ . '/../controllers/BookingController.php';
require_once __DIR__ . '/../controllers/ArticleController.php';
require_once __DIR__ . '/../controllers/VendorController.php';

// 3. LOGIKA COOKIE LOGIN (Hanya bisa jalan jika $conn sudah ada)
if (!isset($_SESSION['login']) && isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // Sekarang $conn sudah tidak null karena sudah di-require di atas
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id' LIMIT 1");
    $row = mysqli_fetch_assoc($result);

    if ($row && $key === hash('sha256', $row['email'])) {
        $_SESSION['login'] = true;
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['user_email'] = $row['email'];
        // Jika ada kolom nama, masukkan juga
        $_SESSION['user_name'] = $row['full_name'] ?? $row['business_name'] ?? '';
    }
}

$action = isset($_GET['action']) ? $_GET['action'] : 'home';

// Logic Auth sederhana (Pengganti isAuthenticated)
$isAuthenticated = isset($_SESSION['user_id']);

// Logic Modal (Pengganti showAuthModal)
$showAuthModal = isset($_GET['auth']) && $_GET['auth'] === 'show';

$authController = new AuthController();
$paymentController = new PaymentController();
$bookingController = new BookingController();

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
    case 'show_registerjournalist':
        require_once __DIR__ . '/../views/auth/signupjournalist.php';
        break;

    case 'dashboard-vendor':
        $vendorController = new VendorController();
        $vendorController->dashboard();
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
        $packageController = new PackageController();
        $packageController->show();
        break;

    case 'checkout':
        $packageController = new PackageController();
        $packageController->checkout();
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

    case 'payment':
        require_once __DIR__ . '/../views/customer/payment.php';
        break;
        
    case 'history':
        require_once __DIR__ . '/../views/customer/history.php';
        break;
        
    case 'dashboard-vendor':
        require_once __DIR__ . '/../views/vendor/dashboard-vendor.php';
        break;
    case 'write_article':
        require_once __DIR__ . '/../views/journalist/write_article.php';
        break;
    case 'journalist_dashboard':
        if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'journalist') {
            header("Location: /index.php?action=home"); exit;
        }
       $articleCtrl = new ArticleController();
        $articleCtrl->dashboard();
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

        case 'register_journalist':
        $authCtrl = new AuthController();
        $authCtrl->registerJournalist();
        break;
        case 'store_package':
        $packageCtrl = new PackageController();
        $packageCtrl->store();
        break;

    case 'process_booking':
        $bookingController->store();
        break;
    
    case 'payment-instruction':
        $paymentController->showPayment();
        break;

    case 'submit_payment':
        $paymentController->store();
        break;

    case 'store_article':
        $articleCtrl = new ArticleController();
        $articleCtrl->store();
        break;

    default:
        header('Content-Type: application/json; charset=utf-8');
        http_response_code(404);
        echo json_encode(["status" => "error", "message" => "Endpoint tidak valid."]);
        break;
}

