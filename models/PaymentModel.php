<?php

class PaymentModel {
    private $conn;

    public function __construct($db_conn) {
        $this->conn = $db_conn;
    }

    /**
     * Memperbarui data pembayaran dengan bukti transfer dan status baru
     */
    public function updatePaymentStatus($bookingId, $imagePath, $status) {
        // Sanitasi input
        $bookingId = mysqli_real_escape_string($this->conn, $bookingId);
        $imagePath = mysqli_real_escape_string($this->conn, $imagePath);
        $status    = mysqli_real_escape_string($this->conn, $status);

        // Query untuk mengupdate data yang sudah ada
        // Kolom disesuaikan dengan struktur tabel payments Anda
        $query = "UPDATE payments SET 
                  payment_proof = '$imagePath', 
                  status = '$status', 
                  updated_at = NOW() 
                  WHERE booking_id = '$bookingId'";

        if (mysqli_query($this->conn, $query)) {
            return true;
        } else {
            // Log error jika diperlukan untuk debugging
            error_log("Update Payment Error: " . mysqli_error($this->conn));
            return false;
        }
    }

    /**
     * Mengambil detail pembayaran untuk ditampilkan di halaman instruksi
     */
    public function getPaymentByBookingId($bookingId) {
        $bookingId = mysqli_real_escape_string($this->conn, $bookingId);
        
        $query = "SELECT p.*, pkg.package_name, pkg.price 
                  FROM payments p 
                  JOIN bookings b ON p.booking_id = b.id 
                  JOIN packages pkg ON b.package_id = pkg.id
                  WHERE p.booking_id = '$bookingId' 
                  LIMIT 1";

        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($result);
    }
}