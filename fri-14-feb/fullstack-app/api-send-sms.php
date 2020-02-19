<?php
if(!isset($_POST['txtFlightId']) || !strlen($_POST['txtFlightId']) == 5) {
    echo 'Flight Id must be 5 characters';
    exit();
}
if(!isset($_POST['txtFlightFrom']) || strlen($_POST['txtFlightFrom']) < 2) {
    echo 'From must be more than 2 characters';
    exit();
}
if(!isset($_POST['txtFlightTo']) || !strlen($_POST['txtFlightTo']) > 2) {
    echo 'To must be more than 2 characters';
    exit();
}

$sFromPhone = '27890855';
$sToPhone = '27890855';
$sFlightId = $_POST['txtFlightId'];
$sMessage = urlencode('Flight from '.$sFlightFrom.' to '.$sFlightTo.' with ID: '.$sFlightId.' has been saved.');
$sApiKey = 'RHAOlEf4kovRo49blDmfvAWbisMMBmSeuY7tQQy9lKKUpuiqHp';
if(strlen($sMessage)>100) {
    echo "Flight info is too long!";
    exit();
}
echo file_get_contents("https://fatsms.com/apis/api-send-sms?to-phone=27890855&message=$sMessage&from-phone=27890855&api-key=RHAOlEf4kovRo49blDmfvAWbisMMBmSeuY7tQQy9lKKUpuiqHp");