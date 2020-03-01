<?php

    http_response_code(200);
    header('Content-type: application/json');

    $sBookings = file_get_contents('../users.json');
    $jBookings = json_decode($sBookings);

    $sFirstname = $_POST['txtFirstname'];
    $sLastname = $_POST['txtLastname'];
    $sEmail = $_POST['txtEmail'];

    require_once('../validator.php');

    if(!isStringValid($sFirstname, 2, 20) || !filter_var($sEmail, FILTER_VALIDATE_EMAIL)) {
        echo 'Name or email is not correct';
        exit();
    }

    $jUser = new stdClass();
    $jUser->bookingId = bin2hex(random_bytes(16));
    $jUser->userFirstname = $sFirstname;
    $jUser->userLastname = $sLastname;
    $jUser->userEmail = $sEmail;

    // get id
    $flightId = $_GET['id'];

    echo $flightId;

    $sFlightData = file_get_contents('../data.json');
    $jFlightData = json_decode($sFlightData);

    foreach($jFlightData as $jFlights) {
        foreach($jFlights->schedule as $jFlight)
        if($flightId == $jFlights->id) {
            $jUser->bookings = new stdClass();
            $jUser->bookings->id = $jFlights->id;
            $jUser->bookings->flightId = $jFlight->flightId;
            $jUser->bookings->from = $jFlight->from;
            $jUser->bookings->fromShortcut = $jFlight->fromShortcut;
            $jUser->bookings->to = $jFlight->to;
            $jUser->bookings->toShortcut = $jFlight->toShortcut;
            $jUser->bookings->companyName = $jFlight->companyName;
            $jUser->bookings->companyShortcut = $jFlight->companyShortcut;
            $jUser->bookings->departureTime = $jFlight->departureTime;
            $jUser->bookings->arrivalTime = $jFlight->arrivalTime;
            $jUser->bookings->currency = $jFlights->currency;
            $jUser->bookings->price = $jFlights->price;
        }
    }

    array_push($jBookings->users, $jUser);
    $sBookings = json_encode($jBookings, JSON_PRETTY_PRINT);
    echo $sBookings;
    
    
    file_put_contents('../users.json', $sBookings);

    $sPassword = file_get_contents('../private/password.txt');
    $sSubject = "Thank you for your purchase";
    $sEmailMessage = "Thank you $sFirstname $sLastname for booking a flight.<br>
    See your flight information with following bookingcode: $jUser->bookingId and your lastname";

    $sPhoneMessage = urlencode("Thank you for booking a flight $sFirstname $sLastname");

    require_once('api-send-email.php');
  
   
    require_once('api-send-sms.php'); 
    // header('Location: ../index.php');
    // exit();

  