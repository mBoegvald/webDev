<?php
// Open/Read file
$sData = file_get_contents('../most-popular-flights.json');

$jData = json_decode($sData);
// CREATE A FLIGHT JSON OBJECT
$jFlight = new stdClass();
//Create a key value pairs for object
$jFlight->id = bin2hex(random_bytes(16)); 
$jFlight->flightId = $_POST["flight-id"];
$jFlight->companyName = $_POST["flight-name"];
$jFlight->companyShortcut = $_POST["flight-shortcut"];
$jFlight->departureTime = strtotime($_POST["departure-time"]); // Convert to epoch
$jFlight->arrivalTime = strtotime($_POST["arrival-time"]); // Convert to epoch
$jFlight->totalTime = $_POST["total-time"];
$jFlight->price = $_POST["price"];
$jFlight->currency = 'DKK';
$jFlight->from = $_POST["flight-from"];
$jFlight->to = $_POST["flight-to"];
$jFlight->pilot = new stdClass();
$jFlight->pilot->name = $_POST["flight-pilot"];

// Add to array.
array_push($jData, $jFlight);

// Write back to the file
$sData = json_encode($jData, JSON_PRETTY_PRINT);
echo $sData;
// Save flight to file
file_put_contents('../most-popular-flights.json', $sData);

// Redirect
header('Location: ../admin.php');