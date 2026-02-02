<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../assets/PHPMailer/src/Exception.php';
require '../assets/PHPMailer/src/PHPMailer.php';
require '../assets/PHPMailer/src/SMTP.php';

function kirimNotifikasiAdmin($judul, $kategori, $deskripsi, $nama_user, $tanggal) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'myogaapriadi43@gmail.com';
        $mail->Password   = 'jdks npwh llib jnch';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('myogaapriadi43@gmail.com', 'Helpdesk System');
        $mail->addAddress('myogaapriadi43@gmail.com', 'Admin Helpdesk'); // email admin

        $mail->isHTML(true);
        $mail->Subject = "Tiket Baru Masuk: $judul";

       $mail->Body = "
        <p>Yth. <b>Admin IT Poltekpar Lombok</b>,</p>
        <p>User <b>$nama_user</b> telah membuat Helpdesk baru di  Helpdesk System:</p>
        <table style='border-collapse: collapse; width: 100%; font-family: Arial, sans-serif;'>
            <tr style='background-color: #f2f2f2;'>
                <th style='padding:10px; border:1px solid #ddd;'>Informasi</th>
                <th style='padding:10px; border:1px solid #ddd;'>Detail</th>
            </tr>
            <tr><td style='padding:10px; border:1px solid #ddd;'>Permasalahan</td><td style='padding:10px; border:1px solid #ddd;'>$judul</td></tr>
            <tr><td style='padding:10px; border:1px solid #ddd;'>Kategori</td><td style='padding:10px; border:1px solid #ddd;'>$kategori</td></tr>
            <tr><td style='padding:10px; border:1px solid #ddd;'>Deskripsi Permasalahan</td><td style='padding:10px; border:1px solid #ddd;'>$deskripsi</td></tr>
            <tr><td style='padding:10px; border:1px solid #ddd;'>User</td><td style='padding:10px; border:1px solid #ddd;'>$nama_user</td></tr>
            <tr><td style='padding:10px; border:1px solid #ddd;'>Tanggal Pengajuan</td><td style='padding:10px; border:1px solid #ddd;'>$tanggal</td></tr>
        </table>
        <p>Silakan login ke <a href='https://yourdomain.com/admin/tiket.php'>sistem Helpdesk</a> untuk menindaklanjuti tiket ini.</p>
        <p>Hormat kami,<br><b>Helpdesk System</b></p>
        ";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}