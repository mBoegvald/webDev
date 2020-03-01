<?php
// Get data from data.json
http_response_code(200);
header('Content-Type: application/json');
$sSearchFor = $_GET['toCityName'];
$sData = file_get_contents('../data.json');
$jData = json_decode($sData);
$jResponse = new stdClass(); // {}
$jResponse->flyingToCities = [];

// Searching for cities using the letters the user typed in the input field (to City)
foreach($jData as $jCity){
    foreach($jCity->schedule as $flyingTo) {
        if( stripos($flyingTo->to, $sSearchFor) !== false ){
            //echo json_encode($flyingTo->to);
            $jResponse->flyingToCities[] = $flyingTo;
         }
    }
}

echo json_encode($jResponse);