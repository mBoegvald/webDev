<?php
header("Content-Type: application/json");
http_response_code(200);

$sSearchFor = $_GET['cityName'];
$sFromOrTo = $_GET['fromOrTo'];

$sData = file_get_contents("http://localhost/momondo-v1/data/flights.json");

$jData = json_decode($sData);

$jResponse = new stdClass();
$jResponse = [];


foreach($jData as $jCity){
  if(stripos($jCity->$sFromOrTo,$sSearchFor) !== false){
    $jResponse[] = $jCity;
  }
}
echo json_encode($jResponse);