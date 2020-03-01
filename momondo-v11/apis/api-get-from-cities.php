<?php
http_response_code(200);
header('Content-Type: application/json');
$aFromCities = file_get_contents('../most-popular-flights.json');
echo $aFromCities;