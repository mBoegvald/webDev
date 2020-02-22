<?php 
header("Content-Type: application/json");
http_response_code(200);

// $aFromCities = ["a","b","c"];

$sSearchFor = $_GET['cityName'];
$sData = file_get_contents("http://localhost/momondo-v1/data/city-names.json");
$jData = json_decode($sData);

$jResponse = new stdClass();
$jResponse->cities = [];

foreach($jData as $jCity){
  if(stripos($jCity,$sSearchFor) !== false){
    $jResponse->cities[] = $jCity;
  }
}
echo json_encode($jResponse);

// echo json_encode($aFromCities);