<?php

$jPerson = new stdClass();
$jPerson->name = "A";
$jPerson->lastName = "B";
foreach($jPerson as $sKeyName=>$value) {
    echo $value;
    echo $sKeyName;
}



// // Associative arrays
// $aPerson = ["name"=>"A","lastName"=>"B"];
// foreach($aPerson as $sKey=>$value) {
//     echo $sKey;
//     echo $value;
// }



// $aLetters = ['a','b','c'];

// foreach($aLetters as $index=>$sLetter) {
//     echo $index;
// }