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
        <a href="" class="active">Momondo</a>
        <a href="">Fly</a>
        <a href="">Hotel</a>
        <a href="">Car</a>
        <a href="">Trips</a>
        <a href="">Discover</a>
        <a href="">My trips</a>
        <a href="" class="active">Login</a>
    </nav>
    <section id="search">
        <input type="text" placeholder="From city"></input>
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
                <div>CHEAPEST
                    <p>2.761 kr 15t. 00min.</p>
                </div>
                <div>BEST
                <p>3.044 kr 12t. 47min.</p>
                </div>
                <div>FASTEST
                <p>13.761 kr 10t. 52min.</p>
                </div>
                <div class="active">CHOOSE YOURSELF
                <p>Compare and choose</p>
                </div>
            </div>
            <div id="flights">
                <div id="flight">
                    <div id="flightRoute">
                        <div>Check</div>
                        <div>
                            <img class="airlineIcon" src="icons/SK.png" alt="">
                        </div>
                        <div>Schedule</div>
                        <div>Stop</div>
                        <div>Total time</div>
                    </div>
                    <div id="flightBuy">
                        <button>Buy</button>
                    </div>
                </div>
                <div id="flight">
                    <div id="flightRoute">
                        <div>Check</div>
                        <div>
                            <img class="airlineIcon" src="icons/KL.png" alt="">
                        </div>
                        <div>Schedule</div>
                        <div>Stop</div>
                        <div>Total time</div>
                    </div>
                    <div id="flightBuy">
                        <button>Buy</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        async function getFlights() {
        var connection = await fetch("api/api-get-flights.php");
        var jData = await connection.json();
        var aOrderedSchedule = [];

        for (var i = 0; i < jData.length; i++) {
          for (var n = 0; n < jData[i].schedule.length; n++) {
            // console.log(jData[i].schedule[n]);
            // console.log("position in array", jData[i].schedule[n].order);
            aOrderedSchedule[jData[i].schedule[n].order] = jData[i].schedule;
          }
        }
        var sDivsWithStops = "";
        for (var i = 0; i < aOrderedSchedule.length; i++) {
            var flyingTime = 0;
            sDivsWithStops += `<b>Flight route</b>`;
            var startDate = new Date(0);
            startDate = setUTCSeconds(aOrderedSchedule[i][0].date)
            console.log(startDate);
            
            
            
          for (var n = 0; n < aOrderedSchedule[i].length; n++) {
            flyingTime = flyingTime + aOrderedSchedule[i][n].flightTime + aOrderedSchedule[i][n].waitingTime;
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
      getFlights();
    </script>
</body>
</html>