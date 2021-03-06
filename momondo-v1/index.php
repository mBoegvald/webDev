<?php 
$sData = file_get_contents('http://localhost/momondo-v1/data/flights.json');
$jData = json_decode($sData);
$sFlightDiv = '';


// Loop through most popular flights for landingpage. 


foreach($jData as $jFlight) {

    // Convert data
    // 
    // 
    // Divide price by 100
    $jFlight->price = $jFlight->price/100;

    // Get total time
    $jFlight->totalTime = $jFlight->arrivalTime - $jFlight->departureTime;
    
    // GET PRICE AND TIME FOR CHEAPEST FLIGHT
    
    // if the value is not set $iCheapestPrice = $jFlight->price

    $iCheapestPrice = $iCheapestPrice ?? $jFlight->price;
    $iCheapestTotalTime = $iCheapestTotalTime ?? $jFlight->totalTime;


    // If $iCheapestPrice is greater than $jFlight->price, 
    // change the variables for $iCheapestPrice and $sCheapestTotalTime

    if( $jFlight->price < $iCheapestPrice ) {

        $iCheapestPrice = $jFlight->price;
        $iCheapestTotalTime = $jFlight->totalTime;
    }
    $init = $iCheapestTotalTime;
    $hours = floor($init / 3600); 
    $minutes = floor(($init / 60) % 60);
    if($hours == 0) {
        $sCheapestTotalTime = $minutes.'min.';
    }else {
        $sCheapestTotalTime = $hours.'h. '.$minutes.'min.';
}
    
    // 
    // 
    // 
    // GET PRICE AND TIME FOR FASTEST FLIGHT

    // if the value is not set $iCheapestPrice = $jFlight->price
    $iFastestPrice = $iFastestPrice ?? $jFlight->price;
    $iFastestTotalTime = $iFastestTotalTime ?? $jFlight->totalTime;
    

    if( $jFlight->totalTime < $iFastestTotalTime) {
        $iFastestPrice = $jFlight->price;
        $iFastestTotalTime = $jFlight->totalTime;
    }


    $init = $iFastestTotalTime;
    $hours = floor($init / 3600); 
    $minutes = floor(($init / 60) % 60);
    if($hours == 0) {
        $sFastestTotalTime = $minutes.'min.';
    }else {
        $sFastestTotalTime = $hours.'h. '.$minutes.'min.';
    }
    $sDepartureDate = date("d-M-Y H:i", substr($jFlight->departureTime, 0, 10));
    $sHomeDate = date("d-M-Y H:i", substr($jFlight->homeDate, 0, 10));
    $init = $jFlight->totalTime;
    $hours = floor($init / 3600);
    $minutes = floor(($init / 60) % 60);
    if($hours == 0) {
        $iTotalTime = $minutes.'min.';
    }else {
        $iTotalTime = $hours.'h. '.$minutes.'min.';
    }

    if($jFlight->mostPopular === true) {

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
                            Direct
                        </div>
                        <div>
                            $iTotalTime
                            <p>$jFlight->fromShortcut - $jFlight->toShortcut</p>
                        </div>
                    </div>
                    <div class='row'>
                        <div>
                            <input type='checkbox'>
                        </div>
                        <div>
                            <img class='airlineIcon' src='icons/$jFlight->companyShortcut.png' alt=''>
                        </div>
                        <div>
                        $sHomeDate
                            <p>$jFlight->companyName</p>
                        </div>
                        <div>
                            Direct
                        </div>
                        <div>Total time
                            <p>$jFlight->toShortcut - $jFlight->fromShortcut</p>
                        </div>
                    </div>
                </div>
                <div id='flightBuy'>
                    <div>
                        $jFlight->price kr.
                    </div>
                    <button id='flight-$jFlight->id' onclick='checkFlightId(event)'>Buy</button>
                </div>
            </div>
        ";
    }
}
require_once('top.php');
?>
    <section id="search">
        <div id="boxFromCity">
            <input oninput="getCities('from')" id="txtSearchFromCity" type="text" placeholder="From city"></input>
            <div id="fromCityResults">
            </div>
        </div>
        <button id="btnSwitch" onclick="switchInput()">&lt;- -&gt;</button>
        <div id="boxToCity">
            <input oninput="getCities('to')" id="txtSearchToCity" type="text" placeholder="To city"></input>
            <div id="toCityResults">
            </div>
        </div>
        <input type="text" placeholder="From date"></input>
        <input type="text" placeholder="To date"></input>
        <button id="btnSearch" onclick="getSearchedFlights('from')">SEARCH</button>
    </section>
    <section id="temporal">
        <img src="screenshot.png" alt="">
    </section>
    <main>
        <div id="options">
            <div id="stops-div">
                Stops
                <div>
                    <input name="noStops" type="checkbox" checked><label for="noStops">Direct</label>
                </div>
                <div>
                    <input name="oneStop" type="checkbox"><label for="oneStop">1 stop</label>
                </div>
                <div>
                    <input name="twoStops" type="checkbox"><label for="twoStops">2 stops</label>
                </div>
            </div>
            <div id="price-div">
                Price
                <div>
                    <input oninput="rangePrice()" name="noStops" min="0" max="10000" id="price-slide" type="range">
                    <span id="range-price"></span>
                </div>
            </div>
        </div>
        <div id="results">
            <div id="priceOptions">
                <div id="cheapest">CHEAPEST
                    <p><span class="price"><?="$iCheapestPrice kr."?></span> <span class="time"><?=$sCheapestTotalTime ?></span></p>
                </div>
                <div id="best">BEST
                <p><span class="price">5000 kr.</span> <span class="time">15t. 00min.</span></p>
                </div>
                <div id="fastest">FASTEST
                <p><span class="price"><?="$iFastestPrice kr."?></span> <span class="time"><?=$sFastestTotalTime?></span></p>
                </div>
                <div class="active">CHOOSE YOURSELF
                <p>Compare and choose</p>
                </div>
            </div>
            <div id="flights">
                <?= $sFlightDiv ?>
            </div>
        </div>
        <?php
        require_once('modal.html');
        ?>
    </main>
    <script src="validate.js"></script>
    <script src="app.js"></script>
    
</body>
</html>