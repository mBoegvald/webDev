<?php
// How do we make momondo talk to sas?
// curl
// file_get_contents open a file
// file_get_contents open a URL
$sData = file_get_contents('http://localhost/momondo-v1/data/flights.json');
//{"status":1,"price":500}
$jData = json_decode($sData); 

// $jData->price *= 1.1;
// $jData->price = $jData->price * 1.1;
echo json_encode($jData);





