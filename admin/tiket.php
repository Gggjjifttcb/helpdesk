<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

$data = mysqli_query($conn, "
    SELECT tickets.*, users.nama 
    FROM tickets 
    JOIN users ON tickets.user_id = users.id
    ORDER BY tickets.created_at DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Tiket | Helpdesk</title>
    <link rel="stylesheet" href="../assets/dasboard.css">
</head>
<body>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <h2 class="sidebar-title">Helpdesk</h2>

        <ul class="menu">
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="tiket.php" class="active">Kelola Tiket</a></li>
        </ul>

        <a href="../auth/logout.php" class="btn-logout">Logout</a>
    </aside>

    <!-- CONTENT -->
    <main class="content">

        <div class="content-header">
            <h3>Kelola Tiket</h3>
        </div>

        <div class="card-table">

            <table class="table-modern">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th width="170">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (mysqli_num_rows($data) > 0): ?>
                    <?php while ($d = mysqli_fetch_assoc($data)): ?>
                    <tr>
                        <td><?= htmlspecialchars($d['nama']) ?></td>
                        <td><?= htmlspecialchars($d['judul']) ?></td>
                        <td><?= htmlspecialchars($d['kategori']) ?></td>
                        <td>
                            <?= htmlspecialchars($d['deskripsi']) ?>
                        </td>
                        <td><br>
                            <span class="badge 
                                <?= $d['status']=='Open'?'badge-open':
                                   ($d['status']=='Proses'?'badge-proses':'badge-selesai') ?>">
                                <?= $d['status'] ?>
                            </span>
                        </td>
                        <td>
                            <form action="update_status.php" method="POST" class="form-inline">
                                <input type="hidden" name="id" value="<?= $d['id'] ?>">
                                <select name="status" class="select-status">
                                    <option <?= $d['status']=='Open'?'selected':'' ?>>Open</option>
                                    <option <?= $d['status']=='Proses'?'selected':'' ?>>Proses</option>
                                    <option <?= $d['status']=='Selesai'?'selected':'' ?>>Selesai</option>
                                </select>
                                <button class="btn-primary btn-sm">Update</button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">
                            Belum ada tiket
                        </td>
                    </tr>
                <?php endif ?>
                </tbody>
            </table>

        </div>

    </main>
</div>

</body>
</html>
