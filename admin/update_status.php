<?php
include "../config/koneksi.php";

$id = $_POST['id'];
$status = $_POST['status'];

mysqli_query($conn, "UPDATE tickets SET status='$status' WHERE id='$id'");
header("Location: tiket.php");
