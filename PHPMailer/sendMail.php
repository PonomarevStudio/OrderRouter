<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $subject = "", $message = "")
{
    require_once __DIR__ . '/Exception.php';
    require_once __DIR__ . '/PHPMailer.php';
    require_once __DIR__ . '/SMTP.php';

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['mailLogin'];
    $mail->Password = $_ENV['mailPass'];
    $mail->setFrom($_ENV['mailLogin']);
    $mail->addAddress($email);
    $mail->Subject = $subject;
    $mail->msgHTML($message);
//    $mail->AltBody = $message;
    $result = $mail->send();
    if (!$result) $result = $mail->ErrorInfo;
    return $result;
    /*if (!$mail->send()) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message sent!';
    }*/
}