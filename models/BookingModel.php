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