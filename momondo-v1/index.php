<?php 
$sData = file_get_contents('most-popular-flights.json');
$jData = json_decode($sData);
$sFlightDiv = '';
foreach($jData as $jFlight) {
    $iCheapestPrice = $iCheapestPrice ?? $jFlight->price;
    $jFlight->price = $jFlight->price/100;
    if($iCheapestPrice > $jFlight->price) {
        $iCheapestPrice = $jFlight->price/100;
    }
    $sDepartureDate = date("d-M-Y H:i", substr($jFlight->departureTime, 0, 10));
    $init = $jFlight->totalTime;
    $hours = floor($init / 3600);
    $minutes = floor(($init / 60) % 60);
    $iTotalTime = $hours.'h. '.$minutes.'min.';

    $sFlightDiv .= "
        <div id='flight'>
            <div id='flightRoute'>
                <div class='row'>
                    <div>
                        <input type='checkbox'>
                    </div>
                    <div>
                        <img class='airlineIcon' src='icons/$jFlight->companyShortcut.png' alt=''>
                    </div>
                    <div>
                        $sDepartureDate
                        <p>$jFlight->companyName</p>
                    </div>
                    <div>
                        1 stop
                        <p>Amsterdam</p>
                    </div>
                    <div>
                        $iTotalTime
                        <p>CPH-MIA</p>
                    </div>
                </div>
                <div class='row'>
                    <div>
                        <input type='checkbox'>
                    </div>
                    <div>
                        <img class='airlineIcon' src='icons/SK.png' alt=''>
                    </div>
                    <div>
                        18:15 - 18:30
                        <p>KLM</p>
                    </div>
                    <div>
                        1 stop
                        <p>Amsterdam</p>
                    </div>
                    <div>10h. 20min.
                        <p>CPH-MIA</p>
                    </div>
                </div>
            </div>
            <div id='flightBuy'>
                <div>
                    $jFlight->price kr.
                </div>
                <button>Buy</button>
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
    <title>Momondo</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="app.css">
</head>
<body>
    <nav>
        <a href="" id="logo" class="active">Momondo</a>
        <a href="">Fly</a>
        <a href="">Hotel</a>
        <a href="">Car</a>
        <a href="">Trips</a>
        <a href="">Discover</a>
        <a href="">My trips</a>
        <a href="" class="active">Login</a>
    </nav>
    <section id="search">
        <div id="boxFromCity">
            <input oninput="getFromCities()" id="txtSearchFromCity" type="text" placeholder="From city"></input>
            <div id="fromCityResults">

            </div>
        </div>
        <button>&lt;- -&gt;</button>
        <input type="text" placeholder="To city"></input>
        <input type="text" placeholder="From date"></input>
        <input  type="text" placeholder="To date"></input>
        <button id="btnSearch">SEARCH</button>
    </section>
    <section id="temporal">
        <img src="screenshot.png" alt="">
    </section>
    <main>
        <div id="options">OPTIONS</div>
        <div id="results">
            <div id="priceOptions">
                <div id="cheapest">CHEAPEST
                    <p><span class="price"><?= $iCheapestPrice?></span> <span class="time">15t. 00min.</span></p>
                </div>
                <div id="best">BEST
                <p><span class="price"></span> <span class="time">15t. 00min.</span></p>
                </div>
                <div id="fastest">FASTEST
                <p><span class="price">2.761 kr.</span> <span class="time">15t. 00min.</span></p>
                </div>
                <div class="active">CHOOSE YOURSELF
                <p>Compare and choose</p>
                </div>
            </div>
            <div id="flights">
                <?= $sFlightDiv ?>
            </div>
        </div>
    </main>

    <script src="app.js"></script>
    <script>
        async function getFlights() {
        var connection = await fetch("api/api-get-flights.php");
        var jData = await connection.json();
        var aOrderedSchedule = [];

        for (var i = 0; i < jData.length; i++) {
          for (var n = 0; n < jData[i].schedule.length; n++) {
            aOrderedSchedule[jData[i].schedule[n].order] = jData[i].schedule;
          }
        }
        var sDivsWithStops = "";
        for (var i = 0; i < aOrderedSchedule.length; i++) {
            sDivsWithStops += `<b>Flight route</b>`;
            
            
          for (var n = 0; n < aOrderedSchedule[i].length; n++) {

            var sFromDate = new Date(0);
            sFromDate.setUTCSeconds(aOrderedSchedule[i][n].date);
            sFromDate = sFromDate.toLocaleString("da-DK");
            sDivsWithStops += `
            <div>
              <img class="airline-icon" src="icons/${aOrderedSchedule[i][n].airlineIcon}">
              <div>FROM: ${aOrderedSchedule[i][n].from}</div>
              <div>TO: ${aOrderedSchedule[i][n].to}</div>
              <div>ID: ${aOrderedSchedule[i][n].id}</div>
              <div>FLIGHTTIME: ${aOrderedSchedule[i][n].flightTime} min.</div>
              <div>DATE: ${sFromDate}</div><br>
            </div>`;
          }
            
          
          var jLastCity = aOrderedSchedule[aOrderedSchedule[i].length - 1];          
          var sTo = `<div>Arrives at city: ${jLastCity[i].to}</div>`;
          sDivsWithStops += `${sTo}`;
        }
        document.getElementById("results").innerHTML = sDivsWithStops;
      }
    //   getFlights();
    </script>
</body>
</html>