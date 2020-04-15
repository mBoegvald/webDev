<?php 

$jPerson = new stdClass();
$jPerson->name = "Miklas";
$jPerson->age = 23;

$sPerson = json_encode($jPerson);
file_put_contents("person.json", $sPerson);