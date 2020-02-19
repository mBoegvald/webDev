<?php
if(!isset($_POST['txtAirlineName']) || strlen($_POST['txtAirlineName']) < 2) {
    echo 'Airline name must be at least 2 characters';
    exit();
}
$sFromPhone = '27890855';
$sToPhone = '27890855';
$sAirlineName = $_POST['txtAirlineName'];
$sMessage = urlencode('Thank you for flying with '.$sAirlineName);
$sApiKey = 'RHAOlEf4kovRo49blDmfvAWbisMMBmSeuY7tQQy9lKKUpuiqHp';
if(strlen($sMessage)>100) {
    echo "Airline name too long!";
    exit();
}
echo file_get_contents("https://fatsms.com/apis/api-send-sms?to-phone=27890855&message=$sMessage&from-phone=27890855&api-key=RHAOlEf4kovRo49blDmfvAWbisMMBmSeuY7tQQy9lKKUpuiqHp");