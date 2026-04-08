<?php
// File: models/PackageModel.php

class PackageModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
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
    public function createPackage($vendor_profile_id, $category_id, $name, $price, $description, $imagePath) {
        $nameEscaped = mysqli_real_escape_string($this->conn, trim($name));
        $descEscaped = mysqli_real_escape_string($this->conn, trim($description));
        $imagePathEscaped = mysqli_real_escape_string($this->conn, $imagePath);
        
        // Memastikan tipe data benar
        $price = floatval($price);
        $category_id = intval($category_id);

        $query = "INSERT INTO packages (vendor_id, category_id, package_name, price, description, main_image, status) 
                  VALUES ('$vendor_profile_id', '$category_id', '$nameEscaped', '$price', '$descEscaped', '$imagePathEscaped', 'active')";
        
        return mysqli_query($this->conn, $query);
    }
}
?>