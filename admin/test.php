<?php
$judul      = "Contoh Judul Tiket";
$nama_user  = "Nama User";
$kategori   = "Hardware";
$deskripsi  = "Laptop tidak menyala";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../assets/PHPMailer/src/Exception.php';
require '../assets/PHPMailer/src/PHPMailer.php';
require '../assets/PHPMailer/src/SMTP.php';

// kode kirim email seperti biasa
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
    $mail->addAddress('myogaapriadi43@gmail.com', 'Admin Helpdesk');

    $mail->isHTML(true);
    $mail->Subject = "Tiket Baru Masuk: $judul";

   $mail->Body = "
<p>Yth. <b>Admin Helpdesk</b>,</p>
<p>Dengan hormat,</p>
<p>User <b>$nama_user</b> telah membuat tiket baru di sistem Helpdesk. Berikut detail tiket tersebut:</p>

<table style='border-collapse: collapse; width: 100%; font-family: Arial, sans-serif;'>
    <tr style='background-color: #f2f2f2;'>
        <th style='padding:10px; border:1px solid #ddd; text-align:left;'>Informasi</th>
        <th style='padding:10px; border:1px solid #ddd; text-align:left;'>Detail</th>
    </tr>
    <tr>
        <td style='padding:10px; border:1px solid #ddd;'>Judul Tiket</td>
        <td style='padding:10px; border:1px solid #ddd;'>$judul</td>
    </tr>
    <tr>
        <td style='padding:10px; border:1px solid #ddd;'>Kategori</td>
        <td style='padding:10px; border:1px solid #ddd;'>$kategori</td>
    </tr>
    <tr>
        <td style='padding:10px; border:1px solid #ddd;'>Deskripsi Masalah</td>
        <td style='padding:10px; border:1px solid #ddd;'>$deskripsi</td>
    </tr>
    <tr>
        <td style='padding:10px; border:1px solid #ddd;'>User</td>
        <td style='padding:10px; border:1px solid #ddd;'>$nama_user</td>
    </tr>
    <tr>
        <td style='padding:10px; border:1px solid #ddd;'>Tanggal</td>
        <td style='padding:10px; border:1px solid #ddd;'>".date('d F Y H:i')."</td>
    </tr>
</table>

<p>Silakan login ke <a href='https://yourdomain.com/admin/tiket.php'>sistem Helpdesk</a> untuk menindaklanjuti tiket ini.</p>

<p>Hormat kami,<br><b>Helpdesk System</b></p>
";

    $mail->send();
    echo "Email berhasil dikirim";
} catch (Exception $e) {
    echo "Email gagal dikirim: " . $mail->ErrorInfo;
}
