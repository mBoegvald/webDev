<?php
$sData = file_get_contents('most-popular-flights.json');
$jData = json_decode($sData);
$sFlightsDivs = '';
foreach($jData as $jFlight){
  $totalTimeFast = $totalTimeFast ?? $jFlight->totalTime;
  if($jFlight->totalTime < $totalTimeFast){
    $duration = $jFlight->totalTime;
    $hours    = (int)($duration / 60);
    $minutes  = $duration - ($hours * 60);
    $totalTimeFast = $hours . 'h.' . $minutes . 'min.';
  }
  $duration = $jFlight->totalTime;
  $hours    = (int)($duration / 60);
  $minutes  = $duration - ($hours * 60);
  $totalTime = $hours . 'h. ' . $minutes . 'min.';
 
  $iCheapestPrice = $iCheapestPrice ?? $jFlight->price;
  if($jFlight->price < $iCheapestPrice){
    $iCheapestPrice = $jFlight->price . $jFlight->currency;
  }
  $sDepatureDate =  date("H:i", substr($jFlight->departureTime, 0, 10));
  $sArrivalDate =  date("H:i", substr($jFlight->arrivalTime, 0, 10));

  // Data to send to modal
  $sFlight = json_encode($jFlight);
  

  $sFlightsDivs .= "
    <div id='flight'>
    <div id='flight-route'>
      <div class='row'>
        <div class='checkbox-container'>
          <input type='checkbox'>
        </div>
        <div>
          <img class='airline-icon' src='icons/$jFlight->companyShortcut.png'>
        </div>
        <div>
          <b>$sDepatureDate</b>
          <p>$jFlight->flightId</p>              
        </div>
        <div>
        <p><b>$jFlight->from</b></p>
        Route
        </div>
        <div>
          <b>$totalTime</b>
          <p>$jFlight->companyName</p>
        </div>
      </div>
      <div class='row'>
      <div class='checkbox-container'>
          <input type='checkbox'>
        </div>
        <div>
          <img class='airline-icon' 
          src='icons/$jFlight->companyShortcut.png'>
        </div>
        <div>
        <b>$sArrivalDate</b>
        <p>$jFlight->flightId</p>           
        </div>
        <div>
        <p><b>$jFlight->to</b></p>
          Route
        </div>
        <div>
          <b>$totalTime</b>
          <p>$jFlight->companyName</p>
        </div>
      </div>            
    </div>
    <div id='flight-buy'>
      <div>
        $jFlight->price $jFlight->currency
      </div>
      <button onclick='openModal($sFlight)'>Buy ticket</button>
    </div>
  </div>
  ";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles/app.css">
  <title>MOMONDO</title>
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

  <section id="search">
    <div id="fromCityContainer">
    <input id="fromCityInput" oninput="getFromCities()" type="text" placeholder="from city">
    <div id="fromCityResults"></div>
    </div>
    <button>&lt;- -&gt;</button>
    <div id="ToCityContainer">
      <input id="toCityInput" type="text" oninput="getToCities()" placeholder="to city">
      <div id="ToCityResults"></div>
    </div>
    <input type="text" placeholder="from date">
    <input type="text" placeholder="to date">
    <button onclick="displaySearchedFlights()" id="btnSearch">SEARCH</button>
  </section>

  <section id="temporal">
    <img src="temporal.png">
  </section>

  <main>
    <div id="options">OPTIONS</div>
    <div id="results">

      <div id="price-options">
        <div id="cheapest">
          Cheapest
          <p>
            <span class="price">
              <?= $iCheapestPrice ?>
            </span>
            <span class="time">19h. 37min.</span>
          </p>
        </div>
        <div id="best" class="active">
          Best
          <p>
            <span class="price"><?= $iCheapestPrice ?></span>
            <span class="time"><?= $totalTimeFast ?></span>
          </p>
        </div>
        <div id="fastest">
          Fastest
          <p>
            <span class="price">4.956 kr</span>
            <span class="time"><?= $totalTimeFast ?></span>
          </p>
        </div>
        <div>
          Custom
          <p>compare and choose</p>
        </div>
      </div>

      <div id="flights">  
        <?= $sFlightsDivs ?>
      </div>



    </div>
  </main>
<div id="modal-overlay"></div>
<div id="modal">
  <!-- <div id="modal-close-btn" onclick="closeModal()">x</div>
  <h3>Flight Details</h3>
    <div id="flight-info">
    <div class='modal-row'>
        <div>
          <img class='airline-icon' src='icons/AF.png'>
        </div>
        <div>
          <b>19.45</b>
          <p>KLM88</p>              
        </div>
        <div>
        <p><b>London</b></p>
        Route
        </div>
        <div>
          <b>2h. 30min.</b>
          <p>Air France</p>
        </div>
    </div>
    <div class='modal-row'>
        <div>
          <img class='airline-icon' src='icons/AF.png'>
        </div>
        <div>
          <b>19.45</b>
          <p>KLM88</p>              
        </div>
        <div>
        <p><b>London</b></p>
        Route
        </div>
        <div>
          <b>2h. 30min.</b>
          <p>Air France</p>
        </div>
    </div>
    <div id='flight-buy'>
      <h3>Book your flight</h3>
      <form id="bookingForm" action="" method="POST">
      <div id="user-name-container">
        <label for="user-name">Enter name
        <input name="user-name" type="text" placeholder="Name">
        </label>
        <label for="user-lastName">Enter last name
        <input name="user-lastName" type="text" placeholder="Last name">
        </label>
      </div>
      <label for="user-email">Enter email</label>
      <input name="user-email" type="text" placeholder="Email">
      <button onclick='buyTicket()'>Buy ticket</button>
      </form>
    </div>
  </div> -->
</div>
<script src="js/app.js"></script>
</body>
</html>