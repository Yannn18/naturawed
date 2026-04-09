<?php
class BookingModel {
    private $conn;

    public function __construct($db_conn) {
        $this->conn = $db_conn;
    }

    public function getCustomerBookings($userId, $statusTab = 'All') {
        $userId = mysqli_real_escape_string($this->conn, $userId);
        
        // Base Query dengan JOIN
        $sql = "SELECT b.*, p.package_name, p.main_image, p.price as package_price, 
                       pay.status as payment_status, pay.amount as total_paid
                FROM bookings b
                JOIN packages p ON b.package_id = p.id
                LEFT JOIN payments pay ON b.id = pay.booking_id
                WHERE b.customer_id = (SELECT id FROM customer_profiles WHERE user_id = '$userId')";

        // Filter berdasarkan Tab
        if ($statusTab === 'Ongoing') {
            $sql .= " AND (pay.status = 'pending_verification' OR pay.status IS NULL OR pay.status = 'unpaid')";
        } elseif ($statusTab === 'Completed') {
            $sql .= " AND pay.status = 'success'";
        } elseif ($statusTab === 'Canceled') {
            $sql .= " AND b.status = 'canceled'";
        }

        $sql .= " ORDER BY b.created_at DESC";
        
        $result = mysqli_query($this->conn, $sql);
        $bookings = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $bookings[] = $row;
        }
        return $bookings;
    }
}