<?php
include 'koneksi.php';

if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $usn = $_POST['usn'];
    $pass = $_POST['password'];

    $query = "INSERT INTO users (email, usn, password) VALUES ('$email', '$usn', '$pass')";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Pendaftaran Berhasil!'); window.location='signin.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<form method="POST">
    <h2>Sign Up</h2>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="text" name="usn" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit" name="register">Daftar</button>
</form>