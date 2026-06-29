<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'counsel@justelpro.com'; 
        $mail->Password = '@&Un0R57Gy!6'; // ← Must use App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('counsel@justelpro.com', 'JustelPro Contact');
        $mail->addAddress('counsel@justelpro.com');

        $mail->Subject = 'New Contact Message';
        $mail->Body = "Name: $name\nPhone: $phone\n\nMessage:\n$message";

        // Debug info
        $mail->SMTPDebug = 2; 
        $mail->Debugoutput = 'html';

        $mail->send();
        echo "Message sent successfully";

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
