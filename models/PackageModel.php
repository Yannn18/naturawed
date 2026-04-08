<?php
// File: models/PackageModel.php

class PackageModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // 1. FUNGSI UNTUK CUSTOMER 
    public function getActivePackages($limit = 6) {
        // Kita JOIN 3 tabel agar nama vendor dan kategori langsung terbaca
        $query = "SELECT p.*, vp.business_name, c.name as category_name 
                  FROM packages p 
                  JOIN vendor_profiles vp ON p.vendor_id = vp.id 
                  JOIN categories c ON p.category_id = c.id 
                  WHERE p.status = 'active' 
                  ORDER BY p.created_at DESC 
                  LIMIT $limit";
                  
        $result = mysqli_query($this->conn, $query);
        $packages = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $packages[] = $row;
            }
        }
        return $packages;
    }

    // 2. FUNGSI UNTUK VENDOR DASHBOARD 
    public function getPackagesByVendor($userId) {
        // Cari ID vendor_profile berdasarkan user_id dari session
        $queryVendor = "SELECT id FROM vendor_profiles WHERE user_id = '$userId'";
        $resVendor = mysqli_query($this->conn, $queryVendor);
        $vendorData = mysqli_fetch_assoc($resVendor);
        $vendorProfileId = $vendorData['id'] ?? 0;

        $query = "SELECT * FROM packages WHERE vendor_id = '$vendorProfileId' ORDER BY created_at DESC";
        $result = mysqli_query($this->conn, $query);
        
        $packages = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $packages[] = $row;
            }
        }
        return $packages;
    }
}
?>