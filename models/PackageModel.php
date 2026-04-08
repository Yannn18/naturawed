<?php
// File: models/PackageModel.php

class PackageModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // =======================================================
    // 1. UNTUK HOME PAGE (Mengambil Banyak Paket Sekaligus)
    // =======================================================
    public function getActivePackages($limit = 6) {
        $limitInt = intval($limit); // Pastikan limit berupa angka
        
        $query = "SELECT p.*, vp.business_name, c.name as category_name 
                  FROM packages p 
                  LEFT JOIN vendor_profiles vp ON p.vendor_id = vp.id 
                  LEFT JOIN categories c ON p.category_id = c.id 
                  WHERE p.status = 'active' 
                  ORDER BY p.created_at DESC 
                  LIMIT $limitInt";
                  
        $result = mysqli_query($this->conn, $query);
        
        $packages = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $packages[] = $row;
            }
        }
        return $packages; // Mengembalikan Array berisi kumpulan paket
    }

    // =======================================================
    // 2. UNTUK PACKAGE DETAIL PAGE (Mengambil Hanya SATU Paket)
    // =======================================================
    public function getPackageById($id) {
        $idEscaped = intval($id);
        
        // WAJIB LEFT JOIN agar paket tetap tampil meskipun kategorinya kosong
        $query = "SELECT p.*, vp.business_name, c.name as category_name 
                  FROM packages p 
                  LEFT JOIN vendor_profiles vp ON p.vendor_id = vp.id 
                  LEFT JOIN categories c ON p.category_id = c.id 
                  WHERE p.id = '$idEscaped'";
                  
        $result = mysqli_query($this->conn, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result); // Mengembalikan 1 baris data
        }
        return null; // Paket tidak ditemukan
    }

    // =======================================================
    // 3. UNTUK VENDOR DASHBOARD (Melihat Paket Milik Sendiri)
    // =======================================================
    public function getPackagesByVendor($userId) {
        $queryVendor = "SELECT id FROM vendor_profiles WHERE user_id = '$userId'";
        $resVendor = mysqli_query($this->conn, $queryVendor);
        $vendorData = mysqli_fetch_assoc($resVendor);
        $vendorProfileId = $vendorData['id'] ?? 0;

        $query = "SELECT p.*, c.name as category_name 
                  FROM packages p 
                  LEFT JOIN categories c ON p.category_id = c.id 
                  WHERE p.vendor_id = '$vendorProfileId' 
                  ORDER BY p.created_at DESC";
                  
        $result = mysqli_query($this->conn, $query);

        $packages = [];
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $packages[] = $row;
            }
        }
        return $packages;
    }

    // =======================================================
    // 4. BANTUAN UNTUK CONTROLLER (Cari Vendor Profile ID)
    // =======================================================
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

    // =======================================================
    // 5. MENYIMPAN PAKET BARU (Dari Form Tambah Paket)
    // =======================================================
    public function createPackage($vendor_profile_id, $category_id, $name, $price, $description, $features, $imagePath) {
        $nameEscaped = mysqli_real_escape_string($this->conn, trim($name));
        $descEscaped = mysqli_real_escape_string($this->conn, trim($description));
        $featEscaped = mysqli_real_escape_string($this->conn, trim($features));
        $imagePathEscaped = mysqli_real_escape_string($this->conn, $imagePath);
        
        $price = floatval($price);
        $category_id = intval($category_id);

        $query = "INSERT INTO packages (vendor_id, category_id, package_name, price, description, features, main_image, status) 
                  VALUES ('$vendor_profile_id', '$category_id', '$nameEscaped', '$price', '$descEscaped', '$featEscaped', '$imagePathEscaped', 'active')";
        
        return mysqli_query($this->conn, $query);
    }
}
?>