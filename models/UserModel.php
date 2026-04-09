<?php
// File: models/UserModel.php

class UserModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // 1. MENGAMBIL DATA USER UNTUK LOGIN
    public function getUserByEmail($email) {
        $emailEscaped = mysqli_real_escape_string($this->conn, trim($email));
        $query = "SELECT * FROM users WHERE email='$emailEscaped'";
        $result = mysqli_query($this->conn, $query);

        if ($result && mysqli_num_rows($result) === 1) {
            return mysqli_fetch_assoc($result);
        }
        return null; // User tidak ditemukan
    }

    // 2. REGISTRASI VENDOR (TRANSAKSI)
    public function registerVendor($email, $password, $businessName, $address) {
        $emailEscaped = mysqli_real_escape_string($this->conn, trim($email));
        $passEscaped = mysqli_real_escape_string($this->conn, trim($password)); // J.A.R.V.I.S Note: Gunakan password_hash() nanti!
        $bNameEscaped = mysqli_real_escape_string($this->conn, trim($businessName));
        $addrEscaped = mysqli_real_escape_string($this->conn, trim($address));
        $role = 'vendor';

        mysqli_begin_transaction($this->conn);
        try {
            // Insert ke tabel users
            $queryUser = "INSERT INTO users (email, password, role) VALUES ('$emailEscaped', '$passEscaped', '$role')";
            if (!mysqli_query($this->conn, $queryUser)) {
                throw new Exception("Gagal simpan akun: " . mysqli_error($this->conn));
            }

            $userId = mysqli_insert_id($this->conn);

            // Insert ke tabel vendor_profiles
            $queryProfile = "INSERT INTO vendor_profiles (user_id, business_name, address) VALUES ('$userId', '$bNameEscaped', '$addrEscaped')";
            if (!mysqli_query($this->conn, $queryProfile)) {
                throw new Exception("Gagal simpan profil vendor: " . mysqli_error($this->conn));
            }

            mysqli_commit($this->conn);
            return true;
        } catch (Exception $e) {
            mysqli_rollback($this->conn);
            throw $e; // Lempar error kembali ke Controller
        }
    }

    // 3. REGISTRASI CUSTOMER (TRANSAKSI)
    public function registerCustomer($email, $password, $fullName) {
        $emailEscaped = mysqli_real_escape_string($this->conn, trim($email));
        $passEscaped = mysqli_real_escape_string($this->conn, trim($password));
        $fNameEscaped = mysqli_real_escape_string($this->conn, trim($fullName));
        $role = 'customer';

        mysqli_begin_transaction($this->conn);
        try {
            // Insert ke tabel users
            $queryUser = "INSERT INTO users (email, password, role) VALUES ('$emailEscaped', '$passEscaped', '$role')";
            if (!mysqli_query($this->conn, $queryUser)) {
                throw new Exception("Gagal simpan akun: " . mysqli_error($this->conn));
            }

            $userId = mysqli_insert_id($this->conn);

            // Insert ke tabel customer_profiles (kolom full_name sesuai SQL Anda)
            $queryProfile = "INSERT INTO customer_profiles (user_id, full_name) VALUES ('$userId', '$fNameEscaped')";
            if (!mysqli_query($this->conn, $queryProfile)) {
                throw new Exception("Gagal simpan profil customer: " . mysqli_error($this->conn));
            }

            mysqli_commit($this->conn);
            return true;
        } catch (Exception $e) {
            mysqli_rollback($this->conn);
            throw $e;
        }
    }

    // REGISTRASI JURNALIS (TRANSAKSI)
    public function registerJournalist($email, $password, $fullName) {
        $emailEscaped = mysqli_real_escape_string($this->conn, trim($email));
        $passEscaped = mysqli_real_escape_string($this->conn, trim($password)); 
        $fNameEscaped = mysqli_real_escape_string($this->conn, trim($fullName));
        $role = 'journalist';

        mysqli_begin_transaction($this->conn);
        try {
            // 1. Insert ke tabel users
            $queryUser = "INSERT INTO users (email, password, role) VALUES ('$emailEscaped', '$passEscaped', '$role')";
            if (!mysqli_query($this->conn, $queryUser)) {
                throw new Exception("Gagal simpan akun: " . mysqli_error($this->conn));
            }

            $userId = mysqli_insert_id($this->conn);

            // 2. Insert ke tabel journalist_profiles
            $queryProfile = "INSERT INTO journalist_profiles (user_id, full_name) VALUES ('$userId', '$fNameEscaped')";
            if (!mysqli_query($this->conn, $queryProfile)) {
                throw new Exception("Gagal simpan profil jurnalis: " . mysqli_error($this->conn));
            }

            mysqli_commit($this->conn);
            return true;
        } catch (Exception $e) {
            mysqli_rollback($this->conn);
            throw $e; // Lempar error kembali ke Controller
        }
    }
    

}
?>