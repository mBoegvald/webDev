<?php 

header("Content-Type: application/json");
http_response_code(200);

$sSearchFor = $_GET['cityName'];
$sData = file_get_contents("data.json");
$jData = json_decode($sData);

$jResponse = new stdClass();
$jResponse->cities = [];

foreach($jData->cities as $jCity){
  if(stripos($jCity->name,$sSearchFor) !== false){
    $jResponse->cities[] = $jCity;
  }
}
echo json_encode($jResponse);