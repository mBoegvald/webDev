<?php
if(!isset($_POST['txtSubject']) || strlen($_POST['txtSubject']) < 2) {
    echo 'Subject must be at least 2 characters';
    exit();
}
if (strlen($_POST['txtSubject']) > 50 ) {
    echo 'Subject must be shorter than 50 characters';
    exit();
}
if(!isset($_POST['txtMessage']) || strlen($_POST['txtMessage']) < 2) {
    echo 'Message must be at least 2 characters';
    exit();
}
if (strlen($_POST['txtMessage']) > 50 ) {
    echo 'Message must be shorter than 50 characters';
    exit();
}
$sPassword = file_get_contents('private/password.txt');
$sSubject = $_POST['txtSubject'];
$sMessage = $_POST['txtMessage'];

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

// Load Composer's autoloader
// require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'miklasboegvald@gmail.com';                     // SMTP username
    $mail->Password   = $sPassword;                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('miklasboegvald@gmail.com', 'Mailer');
    $mail->addAddress('miklasboegvald@gmail.com', 'Miklas');     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('miklasboegvald@gmail.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $sSubject;
    $mail->Body    = $sMessage;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}