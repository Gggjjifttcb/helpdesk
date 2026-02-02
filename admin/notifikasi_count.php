<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] != 'admin') {
    exit;
}

$q = mysqli_query($conn, "
    SELECT COUNT(*) AS total 
    FROM tickets 
    WHERE is_read_admin = 0
");

$d = mysqli_fetch_assoc($q);
echo $d['total'];
