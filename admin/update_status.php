<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../assets/PHPMailer/src/Exception.php';
require '../assets/PHPMailer/src/PHPMailer.php';
require '../assets/PHPMailer/src/SMTP.php';
include "../config/koneksi.php";

// Ambil data POST
$id = $_POST['id'];
$status = $_POST['status'];

// Update status tiket di database
mysqli_query($conn, "UPDATE tickets SET status='$status', is_read_admin=1 WHERE id='$id'");

// Ambil info tiket dan user dari DB
$query = mysqli_query($conn, "SELECT u.email, u.nama, t.judul, t.kategori, t.deskripsi, t.created_at
                              FROM tickets t
                              JOIN users u ON t.user_id = u.id
                              WHERE t.id='$id'");
$user = mysqli_fetch_assoc($query);

// Format tanggal update
$tanggal_update = date('d F Y');

// ---- Kirim email notifikasi ----
$mail = new PHPMailer(true);
try {
    // Pengaturan server SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'myogaapriadi43@gmail.com';   // Email pengirim
    $mail->Password   = 'jdks npwh llib jnch';        // App Password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Penerima
    $mail->setFrom('myogaapriadi43@gmail.com', 'Admin IT Poltekpar Lombok');
    $mail->addAddress($user['email'], $user['nama']);

    // Konten email
    $mail->isHTML(true);
    $mail->Subject = "Pemberitahuan Pembaruan Status Tiket Helpdesk #$id";

    $mail->Body = "
    <p>Yth. <b>".$user['nama']."</b>,</p>

    <p>Kami ingin memberitahukan bahwa Progress helpdesk Anda telah diperbarui. Berikut rincian Helpdesk Anda:</p>

    <table style='border-collapse: collapse; width: 100%;'>
        <tr>
            <td style='padding: 8px; border: 1px solid #ddd;'><b>No </b></td>
            <td style='padding: 8px; border: 1px solid #ddd;'>$id</td>
        </tr>
        <tr>
            <td style='padding: 8px; border: 1px solid #ddd;'><b>Permasalahan</b></td>
            <td style='padding: 8px; border: 1px solid #ddd;'>".$user['judul']."</td>
        </tr>
        <tr>
            <td style='padding: 8px; border: 1px solid #ddd;'><b>Kategori</b></td>
            <td style='padding: 8px; border: 1px solid #ddd;'>".$user['kategori']."</td>
        </tr>
        <tr>
            <td style='padding: 8px; border: 1px solid #ddd;'><b>Deskripsi</b></td>
            <td style='padding: 8px; border: 1px solid #ddd;'>".$user['deskripsi']."</td>
        </tr>
        <tr>
            <td style='padding: 8px; border: 1px solid #ddd;'><b>Status</b></td>
            <td style='padding: 8px; border: 1px solid #ddd;'><b>$status</b></td>
        </tr>
        <tr>
            <td style='padding: 8px; border: 1px solid #ddd;'><b>Tanggal di ajukan</b></td>
            <td style='padding: 8px; border: 1px solid #ddd;'>".date('d F Y H:i', strtotime($user['created_at']))."</td>
        </tr>
    </table>

    <p>Apabila Anda memiliki pertanyaan lebih lanjut atau membutuhkan bantuan tambahan, silakan balas email ini atau menghubungi tim helpdesk kami.</p>

    <p>Terima kasih atas perhatian dan kerjasama Anda.</p>

    <p>Hormat kami,<br><b>Tim Helpdesk</b></p>
    ";

    $mail->send();
    $email_status = 'success';
} catch (Exception $e) {
    $email_status = 'fail';
}

// Redirect ke halaman tiket dengan status email
header("Location: tiket.php?email=$email_status");
exit;
?>
