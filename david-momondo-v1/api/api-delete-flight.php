<?php

    $flightId = $_GET['id'];
    $sData = file_get_contents('../data.json');
    $jData = json_decode($sData);

    foreach($jData as $index=>$jFlight) {
        if($flightId == $jFlight->id) {
            array_splice($jData, $index,1);
        break;
        }
    }

    $sData = json_encode($jData, JSON_PRETTY_PRINT);
    echo $sData;

    file_put_contents('../data.json',$sData);

    header('Location: ../admin.php');
