<?php
session_start();
include 'koneksi.php';

$email = $_POST['email'];
$pass = $_POST['password'];
$remember = $_POST['remember'];

$result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$pass'");

if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);

    $_SESSION['login'] = true;
    $_SESSION['user'] = $row['usn'];

    if ($remember === 'true') {
        setcookie('user_email', $row['usn'], time() + 86400, "/");
    }

    // Kirim status sukses DAN username-nya ke JavaScript
    echo json_encode([
        "status" => "success",
        "username" => $row['usn']
    ]);
} else {
    // Jika tidak ada di database
    echo json_encode([
        "status" => "error",
        "message" => "Email atau Password salah!"
    ]);
}
?>