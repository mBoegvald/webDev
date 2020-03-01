<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="app.css" />
    <title>My trips</title>
  </head>
  <body>
    <?php
        require_once('nav.php');
    ?> 
    <input
      id="userLastname"
      name="txtLastname"
      type="text"
      placeholder="Lastname"
    />
    <input
      id="userBookingCode"
      name="txtBookingCode"
      type="text"
      placeholder="Bookingcode"
    />
    <button onclick="getUsersFlight()">See your trips</button>
    <div id="flights"></div>
    <script>
      async function getUsersFlight() {
        var usersLastname = userLastname.value;
        var usersBookingCode = userBookingCode.value;
        var sFlightsRoutes = "";
        var connection = await fetch("users.json");
        var jData = await connection.json();

        for (var i = 0; i < jData.users.length; i++) {
          if (
            usersLastname === jData.users[i].userLastname &&
            usersBookingCode === jData.users[i].bookingId
          ) {
            var epochTime = new Date(
              jData.users[i].bookings.departureTime * 1000
            );
            var months = [
              "Jan",
              "Feb",
              "Mar",
              "Apr",
              "May",
              "Jun",
              "Jul",
              "Aug",
              "Sep",
              "Oct",
              "Nov",
              "Dec"
            ]; // Array of months because in javascript months will be outputted as 0,1,2 etc.
            var year = epochTime.getFullYear();
            var month = months[epochTime.getMonth()];
            var date = epochTime.getDate();
            var hour = epochTime.getHours();
            var min = epochTime.getMinutes();
            var time = date + "-" + month + "-" + year + " " + hour + ":" + min;

            sFlightsRoutes += `<div id="flight">
            <div id="flightRoute">
                <div class="row">
            <div>
              <input type='checkbox'>
            </div>
            <div>
              <img class='airline-icon' src='icons/${jData.users[i].bookings.companyShortcut}.png'>
            </div>
            <div>
                ${time}
              <p>${jData.users[i].bookings.companyShortcut}</p>
            </div>
            <div>`;
            if (jData.users[i].length === 1) {
              sFlightsRoutes += `Direct`;
            } else {
              sFlightsRoutes += ` 1 stop
          <p>${jData.users[i].bookings.to}`;
            }
            sFlightsRoutes += `</p>
            </div>
            <div>

              <p>${jData.users[i].bookings.fromShortcut} - ${jData.users[i].bookings.toShortcut}</p>
            </div>
          </div>
        </div>
  </div>`;

            console.log("match");
            break;
          }
        }
        document.getElementById("flights").innerHTML = sFlightsRoutes;
      }
    </script>
  </body>
</html>
