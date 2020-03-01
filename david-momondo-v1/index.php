<?php
$sData = file_get_contents('most-popular-flight.json');
$jData = json_decode($sData);
$sFlightsDivs = '';
foreach($jData as $jFlight){
  foreach($jFlight->schedule as $jPopularFlight) {
  $iCheapestPrice = $iCheapestPrice ?? $jFlight->price;
  if($jFlight->price < $iCheapestPrice){
    $iCheapestPrice = $jFlight->price;
  }

  $sDepartureDate = date("d-M-Y H:i", substr("$jPopularFlight->departureTime", 0, 10));
  
  $init = $jPopularFlight->totalTime;
  $hours = floor($init / 3600);
  $minutes = floor(($init / 60) % 60);
  $seconds = $init % 60;
  $totalTime = $hours.'h. '.$minutes.'min.';

  $sFlightsDivs .= "
    <div id='flight'>
    <div id='flightRoute'>
      <div class='row'>
        <div>
          <input type='checkbox'>
        </div>
        <div>
          <img class='airline-icon' src='icons/$jPopularFlight->companyShortcut.png'>
        </div>
        <div>
        $sDepartureDate
          <p>$jPopularFlight->companyShortcut</p>              
        </div>
        <div>
          ";
            if (sizeof($jFlight->schedule) == 1) {
                $sFlightsDivs .= "Direct";
            } else {
                $sFlightsDivs .= "1 stop
                <p>$jFlight->to</p>";
            };
                $sFlightsDivs .=  "
        </div>
        <div>
          $totalTime
          <p>$jPopularFlight->fromShortcut - $jPopularFlight->toShortcut</p>
        </div>
      </div>     
    </div>
    <div id='flightBuy'>
      <div>
        $jFlight->price $jFlight->currency
      </div>
      <button id='$jFlight->id' onclick='checkFlightId(event)'>BUY</button>
    </div>
  </div>
  ";
}
}?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="app.css" />
    <title>Momondo</title>
  </head>
  <body>
    <?php
  require_once('nav.php');
  require_once('searchFlights.php');
  ?>
   <section id="temporal">
      <img src="diagram.png" />
    </section>
    <main>
      <div id="options">OPTIONS</div>
      <div id="results">
        <div id="priceOptions">
          <div id="cheapest">Cheapest<p> <span class="price"><?= $iCheapestPrice?>kr</span> <span class="time">8t. 52min.</span> </p></div>
          <div id="best" class="active">Best <p> <span class="price">1.554 kr</span> <span class="time">8t. 52min.</span></p></div>
          <div id="fastest">Fastest <p> <span class="price">1.554 kr</span> <span class="time">8t. 52min.</span></p></div>
          <div>Custom <p>Compare and choose</p></div>
        </div>
        <div id="flights">
            <?= $sFlightsDivs; ?>
        </div>
      </div>
      <?php
        require_once('buy-ticket-modal.html');
      ?>
    </main>

    <script src="app.js"></script>
  </body>
</html>
