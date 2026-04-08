<?php

class BookingModel {
    private $conn;

    public function __construct($db_conn) {
        $this->conn = $db_conn;
    }

    /**
     * Mengambil ID Profil Customer berdasarkan ID User di Session
     */
    public function getCustomerProfileId($userId) {
        $userId = mysqli_real_escape_string($this->conn, $userId);
        $query = "SELECT id FROM customer_profiles WHERE user_id = '$userId' LIMIT 1";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        return $row ? $row['id'] : null;
    }

    /**
     * Menyimpan data booking baru ke database
     */
    public function createBooking($customerId, $packageId, $date, $location, $notes, $totalPrice) {
        // Sanitasi input untuk keamanan
        $customerId    = mysqli_real_escape_string($this->conn, $customerId);
        $packageId     = mysqli_real_escape_string($this->conn, $packageId);
        $date          = mysqli_real_escape_string($this->conn, $date);
        $location      = mysqli_real_escape_string($this->conn, $location);
        $notes         = mysqli_real_escape_string($this->conn, $notes);
        $totalPrice    = mysqli_real_escape_string($this->conn, $totalPrice);

        $query = "INSERT INTO bookings (customer_id, package_id, event_date, event_location, notes, total_price, status, created_at) 
                  VALUES ('$customerId', '$packageId', '$date', '$location', '$notes', '$totalPrice', 'pending', NOW())";
        
        if (mysqli_query($this->conn, $query)) {
            // Mengembalikan ID Booking yang baru saja dibuat (Primary Key)
            return mysqli_insert_id($this->conn);
        }
        return false;
    }

    /**
     * Otomatis membuat record di tabel payments setelah booking sukses
     */
    public function createInitialPayment($bookingId, $amount) {
        $bookingId = mysqli_real_escape_string($this->conn, $bookingId);
        $amount    = mysqli_real_escape_string($this->conn, $amount);

        // Status awal adalah 'unpaid' sesuai struktur tabel payments Anda
        $query = "INSERT INTO payments (booking_id, amount, status, created_at) 
                  VALUES ('$bookingId', '$amount', 'unpaid', NOW())";
        
        return mysqli_query($this->conn, $query);
    }
}