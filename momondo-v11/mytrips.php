<?php
    session_start();
    if(!isset($_SESSION['txtLastName'])) {
        header('Location: booking-login.php');
        exit();
    }
    $sUserLastName = $_SESSION['txtLastName'];
    $sUserBookingCode = $_SESSION['txtBookingCode'];
    $sBookingDiv = '';

    $sData = file_get_contents('booked-flights.json');
    $jData = json_decode($sData);
    foreach($jData as $jUser){
        if($jUser->bookingCode == $sUserBookingCode){
            $jFlight = $jUser->bookedFlight;

            $duration = $jFlight->totalTime;
            $hours    = (int)($duration / 60);
            $minutes  = $duration - ($hours * 60);
            $totalTime = $hours . 'h. ' . $minutes . 'min.';

            $sDepatureDate =  date("H:i", substr($jFlight->departureTime, 0, 10));
            $sArrivalDate =  date("H:i", substr($jFlight->arrivalTime, 0, 10));

                $sBookingDiv .= "
                <div id='booking-container'>
                <div id='booking-info'>
                    <div>
                        <p style='text-align: center;'><b>Price:</b></p>
                        <p>$jFlight->price $jFlight->currency</p>
                    </div>
                    <div>
                        <p style='text-align: center;'><b>Total time:</b></p>
                        <p>$totalTime</p>
                    </div>
                </div>
                <div id='booking-list'>
                    <div class='airline-icon-container'>
                                <img class='airline-icon' src='icons/$jFlight->companyShortcut.png'>
                    </div>
                    <div class='info-container'>
                                <div>
                                    <b>Departure date:</b>
                                    <p style='text-align: center;'>$sDepatureDate</p>              
                                </div>
                                <div>
                                    <p><b>Leaving from: </b></p>
                                    <p style='text-align: center;'>$jFlight->from</p>
                                </div>
                                <div>
                                    <b>Company: </b>
                                    <p style='text-align: center;'>$jFlight->companyName</p>
                                </div>
                        </div>
                    </div>
                <div id='booking-list'>
                    <div class='airline-icon-container'>
                                <img class='airline-icon' src='icons/$jFlight->companyShortcut.png'>
                    </div>
                    <div class='info-container'>
                                <div>
                                    <b>Arrival date:</b>
                                    <p style='text-align: center;'>$sArrivalDate</p>              
                                </div>
                                <div>
                                    <p><b>Arriving to: </b></p>
                                    <p style='text-align: center;'>$jFlight->to</p>
                                </div>
                                <div>
                                    <b>Company: </b>
                                    <p style='text-align: center;'>$jFlight->companyName</p>
                                </div>
                        </div>
                    </div>
                </div>
            ";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles/app.css">
  <title>My Trips</title>
</head>
<body>
<nav>
    <a class="active" href="index.php" id="logo">
      <img src="momondo-logo.png" alt="Momondo">
    </a>
    <a href="">fly</a>
    <a href="">hotel</a>
    <a href="">car</a>
    <a href="">trips</a>
    <a href="">discover</a>
    <a href="mytrips.php">my trips</a>
    <a href="admin.php">Admin</a>
    <a href="login.php">login</a>
</nav>
<h1 id="loginTitle">My trips</h1>
<div id="booking-wrapper">
    <?= $sBookingDiv ?>
</div>

<div id="logoutLink">
    <a href="logout.php">Logout</a>
</div>

<?php
$sInjectJavascript = 'mytrips';
require_once('components/footer.php');
?>