<?php
//session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'user') {
    header("Location: ../auth/login.php");
    exit;
}

if (isset($_POST['submit'])) {
    $judul     = mysqli_real_escape_string($conn, $_POST['judul']);
    $kategori  = mysqli_real_escape_string($conn, $_POST['kategori']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $user_id   = $_SESSION['user_id'];
    $nama_user = $_SESSION['nama'];

    // Simpan tiket
    $insert = mysqli_query($conn, "INSERT INTO tickets 
        (user_id, judul, kategori, deskripsi, status, created_at)
        VALUES ('$user_id', '$judul', '$kategori', '$deskripsi', 'Open', NOW())
    ");

    if ($insert) {
        // Ambil data tiket yang baru saja dibuat
        $ticket_id = mysqli_insert_id($conn);
        $tiket = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tickets WHERE id='$ticket_id'"));
        $tanggal = date('d F Y H:i', strtotime($tiket['created_at'])); // format dari DB

        include "kirim_notifikasi.php"; // include helper

        // Kirim email ke admin dengan tanggal dari DB
        kirimNotifikasiAdmin($judul, $kategori, $deskripsi, $nama_user, $tanggal);

        header("Location: tiket_saya.php");
        exit;
    } else {
        echo "<script>alert('Gagal membuat tiket, silakan coba lagi!');</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Buat Tiket | Helpdesk</title>
<link rel="stylesheet" href="../assets/user.css">
</head>
<body>

<div class="layout">

    <!-- Sidebar -->
    <aside class="sidebar">
        <h2>Helpdesk</h2>
        <a href="dashboard.php">Dashboard</a>
        <a href="buat_tiket.php" class="active">Buat Helpdesk</a>
        <a href="tiket_saya.php">Helpdesk Saya</a>
        <a href="../auth/logout.php" class="logout">Logout</a>
    </aside>

    <!-- Content -->
    <main class="content">

        <h3>Buat Helpdesk</h3>

        <div class="form-card">
            <form method="POST">

                <div class="form-group">
                    <label>Permasalahan</label>
                    <input type="text" name="judul" placeholder="Contoh: Laptop tidak menyala" required>
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Hardware">Hardware</option>
                        <option value="Software">Software</option>
                        <option value="Jaringan">Jaringan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Deskripsi Masalah</label>
                    <textarea name="deskripsi" rows="5" placeholder="Jelaskan kendala secara detail..." required></textarea>
                </div>

                <div class="form-action">
                    <button type="submit" name="submit" class="btn-primary">
                        Kirim Helpdesk
                    </button>
                    <a href="dashboard.php" class="btn-secondary">
                        Batal
                    </a>
                </div>

            </form>
        </div>

    </main>

</div>

</body>
</html>
