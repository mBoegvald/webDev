<?php 
$userId = $_GET['id'];
$sData = file_get_contents("data.json");
$jData = json_decode($sData);
foreach($jData->users as $index=>$user) {
    if($user->id == $userId){
        array_splice($jData->users,$index,1);
        break;
    }   
}
$sData = json_encode($jData);
echo $sData;
file_put_contents('data.json', $sData);

header("Location: users.php");