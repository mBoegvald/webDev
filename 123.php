<?php 
// $myVar = [];
// $myVar["name"] = "Miklas";

// $myVar = new stdClass();
// $myVar->name = "Miklas"; 

// $myVar = "{}";

// $myVar = json_decode($myVar);
// $myVar->name = "Miklas";
// echo json_encode($myVar);

$name = $_GET['id'];
echo json_encode($name);
?>
