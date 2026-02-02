<?php
session_start();
include "../config/koneksi.php";

// Pastikan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: register.php");
    exit;
}

$nama     = mysqli_real_escape_string($conn, $_POST['nama']);
$email    = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Cek email sudah ada
$cek = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
if (mysqli_num_rows($cek) > 0) {
    echo "
    <script>
        alert('Email sudah terdaftar!');
        window.location.href = 'register.php';
    </script>
    ";
    exit;
}

// Simpan user (ROLE USER)
mysqli_query($conn, "
    INSERT INTO users (nama, email, password, role)
    VALUES ('$nama', '$email', '$password', 'user')
");

// Redirect ke login
echo "
<script>
    alert('Registrasi berhasil, silakan login');
    window.location.href = 'login.php';
</script>
";
