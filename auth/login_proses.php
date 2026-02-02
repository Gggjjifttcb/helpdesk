<?php
session_start();
include "../config/koneksi.php";

// Pastikan lewat POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php");
    exit;
}

// Ambil & amankan input
$email    = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Query user (TANPA HASH)
$query = mysqli_query($conn, "
    SELECT id, role, nama 
    FROM users 
    WHERE email='$email' AND password='$password'
    LIMIT 1
");

$user = mysqli_fetch_assoc($query);

if ($user) {

    // Set session
    $_SESSION['login']   = true;
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role']    = $user['role'];
    $_SESSION['nama']    = $user['nama'];

    // Redirect sesuai role
    if ($user['role'] === 'admin') {
        header("Location: ../admin/dashboard.php");
    } else {
        header("Location: ../user/dashboard.php");
    }
    exit;

} else {
    // Jika gagal login
    echo "
    <script>
        alert('Email atau password salah!');
        window.location.href = 'login.php';
    </script>
    ";
}
