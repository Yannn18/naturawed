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


    /**
     * Mengambil daftar pesanan (bookings) khusus untuk vendor tertentu
     */
    public function getRecentOrdersForVendor($vendorId, $limit = 5) {
        $vendorId = mysqli_real_escape_string($this->conn, $vendorId);
        $limit = intval($limit);

        // JOIN tabel bookings, packages, dan customer_profiles
        // Biar kita dapet nama paket dan nama customernya sekalian
        $query = "SELECT b.id, b.status, b.total_price as amount, 
                         p.package_name as package, 
                         cp.full_name as client
                  FROM bookings b
                  JOIN packages p ON b.package_id = p.id
                  JOIN customer_profiles cp ON b.customer_id = cp.id
                  WHERE p.vendor_id = '$vendorId'
                  ORDER BY b.created_at DESC
                  LIMIT $limit";
                  
        $result = mysqli_query($this->conn, $query);
        $orders = [];
        
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Formatting harga ke Rupiah
                $row['amount'] = "Rp " . number_format($row['amount'], 0, ',', '.');
                
                // Menentukan warna badge berdasarkan status
                switch (strtolower($row['status'])) {
                    case 'confirmed':
                        $row['statusColor'] = 'bg-[#e1f5e1] text-[#2d3e2d]'; // Hijau
                        break;
                    case 'pending':
                        $row['statusColor'] = 'bg-[#fff4e5] text-[#b7791f]'; // Kuning
                        break;
                    case 'completed':
                        $row['statusColor'] = 'bg-[#e3f2fd] text-[#1976d2]'; // Biru
                        break;
                    case 'cancelled':
                        $row['statusColor'] = 'bg-[#ffebee] text-[#c62828]'; // Merah
                        break;
                    default:
                        $row['statusColor'] = 'bg-gray-100 text-gray-600'; // Default
                }
                
                $orders[] = $row;
            }
        }
        return $orders;
    }

    /**
     * Mengambil ID Profil Vendor berdasarkan ID User di Session
     */
    public function getVendorProfileId($userId) {
        $userId = mysqli_real_escape_string($this->conn, $userId);
        $query = "SELECT id FROM vendor_profiles WHERE user_id = '$userId' LIMIT 1";
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        return $row ? $row['id'] : null;
    }

    /**
     * Menghitung total semua pesanan (all time) untuk vendor tertentu
     */
    public function getTotalOrdersForVendor($vendorId) {
        $vendorId = mysqli_real_escape_string($this->conn, $vendorId);
        
        // Ngitung jumlah baris (COUNT) dari tabel bookings khusus buat vendor ini
        $query = "SELECT COUNT(b.id) as total 
                  FROM bookings b
                  JOIN packages p ON b.package_id = p.id
                  WHERE p.vendor_id = '$vendorId'";
                  
        $result = mysqli_query($this->conn, $query);
        $row = mysqli_fetch_assoc($result);
        
        return $row ? (int)$row['total'] : 0;
    }
    
}