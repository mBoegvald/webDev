<?php
// OPTION 1

$array = [];
$array["name"] = "Miklas";
$array["age"] = 23;

$sArray = json_encode($array);
echo $sArray;

$secondArray = [];

// OPTION 2

$jData = new stdClass(); // JSON object

$jData->name = "A"; 

$jData->lastName = "B";

$jData->name = "X";

unset($jData->name);

echo json_encode($jData);

// OPTION 3

$sData = "{}";

$jData = json_decode($sData);

$jData->name = "A";
$jData->lastName = "B";
$jData->lastName = "X";

unset($jData->name);

echo json_encode($jData);