<?php
http_response_code(200);
header('Content-Type: application/json');
$sBookingData = file_get_contents('../booked-flights.json');
$jBookingData = json_decode($sBookingData);

$sUserName = $_POST['user-name'];
$sUserLastName = $_POST['user-lastName'];
$sUserEmail = $_POST['user-email'];

if(!isset($sUserName) && !isset($sUserLastName) && !isset($sUserEmail)){
    echo 'ERROR';
    exit();
}
if(strlen($sUserName) < 2 || strlen($sUserName) > 5){
    echo 'ERROR';
    exit();
}
if(strlen($sUserLastName) < 2 || strlen($sUserLastName) > 5){
    echo 'ERROR';
    exit();
}
if(strlen($sUserEmail) < 2 || !filter_var($sUserEmail, FILTER_VALIDATE_EMAIL)){
    echo 'ERROR';
    exit();
}

$jBookedUser = new stdClass();
$jBookedUser->bookingId = bin2hex(random_bytes(16));
$jBookedUser->userName = $sUserName;
$jBookedUser->userLastName = $sUserLastName;
$jBookedUser->userEmail = $sUserEmail;
$jBookedUser->bookingCode = bin2hex(random_bytes(8));

$flightId = $_GET['flightId'];

$sFlightData = file_get_contents('../most-popular-flights.json');
$jFlightData = json_decode($sFlightData);

foreach($jFlightData as $jFlight){
    if($jFlight->id == $flightId){
        echo 'Match';
        $jBookedUser->bookedFlight = new \stdClass();
        $jBookedUser->bookedFlight->id = $jFlight->id;
        $jBookedUser->bookedFlight->flightId = $jFlight->flightId;
        $jBookedUser->bookedFlight->companyName = $jFlight->companyName;
        $jBookedUser->bookedFlight->companyShortcut = $jFlight->companyShortcut;
        $jBookedUser->bookedFlight->departureTime = $jFlight->departureTime;
        $jBookedUser->bookedFlight->arrivalTime = $jFlight->arrivalTime;
        $jBookedUser->bookedFlight->totalTime = $jFlight->totalTime;
        $jBookedUser->bookedFlight->price = $jFlight->price;
        $jBookedUser->bookedFlight->currency = $jFlight->currency;
        $jBookedUser->bookedFlight->from = $jFlight->from;
        $jBookedUser->bookedFlight->to = $jFlight->to;
    }
}

array_push($jBookingData, $jBookedUser);

$sBookingData = json_encode($jBookingData, JSON_PRETTY_PRINT);

file_put_contents('../booked-flights.json', $sBookingData);

//##################### SMS ########################

$sToPhone = '20662811';
$sFromPhone = '20662811';
$sApiKey = 'ewLYZGjAAy2kp8q19fcXs6Ex2x3VAORayPZuSA5TSdXcwvOGth';
$sMsg = urlencode('Thank you for booking a flight to: ' . $jBookedUser->bookedFlight->to . ' Your booking code is: '. $jBookedUser->bookingCode);

if(strlen($sMsg) > 100){
    echo 'Airline message is too long';
    exit();
}
echo file_get_contents("https://fatsms.com/apis/api-send-sms?to-phone=$sToPhone&message=$sMsg&from-phone=$sFromPhone&api-key=$sApiKey");

//##################### EMAIL ########################

$sPassword = file_get_contents('../private/password.txt');

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

$sId = $jBookedUser->bookingId;
$sCode = $jBookedUser->bookingCode;
$loginLink = "http://127.0.0.1/momondo-v11/booking-login.php";
$message = '<p>You can login with your last name and this booking code: <b>'.$sCode.'</b></p> <a href="'.$loginLink.'">Click here to here to see your booking information</a> ';

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
    $mail->Subject = "Booking information";
    $mail->Body    = "Thank you for booking with us. " . $message;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}