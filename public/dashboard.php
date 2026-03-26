<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: signin.php");
    exit;
}
?>

<h1>Selamat Datang, <?php echo $_SESSION['user']; ?>!</h1>
<p>Kamu berhasil masuk menggunakan Session.</p>
<a href="logout.php">Logout</a>