<?php
$host = "localhost:3306"; // Pastikan portnya benar
$user = "root";
$pass = "1234";
$db   = "naturawed";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    // Jangan pakai echo biasa, kirimkan pesan error yang jelas
    die("Koneksi gagal: " . mysqli_connect_error());
}
// JANGAN ADA ECHO DI SINI!
?>