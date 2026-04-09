<?php
// File: controllers/VendorController.php
require_once __DIR__ . '/../models/BookingModel.php';

class VendorController {
    private $conn;
    private $bookingModel;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
        $this->bookingModel = new BookingModel($this->conn);
    }

    public function dashboard() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        // 1. Keamanan: Pastikan yang akses adalah Vendor
        if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'vendor') {
            header("Location: /index.php?action=show_login");
            exit;
        }

        // 2. Cari ID Profil Vendor berdasarkan ID User yang login
        $userId = $_SESSION['user_id'];
        $vendorProfileId = $this->bookingModel->getVendorProfileId($userId);

        if (!$vendorProfileId) {
            die("Vendor profile not found. Please complete your profile first.");
        }

        // 3. Tarik data pesanan (bookings) dari database
        $recentOrders = $this->bookingModel->getRecentOrdersForVendor($vendorProfileId);

       // 4. Hitung Statistik: Ambil total semua pesanan asli dari database
        $totalOrders = $this->bookingModel->getTotalOrdersForVendor($vendorProfileId);
        
        // 5. Lempar data ke halaman View
        require_once __DIR__ . '/../views/vendor/dashboard-vendor.php';
    }
}
?>