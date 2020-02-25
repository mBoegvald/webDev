<?php
$sData = file_get_contents('http://localhost/momondo-v1/data/most-popular-flights.json');
$jData = json_decode($sData);
$sFlightDiv = '';


// Loop through most popular flights for landingpage. 


foreach($jData as $jFlight) {

    $jFlight->price = $jFlight->price/100;

    $jFlight->totalTime = $jFlight->arrivalTime - $jFlight->departureTime;


    $iCheapestPrice = $iCheapestPrice ?? $jFlight->price;
    $iCheapestTotalTime = $iCheapestTotalTime ?? $jFlight->totalTime;

    if( $jFlight->price < $iCheapestPrice ) {
        $iCheapestPrice = $jFlight->price;
        $iCheapestTotalTime = $jFlight->totalTime;
        
    }
  
    $iFastestPrice = $iFastestPrice ?? $jFlight->price;
    $iFastestTotalTime = $iFastestTotalTime ?? $jFlight->totalTime;

    if( $jFlight->totalTime < $iFastestTotalTime) {
        $iFastestPrice = $jFlight->price;
        $iFastestTotalTime = $jFlight->totalTime;
    }
}

$init = $iFastestTotalTime;
$hours = floor($init / 3600); 
$minutes = floor(($init / 60) % 60);
if($hours == 0) {
    $sFastestTotalTime = $minutes.'min.';
}else {
    $sFastestTotalTime = $hours.'h. '.$minutes.'min.';
}
$init = $iCheapestTotalTime;
$hours = floor($init / 3600); 
$minutes = floor(($init / 60) % 60);
if($hours == 0) {
     $sCheapestTotalTime = $minutes.'min.';
}else {
    $sCheapestTotalTime = $hours.'h. '.$minutes.'min.';
}
echo "$iFastestPrice kr. + $sFastestTotalTime";
echo $iCheapestPrice.' and '.$sCheapestTotalTime;

