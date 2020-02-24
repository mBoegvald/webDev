<?php

// OPTION 3

// $sData = "{}";

// $jData = json_decode($sData);

// $jData->name = "A";
// $jData->lastName = "B";
// $jData->lastName = "X";

// unset($jData->name);

// echo json_encode($jData);



// OPTION 2

// $jData = new stdClass(); // JSON object

// $jData->name = "A"; 

// $jData->lastName = "B";

// $jData->name = "X";

// unset($jData->name);

// echo json_encode($jData);





//OPTION 1
 
// $jData = ["from"=>[
//     ["name"=>"A"],
//     ["name"=>"B"]
// ]];

// Add object

// $jTest = [];
// $jTest["name"] = "A";
// $jTest["lastName"] = "B";

// $jTest["name"] = "C";


// unset($jTest["name"]);

// echo json_encode($jTest);


// echo json_encode($jData);