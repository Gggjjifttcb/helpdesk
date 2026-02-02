<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../assets/PHPMailer/src/PHPMailer.php';
require '../assets/PHPMailer/src/SMTP.php';
require '../assets/PHPMailer/src/Exception.php';

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host       = 'smtp.gmail.com';
$mail->SMTPAuth   = true;
$mail->Username   = 'myogaapriadi43@gmail.com';
$mail->Password   = 'jdks npwh llib jnch';
$mail->SMTPSecure = 'tls';
$mail->Port       = 587;

$mail->setFrom('myogaapriadi43@gmail.com', 'Helpdesk');
$mail->addAddress('yogamuhammad795@gmail.com');

$mail->Subject = 'Tes Email Helpdesk';
$mail->Body    = 'Jika email ini masuk, berarti sistem notifikasi berhasil';

$mail->send();
echo "EMAIL BERHASIL DIKIRIM";
