<?php
//session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

$tiket_terbaru = mysqli_query($conn, "
    SELECT tickets.*, users.nama 
    FROM tickets 
    JOIN users ON tickets.user_id = users.id
    ORDER BY tickets.created_at DESC
    LIMIT 10
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin | Helpdesk</title>
    <link rel="stylesheet" href="../assets/dasboard.css">
</head>
<body>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <h2 class="sidebar-title">Helpdesk</h2>

        <ul class="menu">
            <li><a href="dashboard.php" class="active">Dashboard</a></li>
            <li>
    <a href="tiket.php">
        Kelola Helpdesk
        <span id="notif" class="notif-badge" style="display:none">0</span>
    </a>
</li>

        </ul>

        <a href="../auth/logout.php" class="btn-logout">Logout</a>
    </aside>

    <!-- CONTENT -->
    <main class="content">

        <div class="content-header">
            <h3>Dashboard Admin</h3>
        </div>

        <div class="card-table">
            <div class="card-header">
                <h4>Helpdesk Terbaru</h4>
                <a href="tiket.php" class="btn-primary btn-sm">Lihat Semua</a>
            </div>

            <table class="table-modern">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Permasalahan</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (mysqli_num_rows($tiket_terbaru) > 0): ?>
                    <?php while ($t = mysqli_fetch_assoc($tiket_terbaru)): ?>
                    <tr>
                        <td><?= htmlspecialchars($t['nama']) ?></td>
                        <td><?= htmlspecialchars($t['judul']) ?></td>
                        <td><?= htmlspecialchars($t['kategori']) ?></td>
                        <td class="text-truncate"><?= htmlspecialchars($t['deskripsi']) ?></td>
                        <td>
                            <span class="badge 
                                <?= $t['status']=='Open'?'badge-open':
                                   ($t['status']=='Proses'?'badge-proses':'badge-selesai') ?>">
                                <?= $t['status'] ?>
                            </span>
                        </td>
                        <td><?= date('d M Y H:i', strtotime($t['created_at'])) ?></td>
                    </tr>
                    <?php endwhile ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Belum ada helpdesk terbaru</td>
                    </tr>
                <?php endif ?>
                </tbody>
            </table>
        </div>

    </main>
</div>
<script>
function loadNotif(){
    fetch('notifikasi_count.php')
    .then(res => res.text())
    .then(total => {
        let badge = document.getElementById('notif');
        if (total > 0) {
            badge.style.display = 'inline-block';
            badge.innerText = total;
        } else {
            badge.style.display = 'none';
        }
    });
}

loadNotif();
setInterval(loadNotif, 5000); // tiap 5 detik
</script>

</body>
</html>
