<?php
session_start();

/*
|--------------------------------------------------------------------------
| INDEX HELP DESK
|--------------------------------------------------------------------------
| - Jika belum login → redirect ke halaman login
| - Jika sudah login:
|   - Admin → dashboard admin
|   - User  → dashboard user
*/

if (!isset($_SESSION['login'])) {
    header("Location: auth/login.php");
    exit;
}

// Redirect berdasarkan role
if ($_SESSION['role'] === 'admin') {
    header("Location: admin/dashboard.php");
    exit;
}

if ($_SESSION['role'] === 'user') {
    header("Location: user/dashboard.php");
    exit;
}

// Jika role tidak dikenali
session_destroy();
header("Location: auth/login.php");
exit;
