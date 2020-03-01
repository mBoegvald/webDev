<?php
// GET id from admin.php
$flightId = $_GET['id'];
// Get data from json file
$sFlights = file_get_contents('../most-popular-flights.json');
// Decode from text to Json object
$jFlights = json_decode($sFlights);
// Loop through each flight and get index of each flight
foreach($jFlights as $index=>$flight){
if($flightId == $flight->id){   
    // Remove flight with that id
    array_splice($jFlights, $index, 1);
break;
}
}
// Encode back to text
$sFlights = json_encode($jFlights, JSON_PRETTY_PRINT);
// Replace data with new data
file_put_contents('../most-popular-flights.json', $sFlights);
// Go back to admin.php
header('Location: ../admin.php');