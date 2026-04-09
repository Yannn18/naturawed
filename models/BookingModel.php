<?php
class BookingModel {
    private $conn;

    public function __construct($db_conn) {
        $this->conn = $db_conn;
    }

    // FUNGSI INI YANG HILANG/BELUM ADA:
    public function getCustomerBookings($userId, $statusTab = 'All') {
        $userId = mysqli_real_escape_string($this->conn, $userId);
        
        // Query untuk mengambil data booking, detail paket, dan status pembayaran
        $sql = "SELECT b.*, b.total_price, p.package_name, p.main_image, 
                   pay.status as payment_status, pay.amount as paid_amount
            FROM bookings b
            JOIN packages p ON b.package_id = p.id
            LEFT JOIN payments pay ON b.id = pay.booking_id
            WHERE b.customer_id = (SELECT id FROM customer_profiles WHERE user_id = '$userId')";

    if ($statusTab === 'Ongoing') {
        $sql .= " AND (pay.status = 'pending_verification' OR pay.status IS NULL OR pay.status = 'unpaid')";
    } elseif ($statusTab === 'Completed') {
        $sql .= " AND pay.status = 'paid'"; // Di database kamu statusnya 'paid' (image_65a5ef.png)
    } elseif ($statusTab === 'Canceled') {
        $sql .= " AND b.status = 'cancelled'"; // Pastikan ejaan 'cancelled' sesuai enum database
    }

    $sql .= " ORDER BY b.created_at DESC";
    
    $result = mysqli_query($this->conn, $sql);
    $bookings = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $bookings[] = $row;
        }
    }
    return $bookings;
    }
}