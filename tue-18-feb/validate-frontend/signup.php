<?php 
// $sName = $_POST['name'];
$iPrice = $_POST['price'];
require_once('validate.php');
// if(!isStringValid($sName, 2, 5)) {
//     echo 'error';
// }

if (!isIntegerValid($iPrice, 1, 99999)) {
    echo 'Price not correct';
}