<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "helpdesk");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
