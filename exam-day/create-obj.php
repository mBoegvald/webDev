<?php 

// $var = [];
// $var["name"] = "Miklas";


$var = new stdClass();
$var->name = "Miklas";
$var->movies = [];
$var->movies[] = "movie 1";
$var->movies[] = "movie 2";


echo json_encode($var);