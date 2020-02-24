<?php 
header('Location: cities.php');

$cityID = bin2hex(random_bytes(16));
$cityName = $_POST["city-name"];
$cityAbbr = $_POST["city-abbr"];
$cityLng = $_POST["city-lng"];
$cityLat = $_POST["city-lat"];
$sData = file_get_contents("data.json");

$jData = json_decode($sData);

//JSON OBJECT

$jCity = new stdClass();
$jCity->id = $cityID;
$jCity->name = $cityName;
$jCity->abbr = $cityAbbr;
$jCity->lng = $cityLng;
$jCity->lat = $cityLat;

array_push($jData->cities, $jCity);

$sData = json_encode($jData, JSON_PRETTY_PRINT);
echo $sData;

file_put_contents('data.json', $sData);