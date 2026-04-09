<?php
class BookingModel {
    private $conn;

    public function __construct($db_conn) {
        $this->conn = $db_conn;
    }

    // 1. FUNGSI UNTUK MENDAPATKAN ID PROFILE CUSTOMER (Yang dicari error tadi)
    public function getCustomerProfileId($userId) {
        $userId = mysqli_real_escape_string($this->conn, $userId);
        $query = "SELECT id FROM customer_profiles WHERE user_id = '$userId' LIMIT 1";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        return $row ? $row['id'] : null;
    }

    // 2. FUNGSI UNTUK MEMBUAT DATA BOOKING BARU
    public function createBooking($customerId, $packageId, $eventDate, $eventLocation, $notes, $totalPrice) {
        $customerId = mysqli_real_escape_string($this->conn, $customerId);
        $packageId = mysqli_real_escape_string($this->conn, $packageId);
        $eventDate = mysqli_real_escape_string($this->conn, $eventDate);
        $eventLocation = mysqli_real_escape_string($this->conn, $eventLocation);
        $notes = mysqli_real_escape_string($this->conn, $notes);
        $totalPrice = mysqli_real_escape_string($this->conn, $totalPrice);

        $query = "INSERT INTO bookings (customer_id, package_id, event_date, event_location, notes, total_price, status, created_at) 
                  VALUES ('$customerId', '$packageId', '$eventDate', '$eventLocation', '$notes', '$totalPrice', 'pending', NOW())";

        if (mysqli_query($this->conn, $query)) {
            return mysqli_insert_id($this->conn); // Mengembalikan ID booking yang baru saja dibuat
        }
        return false;
    }

    // 3. FUNGSI UNTUK MEMBUAT ANTRIAN PEMBAYARAN AWAL
    public function createInitialPayment($bookingId, $amount) {
        $bookingId = mysqli_real_escape_string($this->conn, $bookingId);
        $amount = mysqli_real_escape_string($this->conn, $amount);

        // Status awal 'unpaid' agar muncul merah di history
        $query = "INSERT INTO payments (booking_id, amount, status, created_at) 
                  VALUES ('$bookingId', '$amount', 'unpaid', NOW())";
        
        return mysqli_query($this->conn, $query);
    }

    // 4. FUNGSI HISTORY (Yang sudah kita bahas sebelumnya)
    public function getCustomerBookings($userId, $statusTab = 'All') {
        $userId = mysqli_real_escape_string($this->conn, $userId);
        
        $sql = "SELECT b.*, p.package_name, p.main_image, 
                       pay.status as payment_status, pay.amount as paid_amount
                FROM bookings b
                JOIN packages p ON b.package_id = p.id
                LEFT JOIN payments pay ON b.id = pay.booking_id
                WHERE b.customer_id = (SELECT id FROM customer_profiles WHERE user_id = '$userId')";

        if ($statusTab === 'Ongoing') {
            $sql .= " AND (pay.status = 'pending_verification' OR pay.status IS NULL OR pay.status = 'unpaid')";
        } elseif ($statusTab === 'Completed') {
            $sql .= " AND pay.status = 'paid'";
        } elseif ($statusTab === 'Canceled') {
            $sql .= " AND b.status = 'cancelled'";
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