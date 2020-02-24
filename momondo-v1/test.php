<?php
$sData = file_get_contents('http://localhost/momondo-v1/data/most-popular-flights.json');
$jData = json_decode($sData);
$sFlightsDivs = '';



foreach($jData as $jFlight){

  // Divide price by 100
  $jFlight->price = $jFlight->price/100;

  // if the value is not set $iCheapestPrice = $jFlight->price
  $iCheapestPrice = $iCheapestPrice ?? $jFlight->price;

  if($jFlight->price < $iCheapestPrice){
    $iCheapestPrice = $jFlight->price/100;
  }

  $iFastestFlight = $iFastestFlight ?? $jFlight->totalTime;
  if($jFlight->totalTime < $iFastestFlight) {
    $iFastestFlight = $jFlight->totalTime;
  }

  $sDepartureDate = date("Y-M-d H:i", substr("$jFlight->departureTime", 0, 10));
 
  $init = $jFlight->totalTime;
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
          <img class='airline-icon' src='icons/$jFlight->companyShortcut.png'>
        </div>
        <div>
        $sDepartureDate
          <p>$jFlight->companyShortcut</p>              
        </div>
        <div>
          1 stop
          <p>Amsterdam</p>
        </div>
        <div>
          $totalTime
          <p>CPH-MIA</p>
        </div>
      </div>     
    </div>
    <div id='flightBuy'>
      <div>
        $jFlight->price kr
      </div>
      <button>BUY</button>
    </div>
  </div>
  ";
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
