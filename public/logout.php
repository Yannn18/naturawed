<?php
session_start();

// 1. Hapus semua data di dalam variabel $_SESSION
$_SESSION = [];

// 2. Hancurkan session di server
session_unset();
session_destroy();

// 3. Hapus Cookie "user_email" (jika ada)
// Caranya dengan mengatur waktu kadaluarsa ke masa lalu (time() - 3600)
if (isset($_COOKIE['user_email'])) {
    setcookie('user_email', '', time() - 3600, '/');
}

// 4. Redirect ke halaman login atau beranda
header("Location: signin.html");
exit;
?>