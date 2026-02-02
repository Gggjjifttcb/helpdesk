<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../assets/PHPMailer/src/Exception.php';
require '../assets/PHPMailer/src/PHPMailer.php';
require '../assets/PHPMailer/src/SMTP.php';
include "config/koneksi.php"; // koneksi database

if(isset($_POST['id'], $_POST['status'])) {
    $id = (int)$_POST['id'];
    $status = $_POST['status'];

    // Ambil info user dari DB
    $query = mysqli_query($conn, "SELECT email, nama FROM users WHERE id=$id");
    $user = mysqli_fetch_assoc($query);

    // Update status di database
    mysqli_query($conn, "UPDATE your_table SET status='$status' WHERE id=$id");

    // ---- Kirim email dengan PHPMailer ----
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'your_email@gmail.com';
        $mail->Password   = 'your_app_password';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('your_email@gmail.com', 'Admin');
        $mail->addAddress($user['email'], $user['nama']);

        $mail->isHTML(true);
        $mail->Subject = 'Update Status Tiket Anda';
        $mail->Body    = "Halo <b>".$user['nama']."</b>,<br><br>Status tiket Anda telah diubah menjadi: <b>$status</b>.<br><br>Terima kasih.";

        $mail->send();
        $email_status = 'success';
    } catch (Exception $e) {
        $email_status = 'fail';
        // Optional: simpan log error $mail->ErrorInfo
    }

    // Redirect kembali ke tiket.php dengan status update & email
    header("Location: tiket.php?update=success&email=$email_status");
    exit;
}
?>
