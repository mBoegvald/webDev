<?php 



if(isset($_POST["id"]) && isset($_POST["companyName"]) && isset($_POST['companyShortcut'])
&& isset($_POST['departureTime']) && isset($_POST['arrivalTime']) 
&& isset($_POST['price']) && isset($_POST['currency'])) {

    $sData = file_get_contents('http://localhost/momondo-v1/data/most-popular-flights.json');
    $jData = json_decode($sData);   

    foreach($jData as $jFlight){
        if($jFlight->id == $_POST['id']){
            $jFlight->companyName = $_POST['companyName'];
            $jFlight->companyShortcut = $_POST['companyShortcut'];
            $jFlight->departureTime = $_POST['departureTime'];
            $jFlight->arrivalTime = $_POST['arrivalTime'];
            $jFlight->price = $_POST['price'];
            $jFlight->currency = $_POST['currency'];
        break;
        }
    }
    $sData = json_encode($jData, JSON_PRETTY_PRINT);
    file_put_contents('../data/most-popular-flights.json', $sData);
    echo $sData;
}