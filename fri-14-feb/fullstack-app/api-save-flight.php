<?php 
if(!isset($_POST['txtFlightId']) || strlen($_POST['txtFlightId']) < 5 || strlen($_POST['txtFlightId']) == 5) {
    echo 'Flight Id must be 5 characters';
    exit();
}
if(!isset($_POST['txtFlightFrom']) || strlen($_POST['txtFlightFrom']) < 2 || strlen($_POST['txtFlightFrom']) > 50) {
    echo 'From must be more than 2 characters';
    exit();
}
if(!isset($_POST['txtFlightTo']) || strlen($_POST['txtFlightTo']) < 2 || strlen($_POST['txtFlightTo']) > 50) {
    echo 'To must be more than 2 characters';
    exit();
}

$flightId = $_POST["txtFlightId"];
$flightFrom = $_POST["txtFlightFrom"];
$flightTo = $_POST["txtFlightTo"];

$sData = file_get_contents("data.json");

$jData = json_decode($sData);

//JSON OBJECT

$jflight = new stdClass();
$jflight->id = $flightId;
$jflight->from = $flightFrom;
$jflight->to = $flightTo;

array_push($jData->flights, $jflight);

$sData = json_encode($jData, JSON_PRETTY_PRINT);
echo $sData;

file_put_contents('data.json', $sData);






// Send SMS






$sFromPhone = '27890855';
$sToPhone = '27890855';
$sFlightId = $_POST['txtFlightId'];
$sFlightFrom = $_POST['txtFlightFrom'];
$sFlightTo = $_POST['txtFlightTo'];
$sMessage = 'Flight from '.$sFlightFrom.' to '.$sFlightTo.' with ID: '.$sFlightId.' has been saved.';
$sMessageURL = urlencode('Flight from '.$sFlightFrom.' to '.$sFlightTo.' with ID: '.$sFlightId.' has been saved.');
$sApiKey = 'RHAOlEf4kovRo49blDmfvAWbisMMBmSeuY7tQQy9lKKUpuiqHp';
if(strlen($sMessage)>100) {
    echo "Flight info is too long!";
    exit();
}
echo file_get_contents("https://fatsms.com/apis/api-send-sms?to-phone=27890855&message=$sMessageURL&from-phone=27890855&api-key=RHAOlEf4kovRo49blDmfvAWbisMMBmSeuY7tQQy9lKKUpuiqHp");






// SEND EMAIL




$sPassword = file_get_contents('private/password.txt');
$sSubject = 'Flight '.$sFlightId.' has been saved';
$sMessage = $sMessage;

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