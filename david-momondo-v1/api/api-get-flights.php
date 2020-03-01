<?php
// Get data from data.json
http_response_code(200);
header('Content-Type: application/json');
$sSearchFrom = $_GET['fromCityName'];
$sSearchTo = $_GET['toCityName'];
$sData = file_get_contents('http://localhost/momondo-v1/data.json');
$jData = json_decode($sData); 
echo json_encode($jData, JSON_PRETTY_PRINT);