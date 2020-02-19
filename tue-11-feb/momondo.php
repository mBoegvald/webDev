<?php
$sData = file_get_contents("http://localhost/tue-11-feb/sas.php");

$jData = json_decode($sData);
echo json_encode($jData);
