<?php
// File: models/PackageModel.php

class PackageModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

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



    // 1. MENCARI ID PROFIL VENDOR BERDASARKAN ID LOGIN (users.id)
    public function getVendorProfileId($userId) {
        $userIdEscaped = mysqli_real_escape_string($this->conn, $userId);
        $query = "SELECT id FROM vendor_profiles WHERE user_id = '$userIdEscaped'";
        $result = mysqli_query($this->conn, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row['id'];
        }
        return null;
    }

    // 2. MENYIMPAN PAKET BARU
    public function createPackage($vendor_profile_id, $category_id, $name, $price, $description, $features, $imagePath) {
        $nameEscaped = mysqli_real_escape_string($this->conn, trim($name));
        $descEscaped = mysqli_real_escape_string($this->conn, trim($description));
        $featEscaped = mysqli_real_escape_string($this->conn, trim($features));
        $imagePathEscaped = mysqli_real_escape_string($this->conn, $imagePath);
        
        // Memastikan tipe data benar
        $price = floatval($price);
        $category_id = intval($category_id);

        $query = "INSERT INTO packages (vendor_id, category_id, package_name, price, description, features, main_image, status) 
                  VALUES ('$vendor_profile_id', '$category_id', '$nameEscaped', '$price', '$descEscaped', '$featEscaped', '$imagePathEscaped', 'active')";
        
        return mysqli_query($this->conn, $query);
    }
}
?>