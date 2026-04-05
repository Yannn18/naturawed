<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        "status" => "error",
        "message" => "Request method not allowed."
    ]);
    exit;
}

$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$pass = isset($_POST['password']) ? trim($_POST['password']) : '';
$remember = isset($_POST['remember']) ? $_POST['remember'] : 'false';

if ($email === '' || $pass === '') {
    echo json_encode([
        "status" => "error",
        "message" => "Email dan password harus diisi."
    ]);
    exit;
}

$emailEscaped = mysqli_real_escape_string($conn, $email);
$passEscaped = mysqli_real_escape_string($conn, $pass);
$result = mysqli_query($conn, "SELECT * FROM users WHERE email='$emailEscaped' AND password='$passEscaped'");

if ($result === false) {
    echo json_encode([
        "status" => "error",
        "message" => "Database error: " . mysqli_error($conn)
    ]);
    exit;
}

if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);

    $_SESSION['login'] = true;
    $_SESSION['user'] = $row['usn'];

    if ($remember === 'true') {
        setcookie('user_email', $row['usn'], time() + 86400, "/");
    }

    echo json_encode([
        "status" => "success",
        "username" => $row['usn']
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Email atau Password salah!"
    ]);
}
?> 