<?php

$sFromPhone = '27890855';
$sToPhone = '27890855';
$smsMessage = urlencode($smsMessage);
$sApiKey = 'RHAOlEf4kovRo49blDmfvAWbisMMBmSeuY7tQQy9lKKUpuiqHp';

echo file_get_contents("https://fatsms.com/apis/api-send-sms?to-phone=$sToPhone&message=$smsMessage&from-phone=$sFromPhone&api-key=$sApiKey");