<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'user') {
    header("Location: ../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$total   = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM tickets WHERE user_id='$user_id'"));
$open    = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM tickets WHERE user_id='$user_id' AND status='Open'"));
$proses  = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM tickets WHERE user_id='$user_id' AND status='Proses'"));
$selesai = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM tickets WHERE user_id='$user_id' AND status='Selesai'"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>User Dashboard | Helpdesk</title>
<link rel="stylesheet" href="../assets/user.css">
</head>
<body>

<div class="layout">

    <!-- Sidebar -->
    <aside class="sidebar">
        <h2>Helpdesk</h2>
        <a href="dashboard.php" class="active">Dashboard</a>
        <a href="buat_tiket.php">Buat Tiket</a>
        <a href="tiket_saya.php">Tiket Saya</a>
        <a href="../auth/logout.php" class="logout">Logout</a>
    </aside>

    <!-- Main -->
    <main class="content">
        <h3>Dashboard User</h3>

        <div class="cards">
            <div class="card">
                <span>Total Tiket</span>
                <h1><?= $total ?></h1>
            </div>
            <div class="card red">
                <span>Open</span>
                <h1><?= $open ?></h1>
            </div>
            <div class="card orange">
                <span>Diproses</span>
                <h1><?= $proses ?></h1>
            </div>
            <div class="card green">
                <span>Selesai</span>
                <h1><?= $selesai ?></h1>
            </div>
        </div>

        <div class="info-box">
            <p>Gunakan menu di samping untuk membuat tiket baru atau memantau status laporan Anda.</p>
        </div>
    </main>

</div>

</body>
</html>
