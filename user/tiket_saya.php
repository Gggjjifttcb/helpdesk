<?php
//session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'user') {
    header("Location: ../auth/login.php");
    exit;
}

$id = $_SESSION['user_id'];

$data = mysqli_query($conn, "
    SELECT * FROM tickets 
    WHERE user_id='$id' 
    ORDER BY created_at DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tiket Saya | Helpdesk</title>
<link rel="stylesheet" href="../assets/user.css">
</head>
<body>

<div class="layout">

    <!-- Sidebar -->
    <aside class="sidebar">
        <h2>Helpdesk</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="buat_tiket.php">Buat Helpdesk</a>
        <a href="tiket_saya.php" class="active">Helpdesk Saya</a>
        <a href="../auth/logout.php" class="logout">Logout</a>
    </aside>

    <!-- Content -->
    <main class="content">

        <div class="header-flex">
            <h3>Helpdesk Saya</h3>
            <a href="buat_tiket.php" class="btn-primary btn-sm">
                + Buat Helpdesk Baru
            </a>
        </div>

        <div class="card-table">
    <table class="table-modern">
        <thead>
            <tr>
                <th width="60">No</th>
                <th>Permasalahan</th>
                <th width="120">Status</th>
                <th width="180">Tanggal</th>
            </tr>
        </thead>
        <tbody>
        <?php $no=1; while($d=mysqli_fetch_assoc($data)): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td class="judul"><?= htmlspecialchars($d['judul']) ?></td>
                <td>
                    <span class="badge 
                        <?= $d['status']=='Open'?'badge-open':
                           ($d['status']=='Proses'?'badge-proses':'badge-selesai') ?>">
                        <?= $d['status'] ?>
                    </span>
                </td>
                <td><?= date('d M Y H:i', strtotime($d['created_at'])) ?></td>
            </tr>
        <?php endwhile ?>
        </tbody>
    </table>
</div>


    </main>

</div>

</body>
</html>
