<?php 
$flightId = $_GET['id'];
$sData = file_get_contents("http://localhost/momondo-v1/data/flights.json");
$jData = json_decode($sData);
foreach($jData as $index=>$flight) {
    if($flight->id == $flightId){
        array_splice($jData,$index,1);
        break;
    }   
}
$sData = json_encode($jData, JSON_PRETTY_PRINT);
echo $sData;
file_put_contents('../data/flights.json', $sData);

header("Location: http://localhost/momondo-v1/admin.php");