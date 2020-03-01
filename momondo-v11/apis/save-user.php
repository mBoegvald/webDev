<?php
$sData = file_get_contents('../user.json');
$jData = json_decode($sData);


$sUserEmail = $_POST['txtEmail'];
$sUserName = $_POST['txtName'];
$sUserPassword = $_POST['txtPassword'];

session_start();
$_SESSION['sEmail'] = $sUserEmail;
$_SESSION['sName'] = $sUserName;
session_abort();

$jUser = new stdClass();
$jUser->email = $sUserEmail;
$jUser->name = $sUserName;
$jUser->password = $sUserPassword;
$jUser->verified = 0;
$jUser->key = bin2hex(random_bytes(16));

array_push($jData->users, $jUser);

$sData = json_encode($jData, JSON_PRETTY_PRINT);

file_put_contents('../user.json', $sData);

$sPassword = file_get_contents('../private/password.txt');

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

$sKey = $jUser->key;
$verifyLink = "http://127.0.0.1/momondo-v11/apis/verify.php?key=$sKey";
$message = '<a href="'.$verifyLink.'">Click here to verify</a>';

// Load Composer's autoloader
// require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {

    $mail->SMTPOptions = array(

        'ssl' => array(
    
            'verify_peer' => false,
    
            'verify_peer_name' => false,
    
            'allow_self_signed' => true
    
        )
    
    );
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   // Enable verbose debug output
    $mail->isSMTP();                                         // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                // Enable SMTP authentication
    $mail->Username   = 'ironmanweb22@gmail.com';                     // SMTP username
    $mail->Password   = $sPassword;                          // SMTP password
    $mail->SMTPSecure = 'ssl';                               // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 465;                                 // TCP port to connect to

    //Recipients
    $mail->setFrom('ironmanweb22@gmail.com', 'Tony Stark');
    $mail->addAddress('ironmanweb22@gmail.com', 'Jakob');     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    $mail->addReplyTo('ironmanweb22@gmail.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "Verify sign up";
    $mail->Body    = "Welcome, " . $message;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}