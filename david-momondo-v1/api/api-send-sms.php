<?php

$sFromPhone = '40777610';
$sToPhone  = '40777610';
$sApiKey = 'Mt9dagKmcMDmfjrjLe9yhmxHJ9exfrY6EA1twiPiXlSZRY5x9u';
if( strlen($sMessage) > 100 ){
  echo 'Message is too long';
  exit();
}

echo file_get_contents("https://fatsms.com/apis/api-send-sms?to-phone=40777610&message=$sPhoneMessage&from-phone=40777610&api-key=Mt9dagKmcMDmfjrjLe9yhmxHJ9exfrY6EA1twiPiXlSZRY5x9u");

