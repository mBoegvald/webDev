<?php

$userName = $_POST["txtName"];
$userEmail = $_POST["txtEmail"];
$userPassword = $_POST["txtPassword"];
$sKey = bin2hex(random_bytes(32));

$sData = file_get_contents("data.json");

$jData = json_decode($sData);

//JSON OBJECT

$jUser = new stdClass();
$jUser->name = $userName;
$jUser->key = $sKey;
$jUser->email = $userEmail;
$jUser->password = $userPassword;
$jUser->verified = 0;

array_push($jData->users, $jUser);

$sData = json_encode($jData, JSON_PRETTY_PRINT);

file_put_contents('data.json', $sData);


$sPassword = file_get_contents('private/password.txt');
$sLink = "http://localhost/mon-17-feb/signup/verify.php?key=$sKey";
$sSubject = "Please verify";
$sMessage = "Thank you for signing up, to verify your account, click this link: $sLink";

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