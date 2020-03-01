<?php

   header('Content-type: application/json');
   $sFlightPrice = $_POST["price"];
   $sFlightFrom = $_POST["from-city"];
   $sFlightFromShortcut = $_POST["from-city-shortcut"];
   $sFlightTo = $_POST["to-city"];
   $sFlightToShortcut = $_POST["to-city-shortcut"];
   $sFlightCompanyName = $_POST["company-name"];
   $sFlightComapnyShortcut = $_POST["company-shortcut"];
   $sFlightDepartureDate = $_POST["departure-date"];
   $sFlightArrivalDate = $_POST["arrival-date"];
   $sFlightFlightTime = $_POST["flight-time"];
   $sFlightId = $_POST['flight-id'];
   $sCurrency = $_POST['currency'];
   $popularFlight = $_POST['popular-flight'];
   
    $sData = file_get_contents('../data.json');
    $jData = json_decode($sData);

    $sPopularFlight = file_get_contents('../most-popular-flight.json');
    $jPopularFlight = json_decode($sPopularFlight);
    
    $jFlight = new stdClass(); // Create a flight object
    $jFlight->id = uniqid();
    $jFlight->price = (int)$sFlightPrice;
    $jFlight->currency = $sCurrency;
    $jFlight->schedule = []; // Creating the schedule array


    $jFlightInfo = new stdClass(); // Creating a object to push into the array schedule
    $jFlight->schedule[] = $jFlightInfo;
    $jFlightInfo->flightId = $sFlightId;
    $jFlightInfo->from = $sFlightFrom;
    $jFlightInfo->fromShortcut = $sFlightFromShortcut;
    $jFlightInfo->to = $sFlightTo;
    $jFlightInfo->toShortcut = $sFlightToShortcut;
    $jFlightInfo->companyName = $sFlightCompanyName;
    $jFlightInfo->companyShortcut = $sFlightComapnyShortcut;
    $jFlightInfo->departureTime = (int)$sFlightDepartureDate;
    $jFlightInfo->arrivalTime = (int)$sFlightArrivalDate;
    $jFlightInfo->totalTime = (int)$sFlightFlightTime;

   if ($popularFlight == null) {
      array_push($jData, $jFlight);
      
      $sData = json_encode($jData, JSON_PRETTY_PRINT);
      file_put_contents('../data.json', $sData);
   }
   if ($popularFlight == "on") {
      array_push($jPopularFlight, $jFlight);
      $sPopularFlight = json_encode($jPopularFlight, JSON_PRETTY_PRINT);
      file_put_contents('../most-popular-flight.json', $sPopularFlight);
   }
   
    header('Location: ../admin.php');
    exit();