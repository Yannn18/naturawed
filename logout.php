<?php
session_start();
session_destroy(); // Hapus Session

// Hapus Cookie dengan set waktu ke masa lalu
setcookie('user_email', '', time() - 3600, "/");

header("Location: signin.php");
?>