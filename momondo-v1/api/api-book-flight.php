<?php 
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
        $jUser->bookings->companyName = $jFlight->companyName;
        $jUser->bookings->companyShortcut = $jFlight->companyShortcut;
        $jUser->bookings->departureTime = $jFlight->departureTime;
        $jUser->bookings->arrivalTime = $jFlight->arrivalTime;
        $jUser->bookings->price = $jFlight->price;
        $jUser->bookings->currency = $jFlight->currency;
    }
}
array_push($jBookings->users, $jUser);

$sBookings = json_encode($jBookings, JSON_PRETTY_PRINT);
echo $sBookings;

file_put_contents('../data/bookings.json', $sBookings);

