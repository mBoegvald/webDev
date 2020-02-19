<?php
$sKey = $_GET['key'];

// Connect to DB

$sData = file_get_contents('data.json');
$jData = json_decode($sData);

if ($sKey == $jData->key) {
    $jData->verified = 1;
    $sData = json_encode($jData, JSON_PRETTY_PRINT);
    file_put_contents('data.json', $sData);
    echo "User Verified";
    exit();
}
echo "ERROR - Can't verify";
