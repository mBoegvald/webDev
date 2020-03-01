<?php
// Get data from data.json
http_response_code(200);
header('Content-Type: application/json');
$sSearchFor = $_GET['fromCityName'];
$sData = file_get_contents('../data.json');
$jData = json_decode($sData);
$jResponse = new stdClass(); // {}
$jResponse->flyingFromCities = [];

// Searching for cities using the letters the user typed in the input field (from City)
foreach($jData as $jCity){
    foreach($jCity->schedule as $flyingFrom) {
        if( stripos($flyingFrom->from, $sSearchFor) !== false){
            $jResponse->flyingFromCities[] = $flyingFrom;
        }
    }
}

echo json_encode($jResponse, JSON_PRETTY_PRINT);

