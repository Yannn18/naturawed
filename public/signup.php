<?php
session_start(); 
include 'koneksi.php';

// Penting: Beritahu browser bahwa ini adalah respon JSON
header('Content-Type: application/json');

// Cek apakah data email dikirim melalui POST
if (isset($_POST['email'])) {
    // 1. Ambil data & amankan (Gunakan nama variabel yang dikirim dari Fetch HTML)
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $usn   = mysqli_real_escape_string($conn, $_POST['username']); 
    $pass  = mysqli_real_escape_string($conn, $_POST['password']);

    // 2. Query INSERT sesuai nama kolom di database kamu (email, usn, password)
    $query = "INSERT INTO users (email, usn, password) VALUES ('$email', '$usn', '$pass')";
    
    if (mysqli_query($conn, $query)) {
        // --- LOGIKA OTOMATIS LOGIN ---
        
        // 3. Set Session supaya user langsung dianggap login
        $_SESSION['login'] = true;
        $_SESSION['user']  = $usn;

        // 4. Set Cookie berlaku selama 1 hari (86400 detik)
        setcookie('user_email', $usn, time() + 86400, "/");

        // 5. Kirim respon sukses ke JavaScript
        echo json_encode([
            "status" => "success",
            "username" => $usn
        ]);
    } else {
        // Jika gagal simpan (misal karena error SQL)
        echo json_encode([
            "status" => "error",
            "message" => "Gagal simpan ke database: " . mysqli_error($conn)
        ]);
    }
} else {
    // Jika file diakses langsung tanpa kirim data
    echo json_encode([
        "status" => "error",
        "message" => "Data tidak diterima oleh server."
    ]);
}
?>