<?php
require_once __DIR__ . '/../models/BookingModel.php';

class BookingController {
    private $conn;
    private $bookingModel;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
        $this->bookingModel = new BookingModel($this->conn);
    }

    public function store() {
        if (session_status() === PHP_SESSION_NONE) session_start();

        // 1. Keamanan: Pastikan yang akses adalah Customer
        if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'customer') {
            die("Unauthorized access. Only customers can book packages.");
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Ambil data dari Form (Sesuai desain gambar Anda)
            $packageId     = $_POST['package_id'] ?? '';
            $eventDate     = $_POST['event_date'] ?? ''; // format: YYYY-MM-DD
            $eventLocation = $_POST['event_location'] ?? '';
            $notes         = $_POST['notes'] ?? '';
            $totalPrice    = $_POST['total_price'] ?? 0;
            $userId        = $_SESSION['user_id'];

            // Ambil Customer Profile ID (Bisa dibuatkan helper atau fungsi di model)
            $customerId = $this->bookingModel->getCustomerProfileId($userId);

            if (!$customerId) {
                die("Customer profile not found. Please complete your profile.");
            }

            // 2. SIMPAN KE DATABASE BOOKINGS
            $bookingId = $this->bookingModel->createBooking(
                $customerId, 
                $packageId, 
                $eventDate, 
                $eventLocation, 
                $notes, 
                $totalPrice
            );

            if ($bookingId) {
                // 3. LOGIKA TAMBAHAN: Otomatis buat entri di tabel Payments
                // Agar di halaman history, statusnya muncul 'Unpaid'
                $this->bookingModel->createInitialPayment($bookingId, $totalPrice);

                // Jika sukses, arahkan ke halaman pembayaran atau history
                header("Location: index.php?action=payment-instruction&booking_id=" . $bookingId);
                exit;
            } else {
                echo "Gagal melakukan booking: " . mysqli_error($this->conn);
            }
        }
    }
}