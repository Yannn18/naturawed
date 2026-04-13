<?php
// File: controllers/VendorController.php
require_once __DIR__ . '/../models/BookingModel.php';
require_once __DIR__ . '/../models/PackageModel.php'; // Panggil sekalian di atas biar rapi

class VendorController {
    private $conn;
    private $bookingModel;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
        $this->bookingModel = new BookingModel($this->conn);
    }

    // FUNGSI UNTUK HALAMAN DASHBOARD
    public function dashboard() {
        if (session_status() === PHP_SESSION_NONE) session_start();


        if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'vendor') {
            header("Location: /index.php?action=show_login");
            exit;
        }


        $userId = $_SESSION['user_id'];
        $vendorProfileId = $this->bookingModel->getVendorProfileId($userId);

        if (!$vendorProfileId) {
            die("Vendor profile not found. Please complete your profile first.");
        }


        $recentOrders = $this->bookingModel->getRecentOrdersForVendor($vendorProfileId);
        
        $totalOrders = $this->bookingModel->getTotalOrdersForVendor($vendorProfileId);
        
        // Hitung Paket Aktif
        $packageModel = new PackageModel($this->conn);
        $activePackagesCount = $packageModel->getActivePackagesCountByVendor($vendorProfileId);
        
        require_once __DIR__ . '/../views/vendor/dashboard-vendor.php';
    }

    // FUNGSI UNTUK HALAMAN PORTFOLIO (Ini yang bikin garis merah hilang!)
    public function portfolio() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'vendor') {
            header("Location: /index.php?action=show_login");
            exit;
        }

        $userId = $_SESSION['user_id'];
        
        // Tarik data paket vendor yang asli dari database
        $packageModel = new PackageModel($this->conn);
        $myPackages = $packageModel->getPackagesByVendor($userId);

        require_once __DIR__ . '/../views/vendor/portfolio.php';
    }
}
?>