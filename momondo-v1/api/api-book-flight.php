<?php
require_once('validate.php');
if (!isStringValid($_POST['txtFirstname'], 2, 50) || !isStringValid($_POST['txtLastname'], 2, 50) || !filter_var($_POST['txtEmail'], FILTER_VALIDATE_EMAIL)){
    echo 'Name or email not correct';
    exit();
}

http_response_code(200);
header('Content-Type: application/json');

$sBookings = file_get_contents('../data/bookings.json');
$jBookings = json_decode($sBookings);

// Create user

$sFirstname = $_POST['txtFirstname'];
$sLastname = $_POST['txtLastname'];
$sEmail = $_POST['txtEmail'];

$jUser = new stdClass();
$jUser->bookingId = bin2hex(random_bytes(16));
$jUser->userFirstname = $sFirstname;
$jUser->userLastname = $sLastname;
$jUser->userEmail = $sEmail;

// Get flight data
$flightId = $_GET['id'];

$sFlightData = file_get_contents('../data/most-popular-flights.json');
$jFlightData = json_decode($sFlightData);

foreach($jFlightData as $jFlight) {
    if($jFlight->id == $flightId) {
        $jUser->bookings = new stdClass();
        $jUser->bookings->id = $jFlight->id;
        $jUser->bookings->flightId = $jFlight->flightId;
        $jUser->bookings->from = $jFlight->from;
        $jUser->bookings->fromShortcut = $jFlight->fromShortcut;
        $jUser->bookings->to = $jFlight->to;
        $jUser->bookings->toShortcut = $jFlight->toShortcut;
        $jUser->bookings->companyName = $jFlight->companyName;
        $jUser->bookings->companyShortcut = $jFlight->companyShortcut;
        $jUser->bookings->departureTime = $jFlight->departureTime;
        $jUser->bookings->arrivalTime = $jFlight->arrivalTime;
        $jUser->bookings->price = $jFlight->price;
        $jUser->bookings->currency = $jFlight->currency;
        $from = $jFlight->from;
        $to = $jFlight->to;
        $departureTime = date("d-M-Y H:i", substr($jFlight->departureTime, 0, 10));

    }
} 
// Save changes
array_push($jBookings->users, $jUser);

$sBookings = json_encode($jBookings, JSON_PRETTY_PRINT);
echo $sBookings;
file_put_contents('../data/bookings.json', $sBookings);

// Send email and SMS

$sSubject = "Thank you for your purchase";
$sEmailMessage = "Hi $sFirstname $sLastname,
<br> 
this email is sent to confirm your purchase of flighttickets from $from to $to. 
<br>
Departure time: $departureTime";

$smsMessage = "Hi $sFirstname $sLastname,
<br> 
Confirmation of purchase. 
Flight from $from to $to.";

require_once('../api/api-send-mail.php');
require_once('../api/api-send-sms.php');
