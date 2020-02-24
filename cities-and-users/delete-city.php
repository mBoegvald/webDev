<?php 
$cityId = $_GET['id'];
$sData = file_get_contents("data.json");
$jData = json_decode($sData);
foreach($jData->cities as $index=>$city) {
    if($city->id == $cityId){
        array_splice($jData->cities,$index,1);
        break;
    }   
}
$sData = json_encode($jData);
echo $sData;
file_put_contents('data.json', $sData);

header("Location: cities.php");