<?php 

$from = "27890855";
$to = "27890855";
$message = urlencode($_GET['message']);
$apiKey = "RHAOlEf4kovRo49blDmfvAWbisMMBmSeuY7tQQy9lKKUpuiqHp";


$params = $from.'&'.$to.'&'.$message.'&'.$apiKey;

$sData = file_get_contents('https://fatsms.com/apis/api-send-sms?to-phone='.$to.'&message='.$message.'&api-key='.$apiKey.'&from-phone='.$from);

echo $sData;
