<?php 
header('Location: users.php');

$userID = bin2hex(random_bytes(16));
$userName = $_POST["user-name"];
$userAge = $_POST["user-age"];
$sData = file_get_contents("data.json");

$jData = json_decode($sData);

//JSON OBJECT

$jUser = new stdClass();
$jUser->id = $userID;
$jUser->name = $userName;
$jUser->age = $userAge;

array_push($jData->users, $jUser);

$sData = json_encode($jData, JSON_PRETTY_PRINT);
echo $sData;

file_put_contents('data.json', $sData);