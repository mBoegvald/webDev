<?php
    // To start using sessions/cookies 
    require_once('has-access.php');
    $sAdminEmail = $_SESSION['sEmail'];

    $sData = file_get_contents('data.json');
    $jData = json_decode($sData);
    $sFlightsDivs = '';

    foreach($jData as $jFlights) {
        $sFlightsDivs .= 
        "<div id='flight'>
            <div id='flightRoute'>";
        foreach($jFlights->schedule as $jFlight) {

            $init = $jFlight->totalTime;
            $hours = floor($init / 3600);
            $minutes = floor(($init / 60) % 60);
            $seconds = $init % 60;
            $totalTime = $hours.'h. '.$minutes.'min.';

            $sDepartureDate = date("d-M-Y H:i", substr("$jFlight->departureTime", 0, 10));
            $sFlightsDivs .= 
           "<div class='row'>
                <div>
                    <input type='checkbox'>
                </div>
                <div>
                    <img class='airline-icon' src='icons/$jFlight->companyShortcut.png'>
                </div>
                <div>
                    $sDepartureDate
                    <p>$jFlight->companyShortcut</p>              
                </div>
                <div>";
                    if (sizeof($jFlights->schedule) == 1) {
                    $sFlightsDivs .= "Direct";
                  } else {
                    $sFlightsDivs .= "1 stop
                    <p>$jFlight->to</p>";
                  };
                    $sFlightsDivs .=  "</div>
                    <div>
                    $totalTime
                    <p>$jFlight->fromShortcut - $jFlight->toShortcut</p>
                    </div> 
                    </div> 
                  ";
                }
                $sFlightsDivs .=
                "</div>
                <div id='adminPanel'>
                    <a class='editFlight' href='api/api-update-flight.php?id=$jFlights->id' id='editFlight'>EDIT FLIGHT</a>
                    <a class='deleteFlight' href='api/api-delete-flight.php?id=$jFlights->id' id='deleteFlight'>DELETE</a>
                </div>
            </div>";
    }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app.css">
    <title>ADMIN</title>
</head>
<body>
<?php
  require_once('nav.php');
  require_once('searchFlights.php');
  ?>

    <section id="adminPage">
        <h1>Welcome admin, <?= $sAdminEmail ?></h1>
        <a href="logout.php">LOGOUT</a>
        <a href="add-flight.php">ADD FLIGHT</a>
    </section>

    <main id="adminGetFlights">
        <div id="flights">
        <?= $sFlightsDivs; ?>
        </div>
    </main>
</body>
</html>